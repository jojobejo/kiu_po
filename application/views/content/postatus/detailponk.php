<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div style="display: flex; text-align: center;">
                        <a href="<?= base_url('postatusnk') ?>">
                            <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                        </a>
                        <h3>Kembali</h3>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>

    <section class="content">
        <div class="card">
            <div class="m-2">
                <div class="">
                    <div class="row">
                        <?php foreach ($status as $s) : ?>
                            <div class="col">
                                <label for="tgTrans" class="">Tanggal Transaksi : &nbsp;&nbsp; </label>
                                <input type="date" id="tgTrans" name="tgTrans" style="max-width: 250px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="naSupp" class="">Nama Pengaju: </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="noInv" class="">Departemen</label>
                                <input type="text" id="noInv" name="noInv" value="<?= $s->departemen ?>" class="form-control" readonly>
                            </div>

                            <?php if ($this->session->userdata('lv') == '2') : ?>
                                <div class="col-lg">
                                    <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>
                                    <?php if ($s->status == 'DONE') : ?>
                                        <div>
                                            <a href="<?= base_url('printOrdernk/') . $s->kd_po_nk ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                        </div>

                                    <?php elseif ($s->status == 'ON PROGRESS') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'NOTE KEUANGAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'UPDATE DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-exclamation"></i> Terdapat Update</a>
                                        </div>
                                    <?php elseif ($s->status == 'REJECT') : ?>
                                        <div>
                                            <a href="#" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Order Ditolak</a>
                                        </div>
                                    <?php elseif ($s->status == 'PO REVISI') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-undo"></i> PO REVISI</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'ON PROGRESS' || $this->session->userdata('lv') == '3' && $s->status == 'NOTE DIREKTUR' || $this->session->userdata('lv') == '3' && $s->status == 'NOTE KEUANGAN' || $this->session->userdata('lv') == '3' && $s->status == 'UPDATE KEUANGAN') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Status Order : </label>
                                            <a class="btn btn-block btn-success btn-md" href="<?= base_url('konfirmasiOrderNK/') . $s->kd_po_nk . '/' . $this->session->userdata('kode') ?>">
                                                <i class="fas fa-clipboard-check"></i>
                                                Accept
                                            </a>
                                        </div>
                                        <div class="col">
                                            <label for="tgTrans" class=""> &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-danger btn-md" href="<?= base_url('tolakOrderNK/') . $s->kd_po_nk . '/' . $this->session->userdata('kode') ?>">
                                                <i class="fas fa-times"></i> &nbsp;
                                                Reject
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="tgTrans" class="">Note Direktur : &nbsp;&nbsp; </label>
                                    <div>
                                        <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modalAddNote"><i class="fas fa-exclamation"> </i> &nbsp; Add Note</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalAddNote">
                                                <i class="fas fa-clipboard-check"></i> &nbsp;
                                                Update
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Pilih Setting Note : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalAddNote">
                                                <i class="fas fa-clipboard-check"></i> &nbsp;
                                                Setting Note
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col">
                <label for="noInv" class="">Tujuan Pembelian</label>
                <textarea type="text" id="noInv" name="noInv" class="form-control mb-2" readonly><?= $s->tj_pembelian ?></textarea>
            </div>
        </div>
        <!-- FITUR ADD -->
        <?php $this->load->view('content/postatus/modal_setting/modalponk') ?>
        <?php if ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>

        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>

        <?php elseif ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
            <div class="row">
                <div class="col-md mb-2">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#addmodalbarang">
                        <i class="fas fa-plus"> </i>
                        Tambah Barang
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#addtax">
                        <i class="fas fa-percent"> </i>
                        Setting Tax
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#adddiskon">
                        <i class="fas fa-tags"> </i>
                        Tambah Diskon
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#edponk<?= $s->kd_po_nk ?>">
                        <i class="fas fa-server"> </i>
                        Edit Data Po
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#add_note_pembelian">
                        <i class="fas fa-vote-yea"> </i>
                        Tambah Note Pembelian
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped ">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Deskripsi</td>
                    <td>Keterangan</td>
                    <td>Qty</td>
                    <td>Harga</td>
                    <td>Total Harga</td>
                    <?php if ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>
                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                        <td>#</td>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                            foreach ($detail as $d) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d->nama_barang ?></td>
                        <td><?= $d->deskripsi ?></td>
                        <td><?= $d->keterangan ?></td>
                        <td><?= $d->qty ?></td>
                        <td style="display: none;"></td>
                        <td>Rp. <?= number_format($d->hrg_satuan) ?></td>
                        <td>Rp. <?= number_format($d->total_harga) ?></td>
                        <?php if ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>
                        <?php elseif ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                            <td>
                                <div class="row">
                                    <a class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#edititem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#hapusitem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Hapus
                                    </a>
                                </div>
                            </td>

                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                    <?php foreach ($total as $t) : ?>
                        <tr>
                            <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                            <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="8" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
                    </tr>
                    <?php foreach ($diskon as $d) : ?>
                        <?php if ($diskon > 0) : ?>
                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                                <td colspan="2" style="font-weight: bold;">
                                    Rp. <?= number_format($d->nominal, 2) ?>
                                    <?php if ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>
                                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskon/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="8" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
                    </tr>
                    <?php foreach ($ntpembelian as $ntpm) : ?>
                        <tr>
                            <td colspan="7" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
                            <td colspan="1" style="font-weight: bold;">
                                <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#edit_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="8" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
                    </tr>
                    <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($this->session->userdata('lv') == '3') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="1" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="7" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="1" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="1" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>
    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="1" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="7" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="7" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="1" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="1" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>
    <?php endif; ?>


    <div class="row mr-2">
        <div class="col-md-8">
            <div class="noteDirektur">
                <table class="table table-bordered table-stripeds">
                    <thead style="background-color: #212529; color:white;">
                        <tr>
                            <td class="tdnote">ISI NOTE</td>
                            <td class="tduser">USER</td>
                            <td style="text-align: center;">TANGGAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($log as $l) : ?>
                            <tr>
                                <td><?= $l->isi_note ?></td>
                                <td><?= $l->nama_user ?></td>
                                <td><?= $l->log_create ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>
    <!-- /.content-header -->

</div>
<?php endforeach; ?>