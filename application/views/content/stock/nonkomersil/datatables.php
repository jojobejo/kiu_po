<script>
    $(document).ready(function() {
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

            var tableStock = $stockTable.DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
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
                            '<a href="' + detailBaseUrl + s.kode_barangs + '" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></a>'
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
                        $("#btn_reload_stock").prop("disabled", false).text("Reload Cepat");
                    }
                });
            }

            $("#filter_lokasi").on("change", loadStockData);
            $("#btn_reload_stock").on("click", loadStockData);
            $("#btn_reset_filter").on("click", function() {
                $("#filter_lokasi").val("");
                loadStockData();
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
