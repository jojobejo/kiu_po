<script>
    $(function() {
        if ($.fn.DataTable) {
            $('#tbPojasa, #tbVendorJasa, #tbNotePojasa, #tbProgressPojasa, #tbFilePojasa, #tbBiayaPojasa, #tbPaymentPojasa, #tbReportDonePojasa, #tbVendorPerformancePojasa').DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                pageLength: 10
            });
        }

        function formatRupiah(value) {
            var number = Number(value || 0);
            return 'Rp. ' + number.toLocaleString('id-ID', {
                maximumFractionDigits: 0
            });
        }

        function recalculateScope() {
            var grandTotal = 0;
            $('#tbScopeJasa tbody tr').each(function() {
                var qty = Number($(this).find('.scope-qty').val() || 0);
                var price = Number($(this).find('.scope-price').val() || 0);
                var total = qty * price;
                grandTotal += total;
                $(this).find('.scope-total').val(formatRupiah(total));
            });
            $('#grandTotalScopeJasa').text(formatRupiah(grandTotal));
        }

        $('#btnAddScopeJasa').on('click', function() {
            var row = $('#tbScopeJasa tbody tr:first').clone();
            row.find('input').val('');
            row.find('.scope-qty').val('1');
            row.find('[name="satuan[]"]').val('Lot');
            row.find('.scope-price').val('0');
            row.find('.scope-total').val('0');
            $('#tbScopeJasa tbody').append(row);
            recalculateScope();
        });

        $(document).on('click', '.btnRemoveScopeJasa', function() {
            if ($('#tbScopeJasa tbody tr').length > 1) {
                $(this).closest('tr').remove();
                recalculateScope();
            }
        });

        $(document).on('input', '.scope-qty, .scope-price', recalculateScope);
        recalculateScope();

        $('.btnAddEditorScopePojasa').on('click', function() {
            var table = $(this).closest('form').find('.tbScopeEditorPojasa tbody');
            var row = table.find('tr:first').clone();
            row.find('input').val('');
            row.find('[name="qty[]"]').val('1');
            row.find('[name="satuan[]"]').val('Lot');
            row.find('[name="hrg_satuan[]"]').val('0');
            table.append(row);
        });

        $(document).on('click', '.btnRemoveEditorScopePojasa', function() {
            var tbody = $(this).closest('tbody');
            if (tbody.find('tr').length > 1) {
                $(this).closest('tr').remove();
            }
        });

        function recalculateSelisihBiaya() {
            var estimasi = Number($('.biaya-estimasi').val() || 0);
            var realisasi = Number($('.biaya-realisasi').val() || 0);
            $('#selisihBiayaPojasa').text(formatRupiah(realisasi - estimasi));
        }

        $(document).on('input', '.biaya-estimasi, .biaya-realisasi', recalculateSelisihBiaya);
        recalculateSelisihBiaya();

        function recalculatePayment() {
            var tagihan = Number($('.payment-tagihan').val() || 0);
            var bayar = Number($('.payment-bayar').val() || 0);
            $('#sisaPaymentPojasa').text(formatRupiah(tagihan - bayar));
        }

        function recalculateEvaluation() {
            var total = 0;
            var count = 0;
            $('.eval-score').each(function() {
                total += Number($(this).val() || 0);
                count++;
            });
            var avg = count > 0 ? total / count : 0;
            $('#avgEvaluationPojasa').text(avg.toFixed(2));
        }

        $(document).on('input', '.payment-tagihan, .payment-bayar', recalculatePayment);
        $(document).on('input', '.eval-score', recalculateEvaluation);
        recalculatePayment();
        recalculateEvaluation();

        function showMessage(success, message, redirect) {
            if (typeof Swal !== 'undefined') {
                Swal.fire(success ? 'Berhasil' : 'Gagal', message, success ? 'success' : 'error').then(function() {
                    if (success && redirect) {
                        window.location.href = redirect;
                    } else if (success) {
                        window.location.reload();
                    }
                });
            } else {
                alert(message);
                if (success && redirect) {
                    window.location.href = redirect;
                } else if (success) {
                    window.location.reload();
                }
            }
        }

        function postForm(url, data) {
            $.ajax({
                url: url,
                method: 'POST',
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Memproses',
                            allowOutsideClick: false,
                            didOpen: function() {
                                Swal.showLoading();
                            }
                        });
                    }
                },
                success: function(response) {
                    showMessage(response.success || response.status, response.message || 'Proses selesai.', response.redirect);
                },
                error: function() {
                    showMessage(false, 'Terjadi gangguan koneksi atau server tidak mengembalikan JSON.');
                }
            });
        }

        function postMultipart(url, form) {
            $.ajax({
                url: url,
                method: 'POST',
                data: new FormData(form),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Mengupload',
                            allowOutsideClick: false,
                            didOpen: function() {
                                Swal.showLoading();
                            }
                        });
                    }
                },
                success: function(response) {
                    showMessage(response.success || response.status, response.message || 'Upload selesai.', response.redirect);
                },
                error: function() {
                    showMessage(false, 'Upload gagal atau server tidak mengembalikan JSON.');
                }
            });
        }

        $('#formAddVendorJasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/vendor/save') ?>', $(this).serialize());
        });

        $('#formRequestVendorJasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/vendor/save') ?>', $(this).serialize());
        });

        $('.formEditVendorJasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/vendor/update') ?>', $(this).serialize());
        });

        $('.btnApproveVendorJasa, .btnRejectVendorJasa').on('click', function() {
            var kdVendor = $(this).data('kd-vendor');
            var action = $(this).hasClass('btnApproveVendorJasa') ? 'approve' : 'reject';
            var title = action === 'approve' ? 'ACC request vendor jasa?' : 'Tolak request vendor jasa?';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: title,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Proses',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        postForm('<?= base_url('pojasa/vendor/approval') ?>', {
                            kd_vendor_jasa: kdVendor,
                            action: action
                        });
                    }
                });
            } else if (confirm(title)) {
                postForm('<?= base_url('pojasa/vendor/approval') ?>', {
                    kd_vendor_jasa: kdVendor,
                    action: action
                });
            }
        });

        $('.btnDeleteVendorJasa').on('click', function() {
            var kdVendor = $(this).data('kd-vendor');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Hapus vendor jasa?',
                    text: 'Vendor yang sudah dipakai pada request tidak dapat dihapus.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        postForm('<?= base_url('pojasa/vendor/delete') ?>', {
                            kd_vendor_jasa: kdVendor
                        });
                    }
                });
            } else if (confirm('Hapus vendor jasa?')) {
                postForm('<?= base_url('pojasa/vendor/delete') ?>', {
                    kd_vendor_jasa: kdVendor
                });
            }
        });

        $('#formRequestPojasa').on('submit', function(e) {
            e.preventDefault();
            postMultipart('<?= base_url('pojasa/request/save') ?>', this);
        });

        $('#formRevisePojasa').on('submit', function(e) {
            e.preventDefault();
            postMultipart('<?= base_url('pojasa/request/revise') ?>', this);
        });

        $('#formReviewScopePojasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/scope/save') ?>', $(this).serialize());
        });

        $('.btnApprovalPojasa').on('click', function() {
            var kdPo = $(this).data('kd-po');
            var action = $(this).data('action');
            var note = '';

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Proses approval PO Jasa?',
                    input: 'textarea',
                    inputLabel: 'Catatan',
                    inputPlaceholder: 'Opsional, isi alasan pending/reject atau catatan approval',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Proses',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        note = result.value || '';
                        postForm('<?= base_url('pojasa/approval') ?>', {
                            kd_po_jasa: kdPo,
                            action: action,
                            note: note
                        });
                    }
                });
            } else if (confirm('Proses approval PO Jasa?')) {
                postForm('<?= base_url('pojasa/approval') ?>', {
                    kd_po_jasa: kdPo,
                    action: action,
                    note: note
                });
            }
        });

        $('.btnGenerateSpkPojasa').on('click', function() {
            var kdPo = $(this).data('kd-po');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Generate PO/SPK Jasa?',
                    text: 'Nomor SPK akan diterbitkan setelah ACC DIREKTUR.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Generate',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        postForm('<?= base_url('pojasa/generate-spk') ?>', {
                            kd_po_jasa: kdPo
                        });
                    }
                });
            } else if (confirm('Generate PO/SPK Jasa?')) {
                postForm('<?= base_url('pojasa/generate-spk') ?>', {
                    kd_po_jasa: kdPo
                });
            }
        });

        $('#formProgressPojasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/progress/save') ?>', $(this).serialize());
        });

        $('#formUploadFilePojasa').on('submit', function(e) {
            e.preventDefault();
            postMultipart('<?= base_url('pojasa/file/upload') ?>', this);
        });

        $('#formBiayaPojasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/biaya/save') ?>', $(this).serialize());
        });

        $('#formBastPojasa').on('submit', function(e) {
            e.preventDefault();
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Selesaikan project jasa?',
                    text: 'Status PO Jasa akan menjadi DONE.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Selesaikan',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        postForm('<?= base_url('pojasa/bast/complete') ?>', $('#formBastPojasa').serialize());
                    }
                });
            } else if (confirm('Selesaikan project jasa?')) {
                postForm('<?= base_url('pojasa/bast/complete') ?>', $(this).serialize());
            }
        });

        $('#formPaymentPojasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/payment/save') ?>', $(this).serialize());
        });

        $('#formEvaluationPojasa').on('submit', function(e) {
            e.preventDefault();
            postForm('<?= base_url('pojasa/evaluation/save') ?>', $(this).serialize());
        });
    });
</script>
