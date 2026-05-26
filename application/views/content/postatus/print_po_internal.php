<div class="wrapper">
    <!-- Main content -->
    <?php foreach ($status as $s) : ?>
        <section class="m-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <div class="row">
                            <img src="<?= base_url('assets/images/logo1.png') ?>" style="width:120px;height:40px" alt=""></i>
                            <h2>PT. Karisma Indoagro Universal</h2>
                        </div>
                    </h2>
                </div>
            </div>

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
                <div class="col-sm-4 invoice-col text-s">
                    Pemesan
                    <address>
                        <strong>PT.Karisma Indoagro Universal</strong><br>
                        Jl. Semeru No.89, Ajung, Kabupaten Jember<br>
                        Telp 1: (0331) 4833 33 / 4877 88<br>
                        Email: karismaindoagro@gmail.com
                    </address>
                </div>
                <div class="col-sm-4 invoice-col text-s">
                    <br>
                    <b>Nomor Order:</b> <?= $s->no_po ?><br>
                    <b>Tanggal Order:</b> <?= $s->tgl_transaksi ?><br>
                    <img src="<?= base_url('assets/images/logoPT/') . $s->gbr_logo ?>" style="margin-top: 2px;margin-bottom: 5px; width: 200px; height: 75px;" alt="">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table-bordered text-s listdb">
                        <thead>
                            <tr>
                                <td colspan="10" class="bg-black" style="font-weight: bold; font-size: medium; text-align: center;">FORM PEMESANAN INTERNAL</td>
                            </tr>
                            <tr style="text-align: center;">
                                <td style="width: 1%;">No</td>
                                <td>Nama Barang</td>
                                <td>Satuan</td>
                                <td style="width: 8%;">Qty</td>
                                <td style="width: 8%;">Qty Kecil</td>
                                <td>Harga Satuan</td>
                                <td>Harga Satuan Kecil</td>
                                <td>Harga Diskon</td>
                                <td>Total Harga</td>
                                <td>Total Harga Diskon</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $listDiskonPrint = array();
                            foreach ($diskon as $diskonItem) {
                                $listDiskonPrint[] = array(
                                    'keterangan' => $diskonItem->keterangan,
                                    'nominal' => $diskonItem->nominal,
                                );
                            }
                            foreach ($detail as $bonusItem) {
                                if (isset($bonusItem->is_bonus) && (int) $bonusItem->is_bonus === 1) {
                                    $listDiskonPrint[] = array(
                                        'keterangan' => $bonusItem->nama_barang . ' - ' . (!empty($bonusItem->keterangan_bonus) ? $bonusItem->keterangan_bonus : 'Bonus'),
                                        'nominal' => 0,
                                    );
                                }
                            }
                            ?>
                            <?php foreach ($detail as $d) : ?>
                                <?php
                                $isBonus = isset($d->is_bonus) && (int) $d->is_bonus === 1;
                                $hargaDiskon = $isBonus ? 0 : (isset($d->hrg_diskon) && $d->hrg_diskon > 0 ? $d->hrg_diskon : $d->hrg_satuan);
                                $totalHargaDiskon = $isBonus ? 0 : (isset($d->hrg_total_diskon) && $d->hrg_total_diskon > 0 ? $d->hrg_total_diskon : $d->hrg_total);
                                $qtyKecil = isset($d->qty_kecil) && (float) $d->qty_kecil > 0 ? $d->qty_kecil : $d->qty;
                                $qtyKecilDisplay = ceil((float) $qtyKecil);
                                $hargaSatuanKecil = isset($d->harga_satuan_kecil) && ((float) $d->harga_satuan_kecil > 0 || $isBonus) ? $d->harga_satuan_kecil : $d->hrg_satuan;
                                ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?= $d->nama_barang ?>
                                        <?php if ($isBonus) : ?>
                                            <br><small>Bonus<?= !empty($d->keterangan_bonus) ? ' - ' . $d->keterangan_bonus : '' ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;"><?= $d->satuan ?></td>
                                    <td style="text-align: center;"><?= $d->qty ?></td>
                                    <td style="text-align: center;"><?= number_format($qtyKecilDisplay, 0, ',', '.') ?></td>
                                    <td style="text-align: end;">&nbsp;Rp. <?= number_format($d->hrg_satuan, 2) ?></td>
                                    <td style="text-align: end;">&nbsp;Rp. <?= number_format($hargaSatuanKecil, 2) ?></td>
                                    <td style="text-align: end;">&nbsp;Rp. <?= number_format($hargaDiskon, 2) ?></td>
                                    <td style="text-align: end;">&nbsp;Rp. <?= number_format($d->hrg_total, 2) ?></td>
                                    <td style="text-align: end;">&nbsp;Rp. <?= number_format($totalHargaDiskon, 2) ?></td>
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
                                <td colspan="10" class="bg-black color-palette" style="text-align: center; font-weight: bolder;">LIST DISKON</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listDiskonPrint as $d) : ?>
                                <tr>
                                    <td colspan="9" style="text-align: end;font-weight: bold;"><?= $d['keterangan'] ?> : </td>
                                    <td colspan="1" style="text-align:end">&nbsp;Rp. <?= number_format($d['nominal'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="10" class="bg-black color-palette" style="text-align: center; font-weight: bolder;">GRAND TOTAL</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: end;font-weight: bold;">Total Harga Tanpa Diskon :</td>
                                <td colspan="1" style="text-align:end">&nbsp;Rp. <?= number_format($printSummary['total_harga_tanpa_diskon']) ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: end;font-weight: bold;">Total Harga Dengan Diskon :</td>
                                <td colspan="1" style="text-align:end">&nbsp;Rp. <?= number_format($printSummary['total_harga_dengan_diskon']) ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: end;font-weight: bold;">Tax Tanpa Diskon : <?= $printSummary['tax_persen'] ?>(%)</td>
                                <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($printSummary['tax_tanpa_diskon']) ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: end;font-weight: bold;">Tax Dengan Diskon : <?= $printSummary['tax_persen'] ?>(%)</td>
                                <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($printSummary['tax_dengan_diskon']) ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: end; font-weight: bold;">Grand Total Harga Tanpa Diskon</td>
                                <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($printSummary['grand_total_tanpa_diskon']) ?></td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: end; font-weight: bold;">Grand Total Harga Dengan Diskon</td>
                                <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($printSummary['grand_total_dengan_diskon']) ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table-bordered text-s listdb" style="width: 100%; border-color: black;">
                        <tbody>
                            <?php $noteRows = count($notesuplier) > 0 ? count($notesuplier) : 1; ?>
                            <tr>
                                <td style="text-align: center; background-color: lime; width: 50%; font-weight: bold; color: red;">
                                    MOHON INFORMASI DAHULU,<br>
                                    JIKA EXP DATE KURANG DARI 2 THN<br>
                                    DARI TGL PENGIRIMAN
                                </td>
                                <td colspan="2" class="bg-black color-palette" style="text-align: center; font-weight: bolder;">NOTE UNTUK SUPLIER</td>
                            </tr>
                            <tr>
                                <td rowspan="<?= $noteRows ?>" style="text-align: justify; background-color: yellow;width: 50%;">
                                    * SHIP TO : <br>
                                    KARISMA INDOAGRO UNIVERSAL <br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->shipment_to ?><br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->alamat_ship ?> <br>
                                    * Sebelum kirim barang mohon konfirmasi terlebih dahulu <br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->cp_shipment ?> <br>
                                    &nbsp;&nbsp;&nbsp;<?= $s->no_cp ?> <br>
                                    <?= nl2br($s->ket_1) ?><br>
                                </td>
                                <?php if (count($notesuplier) > 0) : ?>
                                    <td colspan="2" class="bg-orange"><?= nl2br($notesuplier[0]->isi_note); ?></td>
                                <?php else : ?>
                                    <td colspan="2" class="bg-orange">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                            <?php foreach ($notesuplier as $index => $ns) : ?>
                                <?php if ($index === 0) : ?>
                                    <?php continue; ?>
                                <?php endif; ?>
                                <tr>
                                    <td colspan="2" class="bg-orange"><?= nl2br($ns->isi_note); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

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
        </section>
</div>
<?php endforeach; ?>
