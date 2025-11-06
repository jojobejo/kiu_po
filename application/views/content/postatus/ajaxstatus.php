<script>
    $(document).ready(function() {

        var baseUrl = '<?php echo base_url('postatus'); ?>';

        // === REPOST ===
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
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Dapat Diproses',
                    text: 'Jumlah item masih kosong.'
                });
                return;
            }

            if (nopo == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Nomor PO Kosong',
                    text: 'Nomor PO harus diisi.'
                });
                return;
            }

            if (tgl == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tanggal Kosong',
                    text: 'Tanggal order belum diisi.'
                });
                return;
            }

            if (tax == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Kolom Pajak Kosong',
                    text: 'Kolom pajak (Tax) wajib diisi.'
                });
                return;
            }

            Swal.fire({
                title: 'Repost Data?',
                text: 'Pastikan semua data sudah benar sebelum dikirim.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, kirim',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

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
                            hargapjk: hargapjk,
                            tax: tax
                        },
                        dataType: "JSON",
                        cache: false,
                        success: function(data) {
                            if (data.msg == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data PO berhasil diproses!',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.href = baseUrl;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan',
                                    text: 'Terjadi kesalahan pada data!'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Tidak dapat terhubung ke server.'
                            });
                        }
                    });
                }
            });
        });


        // === ACC DIREKTUR ===
        $(document).on('click', '.btn-konfirmasi', function(e) {
            e.preventDefault();
            var url = $(this).data('url');

            Swal.fire({
                title: 'Konfirmasi Order?',
                text: 'Pastikan data PO sudah benar sebelum dilanjutkan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, lanjutkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Mohon tunggu sebentar.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    setTimeout(() => {
                        window.location.href = url;
                    }, 800);
                }
            });
        });

        $(document).on('click', '.btn-reject', function(e) {
            e.preventDefault();
            var url = $(this).data('url');

            Swal.fire({
                title: 'Tolak Order?',
                text: 'Apakah Anda yakin ingin menolak order ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, tolak',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        text: 'Order sedang ditolak.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    setTimeout(() => {
                        window.location.href = url;
                    }, 800);
                }
            });
        });

    });
</script>


<!-- <script>
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
    
</script> -->