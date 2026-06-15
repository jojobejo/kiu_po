<?php $this->load->view('content/po/_po_summary_helpers') ?>
<div class="wrapper">
    <!-- Main content -->
    <?php foreach ($status as $s) : ?>
        <?php
        list($poPrintRows, $poPrintSummary) = po_build_item_rows($detail, $diskon, 'detail', $s->tax);
        $poPrintDiscountRows = po_build_discount_rows($diskon, $poPrintRows, 'detail', $s->tax);
        $poPrintSummary = po_apply_discount_rows_summary($poPrintSummary, $poPrintDiscountRows);
        $poPrintSummary = po_add_tax_summary($poPrintSummary, $s->tax);
        $poPrintDisplayTaxPercent = $poPrintSummary['tax_percent'];
        $poPrintGrandTotalHarga = $poPrintSummary['grand_total_with_discount'];
        $poPrintTotalDiskonRounded = ceil(po_num($poPrintSummary['total_discount']) / 10000000) * 10000000;
        $poPrintGrandTotalHargaRounded = ceil(po_num($poPrintGrandTotalHarga) / 100000) * 100000;
        $poPrintTotalPajakRounded = max($poPrintGrandTotalHargaRounded - po_num($poPrintSummary['total_after_discount']), 0);
        ?>
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
                    <table class="table-bordered text-s listdb" style="width: 100%; table-layout: fixed;">
                        <colgroup>
                            <col style="width: 2%;">
                            <col style="width: 37%;">
                            <col style="width: 5%;">
                            <col style="width: 4%;">
                            <col style="width: 5%;">
                            <col style="width: 12%;">
                            <col style="width: 12%;">
                            <col style="width: 11%;">
                            <col style="width: 12%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <td colspan="9" class="bg-black" style="font-weight: bold; font-size: medium; text-align: center;">FORM PEMESANAN INTERNAL</td>
                            </tr>
                            <tr style="text-align: center;">
                                <td>No</td>
                                <td>Nama Barang</td>
                                <td>Satuan</td>
                                <td>Qty</td>
                                <td>Qty Kecil</td>
                                <td hidden>Harga Satuan</td>
                                <td>Harga Satuan Kecil</td>
                                <td>Harga Setelah Diskon</td>
                                <td>Total Harga</td>
                                <td>Total Harga Setelah Diskon</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($poPrintRows as $row) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $no++; ?></td>
                                    <td style="word-wrap: break-word;">
                                        <?= htmlspecialchars($row['nama_barang'], ENT_QUOTES, 'UTF-8') ?>
                                        <?php if ($row['is_bonus']) : ?>
                                            <br><small>Bonus<?= $row['bonus_note'] !== '' ? ' - ' . htmlspecialchars($row['bonus_note'], ENT_QUOTES, 'UTF-8') : '' ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;"><?= htmlspecialchars($row['satuan'], ENT_QUOTES, 'UTF-8') ?></td>
                                    <td style="text-align: center;"><?= po_qty($row['qty']) ?></td>
                                    <td style="text-align: center;"><?= po_qty($row['qty_kecil']) ?></td>
                                    <td hidden style="text-align: end;">&nbsp;<?= po_money($row['harga_satuan']) ?></td>
                                    <td style="text-align: end;">&nbsp;<?= po_money($row['harga_satuan_kecil']) ?></td>
                                    <td style="text-align: end;">&nbsp;<?= po_money($row['harga_final_unit']) ?></td>
                                    <td style="text-align: end;">&nbsp;<?= po_money($row['total_before']) ?></td>
                                    <td style="text-align: end;">&nbsp;<?= po_money($row['total_after']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="7" style="text-align: end;font-weight: bold;">Total Harga :</td>
                                <td style="text-align:end;font-weight: bold;">&nbsp;<?= po_money($poPrintSummary['total_before_discount']) ?></td>
                                <td style="text-align:end;font-weight: bold;">&nbsp;<?= po_money($poPrintSummary['total_after_discount']) ?></td>
                            </tr>
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
                            <tr>
                                <td colspan="8" style="text-align: center; font-weight: bold;">Deskripsi Diskon</td>
                                <td style="text-align: center; font-weight: bold;">Nominal</td>
                                <td style="text-align: center; font-weight: bold;">Value</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($poPrintDiscountRows as $d) : ?>
                                <tr>
                                    <td colspan="8" style="text-align: end;font-weight: bold;"><?= htmlspecialchars($d['label'], ENT_QUOTES, 'UTF-8') ?> : </td>
                                    <td colspan="1" style="text-align:end">&nbsp;<?= po_money($d['nominal']) ?></td>
                                    <td colspan="1" style="text-align:end">&nbsp;<?= po_money($d['total_discount']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="10" class="bg-black color-palette" style="text-align: center; font-weight: bolder;">GRAND TOTAL</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align: end; font-weight: bold;">Total Diskon</td>
                                <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($poPrintTotalDiskonRounded, 2, '.', ',') ?></td>
                            </tr>
                            <?php if (po_num($poPrintDisplayTaxPercent) > 0) : ?>
                                <tr>
                                    <td colspan="9" style="text-align: end;font-weight: bold;">Total Pajak : <?= po_qty($poPrintDisplayTaxPercent) ?>(%)</td>
                                    <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($poPrintTotalPajakRounded, 2, '.', ',') ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td colspan="9" style="text-align: end; font-weight: bold;">Grand Total Harga</td>
                                <td colspan="1" style="text-align:end;">&nbsp;Rp. <?= number_format($poPrintGrandTotalHargaRounded, 2, '.', ',') ?></td>
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
