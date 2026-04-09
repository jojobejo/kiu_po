<script>
    $(document).ready(function() {
        function toggleStockLoading(show) {
            var $table = $("#list_stocknonkomersil");
            if (!$table.length) return;
            var $wrapper = $table.closest(".dataTables_wrapper");
            if (!$wrapper.length) return;
            var $overlay = $wrapper.find(".dt-loading-overlay");
            if (!$overlay.length) {
                $wrapper.css("position", "relative");
                $overlay = $(
                    '<div class="dt-loading-overlay">' +
                    '  <div class="dt-loading-box">' +
                    '    <div class="dt-loading-spinner"></div>' +
                    '    <div class="dt-loading-text">Memuat data...</div>' +
                    '  </div>' +
                    '</div>'
                );
                $wrapper.append($overlay);
            }
            if (show) {
                $overlay.addClass("show");
            } else {
                $overlay.removeClass("show");
            }
        }

        $("#daterange").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });

        $("#filter").click(function() {
            var startDate = $("#start_date").val();
            var endDate = $("#end_date").val();

            if (startDate !== "" && endDate !== "") {
                $.ajax({
                    url: "your_controller/getDataByDate", // Sesuaikan dengan URL controller Anda
                    type: "POST",
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(data) {
                        $("#result").html(data);
                    }
                });
            } else {
                alert("Silakan pilih rentang tanggal terlebih dahulu");
            }
        });

        if ($("#stocknk_filter_form").length && $("#list_stocknonkomersil").length) {
            var $stockTable = $("#list_stocknonkomersil");
            var isAdminView = $stockTable.data("admin-view") == 1;
            var ajaxUrl = $stockTable.data("ajax-url");
            var detailBaseUrl = "<?= base_url('detailtransaksi/'); ?>";
            var updateLokasiUrl = "<?= base_url('stocknonkomersil/update_lokasi'); ?>";

            var tableStock = $stockTable.DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
                "language": {
                    "emptyTable": "Memuat data...",
                    "zeroRecords": "Memuat data...",
                    "processing": "Memuat data..."
                }
            });

            function escHtml(text) {
                if (text === null || text === undefined) return "";
                return $("<div>").text(text).html();
            }

            function buildQtyCell(qty) {
                var qtyNum = parseFloat(qty || 0);
                if (qtyNum <= 0) {
                    return '<span class="table-warning d-block p-1">' + escHtml(qty) + '</span>';
                }
                return escHtml(qty);
            }

            function renderRows(rows) {
                tableStock.clear();

                $.each(rows, function(_, s) {
                    if (isAdminView) {
                        tableStock.row.add([
                            escHtml(s.kode_barang),
                            escHtml(s.nama_barang),
                            escHtml(s.deskripsi),
                            buildQtyCell(s.qty_ready),
                            escHtml(s.satuan),
                            escHtml(s.nama_lokasi),
                            '<a href="' + detailBaseUrl + s.kode_barangs + '" id="btndetailbrs" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></a>' +
                            '<button type="button" class="btn btn-block btn-warning btn-lokasi" data-toggle="modal" data-target="#modalUpdateLokasi" data-kode-barang="' + escHtml(s.kode_barang) + '" data-nama-barang="' + escHtml(s.nama_barang) + '" data-id-lokasi="' + escHtml(s.id_lokasi) + '"><i class="fas fa-map-marker-alt"></i></button>'
                        ]);
                    } else {
                        tableStock.row.add([
                            escHtml(s.kode_barang),
                            escHtml(s.nama_barang),
                            escHtml(s.deskripsi),
                            buildQtyCell(s.qty_ready),
                            escHtml(s.satuan),
                            escHtml(s.nama_lokasi)
                        ]);
                    }
                });

                tableStock.draw(false);
            }

            function loadStockData() {
                var lokasi = $("#filter_lokasi").val();
                $("#btn_reload_stock").prop("disabled", true).text("Loading...");
                toggleStockLoading(true);

                $.ajax({
                    url: ajaxUrl,
                    type: "GET",
                    dataType: "json",
                    data: {
                        lokasi: lokasi
                    },
                    success: function(res) {
                        if (res && res.status && Array.isArray(res.data)) {
                            renderRows(res.data);
                        } else {
                            renderRows([]);
                        }
                    },
                    error: function() {
                        renderRows([]);
                    },
                    complete: function() {
                        $("#btn_reload_stock").prop("disabled", false).text("filter");
                        toggleStockLoading(false);
                    }
                });
            }

            $("#filter_lokasi").on("change", loadStockData);
            $("#btn_reload_stock").on("click", loadStockData);
            $("#btn_reset_filter").on("click", function() {
                $("#filter_lokasi").val("");
                loadStockData();
            });

            $(document).on("click", ".btn-lokasi", function() {
                var kodeBarang = $(this).data("kode-barang");
                var namaBarang = $(this).data("nama-barang");
                var idLokasi = $(this).data("id-lokasi");

                $("#lokasi_kode_barang").val(kodeBarang);
                $("#lokasi_nama_barang").text(namaBarang || "-");
                $("#lokasi_id").val(idLokasi || "");
            });

            $("#formUpdateLokasi").on("submit", function(e) {
                e.preventDefault();
                var $btn = $("#btn_save_lokasi");
                $btn.prop("disabled", true).text("Menyimpan...");

                $.ajax({
                    url: updateLokasiUrl,
                    type: "POST",
                    dataType: "json",
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res && res.status) {
                            $("#modalUpdateLokasi").modal("hide");
                            loadStockData();
                        } else {
                            alert("Gagal update lokasi.");
                        }
                    },
                    error: function() {
                        alert("Gagal update lokasi.");
                    },
                    complete: function() {
                        $btn.prop("disabled", false).text("Simpan");
                    }
                });
            });

            loadStockData();
        } else if ($("#list_stocknonkomersil").length) {
            $("#list_stocknonkomersil").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }

        $(function() {
            $("#list_stocknonkomersil1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $(function() {
            $("#tracking_list_nonkomersil").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    });
</script>

<?php $lokasi_modal = isset($lokasi_option_modal) ? $lokasi_option_modal : (isset($lokasi_option) ? $lokasi_option : []); ?>
<div class="modal fade" id="modalUpdateLokasi" tabindex="-1" role="dialog" aria-labelledby="modalUpdateLokasiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formUpdateLokasi">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalUpdateLokasiLabel">Update Lokasi Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kode_barang" id="lokasi_kode_barang">
                    <div class="form-group">
                        <label class="mb-1"><b>Barang</b></label>
                        <div id="lokasi_nama_barang">-</div>
                    </div>
                    <div class="form-group">
                        <label class="mb-1"><b>Pilih Lokasi</b></label>
                        <select name="id_lokasi" id="lokasi_id" class="form-control" required>
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($lokasi_modal as $l) : ?>
                                <option value="<?= $l->id_lokasi; ?>"><?= $l->nama_lokasi; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btn_save_lokasi" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .dt-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: none;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.7);
        z-index: 10;
    }

    .dt-loading-overlay.show {
        display: flex;
    }

    .dt-loading-box {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 8px;
        background: #ffffff;
        border: 1px solid #e2e2e2;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .dt-loading-spinner {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid #d9d9d9;
        border-top-color: #007bff;
        animation: dtspin 0.9s linear infinite;
    }

    .dt-loading-text {
        font-weight: 600;
        color: #333333;
    }

    @keyframes dtspin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>