<script>
    $(function() {
        if ($("#list_mbarangkomersil").length) {
            var $tableKomersil = $("#list_mbarangkomersil");
            $tableKomersil.DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "autoWidth": false,
                "aaSorting": [],
                "ajax": {
                    "url": $tableKomersil.data("ajax-url"),
                    "type": "GET"
                },
                "columns": [{
                        "data": "kode_barang",
                        "render": escHtml
                    },
                    {
                        "data": "nama_barang",
                        "render": escHtml
                    },
                    {
                        "data": "bahan_aktif",
                        "render": escHtml
                    },
                    {
                        "data": "nm_satuan",
                        "render": escHtml
                    },
                    {
                        "data": "nama_suplier",
                        "render": escHtml
                    },
                    {
                        "data": "panjang",
                        "render": formatNumber
                    },
                    {
                        "data": "lebar",
                        "render": formatNumber
                    },
                    {
                        "data": "tinggi",
                        "render": formatNumber
                    },
                    {
                        "data": "stock_minimum",
                        "render": formatNumber
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "render": function(_, __, row) {
                            var id = escHtml(row.id_barang);
                            return '<a class="btn btn-info btn-sm" href="' + $tableKomersil.data("detail-url") + id + '" title="Detail"><i class="fas fa-eye"></i></a>';
                        }
                    }
                ],
                "language": {
                    "processing": "Memuat data...",
                    "emptyTable": "Belum ada data barang komersil.",
                    "zeroRecords": "Data tidak ditemukan."
                }
            });

            function escHtml(text) {
                if (text === null || text === undefined) return "";
                return $("<div>").text(text).html();
            }

            function formatNumber(value) {
                var number = parseFloat(value || 0);
                return Number.isInteger(number) ? number.toString() : number.toFixed(2);
            }
        }

        if ($("#detail_barang_komersil").length) {
            var $detailKomersil = $("#detail_barang_komersil");

            function escHtml(text) {
                if (text === null || text === undefined) return "";
                return $("<div>").text(text).html();
            }

            function showAlert(type, title, message) {
                if (typeof Swal !== "undefined") {
                    Swal.fire({
                        icon: type,
                        title: title,
                        text: message,
                        timer: type === "success" ? 1600 : undefined,
                        showConfirmButton: type !== "success"
                    });
                    return;
                }

                alert(message);
            }

            function loadBarangKomersil(callback) {
                $.ajax({
                    url: $detailKomersil.data("get-url") + $detailKomersil.data("id"),
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response && response.status) {
                            callback(response.data);
                            return;
                        }

                        showAlert("error", "Gagal", response && response.message ? response.message : "Data tidak dapat dibuka.");
                    },
                    error: function(xhr) {
                        var response = xhr.responseJSON || {};
                        showAlert("error", "Gagal", response.message || "Data tidak dapat dibuka.");
                    }
                });
            }

            function updateDetailView(data) {
                $('[data-field="kode_barang"]').text(data.kode_barang || "");
                $('[data-field="nama_barang"]').text(data.nama_barang || "");
                $('[data-field="bahan_aktif"]').text(data.bahan_aktif || "");
                $('[data-field="nm_satuan"]').text(data.nm_satuan || data.satuan || "");
                $('[data-field="merk_barang"]').text(data.merk_barang || "");
                $('[data-field="stock_minimum"]').text(data.stock_minimum || 0);
                $('[data-field="panjang"]').text(data.panjang || 0);
                $('[data-field="lebar"]').text(data.lebar || 0);
                $('[data-field="tinggi"]').text(data.tinggi || 0);
                $('[data-field="berat"]').text(data.berat || 0);
                $('[data-field="isi"]').text(data.isi || 0);
                $('[data-field="kemasan"]').text(data.kemasan || 0);
                $('[data-field="is_active_label"]').text(data.is_active === "F" ? "Nonaktif" : "Aktif");
                $('[data-field="kelompok_barang"]').text(data.kelompok_barang || "");
                $('[data-field="kategori_barang"]').text(data.kategori_barang || "");
                $('[data-field="produk_fokus"]').text(data.produk_fokus || "");
                $('[data-field="kd_suplier"]').text(data.kd_suplier || "");
                $('[data-field="nama_suplier"]').text(data.nama_suplier || "");
                $("#detail_satuan_options").val(data.satuan || data.nm_satuan || "");
            }

            function editBarangKomersil(data) {
                if (typeof Swal === "undefined") {
                    showAlert("error", "Gagal", "SweetAlert2 belum tersedia.");
                    return;
                }

                var satuanOptions = $("#detail_satuan_options").html();
                Swal.fire({
                    title: "Edit Barang Komersil",
                    width: 900,
                    html: '<div class="text-left">' +
                        '<div class="row">' +
                        '<div class="col-md-4 form-group"><label>Kode Barang</label><input id="swal_kode_barang" class="form-control" value="' + escHtml(data.kode_barang) + '"></div>' +
                        '<div class="col-md-8 form-group"><label>Nama Barang</label><input id="swal_nama_barang" class="form-control" value="' + escHtml(data.nama_barang) + '"></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-6 form-group"><label>Bahan Aktif</label><input id="swal_bahan_aktif" class="form-control" value="' + escHtml(data.bahan_aktif) + '"></div>' +
                        '<div class="col-md-3 form-group"><label>Satuan</label><select id="swal_satuan" class="form-control">' + satuanOptions + '</select></div>' +
                        '<div class="col-md-3 form-group"><label>Merk</label><input id="swal_merk_barang" class="form-control" value="' + escHtml(data.merk_barang) + '"></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-3 form-group"><label>Stock Min</label><input type="number" id="swal_stock_minimum" class="form-control" min="0" value="' + escHtml(data.stock_minimum) + '"></div>' +
                        '<div class="col-md-3 form-group"><label>Status</label><select id="swal_is_active" class="form-control"><option value="T">Aktif</option><option value="F">Nonaktif</option></select></div>' +
                        '<div class="col-md-6 form-group"><label>Supplier</label><input class="form-control" value="' + escHtml(data.nama_suplier || data.kd_suplier) + '" disabled></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-3 form-group"><label>Panjang</label><input type="number" id="swal_panjang" class="form-control" min="0" step="0.01" value="' + escHtml(data.panjang) + '"></div>' +
                        '<div class="col-md-3 form-group"><label>Lebar</label><input type="number" id="swal_lebar" class="form-control" min="0" step="0.01" value="' + escHtml(data.lebar) + '"></div>' +
                        '<div class="col-md-3 form-group"><label>Tinggi</label><input type="number" id="swal_tinggi" class="form-control" min="0" step="0.01" value="' + escHtml(data.tinggi) + '"></div>' +
                        '<div class="col-md-3 form-group"><label>Berat</label><input type="number" id="swal_berat" class="form-control" min="0" step="0.01" value="' + escHtml(data.berat) + '"></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-3 form-group"><label>Isi</label><input type="number" id="swal_isi" class="form-control" min="0" step="0.01" value="' + escHtml(data.isi) + '"></div>' +
                        '<div class="col-md-3 form-group"><label>Kemasan</label><input type="number" id="swal_kemasan" class="form-control" min="0" step="0.01" value="' + escHtml(data.kemasan) + '"></div>' +
                        '<div class="col-md-3 form-group"><label>Lot</label><select id="swal_is_lot" class="form-control"><option value="F">Tidak</option><option value="T">Ya</option></select></div>' +
                        '<div class="col-md-3 form-group"><label>Produk Fokus</label><input id="swal_produk_fokus" class="form-control" value="' + escHtml(data.produk_fokus) + '"></div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-6 form-group"><label>Kelompok</label><input id="swal_kelompok_barang" class="form-control" value="' + escHtml(data.kelompok_barang) + '"></div>' +
                        '<div class="col-md-6 form-group"><label>Kategori</label><input id="swal_kategori_barang" class="form-control" value="' + escHtml(data.kategori_barang) + '"></div>' +
                        '</div>' +
                        '</div>',
                    showCancelButton: true,
                    confirmButtonText: "Simpan",
                    cancelButtonText: "Batal",
                    didOpen: function() {
                        $("#swal_satuan").val(data.satuan || data.nm_satuan || "");
                        $("#swal_is_active").val(data.is_active || "T");
                        $("#swal_is_lot").val(data.is_lot || "F");
                    },
                    preConfirm: function() {
                        return {
                            id_barang: data.id_barang,
                            kode_barang: $("#swal_kode_barang").val(),
                            nama_barang: $("#swal_nama_barang").val(),
                            kd_suplier: data.kd_suplier,
                            bahan_aktif: $("#swal_bahan_aktif").val(),
                            satuan: $("#swal_satuan").val(),
                            merk_barang: $("#swal_merk_barang").val(),
                            stock_minimum: $("#swal_stock_minimum").val(),
                            panjang: $("#swal_panjang").val(),
                            lebar: $("#swal_lebar").val(),
                            tinggi: $("#swal_tinggi").val(),
                            berat: $("#swal_berat").val(),
                            isi: $("#swal_isi").val(),
                            kemasan: $("#swal_kemasan").val(),
                            is_active: $("#swal_is_active").val(),
                            is_lot: $("#swal_is_lot").val(),
                            kelompok_barang: $("#swal_kelompok_barang").val(),
                            kategori_barang: $("#swal_kategori_barang").val(),
                            produk_fokus: $("#swal_produk_fokus").val()
                        };
                    }
                }).then(function(result) {
                    if (!result.isConfirmed) return;
                    $.ajax({
                        url: $detailKomersil.data("save-url"),
                        method: "POST",
                        dataType: "json",
                        data: result.value,
                        success: function(response) {
                            if (response && response.status) {
                                showAlert("success", "Berhasil", response.message || "Data berhasil disimpan.");
                                loadBarangKomersil(updateDetailView);
                                return;
                            }
                            showAlert("error", "Gagal", response && response.message ? response.message : "Data gagal disimpan.");
                        },
                        error: function(xhr) {
                            var response = xhr.responseJSON || {};
                            showAlert("error", "Gagal", response.message || "Data gagal disimpan.");
                        }
                    });
                });
            }

            $("#btn_edit_detail_komersil").on("click", function() {
                loadBarangKomersil(editBarangKomersil);
            });

            $("#btn_delete_detail_komersil").on("click", function() {
                loadBarangKomersil(function(data) {
                    if (typeof Swal === "undefined") {
                        if (!confirm("Hapus " + (data.nama_barang || "barang ini") + "?")) {
                            return;
                        }

                        deleteBarangKomersil(data.id_barang);
                        return;
                    }

                    Swal.fire({
                        icon: "warning",
                        title: "Hapus Barang?",
                        text: "Data " + (data.nama_barang || "barang ini") + " akan dihapus.",
                        showCancelButton: true,
                        confirmButtonText: "Hapus",
                        cancelButtonText: "Batal",
                        confirmButtonColor: "#dc3545"
                    }).then(function(result) {
                        if (!result.isConfirmed) return;
                        deleteBarangKomersil(data.id_barang);
                    });
                });
            });

            function deleteBarangKomersil(id) {
                $.ajax({
                    url: $detailKomersil.data("delete-url"),
                    method: "POST",
                    dataType: "json",
                    data: {
                        id_barang: id
                    },
                    success: function(response) {
                        if (response && response.status) {
                            if (typeof Swal !== "undefined") {
                                Swal.fire("Berhasil", response.message || "Data berhasil dihapus.", "success").then(function() {
                                    window.location.href = $detailKomersil.data("list-url");
                                });
                                return;
                            }

                            window.location.href = $detailKomersil.data("list-url");
                            return;
                        }
                        showAlert("error", "Gagal", response && response.message ? response.message : "Data gagal dihapus.");
                    },
                    error: function(xhr) {
                        var response = xhr.responseJSON || {};
                        showAlert("error", "Gagal", response.message || "Data gagal dihapus.");
                    }
                });
            }
        }

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
