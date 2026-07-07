<script>
    var nomorPoDuplikat = false;
    var nomorPoTimer = null;

    function formatNomorPoInput(value) {
        var parts = String(value || '').toUpperCase().replace(/\s+/g, '').split('/');
        var nomor = parts[0] || '';
        nomor = nomor.replace(/\D/g, '');

        if (nomor !== '') {
            nomor = ('000' + nomor.slice(0, 3)).slice(-3);
        }

        if (parts.length === 1 && nomor !== '') {
            var defaultParts = String($('#po_isi').data('nomor-po-awal') || '').split('/');
            return nomor + '/KIU/' + (defaultParts[2] || '') + '/' + (defaultParts[3] || '');
        }

        if (parts.length >= 4) {
            return nomor + '/KIU/' + (parts[2] || '').replace(/[^IVXLCDM]/g, '') + '/' + (parts[3] || '').replace(/\D/g, '').slice(0, 4);
        }

        return String(value || '').toUpperCase().replace(/\s+/g, '');
    }

    function setNomorPoInvalid(message) {
        nomorPoDuplikat = true;
        $('#po_isi').addClass('is-invalid').css({
            'border-color': '#dc3545',
            'background-color': '#fff5f5'
        });
        $('#po_isi_feedback').text(message).show();
    }

    function clearNomorPoInvalid() {
        nomorPoDuplikat = false;
        $('#po_isi').removeClass('is-invalid').css({
            'border-color': '',
            'background-color': ''
        });
        $('#po_isi_feedback').hide().text('');
    }

    function cekNomorPoDuplikat() {
        var nopo = $('#po_isi').val();
        var polaNomorPo = /^\d{3}\/KIU\/(I|II|III|IV|V|VI|VII|VIII|IX|X|XI|XII)\/\d{4}$/;

        if (nopo === '') {
            clearNomorPoInvalid();
            return;
        }

        if (!polaNomorPo.test(nopo)) {
            setNomorPoInvalid('Format Nomor PO harus seperti 001/KIU/VII/2026.');
            return;
        }

        $.ajax({
            url: "<?= base_url('purchase/check-nomor-po') ?>",
            type: "POST",
            data: {
                no_po: nopo
            },
            dataType: "JSON",
            cache: false,
            success: function(data) {
                if (data.exists) {
                    setNomorPoInvalid('Nomor PO sudah digunakan. Silakan gunakan nomor berikutnya.');
                } else {
                    clearNomorPoInvalid();
                }
            }
        });
    }

    $(document).ready(function() {

        $("#po_isi").on("input blur", function() {
            var formatted = formatNomorPoInput($(this).val());
            $(this).val(formatted);

            clearTimeout(nomorPoTimer);
            nomorPoTimer = setTimeout(cekNomorPoDuplikat, 300);
        });

        cekNomorPoDuplikat();

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
        var tax = $("#taxisi_in").val();

        if (jml == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tidak ada transaksi!',
            });
            return;
        }

        if (nopo == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Nomor PO belum terisi!',
            });
            return;
        }

        if (nomorPoDuplikat) {
            Swal.fire({
                icon: 'warning',
                title: 'Nomor PO Tidak Valid',
                text: $("#po_isi_feedback").text() || 'Nomor PO sudah digunakan atau formatnya belum sesuai.',
            });
            return;
        }

        if (tgl == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Tanggal order belum terisi!',
            });
            return;
        }

        Swal.fire({
            title: 'Simpan Data?',
            text: "Pastikan semua data sudah benar.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data PO berhasil direkam!',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(true);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan',
                                text: data.message || 'Terjadi kesalahan pada data!',
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Tidak dapat terhubung ke server.',
                        });
                    }
                });
            }
        });
    });


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
