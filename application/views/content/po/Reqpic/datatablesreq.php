<script>
    $(function() {
        $("#list_reqpic").DataTable({
            "pageLength": 25,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>