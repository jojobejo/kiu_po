<script>
    $(document).ready(function() {
        var baseUrl = '<?php echo base_url('postatus'); ?>';

        $("#repost").on('click', function() {
            var kd_lama = $("#kd_lama").val();
            var kdpo = $("#kdpoisi").val();
            var nopo = $("#nopoisi").val();
            var tgl = $("#tgltisi").val();
            var tmpo = $("#tmpobayarisi").val();
            var gdg = $("#gdgkirimisi").val();
            var jml = $("#jmlitemisi").val();
            var suplier = $("#kdsupisi").val();
            var harga = $("#tothrgisi").val();
            var hargapjk = $("#hrgpjkisi").val();
            var tax = $("#taxisi").val();

            if (jml == 0) {
                alert('tidak dapat diproses');
            } else {
                if (nopo == "") {
                    alert('Nomor PO tidak terisi');
                } else if (tgl == "") {
                    alert('tgl order belum terisi');
                } else {
                    $.ajax({
                        url: "<?= base_url('repost_po') ?>",
                        type: "POST",
                        data: {
                            kd_lama: kd_lama,
                            kdpo: kdpo,
                            nopo: nopo,
                            tgl: tgl,
                            tmpo: tmpo,
                            gdg: gdg,
                            jml: jml,
                            suplier: suplier,
                            harga: harga,
                            tax: tax
                        },
                        dataType: "JSON",
                        cache: false,
                        success: function(data) {
                            if (data.msg == "success") {
                                location.href = baseUrl
                            } else {
                                alert('ada kesalahan data')
                            }
                        }
                    })
                }
            }
        })



    });
</script>