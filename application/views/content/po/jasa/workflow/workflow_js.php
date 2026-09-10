<script>
(function($) {
  'use strict';
  var csrfToken = <?= json_encode($csrf_token) ?>;
  var currentState = null;
  var selectedAction = '';
  var endpoints = {
    table: <?= json_encode(base_url('pojasa/ajax/workflow/requests')) ?>,
    state: <?= json_encode(base_url('pojasa/ajax/workflow/state/')) ?>,
    action: <?= json_encode(base_url('pojasa/ajax/approval/action')) ?>,
    review: <?= json_encode(base_url('pojasa/ajax/workflow/purchasing/save')) ?>,
    planning: <?= json_encode(base_url('pojasa/ajax/workflow/planning/')) ?>
  };
  var actionMeta = {
    ACC: { label: 'ACC', icon: 'fa-check', color: 'success' },
    REVISI: { label: 'REVISI', icon: 'fa-edit', color: 'warning' },
    PENDING: { label: 'PENDING', icon: 'fa-pause', color: 'secondary' },
    REJECT: { label: 'REJECT', icon: 'fa-times', color: 'danger' },
    SUBMIT: { label: 'AJUKAN', icon: 'fa-paper-plane', color: 'primary' }
  };

  var table = null;
  if ($('#workflowTable').length) {
    table = $('#workflowTable').DataTable({
      processing: true, serverSide: true, responsive: true, pageLength: 10, order: [[0, 'desc']],
      ajax: {
        url: endpoints.table, type: 'GET',
        data: function(data) {
          data.status = $('#workflowFilterStatus').val();
          data.date_from = $('#workflowDateFrom').val();
          data.date_to = $('#workflowDateTo').val();
        },
        dataSrc: function(response) { csrfToken = response.csrf_token || csrfToken; return response.data || []; },
        error: function(xhr) { showAjaxError(xhr, 'Daftar kerja gagal dimuat.'); }
      },
      columns: [
        { data: 'tgl_request' }, { data: 'kd_po_jasa' }, { data: 'pic' }, { data: 'departemen' },
        { data: 'vendor' }, { data: 'total', className: 'text-right' },
        { data: 'status', orderable: false }, { data: 'actions', orderable: false, searchable: false }
      ],
      language: { processing: 'Memuat data...', emptyTable: 'Tidak ada request dalam daftar kerja.', zeroRecords: 'Data tidak ditemukan.' }
    });
    $('#workflowFilter').on('submit', function(event) { event.preventDefault(); table.ajax.reload(); });
    $('#workflowFilterReset').on('click', function() { $('#workflowFilterStatus, #workflowDateFrom, #workflowDateTo').val(''); table.search('').ajax.reload(); });
  }

  $(document).on('click', '.btn-workflow-process', function() {
    loadState(String($(this).data('code') || ''), true);
  });

  $(document).on('click', '.workflow-action-choice', function() {
    selectedAction = String($(this).data('action') || '');
    $('#workflowSelectedAction').val(selectedAction);
    $('.workflow-action-choice').removeClass('active');
    $(this).addClass('active');
    var required = selectedAction === 'REVISI' || selectedAction === 'REJECT';
    $('#workflowNoteLabel').html('Catatan' + (required ? ' <span class="text-danger">*</span>' : ''));
    $('#workflowExecuteAction').prop('disabled', false).removeClass().addClass('btn btn-' + actionMeta[selectedAction].color);
  });

  $('#workflowExecuteAction').on('click', function() {
    if (!currentState || !selectedAction) {
      return;
    }
    var note = $.trim($('#workflowActionNote').val());
    if ((selectedAction === 'REVISI' || selectedAction === 'REJECT') && !note) {
      Swal.fire('Catatan wajib', 'Isi alasan sebelum menjalankan aksi ' + selectedAction + '.', 'warning');
      return;
    }
    var meta = actionMeta[selectedAction];
    Swal.fire({
      title: meta.label + ' request?',
      text: confirmationText(selectedAction, currentState.request),
      icon: selectedAction === 'REJECT' ? 'warning' : 'question',
      showCancelButton: true, confirmButtonText: 'Ya, proses', cancelButtonText: 'Batal',
      confirmButtonColor: selectedAction === 'REJECT' ? '#dc3545' : undefined
    }).then(function(result) {
      if (!result.value) { return; }
      executeAction(note);
    });
  });

  $('#workflowSavePurchasing').on('click', function() {
    var payload = { kd_vendor_jasa: $('#workflowPurchasingVendor').val(), note: $('#workflowPurchasingNote').val(), tgl_mulai_pekerjaan: $('#workflowStartDate').val(), tgl_selesai_pekerjaan: $('#workflowEndDate').val(), scopes: [], materials: [] };
    $('#workflowScopeTable tbody tr[data-line]').each(function() {
      payload.scopes.push({ line_no: Number($(this).data('line')), nama_scope: $(this).find('.workflow-name').val(), deskripsi: $(this).find('.workflow-description').val(), qty: $(this).find('.workflow-qty').val(), satuan: $(this).find('.workflow-unit').val(), harga_estimasi: $(this).find('.workflow-price').val(), keterangan_purchasing: $(this).find('.workflow-scope-note').val() });
    });
    $('#workflowMaterialTable tbody tr[data-line]').each(function() {
      payload.materials.push({ line_no: Number($(this).data('line')), nama_material: $(this).find('.workflow-name').val(), deskripsi: $(this).find('.workflow-description').val(), qty: $(this).find('.workflow-qty').val(), satuan: $(this).find('.workflow-unit').val(), harga_estimasi: $(this).find('.workflow-price').val() });
    });
    var button = $(this).prop('disabled', true);
    $.ajax({
      url: endpoints.review, method: 'POST', dataType: 'json', headers: { 'X-POJASA-CSRF': csrfToken },
      data: {
        csrf_token: csrfToken, kd_po_jasa: $('#workflowDetailCode').val(),
        expected_status: $('#workflowDetailExpectedStatus').val(), status_version: $('#workflowDetailVersion').val(),
        payload: JSON.stringify(payload)
      }
    }).done(function(response) {
      updateCsrf(response);
      if (!response.success) { showResponseError(response); return; }
      applyDetailState(response.data);
      if (response.data.totals) { renderTotals(response.data.totals); }
      Swal.fire({ title: 'Review tersimpan', text: response.message, icon: 'success', timer: 1700, showConfirmButton: false });
      $(document).trigger('pojasa:refresh-notifications');
    }).fail(function(xhr) { showAjaxError(xhr, 'Review Purchasing gagal disimpan.'); })
      .always(function() { button.prop('disabled', false); });
  });

  $(document).on('input', '#workflowScopeTable .workflow-price, #workflowScopeTable .workflow-qty, #workflowMaterialTable .workflow-price, #workflowMaterialTable .workflow-qty', previewTotals);

  $(document).on('click', '.workflow-document-preview', function() {
    var button = $(this), url = String(button.data('url') || ''), type = String(button.data('type') || '');
    $('#workflowDocumentTitle').text(button.data('title') || 'Preview dokumen');
    $('#workflowDocumentBody').html(type === 'pdf'
      ? '<iframe title="Preview PDF" src="' + escapeHtml(url) + '" style="width:100%;height:70vh;border:0"></iframe>'
      : '<img src="' + escapeHtml(url) + '" alt="Preview dokumen" class="img-fluid">');
    $('#workflowDocumentModal').modal('show');
  });
  $('#workflowDocumentModal').on('hidden.bs.modal', function() { $('#workflowDocumentBody').empty(); });

  $(document).on('click', '.workflow-planning-detail', function() {
    var row = $(this).closest('tr'), type = String($(this).data('type') || ''), materialId = Number(row.data('material'));
    $('#workflowPlanningHead').html(type === 'allocation' ? '<tr><th>Barang</th><th>Qty alokasi</th><th>Diterima/Dilepas</th><th>Status</th><th>Pembuat</th><th>Waktu/Riwayat</th></tr>' : '<tr><th>Vendor</th><th>Qty/Harga</th><th>Status</th><th>Keterangan</th><th>Pembuat</th><th>Waktu/Riwayat</th></tr>');
    $('#workflowPlanningBody').html('<tr><td colspan="6" class="text-center">Memuat...</td></tr>');
    $('#workflowPlanningModal').modal('show');
    $.ajax({ url: endpoints.planning + encodeURIComponent(type) + '/' + materialId, method: 'GET', dataType: 'json', data: { kd_po_jasa: $('#workflowDetailCode').val() } })
      .done(function(response) {
        updateCsrf(response); var body = $('#workflowPlanningBody').empty(), items = response.success ? (response.data.items || []) : [];
        if (!items.length) { body.html('<tr><td colspan="6" class="text-center text-muted">Belum ada data.</td></tr>'); return; }
        items.forEach(function(item) {
          body.append(type === 'allocation'
            ? '<tr><td>' + escapeHtml(item.nama_barang || item.kd_barang || '-') + '</td><td>' + escapeHtml(item.qty_allocation) + '</td><td>' + escapeHtml(item.qty_received) + ' / ' + escapeHtml(item.qty_released) + '</td><td>' + escapeHtml(item.status_allocation) + '</td><td>' + escapeHtml(item.created_name || '-') + '</td><td>' + escapeHtml(item.allocated_at || '-') + '<br><small>Versi ' + Number(item.version || 1) + (item.release_reason ? ' · ' + escapeHtml(item.release_reason) : '') + '</small></td></tr>'
            : '<tr><td>' + escapeHtml(item.nama_vendor || '-') + '</td><td>' + escapeHtml(item.qty) + ' · ' + formatRupiah(item.harga_estimasi) + '</td><td>' + escapeHtml(item.status_draft) + '</td><td>' + escapeHtml(item.keterangan || '-') + '</td><td>' + escapeHtml(item.created_name || '-') + '</td><td>' + escapeHtml(item.created_at || '-') + '<br><small>Versi ' + Number(item.version || 1) + (item.updated_at ? ' · diubah ' + escapeHtml(item.updated_at) : '') + (item.cancel_reason ? ' · ' + escapeHtml(item.cancel_reason) : '') + '</small></td></tr>');
        });
      }).fail(function(xhr) { $('#workflowPlanningModal').modal('hide'); showAjaxError(xhr, 'Detail pemenuhan gagal dimuat.'); });
  });

  function loadState(code, openModal) {
    if (!code) { return; }
    $('#workflowModalLoading').removeClass('d-none');
    $('#workflowModalContent').addClass('d-none');
    if (openModal) { $('#workflowActionModal').modal('show'); }
    $.ajax({ url: endpoints.state + encodeURIComponent(code), method: 'GET', dataType: 'json', cache: false })
      .done(function(response) {
        updateCsrf(response);
        if (!response.success) { $('#workflowActionModal').modal('hide'); showResponseError(response); return; }
        currentState = response.data;
        renderModal(response.data);
        if ($('#workflowDetailCode').val() === code) { applyDetailState(response.data); }
      }).fail(function(xhr) { $('#workflowActionModal').modal('hide'); showAjaxError(xhr, 'Status workflow gagal dimuat.'); });
  }

  function renderModal(state) {
    selectedAction = '';
    var request = state.request;
    $('#workflowModalCode').val(request.kd_po_jasa);
    $('#workflowModalStatus').val(request.status);
    $('#workflowModalVersion').val(request.status_version);
    $('#workflowSummaryCode').text(request.kd_po_jasa);
    $('#workflowSummaryPic').text(request.nm_user || '-');
    $('#workflowSummaryDepartment').text(request.departemen || '-');
    $('#workflowSummaryStatus').text(request.status);
    $('#workflowSummaryVendor').text(request.vendor || '-');
    $('#workflowSummaryTotal').text(formatRupiah(request.estimasi_total));
    $('#workflowSummaryPurpose').text(request.tujuan_pekerjaan || '-');
    $('#workflowOpenDetail').attr('href', state.detail_url);
    $('#workflowActionNote').val('');
    $('#workflowExecuteAction').prop('disabled', true).removeClass().addClass('btn btn-primary');
    var choices = $('#workflowActionChoices').empty();
    var actions = state.allowed_actions || [];
    var revisionBlocked = actions.indexOf('SUBMIT') !== -1 && !state.revision_ready;
    $('#workflowRevisionSaveHint').toggleClass('d-none', !revisionBlocked);
    if (!revisionBlocked) {
      actions.forEach(function(action) {
        var meta = actionMeta[action];
        if (!meta) { return; }
        choices.append('<button type="button" class="btn btn-outline-' + meta.color + ' mr-2 mb-2 workflow-action-choice" data-action="' + action + '"><i class="fas ' + meta.icon + ' mr-1"></i>' + meta.label + '</button>');
      });
    }
    if (!actions.length) { choices.html('<span class="text-muted">Tidak ada aksi untuk status dan role aktif.</span>'); }
    renderApprovalRows('#workflowModalHistory', state.approvals || [], 5, true);
    $('#workflowModalLoading').addClass('d-none');
    $('#workflowModalContent').removeClass('d-none');
  }

  function executeAction(note) {
    var button = $('#workflowExecuteAction').prop('disabled', true);
    $.ajax({
      url: endpoints.action, method: 'POST', dataType: 'json', headers: { 'X-POJASA-CSRF': csrfToken },
      data: {
        csrf_token: csrfToken, kd_po_jasa: currentState.request.kd_po_jasa,
        action: selectedAction, note: note, idempotency_token: uuid(),
        expected_status: currentState.request.status, status_version: currentState.request.status_version
      }
    }).done(function(response) {
      updateCsrf(response);
      if (!response.success) { showResponseError(response); if (response.code === 'CONCURRENT_UPDATE') { loadState(currentState.request.kd_po_jasa, false); } return; }
      var code = currentState.request.kd_po_jasa;
      $('#workflowActionModal').modal('hide');
      Swal.fire('Berhasil', response.message + (response.data.no_spk ? ' Nomor SPK: ' + response.data.no_spk : ''), 'success');
      if (table) { table.ajax.reload(null, false); }
      if ($('#workflowDetailCode').val() === code) { loadState(code, false); }
      $(document).trigger('pojasa:refresh-notifications');
    }).fail(function(xhr) { showAjaxError(xhr, 'Aksi workflow gagal diproses.'); })
      .always(function() { button.prop('disabled', false); });
  }

  function applyDetailState(state) {
    if (!state || !state.request || !$('#workflowDetailCode').length) { return; }
    $('#workflowDetailStatus').text(state.request.status);
    $('#workflowDetailVersion').val(state.request.status_version);
    $('#workflowDetailExpectedStatus').val(state.request.status);
    $('#workflowDetailRevision').text(state.request.revision_no);
    $('#workflowDetailVendor').text(state.request.vendor || '-');
    var actions = state.allowed_actions || [];
    $('#workflowDetailProcess').toggleClass('d-none', !actions.length).data('code', state.request.kd_po_jasa);
    (state.materials || []).forEach(function(material) {
      var row = $('#workflowMaterialTable tbody tr[data-line="' + Number(material.line_no) + '"]');
      row.find('.js-reserved').text(material.reserved_qty); row.find('.js-draft').text(material.active_draft_qty);
      row.find('.js-remaining').text(material.remaining_need); row.find('.js-source').text(material.computed_source);
      row.find('.js-fulfillment').text(material.fulfillment_status);
    });
    renderApprovalRows('#workflowDetailApprovals', state.approvals || [], 0, false);
    renderRevisionRows(state.revisions || []);
  }

  function renderApprovalRows(selector, rows, limit, modal) {
    var target = $(selector).empty();
    var items = limit ? rows.slice(0, limit) : rows;
    if (!items.length) { target.append('<tr><td colspan="' + (modal ? 5 : 6) + '" class="text-center text-muted">Belum ada approval.</td></tr>'); return; }
    items.forEach(function(row) {
      var cells = '<td>' + escapeHtml(row.created_at) + '</td><td>' + escapeHtml(row.approval_stage) + '</td><td>' + escapeHtml(row.action) + '</td><td>' + escapeHtml(row.from_status) + ' → ' + escapeHtml(row.to_status) + '</td>';
      if (!modal) { cells += '<td>' + escapeHtml(row.actor_code) + ' (' + escapeHtml(row.actor_role) + ')</td>'; }
      cells += '<td>' + escapeHtml(row.catatan || '-') + '</td>';
      target.append('<tr>' + cells + '</tr>');
    });
  }

  function renderRevisionRows(rows) {
    var target = $('#workflowDetailRevisions');
    if (!target.length) { return; }
    target.empty();
    if (!rows.length) { target.append('<tr><td colspan="5" class="text-center text-muted">Belum ada revisi.</td></tr>'); return; }
    rows.forEach(function(row) {
      target.append('<tr><td>' + Number(row.revision_no || 0) + '</td><td>' + escapeHtml(row.revision_source) + '</td><td>' + escapeHtml(row.requested_at) + '</td><td>' + escapeHtml(row.alasan_revisi) + '</td><td>' + escapeHtml(row.submitted_at || '-') + '</td></tr>');
    });
  }

  function previewTotals() {
    var scope = sumTable('#workflowScopeTable');
    var material = sumTable('#workflowMaterialTable');
    renderTotals({ jasa: scope, material: material, grand_total: scope + material });
  }

  function sumTable(selector) {
    var total = 0;
    $(selector + ' tbody tr[data-line]').each(function() {
      var qty = $(this).find('.workflow-qty').length ? Number($(this).find('.workflow-qty').val()) : (Number($(this).children('td').eq(2).text()) || 0);
      var price = Number($(this).find('.workflow-price').val()) || 0;
      total += qty * price;
    });
    return total;
  }

  function renderTotals(totals) {
    $('#workflowDetailScopeTotal').text(formatRupiah(totals.jasa));
    $('#workflowDetailMaterialTotal').text(formatRupiah(totals.material));
    $('#workflowDetailGrandTotal').text(formatRupiah(totals.grand_total));
  }

  function confirmationText(action, request) {
    if (action === 'ACC' && request.status === 'MENUNGGU_DIREKTUR') { return 'ACC Direktur akan langsung menerbitkan SPK secara otomatis.'; }
    if (action === 'PENDING') { return 'Request akan tetap terkunci untuk PIC sampai KADEP memberi tindakan lanjutan.'; }
    if (action === 'REVISI') { return 'Request akan dikembalikan ke pihak yang wajib melakukan perbaikan.'; }
    if (action === 'REJECT') { return 'Request akan masuk ke status penolakan terminal.'; }
    if (action === 'SUBMIT') { return 'Request akan diajukan langsung ke approver berikutnya sesuai jalur departemen.'; }
    return 'Status request akan diperbarui.';
  }

  function updateCsrf(response) {
    if (response && response.data && response.data.csrf_token) { csrfToken = response.data.csrf_token; }
    else if (response && response.csrf_token) { csrfToken = response.csrf_token; }
  }

  function showResponseError(response) {
    var errors = response.errors || {};
    var messages = Object.keys(errors).map(function(key) { return escapeHtml(errors[key]); });
    Swal.fire({ title: response.code === 'CONCURRENT_UPDATE' ? 'Data sudah berubah' : 'Aksi gagal', html: messages.length ? messages.join('<br>') : escapeHtml(response.message || 'Aksi tidak dapat diproses.'), icon: response.code === 'VALIDATION_ERROR' || response.code === 'NOTE_REQUIRED' ? 'warning' : 'error' });
  }

  function showAjaxError(xhr, fallback) {
    var response = xhr.responseJSON || {};
    if (xhr.status === 401 && response.redirect) { window.location.href = response.redirect; return; }
    showResponseError({ code: response.code, message: response.message || fallback, errors: response.errors });
  }

  function formatRupiah(value) { return 'Rp ' + Math.round(Number(value) || 0).toLocaleString('id-ID'); }
  function escapeHtml(value) { return $('<div>').text(value === null || value === undefined ? '' : value).html(); }
  function uuid() {
    if (window.crypto && window.crypto.getRandomValues) {
      var bytes = new Uint8Array(16); window.crypto.getRandomValues(bytes); bytes[6] = (bytes[6] & 15) | 64; bytes[8] = (bytes[8] & 63) | 128;
      return Array.prototype.map.call(bytes, function(byte, index) { return (index === 4 || index === 6 || index === 8 || index === 10 ? '-' : '') + ('0' + byte.toString(16)).slice(-2); }).join('');
    }
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(char) { var value = Math.random() * 16 | 0; return (char === 'x' ? value : (value & 3 | 8)).toString(16); });
  }
})(jQuery);
</script>
