<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div style="display: flex; text-align: center;">
                        <a href="<?= base_url('postatus') ?>">
                            <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                        </a>
                        <h3>Kembali</h3>
                    </div>
                </div><!-- /.col -->
                <?php $this->load->view('content/postatus/modalNote') ?>
                <?php $this->load->view('content/postatus/modalEditPO') ?>
            </div><!-- /.row -->
            <div class="card ">
                <div class="m-2">
                    <div class="">
                        <div class="row">
                            <?php foreach ($status as $s) : ?>
                                <div class="col">
                                    <label for="noInv" class="">No Po</label>
                                    <input type="text" id="noInv" name="noInv" value="<?= $s->no_po ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="naSupp" class="">Nama Suplier : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nama_suplier ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="tgTrans" class="">Tanggal Transaksi : &nbsp;&nbsp; </label>
                                    <input type="date" id="tgTrans" name="tgTrans" style="max-width: 250px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly>
                                </div>
                                <?php if ($this->session->userdata('lv') == '2') : ?>
                                    <div class="col-lg">
                                        <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>
                                        <?php if ($s->status == 'DONE') : ?>
                                            <div>
                                                <a href="<?= base_url('printOrder/') . $s->kd_po ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                            </div>
                                        <?php elseif ($s->status == 'ON PROGRESS' || 'NOTE KEUANGAN') : ?>
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
                                        <?php endif; ?>
                                    </div>
                                <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'ON PROGRESS' || $this->session->userdata('lv') == '3' && $s->status == 'NOTE KEUANGAN' || $this->session->userdata('lv') == '3' && $s->status == 'UPDATE KEUANGAN') : ?>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="tgTrans" class="">Status Order : </label>
                                                <a class="btn btn-block btn-success btn-md" href="<?= base_url('konfirmasiOrder/') . $s->kd_po ?>">
                                                    <i class="fas fa-clipboard-check"></i>
                                                    Accept
                                                </a>
                                            </div>
                                            <div class="col">
                                                <label for="tgTrans" class=""> &nbsp;&nbsp; </label>
                                                <a class="btn btn-block btn-danger btn-md" href="<?= base_url('konfirmasiOrder/') . $s->kd_po ?>">
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
            </div>
            <?php $this->load->view('content/postatus/modal_setting/modalSetting') ?>
            <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                <div class="row">
                    <div class="col-md mb-2">
                        <a class="btn btnAtas btn-sm btn-block" href="<?= base_url('addBarangRevisi/') . $s->kd_suplier . '/' . $s->kd_po ?>">
                            <i class="fas fa-plus"> </i>
                            Tambah Barang
                        </a>
                    </div>
                    <div class="col-md">
                        <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalTax<?= $s->kd_po ?>">
                            <i class="fas fa-percent"> </i>
                            Setting Tax
                        </a>
                    </div>
                    <div class="col-md">
                        <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalPembayaran<?= $s->kd_po ?> ">
                            <i class="fas fa-calendar-alt"> </i>
                            Syarat Pembayaran
                        </a>
                    </div>
                    <div class="col-md">
                        <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalPengiriman<?= $s->kd_po ?> ">
                            <i class="fas fa-truck"> </i>
                            Franko Pengiriman
                        </a>
                    </div>
                    <div class="col-md">
                        <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalDiskon<?= $s->kd_po ?>  ">
                            <i class="fas fa-tags"> </i>
                            Tambah Diskon
                        </a>
                    </div>
                </div>

            <?php endif; ?>

            <table class="table table-bordered table-striped ">
                <thead style="background-color: #212529; color:white;">
                    <tr>
                        <td>No</td>
                        <td>Nama Barang</td>
                        <td>Satuan</td>
                        <td>Qty</td>
                        <td>Harga</td>
                        <td>Total Harga</td>
                        <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
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
                            <td><?= $d->satuan ?></td>
                            <td><?= $d->qty ?></td>
                            <td style="display: none;"></td>
                            <td>Rp. <?= number_format($d->hrg_satuan) ?></td>
                            <td>Rp. <?= number_format($d->hrg_total) ?></td>
                            <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                                <td>
                                    <div class="row">
                                        <a class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modalEdit<?= $d->id_det_po ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusBarangPO/') . $d->id_det_po . '/' . $d->kd_po ?>">
                                            <i class="fas fa-trash-alt"></i>
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>

                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach ($total as $t) : ?>
                        <tr>
                            <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                            <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if ($this->session->userdata('lv') == '2' && $s->status != 'DONE') : ?>
                        <tr>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                            <td colspan="1" style="font-weight: bold;"> <?= $s->tmpo_pembayaran ?> Hari </td>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                            <td colspan="2" style="font-weight: bold;"> <?= $s->gdg_pengiriman ?> </td>
                            <td colspan="2" style="font-weight: bold;"></td>
                        </tr>
                        <?php foreach ($diskon as $d) : ?>
                            <?php if ($diskon > 0) : ?>
                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                                    <td colspan="2" style="font-weight: bold;">
                                        Rp. <?= number_format($d->nominal) ?>
                                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskon/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
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
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'DONE') : ?>
                        <tr>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                            <td colspan="1" style="font-weight: bold;"><?= $s->tmpo_pembayaran ?></td>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                            <td colspan="1" style="font-weight: bold;"><?= $s->gdg_pengiriman ?></td>
                            <td colspan="2" style="font-weight: bold;"></td>
                        </tr>
                        <?php foreach ($diskon as $d) : ?>
                            <?php if ($diskon > 0) : ?>
                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                                    <td colspan="2" style="font-weight: bold;">
                                        Rp. <?= number_format($d->nominal) ?>
                                    </td>
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
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php elseif ($this->session->userdata('lv') == '3' && $s->status != 'DONE') : ?>
                        <tr>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                            <td colspan="1" style="font-weight: bold;"> <?= $s->tmpo_pembayaran ?> Hari </td>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                            <td colspan="2" style="font-weight: bold;"> <?= $s->gdg_pengiriman ?> </td>
                            <td colspan="1" style="font-weight: bold;"></td>
                        </tr>
                        <?php foreach ($diskon as $d) : ?>
                            <?php if ($diskon > 0) : ?>
                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                                    <td colspan="1" style="font-weight: bold;">
                                        Rp. <?= number_format($d->nominal) ?>
                                        <?php if ($this->session->userdata('lv') != '3') : ?>
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
                        <?php foreach ($total as $t) :
                                        foreach ($totalDiskon as $d) :
                                            $stlhDiskon = $t->total_harga - $d->total_diskon;
                                            $tax = $s->tax / 100;
                                            $hargaPajak = $stlhDiskon * $tax;
                                            $hargaAll = $stlhDiskon + $hargaPajak; ?>
                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>

                    <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'DONE') : ?>
                        <tr>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                            <td colspan="1" style="font-weight: bold;"> 30 Hari </td>
                            <td colspan="1" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                            <td colspan="1" style="font-weight: bold;"> Gudang Jember </td>
                            <td colspan="2" style="font-weight: bold;"></td>
                        </tr>
                        <?php foreach ($diskon as $d) : ?>
                            <?php if ($diskon > 0) : ?>
                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                                    <td colspan="1" style="font-weight: bold;">
                                        Rp. <?= number_format($d->nominal) ?>
                                        <?php if ($this->session->userdata('lv') != '3') : ?>
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
                        <?php foreach ($total as $t) :
                                        foreach ($totalDiskon as $d) :
                                            $stlhDiskon = $t->total_harga - $d->total_diskon;
                                            $tax = $s->tax / 100;
                                            $hargaPajak = $stlhDiskon * $tax;
                                            $hargaAll = $stlhDiskon + $hargaPajak; ?>
                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                    <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak) ?> </td>
                                </tr>

                                <tr>
                                    <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>


                    <?php endif; ?>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
        <div class="row ml-2 mr-2">
            <div class="col-md-8">
                <div class="noteDirektur">
                    <table class="table noborder">
                        <thead>
                            <tr>
                                <td class="tdnote">ISI NOTE</td>
                                <td class="tduser">USER</td>
                                <td style="text-align: center;">TANGGAL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($noted as $n) : ?>
                                <tr>
                                    <td class="tdnote"><?= $n->isi_note ?></td>
                                    <td class="tduser"><?= $n->kd_user ?></td>
                                    <td style="text-align: center;"><?= $n->log_create ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <!-- /.content-header -->
</div>
<?php endforeach; ?>