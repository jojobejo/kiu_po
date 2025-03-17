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

        $(function() {
            $("#list_stocknonkomersil").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
        $(function() {
            $("#list_stocknonkomersil1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "aaSorting": [],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

    });
</script>