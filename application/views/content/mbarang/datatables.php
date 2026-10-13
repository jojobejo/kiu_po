<script>
    $(function() {
        $("#list_mbarangnk").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": [],
        }).buttons().container().appendTo('#list_mbarangnk_wrapper .col-md-6:eq(0)');

        $('#editbarang').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            $('#edit_id_isi').val(button.attr('data-id'));
            $('#edit_kd_adm').val(button.attr('data-kd-adm'));
            $('#edit_skatbr').val(button.attr('data-kategori'));
            $('#edit_nmbarang').val(button.attr('data-nama'));
            $('#edit_descisi').val(button.attr('data-desc'));
            $('#edit_stuanbr').val(button.attr('data-satuan'));
            $('#edit_minimum_stock').val(button.attr('data-minimum-stock'));
        });

        $('#hapusbarang').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            $('#delete_id_isi').val(button.attr('data-id'));
            $('#delete_barang_name').text(button.attr('data-nama'));
        });

        $('#uploadmbrang').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);

            $('#upload_id_isi').val(button.attr('data-id'));
            $('#upload_file_nm').val(button.attr('data-file'));
            $('#upload_file_nms').val(button.attr('data-kd-adm'));
            $('#upload_gambar_1').val('');
            $('#uploadmbrang .custom-file-label').text('Choose file');
        });

        var kodeBarangCheckTimer = null;
        var kodeBarangIsUsed = false;
        var kodeBarangRequest = null;

        function setKodeBarangState(state, message) {
            var input = $('#add_kd_adm');
            var feedback = $('#add_kd_adm_feedback');
            var submitButton = $('#add_mbarang_submit');

            input.removeClass('is-invalid is-valid');
            feedback.removeClass('d-none text-danger text-success text-muted');

            if (state === 'used') {
                input.addClass('is-invalid');
                feedback.addClass('text-danger').text(message);
                submitButton.prop('disabled', true);
                kodeBarangIsUsed = true;
                return;
            }

            if (state === 'available') {
                input.addClass('is-valid');
                feedback.addClass('text-success').text(message);
                submitButton.prop('disabled', false);
                kodeBarangIsUsed = false;
                return;
            }

            if (state === 'checking') {
                feedback.addClass('text-muted').text(message);
                submitButton.prop('disabled', true);
                kodeBarangIsUsed = false;
                return;
            }

            feedback.addClass('d-none').text('');
            submitButton.prop('disabled', false);
            kodeBarangIsUsed = false;
        }

        $('#add_kd_adm').on('input', function() {
            var input = $(this);
            var kodeBarang = $.trim(input.val());
            var checkUrl = input.attr('data-check-url');

            clearTimeout(kodeBarangCheckTimer);

            if (kodeBarangRequest) {
                kodeBarangRequest.abort();
                kodeBarangRequest = null;
            }

            if (kodeBarang === '') {
                setKodeBarangState('empty', '');
                return;
            }

            setKodeBarangState('checking', 'Memeriksa kode barang...');

            kodeBarangCheckTimer = setTimeout(function() {
                kodeBarangRequest = $.ajax({
                    url: checkUrl,
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        kd_barang: kodeBarang
                    },
                    success: function(response) {
                        if (response && response.used) {
                            setKodeBarangState('used', 'Kode barang telah di gunakan dengan nama barang: ' + response.nama_barang);
                            return;
                        }

                        setKodeBarangState('available', 'Kode barang dapat digunakan.');
                    },
                    error: function(xhr, status) {
                        if (status === 'abort') {
                            return;
                        }

                        setKodeBarangState('empty', '');
                    },
                    complete: function() {
                        kodeBarangRequest = null;
                    }
                });
            }, 350);
        });

        $('#addmbarangnk').on('hidden.bs.modal', function() {
            clearTimeout(kodeBarangCheckTimer);

            if (kodeBarangRequest) {
                kodeBarangRequest.abort();
                kodeBarangRequest = null;
            }

            setKodeBarangState('empty', '');
        });

        $('#form_add_mbarang').on('submit', function(event) {
            if (kodeBarangIsUsed) {
                event.preventDefault();
                $('#add_kd_adm').focus();
            }
        });
    });
    $(function() {
        $("#list_req").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "aaSorting": [],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
