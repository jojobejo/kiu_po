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
                    <img src="<?= base_url('assets/images/logoPT/') . $s->gbr_logo ?>" style="margin: 15px; width: 250px; height: 100px;" alt="">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        <?php endforeach; ?>
        <!-- Table row -->
        <h3>FORM PESANAN</h3>
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead class="theadprint">
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
                        <?php
                        $no = 1;
                        foreach ($detail as $d) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d->nama_barang ?></td>
                                <td><?= $d->kemasan ?></td>
                                <td><?= $d->satuan ?></td>
                                <td><?= $d->qty ?></td>
                                <td>Rp. <?= number_format($d->hrg_satuan) ?></td>
                                <td><?= $d->tax ?> %</td>
                                <td>Rp. <?= number_format($d->hrg_total) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php
                        foreach ($total as $t) : ?>
                            <tr>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td style="display: none;"></td>
                                <td colspan="7" style="text-align: end; padding-right:5%; font-weight: bold;">Total Harga</td>
                                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-6 noted">
                <p class="text-muted well well-sm" style="margin-top: 10px;">
                    * Sebelum kirim barang mohon konfirmasi terlebih dahulu <br>
                    NANDANG ERNOKO (Kadep Logistik) <br>
                    081 131 361 66 / 081 252 151 314 <br>
                    * Kedatangan barang maksimal: Senin s/d Jumat maksimal Jam 14:00 ,Sabtu maksimal Jam 11:00 <br>
                    * Maksimal terdiri dari 2 No. Batch* Mohon info terlebih dahulu,
                    jika Exp. date kurang dari 2 tahun sejak PO ini diterbitkan.tks <br>

                </p>
            </div>
            <div class="col-6">
                <table class="mt-2" width='650' style='font-size:12pt;' cellspacing='2'>
                    <tr>
                        <td align="center">Pemesan,</br></br></br></br></br><u>( Agoes Santoso )</u></td>
                        <td align="center">Disetujui,</br></br></br></br></br><u>(....................)</u></td>
                    </tr>
                </table>
            </div>

        </div>
        <!-- /.row -->
        </section>
        <!-- /.content -->
</div>