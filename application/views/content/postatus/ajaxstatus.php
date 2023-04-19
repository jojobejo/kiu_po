<script>
    $(document).ready(function() {

        $(".tax_isi_value ").on("change", function() {
            var $el = $(this).closest('select')
            var ppn = $("this").val();
            var hasil = ppn / 100;
            $('.hasil_ppn').val(hasil);
        });

    });
    
</script>