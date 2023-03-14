<div class="wrapper">
    <!-- Main content -->
    <?php foreach ($status as $s) : ?>
        <section class="m-4">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <img src="<?= base_url('assets/images/logo1.png') ?>" style="width:175px;height:60px" alt="">PT. Karisma Indoagro Universal</i>
                        <small class="float-right"></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Kepada Yth.
                    <address>
                        <strong><?= $s->nama_suplier ?></strong><br>
                        <?= $s->alamat_suplier ?><br>
                        Telp : <?= $s->no_telpon ?>,<br>
                        Fax : <?= $s->no_fax ?><br>
                        Email : <?= $s->email ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Pemesan
                    <address>
                        <strong>PT.Karisma Indoagro Universal</strong><br>
                        Jl. Semeru No.89, Krajan, Ajung, Kec. Ajung,<br>
                        Kabupaten Jember, Jawa Timur 68175<br>
                        Telp 1: (0331) 4833 33<br>
                        Telp 2: (0331) 4877 88<br>
                        Email: karisma@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <br>
                    <b>Nomor Order:</b> <?= $s->no_po ?><br>
                    <b>Tanggal Order:</b> <?= $s->tgl_transaksi ?><br>
                    <img src="<?= base_url('assets/images/logoPT/') . $s->gbr_logo ?>" style="width: 250px; height: 100px;" alt="">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        <?php endforeach; ?>
        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Barang</td>
                            <td>Isi Kemasan</td>
                            <td>Satuan</td>
                            <td>Qty</td>
                            <td>Harga</td>
                            <td>Tax(%)</td>
                            <td>Total Harga</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px; background-color: yellow;">
                    * Sebelum kirim barang mohon konfirmasi terlebih dahulu <br>
                    NANDANG ERNOKO (Kadep Logistik) <br>
                    081 131 361 66 / 081 252 151 314 <br>
                    * Kedatangan barang maksimal: Senin s/d Jumat maksimal Jam 14:00 ,Sabtu maksimal Jam 11:00 <br>
                    * Maksimal terdiri dari 2 No. Batch* Mohon info terlebih dahulu,
                    jika Exp. date kurang dari 2 tahun sejak PO ini diterbitkan.tks <br>

                </p>
            </div>
            <!-- /.col -->
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table-borderless">
                        <tr>
                            <th style="width:50%">Pemesan</th>
                        </tr>
                        <tr>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                            <th style="display: none;"></th>
                        </tr>
                        <tr>
                            <th>Agoes Santoso</th>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
</div>