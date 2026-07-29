<script>
    $(function() {
        var tablesReady = <?= $tables_ready ? 'true' : 'false' ?>;
        var requestTable = null;
        var vendorTable = null;

        var routes = {
            vendorData: "<?= base_url('pojasa/vendor/data') ?>",
            vendorSave: "<?= base_url('pojasa/vendor/save') ?>",
            vendorStatus: "<?= base_url('pojasa/vendor/status') ?>",
            requestData: "<?= base_url('pojasa/request/data') ?>",
            requestSave: "<?= base_url('pojasa/request/save') ?>",
            requestDetail: "<?= base_url('pojasa/request/detail') ?>",
            requestStatus: "<?= base_url('pojasa/request/status') ?>",
            summary: "<?= base_url('pojasa/summary') ?>"
        };

        function money(value) {
            var amount = parseFloat(value || 0);
            return 'Rp ' + amount.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        function numberValue(value) {
            var clean = String(value || '').replace(/[^0-9.\-]/g, '');
            var parsed = parseFloat(clean);
            return isNaN(parsed) ? 0 : parsed;
        }

        function statusBadge(status) {
            var map = {
                'DRAFT': 'secondary',
                'DIAJUKAN': 'info',
                'APPROVED KADEP': 'primary',
                'REJECT KADEP': 'danger',
                'REVIEW BIAYA': 'warning',
                'APPROVED DIREKTUR': 'success',
                'REJECT DIREKTUR': 'danger',
                'PO TERBIT': 'primary',
                'DALAM PELAKSANAAN': 'info',
                'SELESAI PIC': 'success',
                'CLOSED': 'success',
                'CANCEL': 'dark'
            };
            var color = map[status] || 'secondary';
            return '<span class="status-pill bg-' + color + '">' + escapeHtml(status || '-') + '</span>';
        }

        function vendorStatusBadge(status) {
            var color = status === 'AKTIF' ? 'success' : 'dark';
            return '<span class="status-pill bg-' + color + '">' + escapeHtml(status || '-') + '</span>';
        }

        function escapeHtml(value) {
            return $('<div>').text(value || '').html();
        }

        function ajaxError(xhr) {
            var response = xhr.responseJSON || {};
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: response.message || 'Tidak dapat terhubung ke server.'
            });
        }

        function addBiayaRow(jenis) {
            var html = '' +
                '<tr class="pojasa-row-fade">' +
                '<td>' +
                '<select class="form-control form-control-sm biaya-jenis">' +
                '<option value="JASA">JASA</option>' +
                '<option value="OPERASIONAL">OPERASIONAL</option>' +
                '<option value="BAHAN">BAHAN</option>' +
                '<option value="LAIN_LAIN">LAIN-LAIN</option>' +
                '</select>' +
                '</td>' +
                '<td><input type="text" class="form-control form-control-sm biaya-nama"></td>' +
                '<td><input type="number" min="0" step="0.01" class="form-control form-control-sm biaya-qty" value="1"></td>' +
                '<td><input type="text" class="form-control form-control-sm biaya-satuan" value="LS"></td>' +
                '<td><input type="number" min="0" step="0.01" class="form-control form-control-sm biaya-nominal" value="0"></td>' +
                '<td><button type="button" class="btn btn-danger btn-sm btn-remove-biaya"><i class="fas fa-times"></i></button></td>' +
                '</tr>';

            $('#table-biaya tbody').append(html);
            $('#table-biaya tbody tr:last .biaya-jenis').val(jenis || 'JASA');
            calculateTotal();
        }

        function resetBiayaRows() {
            $('#table-biaya tbody').empty();
            addBiayaRow('JASA');
            addBiayaRow('OPERASIONAL');
            addBiayaRow('BAHAN');
            addBiayaRow('LAIN_LAIN');
        }

        function collectBiayaRows() {
            var rows = [];
            $('#table-biaya tbody tr').each(function() {
                var row = $(this);
                var nama = row.find('.biaya-nama').val();
                var qty = numberValue(row.find('.biaya-qty').val());
                var nominal = numberValue(row.find('.biaya-nominal').val());

                if ($.trim(nama) !== '' || nominal > 0) {
                    rows.push({
                        jenis_biaya: row.find('.biaya-jenis').val(),
                        nama_biaya: nama,
                        keterangan_biaya: '',
                        qty: qty,
                        satuan: row.find('.biaya-satuan').val(),
                        nominal: nominal
                    });
                }
            });
            return rows;
        }

        function calculateTotal() {
            var total = 0;
            $('#table-biaya tbody tr').each(function() {
                var qty = numberValue($(this).find('.biaya-qty').val());
                var nominal = numberValue($(this).find('.biaya-nominal').val());
                total += qty * nominal;
            });

            var taxPercent = numberValue($('#request-tax').val());
            var tax = total * taxPercent / 100;
            $('#total-estimasi').text(money(total));
            $('#total-tax').text(money(tax));
            $('#grand-total').text(money(total + tax));
        }

        function loadVendorOptions() {
            if (!tablesReady) {
                return;
            }

            $.ajax({
                url: routes.vendorData,
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    var select = $('#request-kd-vendor');
                    select.empty();
                    select.append('<option value="">Pilih vendor jasa</option>');
                    $.each(res.data || [], function(_, vendor) {
                        if (vendor.status_vendor === 'AKTIF') {
                            select.append(
                                '<option value="' + escapeHtml(vendor.kd_vendor_jasa) + '">' +
                                escapeHtml(vendor.nama_vendor) + ' - ' + escapeHtml(vendor.kategori_jasa) +
                                '</option>'
                            );
                        }
                    });
                },
                error: ajaxError
            });
        }

        function initVendorTable() {
            vendorTable = $('#table-pojasa-vendor').DataTable({
                responsive: true,
                pageLength: 25,
                ajax: {
                    url: routes.vendorData,
                    type: 'GET',
                    dataSrc: function(res) {
                        return res.success ? res.data : [];
                    },
                    error: ajaxError
                },
                columns: [{
                        data: 'kd_vendor_jasa'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'kategori_jasa'
                    },
                    {
                        data: 'kontak_person'
                    },
                    {
                        data: 'no_telpon'
                    },
                    {
                        data: 'status_vendor',
                        render: function(data) {
                            return vendorStatusBadge(data);
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data) {
                            var next = data.status_vendor === 'AKTIF' ? 'NONAKTIF' : 'AKTIF';
                            return '' +
                                '<button type="button" class="btn btn-warning btn-sm btn-edit-vendor mr-1"><i class="fas fa-edit"></i></button>' +
                                '<button type="button" class="btn btn-info btn-sm btn-toggle-vendor" data-next="' + next + '"><i class="fas fa-power-off"></i></button>';
                        }
                    }
                ]
            });
        }

        function initRequestTable() {
            requestTable = $('#table-pojasa-request').DataTable({
                responsive: true,
                pageLength: 25,
                ajax: {
                    url: routes.requestData,
                    type: 'POST',
                    data: function(d) {
                        d.status = $('#filter-status').val();
                        d.tgl_awal = $('#filter-tgl-awal').val();
                        d.tgl_akhir = $('#filter-tgl-akhir').val();
                    },
                    dataSrc: function(res) {
                        return res.success ? res.data : [];
                    },
                    error: ajaxError
                },
                columns: [{
                        data: 'kd_pojasa'
                    },
                    {
                        data: 'tgl_request'
                    },
                    {
                        data: 'tgl_kebutuhan'
                    },
                    {
                        data: 'judul_jasa'
                    },
                    {
                        data: 'nama_vendor',
                        defaultContent: '-'
                    },
                    {
                        data: 'departemen'
                    },
                    {
                        data: 'nm_user'
                    },
                    {
                        data: 'total_estimasi',
                        render: function(data) {
                            return money(data);
                        }
                    },
                    {
                        data: 'status_request',
                        render: statusBadge
                    },
                    {
                        data: 'kd_pojasa',
                        orderable: false,
                        render: function(data) {
                            return '<button type="button" class="btn btn-primary btn-sm btn-detail-pojasa" data-kd="' + escapeHtml(data) + '"><i class="fas fa-eye"></i></button>';
                        }
                    }
                ]
            });
        }

        function reloadAll() {
            if (requestTable) {
                requestTable.ajax.reload(null, false);
            }
            if (vendorTable) {
                vendorTable.ajax.reload(null, false);
            }
            loadVendorOptions();
            loadSummary();
        }

        function loadSummary() {
            if (!tablesReady) {
                return;
            }

            $.ajax({
                url: routes.summary,
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    if (!res.success) {
                        return;
                    }
                    var data = res.summary || {};
                    $('#sum-diaju').text(data['DIAJUKAN'] || 0);
                    $('#sum-review').text(data['REVIEW BIAYA'] || 0);
                    $('#sum-proses').text(data['DALAM PELAKSANAAN'] || 0);
                    $('#sum-closed').text(data['CLOSED'] || 0);
                }
            });
        }

        function rowData(table, button) {
            var tr = $(button).closest('tr');
            if (tr.hasClass('child')) {
                tr = tr.prev();
            }
            return table.row(tr).data();
        }

        function resetVendorForm() {
            $('#form-pojasa-vendor')[0].reset();
            $('#vendor-id').val('');
        }

        function resetRequestForm() {
            $('#form-pojasa-request')[0].reset();
            resetBiayaRows();
        }

        function saveRequest(submitRequest) {
            var biaya = collectBiayaRows();

            if (!$('#request-kd-vendor').val()) {
                Swal.fire('Peringatan', 'Vendor jasa wajib dipilih.', 'warning');
                return;
            }
            if (!$('#request-judul').val() || !$('#request-kegiatan').val() || !$('#request-tgl').val()) {
                Swal.fire('Peringatan', 'Judul jasa, kegiatan vendor, dan tanggal kebutuhan wajib diisi.', 'warning');
                return;
            }
            if (biaya.length === 0) {
                Swal.fire('Peringatan', 'Minimal satu rincian biaya wajib diisi.', 'warning');
                return;
            }

            Swal.fire({
                title: submitRequest ? 'Ajukan PO Jasa?' : 'Simpan Draft?',
                text: 'Pastikan vendor, kegiatan, dan biaya sudah benar.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: submitRequest ? 'Ya, ajukan' : 'Ya, simpan',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (!result.isConfirmed) {
                    return;
                }

                var payload = $('#form-pojasa-request').serializeArray();
                payload.push({
                    name: 'biaya_json',
                    value: JSON.stringify(biaya)
                });
                payload.push({
                    name: 'submit_request',
                    value: submitRequest ? '1' : '0'
                });

                $.ajax({
                    url: routes.requestSave,
                    type: 'POST',
                    data: payload,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('Berhasil', res.message + ' Nomor: ' + res.kd_pojasa, 'success');
                            resetRequestForm();
                            reloadAll();
                            $('#tab-list-request').tab('show');
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: ajaxError
                });
            });
        }

        function renderDetail(res) {
            var req = res.request;
            var biayaHtml = '';
            var logHtml = '';

            $.each(res.biaya || [], function(_, row) {
                biayaHtml += '<tr>' +
                    '<td>' + escapeHtml(row.jenis_biaya) + '</td>' +
                    '<td>' + escapeHtml(row.nama_biaya) + '</td>' +
                    '<td class="text-right">' + numberValue(row.qty).toLocaleString('id-ID') + '</td>' +
                    '<td>' + escapeHtml(row.satuan) + '</td>' +
                    '<td class="text-right">' + money(row.nominal) + '</td>' +
                    '<td class="text-right">' + money(row.subtotal) + '</td>' +
                    '</tr>';
            });

            $.each(res.log || [], function(_, log) {
                logHtml += '<li>' +
                    '<strong>' + escapeHtml(log.aktivitas) + '</strong><br>' +
                    '<span>' + escapeHtml(log.status_dari || '-') + ' &rarr; ' + escapeHtml(log.status_ke || '-') + '</span><br>' +
                    '<small>' + escapeHtml(log.nama_user) + ' - ' + escapeHtml(log.created_at) + '</small>' +
                    '<div>' + escapeHtml(log.catatan || '') + '</div>' +
                    '</li>';
            });

            $('#detail-pojasa-content').html(
                '<div class="row">' +
                '<div class="col-md-7">' +
                '<table class="table table-sm table-bordered">' +
                '<tr><th style="width:180px;">Kode</th><td>' + escapeHtml(req.kd_pojasa) + '</td></tr>' +
                '<tr><th>Status</th><td>' + statusBadge(req.status_request) + '</td></tr>' +
                '<tr><th>Judul</th><td>' + escapeHtml(req.judul_jasa) + '</td></tr>' +
                '<tr><th>Vendor</th><td>' + escapeHtml(req.nama_vendor || '-') + '</td></tr>' +
                '<tr><th>User PIC</th><td>' + escapeHtml(req.nm_user) + ' / ' + escapeHtml(req.departemen) + '</td></tr>' +
                '<tr><th>Tgl Kebutuhan</th><td>' + escapeHtml(req.tgl_kebutuhan) + '</td></tr>' +
                '<tr><th>Lokasi</th><td>' + escapeHtml(req.lokasi_jasa) + '</td></tr>' +
                '<tr><th>Kegiatan</th><td>' + escapeHtml(req.kegiatan_jasa) + '</td></tr>' +
                '<tr><th>Alasan</th><td>' + escapeHtml(req.alasan_kebutuhan) + '</td></tr>' +
                '<tr><th>Total</th><td><strong>' + money(req.grand_total) + '</strong></td></tr>' +
                '</table>' +
                '<div class="table-responsive"><table class="table table-bordered table-sm">' +
                '<thead><tr><th>Jenis</th><th>Nama</th><th>Qty</th><th>Satuan</th><th>Nominal</th><th>Subtotal</th></tr></thead>' +
                '<tbody>' + biayaHtml + '</tbody></table></div>' +
                '</div>' +
                '<div class="col-md-5"><h5>Histori Aktivitas</h5><ul class="timeline">' + logHtml + '</ul></div>' +
                '</div>'
            );

            var select = $('#detail-action');
            select.empty();
            $.each(res.actions || {}, function(key, action) {
                select.append('<option value="' + escapeHtml(key) + '">' + escapeHtml(action.label) + '</option>');
            });

            if (select.find('option').length === 0) {
                select.append('<option value="">Tidak ada aksi tersedia</option>');
                $('#btn-update-status').prop('disabled', true);
            } else {
                $('#btn-update-status').prop('disabled', false);
            }
        }

        if (!tablesReady) {
            resetBiayaRows();
            Swal.fire({
                icon: 'warning',
                title: 'Database PO Jasa belum siap',
                text: 'Import SQL migration PO Jasa sebelum memakai modul ini.'
            });
            return;
        }

        resetBiayaRows();
        initVendorTable();
        initRequestTable();
        loadVendorOptions();
        loadSummary();

        $('#btn-add-biaya').on('click', function() {
            addBiayaRow('JASA');
        });

        $('#table-biaya').on('click', '.btn-remove-biaya', function() {
            $(this).closest('tr').remove();
            calculateTotal();
        });

        $('#table-biaya, #request-tax').on('input change', 'input, select', calculateTotal);
        $('#request-tax').on('input change', calculateTotal);

        $('#btn-save-draft').on('click', function() {
            saveRequest(false);
        });

        $('#btn-submit-request').on('click', function() {
            saveRequest(true);
        });

        $('#btn-filter-request').on('click', function() {
            requestTable.ajax.reload();
        });

        $('#btn-save-vendor').on('click', function() {
            $.ajax({
                url: routes.vendorSave,
                type: 'POST',
                data: $('#form-pojasa-vendor').serialize(),
                dataType: 'JSON',
                success: function(res) {
                    if (res.success) {
                        Swal.fire('Berhasil', res.message, 'success');
                        resetVendorForm();
                        reloadAll();
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                },
                error: ajaxError
            });
        });

        $('#btn-reset-vendor').on('click', resetVendorForm);

        $('#table-pojasa-vendor').on('click', '.btn-edit-vendor', function() {
            var data = rowData(vendorTable, this);
            $('#vendor-id').val(data.id_vendor_jasa);
            $('#vendor-nama').val(data.nama_vendor);
            $('#vendor-kategori').val(data.kategori_jasa);
            $('#vendor-alamat').val(data.alamat_vendor || '');
            $('#vendor-kontak').val(data.kontak_person || '');
            $('#vendor-telpon').val(data.no_telpon || '');
            $('#vendor-email').val(data.email || '');
            $('#vendor-npwp').val(data.npwp || '');
        });

        $('#table-pojasa-vendor').on('click', '.btn-toggle-vendor', function() {
            var data = rowData(vendorTable, this);
            var next = $(this).data('next');

            Swal.fire({
                title: 'Ubah status vendor?',
                text: data.nama_vendor + ' menjadi ' + next,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (!result.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: routes.vendorStatus,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id_vendor_jasa: data.id_vendor_jasa,
                        status_vendor: next
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('Berhasil', res.message, 'success');
                            reloadAll();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: ajaxError
                });
            });
        });

        $('#table-pojasa-request').on('click', '.btn-detail-pojasa', function() {
            var kd = $(this).data('kd');
            $('#detail-kd-pojasa').val(kd);
            $('#detail-catatan').val('');

            $.ajax({
                url: routes.requestDetail + '/' + kd,
                type: 'GET',
                dataType: 'JSON',
                success: function(res) {
                    if (res.success) {
                        renderDetail(res);
                        $('#modal-pojasa-detail').modal('show');
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                },
                error: ajaxError
            });
        });

        $('#btn-update-status').on('click', function() {
            var action = $('#detail-action').val();
            if (!action) {
                Swal.fire('Peringatan', 'Tidak ada aksi status yang tersedia.', 'warning');
                return;
            }

            Swal.fire({
                title: 'Update status?',
                text: 'Aktivitas ini akan tercatat di histori PO Jasa.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, update',
                cancelButtonText: 'Batal'
            }).then(function(result) {
                if (!result.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: routes.requestStatus,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        kd_pojasa: $('#detail-kd-pojasa').val(),
                        action: action,
                        catatan: $('#detail-catatan').val()
                    },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('Berhasil', res.message, 'success');
                            $('#modal-pojasa-detail').modal('hide');
                            reloadAll();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: ajaxError
                });
            });
        });
    });
</script>
