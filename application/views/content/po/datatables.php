<script>
    $(function() {
        $("#list_suplier").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $("#tb_barang").DataTable({
            "responsive": true,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    });
</script>