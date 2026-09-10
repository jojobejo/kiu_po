<script>
(function($) {
  'use strict';

  var csrfToken = <?= json_encode($csrf_token) ?>;
  var requestCode = <?= json_encode($request ? (string) $request->kd_po_jasa : '') ?>;
  var documents = [];
  var busy = false;
  var endpoints = {
    save: <?= json_encode(base_url('pojasa/ajax/pic/draft/save')) ?>,
    submit: <?= json_encode(base_url('pojasa/ajax/pic/submit')) ?>,
    upload: <?= json_encode(base_url('pojasa/ajax/pic/documents/upload')) ?>,
    removeDocument: <?= json_encode(base_url('pojasa/ajax/pic/documents/delete')) ?>,
    documents: <?= json_encode(base_url('pojasa/ajax/pic/documents/')) ?>
  };

  calculateAll();
  if (requestCode) {
    loadDocuments();
  }

  $('#vendorCode').on('change', function() {
    if ($(this).val()) {
      $('#vendorProposal').val('');
    }
  });
  $('#vendorProposal').on('input', function() {
    if ($.trim($(this).val()) !== '') {
      $('#vendorCode').val('');
    }
  });
  $('#documentFiles').on('change', function() {
    var count = this.files ? this.files.length : 0;
    var label = count === 1 ? this.files[0].name : (count > 1 ? count + ' file dipilih' : 'Pilih satu atau beberapa file');
    $(this).next('.custom-file-label').text(label);
  });

  $('#addScopeRow').on('click', function() {
    $('#scopeTable tbody').append($('#scopeRowTemplate').html());
  });
  $('#addMaterialRow').on('click', function() {
    $('#materialTable tbody').append($('#materialRowTemplate').html());
  });
  $(document).on('click', '.remove-line', function() {
    $(this).closest('tr').remove();
    calculateAll();
  });
  $(document).on('input change', '.line-qty, .line-price', calculateAll);

  $('#saveDraft').on('click', function() {
    saveDraft(false);
  });

  $('#submitRequest').on('click', function() {
    Swal.fire({
      title: 'Ajukan request?',
      text: 'Data terbaru akan disimpan, lalu request dikirim ke KADEP. Selama menunggu approval request tidak dapat diedit.',
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, simpan dan ajukan',
      cancelButtonText: 'Batal'
    }).then(function(result) {
      if (!result.value) {
        return;
      }
      saveDraft(true);
    });
  });

  $('#uploadDocuments').on('click', function() {
    var input = $('#documentFiles')[0];
    if (!requestCode) {
      Swal.fire('Simpan draft dahulu', 'Nomor request diperlukan sebelum upload dokumen.', 'warning');
      return;
    }
    if (!input.files || !input.files.length) {
      Swal.fire('Dokumen belum dipilih', 'Pilih minimal satu dokumen untuk diunggah.', 'warning');
      return;
    }
    for (var i = 0; i < input.files.length; i++) {
      if (input.files[i].size > 10 * 1024 * 1024) {
        Swal.fire('Ukuran file terlalu besar', input.files[i].name + ' melebihi maksimum 10 MB.', 'warning');
        return;
      }
    }
    var formData = new FormData();
    formData.append('kd_po_jasa', requestCode);
    formData.append('keterangan', $('#documentNote').val());
    formData.append('csrf_token', csrfToken);
    for (var fileIndex = 0; fileIndex < input.files.length; fileIndex++) {
      formData.append('documents[]', input.files[fileIndex]);
    }
    setBusy(true);
    $('#uploadProgress').removeClass('d-none').find('.progress-bar').css('width', '0%').text('0%');
    $.ajax({
      url: endpoints.upload,
      method: 'POST',
      data: formData,
      dataType: 'json',
      processData: false,
      contentType: false,
      headers: { 'X-POJASA-CSRF': csrfToken },
      xhr: function() {
        var xhr = $.ajaxSettings.xhr();
        if (xhr.upload) {
          xhr.upload.addEventListener('progress', function(event) {
            if (event.lengthComputable) {
              var percent = Math.round((event.loaded / event.total) * 100);
              $('#uploadProgress .progress-bar').css('width', percent + '%').text(percent + '%');
            }
          });
        }
        return xhr;
      }
    }).done(function(response) {
      updateCsrf(response);
      if (!response.success) {
        showResponseError(response);
        setBusy(false);
        return;
      }
      documents = (response.data && response.data.items) || [];
      renderDocuments(true);
      $('#documentFiles').val('').next('.custom-file-label').text('Pilih satu atau beberapa file');
      $('#documentNote').val('');
      Swal.fire('Berhasil', response.message, 'success');
    }).fail(function(xhr) {
      showAjaxError(xhr, 'Upload dokumen gagal.');
    }).always(function() {
      setBusy(false);
      setTimeout(function() { $('#uploadProgress').addClass('d-none'); }, 600);
    });
  });

  $(document).on('click', '.delete-document', function() {
    var id = Number($(this).data('id'));
    var name = String($(this).data('name') || 'dokumen');
    Swal.fire({
      title: 'Hapus dokumen?',
      text: name + ' akan diarsipkan dari draft.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal'
    }).then(function(result) {
      if (!result.value) {
        return;
      }
      post(endpoints.removeDocument, { id_dokumen: id }).done(function(response) {
        if (!response.success) {
          showResponseError(response);
          return;
        }
        documents = (response.data && response.data.items) || [];
        renderDocuments(true);
        Swal.fire('Terhapus', response.message, 'success');
      }).fail(function(xhr) {
        showAjaxError(xhr, 'Dokumen gagal dihapus.');
      });
    });
  });

  function saveDraft(andSubmit) {
    if (busy) {
      return;
    }
    if (andSubmit && !$('#vendorCode').val() && $.trim($('#vendorProposal').val()) === '') {
      Swal.fire('Vendor wajib ditentukan', 'Pilih vendor terdaftar atau isi nama vendor/toko secara manual.', 'warning');
      return;
    }
    setBusy(true);
    $.ajax({
      url: endpoints.save,
      method: 'POST',
      dataType: 'json',
      headers: { 'X-POJASA-CSRF': csrfToken },
      data: {
        csrf_token: csrfToken,
        payload: JSON.stringify(collectPayload())
      }
    }).done(function(response) {
      updateCsrf(response);
      if (!response.success) {
        showResponseError(response);
        return;
      }
      activateSavedDraft(response.data);
      if (andSubmit) {
        submitSavedRequest();
      } else {
        Swal.fire({ title: 'Draft tersimpan', text: response.message, icon: 'success', timer: 1600, showConfirmButton: false });
      }
    }).fail(function(xhr) {
      showAjaxError(xhr, 'Draft gagal disimpan.');
      if (andSubmit) {
        setBusy(false);
      }
    }).always(function() {
      if (!andSubmit) {
        setBusy(false);
      }
    });
  }

  function submitSavedRequest() {
    post(endpoints.submit, { kd_po_jasa: requestCode }).done(function(response) {
      updateCsrf(response);
      if (!response.success) {
        if (response.code === 'SUBMIT_VALIDATION' && response.errors && response.errors.documents) {
          Swal.fire('Dokumen wajib', escapeHtml(response.errors.documents), 'warning');
        } else {
          showResponseError(response);
        }
        return;
      }
      $('#requestStatusBadge').removeClass().addClass('badge badge-warning').text(response.data.status);
      disableEditor();
      Swal.fire({
        title: 'Request diajukan',
        text: response.message,
        icon: 'success',
        confirmButtonText: 'Lihat detail'
      }).then(function() {
        window.location.href = response.data.detail_url;
      });
    }).fail(function(xhr) {
      showAjaxError(xhr, 'Request gagal diajukan.');
    }).always(function() {
      setBusy(false);
    });
  }

  function activateSavedDraft(data) {
    requestCode = data.request_code;
    $('#requestCode').val(requestCode);
    $('#requestCodeLabel').text(requestCode);
    $('#requestStatusBadge').text(data.status);
    $('#documentDraftHint').addClass('d-none');
    $('#documentFiles, #documentNote, #uploadDocuments, #submitRequest').prop('disabled', false);
    if (data.edit_url && window.history && window.history.replaceState) {
      window.history.replaceState({}, document.title, data.edit_url);
    }
    calculateAll();
    loadDocuments();
  }

  function collectPayload() {
    var scopes = [];
    $('#scopeTable tbody tr').each(function() {
      scopes.push({
        nama_scope: $(this).find('.line-name').val(),
        deskripsi: $(this).find('.line-description').val(),
        qty: $(this).find('.line-qty').val(),
        satuan: $(this).find('.line-unit').val(),
        harga_estimasi: $(this).find('.line-price').val()
      });
    });
    var materials = [];
    $('#materialTable tbody tr').each(function() {
      materials.push({
        nama_material: $(this).find('.line-name').val(),
        deskripsi: $(this).find('.line-description').val(),
        qty_kebutuhan: $(this).find('.line-qty').val(),
        satuan: $(this).find('.line-unit').val(),
        harga_estimasi: $(this).find('.line-price').val()
      });
    });
    return {
      kd_po_jasa: requestCode,
      kd_vendor_jasa: $('#vendorCode').val(),
      vendor_usulan: $('#vendorProposal').val(),
      tujuan_pekerjaan: $('#workPurpose').val(),
      catatan_pic: $('#picNotes').val(),
      scopes: scopes,
      materials: materials
    };
  }

  function calculateAll() {
    var scope = calculateTable('#scopeTable');
    var material = calculateTable('#materialTable');
    $('#scopeTotal').text(formatRupiah(scope));
    $('#materialTotal').text(formatRupiah(material));
    $('#grandTotal').text(formatRupiah(scope + material));
  }

  function calculateTable(selector) {
    var total = 0;
    $(selector + ' tbody tr').each(function() {
      var qty = parseFloat($(this).find('.line-qty').val()) || 0;
      var price = parseFloat($(this).find('.line-price').val()) || 0;
      var subtotal = qty * price;
      total += subtotal;
      $(this).find('.line-subtotal').text(formatRupiah(subtotal));
    });
    return total;
  }

  function loadDocuments() {
    if (!requestCode) {
      return;
    }
    $.ajax({ url: endpoints.documents + encodeURIComponent(requestCode), method: 'GET', dataType: 'json' })
      .done(function(response) {
        updateCsrf(response);
        if (response.success) {
          documents = (response.data && response.data.items) || [];
          renderDocuments(response.data.can_edit);
        }
      }).fail(function(xhr) { showAjaxError(xhr, 'Daftar dokumen gagal dimuat.'); });
  }

  function renderDocuments(canEdit) {
    var list = $('#documentList').empty();
    if (!documents.length) {
      list.append($('<div>', { 'class': 'col-12 text-muted', text: 'Belum ada dokumen.' }));
      return;
    }
    documents.forEach(function(item) {
      var card = $('<div>', { 'class': 'col-md-4 mb-3' });
      var body = $('<div>', { 'class': 'border rounded p-2 h-100' });
      if (item.is_image) {
        body.append($('<a>', { href: item.view_url, target: '_blank' }).append($('<img>', { src: item.view_url, alt: item.name, 'class': 'img-fluid rounded mb-2', style: 'max-height:130px;width:100%;object-fit:cover' })));
      } else {
        body.append($('<div>', { 'class': 'text-center text-secondary py-3' }).append($('<i>', { 'class': 'fas fa-file-alt fa-3x' })));
      }
      body.append($('<div>', { 'class': 'font-weight-bold text-truncate', title: item.name, text: item.name }));
      body.append($('<small>', { 'class': 'text-muted d-block', text: item.size_label + ' · revisi ' + item.revision_no }));
      var buttons = $('<div>', { 'class': 'mt-2' }).append($('<a>', { href: item.view_url, target: '_blank', 'class': 'btn btn-xs btn-info mr-1', text: 'Lihat' }));
      if (canEdit) {
        buttons.append($('<button>', { type: 'button', 'class': 'btn btn-xs btn-danger delete-document', 'data-id': item.id_dokumen, 'data-name': item.name, text: 'Hapus' }));
      }
      body.append(buttons);
      list.append(card.append(body));
    });
  }

  function post(url, data) {
    data.csrf_token = csrfToken;
    return $.ajax({ url: url, method: 'POST', dataType: 'json', headers: { 'X-POJASA-CSRF': csrfToken }, data: data })
      .done(updateCsrf);
  }

  function updateCsrf(response) {
    if (response && response.data && response.data.csrf_token) {
      csrfToken = response.data.csrf_token;
    } else if (response && response.csrf_token) {
      csrfToken = response.csrf_token;
    }
  }

  function setBusy(state) {
    busy = state;
    $('#saveDraft, #submitRequest, #uploadDocuments').prop('disabled', state);
    if (!state && requestCode) {
      $('#saveDraft, #submitRequest, #uploadDocuments').prop('disabled', false);
    }
  }

  function disableEditor() {
    $('#pojasaPicForm :input, #scopeTable :input, #materialTable :input, #addScopeRow, #addMaterialRow, #saveDraft, #submitRequest, #documentFiles, #documentNote, #uploadDocuments, .delete-document').prop('disabled', true);
  }

  function showResponseError(response) {
    var errors = response.errors || {};
    var messages = Object.keys(errors).map(function(key) { return escapeHtml(errors[key]); });
    Swal.fire({ title: 'Data belum dapat diproses', html: messages.length ? messages.join('<br>') : escapeHtml(response.message || 'Aksi gagal.'), icon: response.code === 'SUBMIT_VALIDATION' || response.code === 'VALIDATION_ERROR' ? 'warning' : 'error' });
  }

  function showAjaxError(xhr, fallback) {
    var response = xhr.responseJSON || {};
    if (xhr.status === 401 && response.redirect) {
      window.location.href = response.redirect;
      return;
    }
    showResponseError({ code: response.code, message: response.message || fallback, errors: response.errors });
  }

  function formatRupiah(value) {
    return 'Rp ' + Math.round(Number(value) || 0).toLocaleString('id-ID');
  }

  function escapeHtml(value) {
    return $('<div>').text(value === null || value === undefined ? '' : value).html();
  }
})(jQuery);
</script>
