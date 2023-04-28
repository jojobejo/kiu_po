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
                                <?php if ($this->session->userdata('lv') < '3') : ?>
                                    <div class="col-lg">
                                        <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>

                                        <?php if ($s->status == 'ON PROGRESS') : ?>
                                            <div>
                                                <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                            </div>
                                        <?php elseif ($s->status == 'DONE') : ?>
                                            <div>
                                                <a href="<?= base_url('printOrder/') . $s->kd_po ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                            </div>
                                        <?php elseif ($s->status == 'NOTED') : ?>
                                            <div>
                                                <a href="#" class="btn btn-warning btn-block"><i class="fas fa-exclamation"></i> Note Direktur</a>
                                            </div>
                                        <?php elseif ($s->status == 'UPDATE') : ?>
                                            <div>
                                                <a href="#" class="btn btn-warning btn-block"><i class="fas fa-exclamation"></i> Terdapat Update</a>
                                            </div>
                                        <?php elseif ($s->status == 'REJECT') : ?>
                                            <div>
                                                <a href="#" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Order Ditolak</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'ON PROGRESS' || $this->session->userdata('lv') == '3' && $s->status == 'NOTED' || $this->session->userdata('lv') == '3' && $s->status == 'UPDATE') : ?>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>
                                                <a class="btn btn-block btn-success btn-md" href="<?= base_url('konfirmasiOrder/') . $s->kd_po ?>">
                                                    <i class="fas fa-clipboard-check"></i> &nbsp;
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
            <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                <div class="col m-2">
                    <a class="btn btn-primary btn-sm" href="<?= base_url('addBarangRevisi/') . $s->kd_suplier . '/' . $s->kd_po ?>  ">
                        <i class="fas fa-pencil-alt"></i>
                        Tambah Barang
                    </a>
                </div>
            <?php endif; ?>

            <table class="table table-bordered table-striped">
                <thead style="background-color: #212529; color:white;">
                    <tr>
                        <td>No</td>
                        <td>Nama Barang</td>
                        <td>Satuan</td>
                        <td>Qty</td>
                        <td>Harga</td>
                        <td>Tax(%)</td>
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
                            <td>Rp. <?= number_format($d->hrg_satuan) ?></td>
                            <td><?= $d->tax ?> (%)</td>
                            <td>Rp. <?= number_format($d->hrg_total) ?></td>
                            <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                                <td>
                                    <div class="row">
                                        <a class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modalEdit<?= $d->id_det_po ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <a class="btn btn-block btn-danger btn-sm" href="<?= base_url('hapusBarangPO/') . $d->id_det_po . '/' . $d->kd_po ?>">
                                            <i class="fas fa-trash-alt"></i>
                                            Hapus
                                        </a>
                                    </div>
                                </td>
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>

                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <?php if ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
                            <td></td>
                        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                        <?php endif; ?>
                    </tr>
                    <?php foreach ($total as $t) : ?>
                        <tr>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                            <td colspan="2" style="font-weight: bold;">Rp.<?= number_format($t->total_harga) ?></td>
                        </tr>
                    <?php endforeach; ?>
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
            <div class="col-md-4">
                <div class="log-status">
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="tduser">Status</td>
                                <td class="tduser">LOG</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($log as $l) : ?>
                                <tr>
                                    <td style="text-align: center;"><?= $l->status ?></td>
                                    <td style="text-align: center;"><?= $l->createat ?></td>
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