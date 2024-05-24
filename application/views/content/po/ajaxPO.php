<script>
    $(document).ready(function() {

        $("#tax_isi").on("input", function() {
            var ppn = $(this).val();
            var hasil = ppn / 100;
            $('#hasil_ppn').val(hasil);
        });

    });

    $("#selesai").on('click', function() {
        var nopo = $("#po_isi").val();
        var tgl = $("#tgl_isi").val();
        var tmpo = $("#tmpo").val();
        var gdg = $("#gdgpengiriman").val();
        var jml = $("#jmlitem").val();
        var kdpo = $("#kd_po_isi").val();
        var suplier = $("#kdsuplier").val();
        var harga = $("#jmlharga").val();
        var tax = $("#taxisi").val();

        if (jml == 0) {
            alert('tidak ada transaksi');
        } else {
            if (nopo == "") {
                alert('Nomor PO tidak terisi');
            } else if (tgl == "") {
                alert('tgl order belum terisi');
            } else {
                $.ajax({
                    url: "<?= base_url('rekam_po') ?>",
                    type: "POST",
                    data: {
                        nopo: nopo,
                        tgl: tgl,
                        tmpo: tmpo,
                        gdg: gdg,
                        jml: jml,
                        kdpo: kdpo,
                        suplier: suplier,
                        harga: harga,
                        tax: tax
                    },
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        if (data.msg == "success") {
                            location.reload(true);
                        } else {
                            alert('ada kesalahan data')
                        }
                    }
                })
            }
        }
    })

    $("#selesaink").on('click', function() {
        var kdpo = $("#po_isi").val();
        var nopo = $("#no_po_isi").val();
        var nm_user = $("#nm_user").val();
        var tgl = $("#tgl_isi").val();
        var departemen = $("#dep_isi").val();
        var tujuan = $("#tujuan_isi").val();
        var jml = $("#jmlitem").val();
        var harga = $("#jmlharga").val();

        if (jml == 0) {
            alert('tidak ada transaksi');
        } else {
            if (nopo == "") {
                alert('Nomor PO tidak terisi');
            } else if (tgl == "") {
                alert('tgl order belum terisi');
            } else {
                $.ajax({
                    url: "<?= base_url('rekam_po_nk') ?>",
                    type: "POST",
                    data: {
                        kdpo: kdpo,
                        nopo: nopo,
                        nm_user: nm_user,
                        tgl: tgl,
                        departemen: departemen,
                        tujuan: tujuan,
                        jml: jml,
                        harga: harga
                    },
                    dataType: "JSON",
                    cache: false,
                    success: function(data) {
                        if (data.msg == "success") {
                            alert('PO telah di simpan');
                            location.reload(true);
                        } else {
                            alert('ada kesalahan data')
                        }
                    }
                })
            }
        }
    })
</script>