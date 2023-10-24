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
                <div class="col-sm-4 invoice-col text-s">
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
                <div class="col-sm-4 invoice-col text-s">
                    Pemesan
                    <address>
                        <strong>PT.Karisma Indoagro Universal</strong><br>
                        Jl. Semeru No.89, Ajung, Kabupaten Jember<br>
                        Telp 1: (0331) 4833 33 / 4877 88<br>
                        Email: karismaindoagro@gmail.com
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col text-s">
                    <br>
                    <b>Nomor Order:</b> <?= $s->no_po ?><br>
                    <b>Tanggal Order:</b> <?= $s->tgl_transaksi ?><br>
                    <img src="<?= base_url('assets/images/logoPT/') . $s->gbr_logo ?>" style="margin-top: 2px;margin-bottom: 5px; width: 200px; height: 75px;" alt="">
                </div>
                <!-- /.col -->
            </div>
            <?php foreach ($CountItem as $c) :
                if ($c->total_item == '15') {
                    $a = '18';
                } else if ($c->total_item == '14') {
                    $a = '18';
                } else if ($c->total_item == '13') {
                    $a = '18';
                } else if ($c->total_item == '12') {
                    $a = '18';
                } else if ($c->total_item == '11') {
                    $a = '18';
                } else if ($c->total_item == '10') {
                    $a = '18';
                } else if ($c->total_item == '9') {
                    $a = '18';
                } else if ($c->total_item == '8') {
                    $a = '18';
                } else if ($c->total_item == '7') {
                    $a = '18';
                } else if ($c->total_item == '6') {
                    $a = '18';
                } else if ($c->total_item == '5') {
                    $a = '18';
                } else if ($c->total_item == '4') {
                    $a = '18';
                } else if ($c->total_item == '3') {
                    $a = '18';
                } else if ($c->total_item == '2') {
                    $a = '18';
                } else if ($c->total_item == '1') {
                    $a = '15';
                } else {
                    $a = '14';
                }
            ?>
                <!-- /.row -->
            <?php endforeach; ?>

            <div class="row">
                <div class="col-12">
                    <table class="table-bordered text-s listdb">
                        <thead>
                            <tr>
                                <td colspan="8" class="bg-black" style="font-weight: bold; font-size: medium; text-align: center;">FORM PEMESANAN</td>
                            </tr>
                            <tr style="text-align: center;">
                                <td style="width: 1%;">No</td>
                                <td>Nama Barang</td>
                                <td>Satuan</td>
                                <td style="width: 10%;">Qty</td>
                                <td>Harga</td>
                                <td colspan="7" style="width: <?= $a ?>%;">Total Harga</td>
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
                                    <td style="text-align: center;"> &nbsp;Rp. <?= number_format($d->hrg_satuan, 2) ?></td>
                                    <td colspan="7" style="text-align:end">&nbsp;Rp. <?= number_format($d->hrg_total, 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php
                            foreach ($total as $t) : ?>
                                <tr>
                                    <td colspan="7" style="text-align: end; padding-right:5%; font-weight: bold;">Total Harga</td>
                                    <td style="text-align:end ">&nbsp;Rp. <?= number_format($t->total_harga) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table-bordered text-s listdb" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="bg-black color-palette" style="text-align: center;">FRANGKO PENGIRIMAN</th>
                                <th class="bg-black color-palette" style="text-align: center;">TEMPO PEMBAYARAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;"><?= $s->gdg_pengiriman ?></td>
                                <td style="text-align: center;"><?= $s->tmpo_pembayaran ?> Hari</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table-bordered text-s listdb" style="width: 100%;">
                        <thead>
                            <tr>
                                <td colspan="8" class="bg-black color-palette" style="text-align: center; font-weight: bolder;">LIST DISKON</td>
                            </tr>
                            <?php foreach ($diskon as $d) : ?>
                                <?php if ($diskon > 0) : ?>
                                    <tr>
                                        <td colspan="7" style="text-align: end;font-weight: bold;"><?= $d->keterangan ?> : </td>
                                        <td colspan="1" style="text-align:end">&nbsp;Rp. <?= number_format($d->nominal, 2) ?></td>
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
                                        <td colspan="8" class="bg-black color-palette" style="text-align: center; font-weight: bolder;">GRAND TOTAL</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: end;font-weight: bold;">Total Harga Setelah Diskon :</td>
                                        <td colspan="1" style="text-align:end">&nbsp;Rp.<?= number_format($stlhDiskon) ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: end;font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                        <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($hargaPajak) ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" style="text-align: end; font-weight: bold;">Grand Total Harga</td>
                                        <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($hargaAll) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </thead>
                    </table>
                    <table class="table-bordered text-s listdb" style="width: 100%; border-color: black;">
                        <tbody>
                            <?php foreach ($totalDiskon as $t) :
                                if ($t->total_item == '7') {
                                    $b = '14';
                                } else if ($t->total_item == '6') {
                                    $b = '13';
                                } else if ($t->total_item == '5') {
                                    $b = '12';
                                } else if ($t->total_item == '4') {
                                    $b = '11';
                                } else if ($t->total_item == '3') {
                                    $b = '10';
                                } else if ($t->total_item == '2') {
                                    $b = '9';
                                } else if ($t->total_item == '1') {
                                    $b = '8';
                                } else {
                                    $b = '15';
                                }
                                foreach ($totalnote as $tn) {
                                    if ($tn->total_nt_item == '1') {
                                        $c = '1';
                                    } else if ($tn->total_nt_item == '2') {
                                        $c = '2';
                                    } else if ($tn->total_nt_item == '3') {
                                        $c = '3';
                                    } else if ($tn->total_nt_item == '4') {
                                        $c = '4';
                                    } else if ($tn->total_nt_item == '5') {
                                        $c = '5';
                                    } else if ($tn->total_nt_item == '6') {
                                        $c = '6';
                                    } else if ($tn->total_nt_item == '7') {
                                        $c = '7';
                                    } else if ($tn->total_nt_item == '8') {
                                        $c = '8';
                                    } else {
                                        $c = '9';
                                    }

                                    $d = $b + $c;
                                }

                            ?>
                            <?php endforeach; ?>
                            <tr>
                                <td rowspan="<?= $d ?>" style="text-align: justify; background-color: yellow;width: 50%;">
                                    * SHIP TO : <br>
                                    KARISMA INDOAGRO UNIVERSAL <br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->shipment_to ?><br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->alamat_ship ?> <br>
                                    * Sebelum kirim barang mohon konfirmasi terlebih dahulu <br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->cp_shipment ?> <br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->no_cp ?> <br>
                                    <?= nl2br($s->ket_1) ?><br>
                                </td>
                                <td colspan="2" class="bg-black color-palette" style="text-align: center; font-weight: bolder;">NOTE UNTUK SUPLIER</td>
                            </tr>
                            <?php foreach ($notesuplier as $ns) :
                            ?>
                                <tr>
                                    <td colspan="2" class="bg-orange"><?= nl2br($ns->isi_note); ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col">
                    <table class="table-bordered text-s listdb" width='100%' height=''>
                        <tr>
                            <td align="center" style="width: 50%;">Pemesan,</br><img src=" <?= base_url('assets/images/qrcode/') . $s->acc_with ?>.png" style="width: 170px; height: 170px;"></br><u>( <?= $s->nama_user ?> )</u></td>
                            <td align="center">Disetujui,</br></br></br></br></br></br></br></br><u>( <?= $s->nama_suplier ?> )</u></td>
                        </tr>
                    </table>
                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
</div>
<?php endforeach; ?>