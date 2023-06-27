<div class="wrapper">
    <!-- Main content -->
    <?php foreach ($status as $s) : ?>
        <section class="m-4">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <div class="row">
                            <img src="<?= base_url('assets/images/logo1.png') ?>" style="width:120px;height:40px" alt=""></i>
                            <h2>PT. Karisma Indoagro Universal</h2>
                        </div>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col text-xs">
                    Kepada Yth.
                    <address>
                        <strong><?= $s->nama_suplier ?></strong>
                        <?= $s->alamat_suplier ?><br>
                        Telp : <?= $s->no_telpon ?>,<br>
                        Fax : <?= $s->no_fax ?><br>
                        Email : <?= $s->email ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col text-xs">
                    Pemesan
                    <address>
                        <strong>PT.Karisma Indoagro Universal</strong><br>
                        Jl. Semeru No.89, Ajung, Kabupaten Jember<br>
                        Telp 1: (0331) 4833 33 / 4877 88<br>
                        Email: karisma@kiu.co.id
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col text-xs">
                    <br>
                    <b>Nomor Order:</b> <?= $s->no_po ?><br>
                    <b>Tanggal Order:</b> <?= $s->tgl_transaksi ?><br>
                    <img src="<?= base_url('assets/images/logoPT/') . $s->gbr_logo ?>" style="margin-top: 2px;margin-bottom: 5px; width: 200px; height: 75px;" alt="">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <table class="table-bordered text-xs listdb">
                        <thead>
                            <tr>
                                <td colspan="7" style="font-weight: bold; font-size: medium; text-align: center;">FORM PEMESANAN</td>
                            </tr>
                            <tr style="text-align: center;">
                                <td style="width: 1%;">No</td>
                                <td>Nama Barang</td>
                                <td>Satuan</td>
                                <td style="width: 10%;">Qty</td>
                                <td>Harga</td>
                                <td colspan="7" style="width: 17.88%;">Total Harga</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detail as $d) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $d->nama_barang ?></td>
                                    <td style="text-align: center;"><?= $d->satuan ?></td>
                                    <td style="text-align: center;"><?= $d->qty ?></td>
                                    <td style="text-align: center;"> &nbsp;Rp. <?= number_format($d->hrg_satuan) ?></td>
                                    <td colspan="7">&nbsp;Rp. <?= number_format($d->hrg_total) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                            foreach ($total as $t) : ?>
                                <tr>
                                    <td colspan="7" style="text-align: end; padding-right:5%; font-weight: bold;">Total Harga</td>
                                    <td style="font-weight: bold;">&nbsp;Rp. <?= number_format($t->total_harga) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table-bordered text-xs listdb" style="width: 100%;">
                        <thead>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="7" colspan="2" style="text-align: justify; background-color: yellow; width:50%">
                                    * Sebelum kirim barang mohon konfirmasi terlebih dahulu <br>
                                    NANDANG ERNOKO (Kadep Logistik) <br>
                                    081 131 361 66 / 081 252 151 314 <br>
                                    * Kedatangan barang maksimal: Senin s/d Jumat <br>
                                    maksimal Jam 14:00 ,Sabtu maksimal Jam 11:00 <br>
                                    * Maksimal terdiri dari 2 No. Batch* Mohon info terlebih dahulu,<br>
                                    jika Exp. date kurang dari 2 tahun sejak PO ini diterbitkan.tks <br>
                                </td>
                            </tr>
                            <?php foreach ($diskon as $d) : ?>
                                <?php if ($diskon > 0) : ?>
                                    <tr>
                                        <td colspan="1" style="text-align: end;font-weight: bold;"><?= $d->keterangan ?> : </td>
                                        <td colspan="4" style="font-weight: bold;">&nbsp;Rp. <?= number_format($d->nominal) ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach ($total as $t) :
                                foreach ($totalDiskon as $d) :
                                    $stlhDiskon = $t->total_harga - $d->total_diskon;
                                    $tax = $s->tax / 100;
                                    $hargaPajak = $stlhDiskon * $tax;
                                    $hargaAll = $stlhDiskon + $hargaPajak; ?>
                                    <tr>
                                        <td colspan="1" style="text-align: end;font-weight: bold;">Total Harga Setelah Diskon :</td>
                                        <td colspan="4" style="font-weight: bold;">&nbsp;Rp.<?= number_format($stlhDiskon) ?> </td>
                                    </tr>

                                    <tr>
                                        <td colspan="1" style="text-align: end;font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                        <td colspan="4" style="font-weight: bold;">&nbsp;Rp. <?= number_format($hargaPajak) ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" style="text-align: end; font-weight: bold;">Grand Total Harga</td>
                                        <td colspan="4" style="font-weight: bold;">&nbsp;Rp. <?= number_format($hargaAll) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col">
                    <table class="table-bordered text-xs listdb" width='100%' height=''>
                        <?php
                        $qrPath = base_url('assets/images/') . $s->acc_with . '.png'
                        ?>
                        <tr>
                            <td align="center" style="width: 50%;">Pemesan,</br><img src="<?= $qrPath ?>" style="width: 120px;; height: 120px;"></br><u>( <?= $s->nama_user ?> )</u></td>
                            <td align="center">Disetujui,</br></br></br></br><u>( <?= $s->nama_suplier ?> )</u></td>
                        </tr>
                    </table>
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
</div>
<?php endforeach; ?>