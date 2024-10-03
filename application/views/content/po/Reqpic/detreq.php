<?php if ($this->session->userdata('lv') == '4') : ?>
    <?php foreach ($status as $s) : ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="card">
                        <?php if ($s->status == 'ON PROGRESS') : ?>
                            <a class="btn btn-block btn-warning btn-sm" href=""><i class="fas fa-exclamation-triangle"></i>&nbsp;<?= $s->status ?>&nbsp;<i class="fas fa-exclamation-triangle"></i></a>
                        <?php elseif ($s->status == 'REQUEST ACC') : ?>
                            <a class="btn btn-block btn-info btn-sm" href=""><i class="fas fa-check-circle"></i>&nbsp;<?= $s->status ?>&nbsp;<i class="fas fa-check-circle"></i></a>
                        <?php elseif ($s->status == 'DONE') : ?>
                            <a class="btn btn-block btn-success btn-sm" href=""><i class="fas fa-check-circle"></i>&nbsp;<?= $s->status ?>&nbsp;<i class="fas fa-check-circle"></i></a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h1 class="m-0">Detail Request Barang - PIC - <a class="btn btn-primary btn-sm" href="<?= base_url('reqpic') ?>"><i class="fas fa-home"></i></a></h1>
                            <!-- FIELD DATA PENGAJUAN  -->
                            <div class="row">
                                <div class="col">
                                    <label for="naSupp" class="">Tanggal Transaksi : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= format_tgl_lahir($s->tgl_transaksi) ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="naSupp" class="">PIC : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="naSupp" class="">Departement : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->departemen ?>" class="form-control" readonly>
                                </div>
                            </div>
                            <?php if ($s->status == 'ON PROGRESS') : ?>
                                <table class="table table-bordered table-striped mt-4 mb-2 ">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td>Keterangan</td>
                                            <td>QTY</td>
                                            <td>Satuan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($datereqpic as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->qtykebutuhan ?></td>
                                                <td><?= $d->nm_satuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php elseif ($s->status == 'BARANG TERSEDIA') : ?>
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">item list barang request</b></a>
                                <table class="table table-bordered table-striped mb-2">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:20%;">Keterangan</td>
                                            <td style="width:10%;text-align: center;">QTY</td>
                                            <td style="width:10%;text-align: center;">Satuan</td>
                                            <td style="width:10%;text-align: center;">#</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($getitmlistpicreq as $d) : ?>
                                            <tr>
                                                <td><?= $d->nmbarang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->ket ?></td>
                                                <td style="text-align: center;"><?= $d->qty ?></td>
                                                <td style="text-align: center;"><?= $d->nmsatuan ?></td>
                                                <td><a href="#" class="btn btn-block btn-success btn-md"><i class="fas fa-check-circle"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php elseif ($s->status == 'REQUEST ACC') : ?>
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">Work in Process</b></a>
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">item list</b></a>
                                <table class="table table-bordered table-striped mb-2 ">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:30%">Keterangan</td>
                                            <td style="width:10%">Satuan</td>
                                            <td style="width:10%">QTY</td>
                                            <td style="width:10%">#</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detreq as $d) :
                                            $stkready = $d->qty_ready - $d->qty_req;
                                        ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->nm_satuan ?></td>
                                                <td><?= $d->qty_req ?></td>
                                                <?php if ($d->sts == '1') : ?>
                                                    <td><a href="#" class="btn btn-block btn-success btn-md"><i class="fas fa-check-circle"></i></a></td>
                                                <?php elseif ($d->sts == '4') : ?>
                                                    <td><a href="#" class="btn btn-block btn-warning btn-md"><i class="fas fa-pause-circle "></i></a></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php elseif ($s->status == 'DONE') : ?>
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">REQUEST DONE</b></a>
                                <table class="table table-bordered table-striped mb-2">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:20%;">Keterangan</td>
                                            <td style="width:10%;text-align: center;">QTY</td>
                                            <td style="width:10%;text-align: center;">Satuan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($getitmlistpicreq as $d) : ?>
                                            <tr>
                                                <td><?= $d->nmbarang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->ket ?></td>
                                                <td style="text-align: center;"><?= $d->qty ?></td>
                                                <td style="text-align: center;"><?= $d->nmsatuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
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
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->
        </div>
    <?php endforeach; ?>
    <!-- ============================================================================================================================================================================== -->
    <!-- ============================================================================================================================================================================== -->
    <!-- ============================================================================================================================================================================== -->
    <!-- ============================================================================================================================================================================== -->
    <!-- ============================================================================================================================================================================== -->
    <!-- ============================================================================================================================================================================== -->
<?php elseif ($this->session->userdata('lv') == '2') : ?>
    <?php foreach ($status as $s) : ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <?php if ($s->status == 'ON PROGRESS') : ?>
                        <a class="btn btn-block btn-warning btn-sm" href=""><i class="fas fa-exclamation-triangle"></i>&nbsp;<?= $s->status ?>&nbsp;<i class="fas fa-exclamation-triangle"></i></a>
                    <?php elseif ($s->status == 'REQUEST ACC') : ?>
                        <a class="btn btn-block btn-info btn-sm" href=""><i class="fas fa-check-circle"></i>&nbsp;<?= $s->status ?>&nbsp;<i class="fas fa-check-circle"></i></a>
                    <?php else : ?>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">Detail Request Barang - PIC - <a class="btn btn-primary btn-sm" href="<?= base_url('reqpic') ?>"><i class="fas fa-home"></i></a></h1>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                            <!-- FIELD DATA PENGAJUAN  -->
                            <div class="row mt-3">
                                <div class="col">
                                    <label for="naSupp" class="">Tanggal Transaksi : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= format_tgl_lahir($s->tgl_transaksi) ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="naSupp" class="">PIC : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="naSupp" class="">Departement : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->departemen ?>" class="form-control" readonly>
                                </div>
                            </div>


                            <!-- STATUS : REQUEST ACC  -->
                            <?php if ($s->status == 'REQUEST ACC') : ?>
                                <!-- =================================================================================================================================== -->
                                <!-- ==================================================V2====================================================================  -->
                                <!-- =================================================================================================================================== -->
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">Work in Process</b></a>
                                <table class="table table-bordered table-striped mb-2">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nomor PO</td>
                                            <td>Status Order</td>
                                            <td>Tanggal PO</td>
                                            <td>Nama Pengaju</td>
                                            <td>Departement</td>
                                            <td>Tujuan Pembelian</td>
                                            <td>#</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($stspo as $st) : ?>
                                            <tr>
                                                <td><?= $st->nopo ?></td>
                                                <?php if ($st->status == 'ON PROGRESS') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-clock"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '2') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-exclamation"></i>&nbsp;
                                                            Terdapat Update Dari Direktur
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '3') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-clock"></i>&nbsp;
                                                            ON PROGRESS
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '3') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-exclamation"></i>&nbsp;
                                                            Terdapat Update Dari Keuangan
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '2') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-clock"></i>&nbsp;
                                                            ON PROGRESS
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '2') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-clock"></i>&nbsp;
                                                            MENUNGGU ACC KADEP
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'DONE') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-success btn-sm">
                                                            <i class="fas fa-thumbs-up"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'REJECT') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-danger btn-sm">
                                                            <i class="fas fa-times"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'PO REVISI') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-undo"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'PENDING') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-pause"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'ACC-KADEP') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-primary btn-sm">
                                                            <i class="fas fa-thumbs-up"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'PROSES PEMBELIAN') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-primary btn-sm">
                                                            <i class="fas fa-thumbs-up"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '5') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-clock"></i>&nbsp;
                                                            MENUNGGU ACC KADEP
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') != '3') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-clock"></i>&nbsp;
                                                            <?= $st->status ?>
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') == '3') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-warning btn-sm">
                                                            <i class="fas fa-clock"></i>&nbsp;
                                                            PENGAJUAN PEMBELIAN BARU
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '2' || $st->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '4' || $st->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '5') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-primary btn-sm">
                                                            <i class="fas fa-thumbs-up"></i>&nbsp;
                                                            ACC DIREKTUR
                                                        </a>
                                                    </td>
                                                <?php elseif ($st->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '2' || $st->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '4' || $st->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '5') : ?>
                                                    <td>
                                                        <a class="btn btn-block btn-primary btn-sm">
                                                            <i class="fas fa-thumbs-up"></i>&nbsp;
                                                            PROSES PEMBELIAN
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                                <td><?= format_tgl_lahir($st->tgltr) ?></td>
                                                <td><?= $st->nmuser ?></td>
                                                <td><?= $st->dep ?></td>
                                                <td><?= $st->tjbeli ?></td>
                                                <td>
                                                    <a href="<?= base_url('detailponk/' . $st->kdpo) ?>" class="btn btn-block btn-primary btn-sm" target="_blank"><i class="fas fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">item list</b></a>
                                <table class="table table-bordered table-striped mb-2 ">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:30%">Keterangan</td>
                                            <td style="width:10%">Satuan</td>
                                            <td style="width:10%">QTY</td>
                                            <td style="width:10%">#</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detreq as $d) :
                                            $stkready = $d->qty_ready - $d->qty_req;
                                        ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->nm_satuan ?></td>
                                                <td><?= $d->qty_req ?></td>
                                                <?php if ($d->sts == '1') : ?>
                                                    <td><a href="#" class="btn btn-block btn-success btn-md"><i class="fas fa-check-circle"></i></a></td>
                                                <?php elseif ($d->sts == '4') : ?>
                                                    <td><a href="#" class="btn btn-block btn-warning btn-md"><i class="fas fa-pause-circle "></i></a></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php foreach ($countitm as $c) :
                                    $tot    = $c->total;
                                    $toty   = $c->tot_yes + $c->tot_no;
                                    $totacc = $c->tot_yes;
                                    $totpnd = $c->tot_no;
                                ?>
                                    <?php if ($totpnd == '0') : ?>
                                        <?php foreach ($stspo as $st) : ?>
                                            <?php if ($st->status != 'PROSES PEMBELIAN') : ?>
                                                <?php echo form_open_multipart('reqpicconfirmed'); ?>
                                                <?php $now = date("Y-m-d"); ?>
                                                <input type="text" id="kdreqpo" name="kdreqpo" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                                <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $st->kdpo ?>" class="form-control" readonly hidden>
                                                <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $now ?>" class="form-control" readonly hidden>
                                                <input type="text" id="pic" name="pic" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>
                                                <input type="text" id="kdpic" name="kdpic" style="max-width: 550px;" value="<?= $s->kd_user ?>" class="form-control" readonly hidden>
                                                <input type="text" id="dep" name="dep" style="max-width: 550px;" value="<?= $s->departemen ?>" class="form-control" readonly hidden>
                                                <input type="text" id="tjbuy" name="tjbuy" style="max-width: 550px;" value="<?= $s->tj_pembelian ?>" class="form-control" readonly hidden>
                                                <button type="submit" class="btn btn-block btn-primary btn-md"><B>ORDER CONFIRMED</B></button>
                                            <?php else : ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <?php echo form_open_multipart('reqpicconfirmed_plus'); ?>
                                        <?php $now = date("Y-m-d"); ?>
                                        <input type="text" id="kdreqpo" name="kdreqpo" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                        <button type="submit" class="btn btn-block btn-primary btn-md"><B>ORDER CONFIRMED</B></button>
                                    <?php endif; ?>
                                <?php endforeach; ?>

                                <!-- STATUS : ON PROGRESS -->

                            <?php elseif ($s->status == 'ON PROGRESS') : ?>
                                <table class="table table-bordered table-striped mt-4 mb-2 ">

                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td>Keterangan</td>
                                            <td>QTY</td>
                                            <td style="width: 10%;">Qty Tersedia</td>
                                            <td>Satuan</td>
                                            <td>Status</td>
                                            <td>#</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detreq as $d) :
                                            $tot    = ($d->qty_ready) - ($d->qty_req);
                                        ?>
                                            <!-- MODAL START -->
                                            <div class="modal fade" id="modaledited<?= $d->id ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Pengajuan Tambahan Barang </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo form_open_multipart('actpending/' . $d->id . '/' . $d->kode_po); ?>
                                                            <div class="form-group" hidden>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text" id="kdponk" name="qty_isi" value="<?= $d->kode_po ?>" readonly />
                                                                        <input class="form-control" type="text" id="idponk" name="qty_isi" value="<?= $d->id ?>" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label class="col-sm-3 control-label text-right" for="kd_user">Qty<span class="required">*</span></label>
                                                                    <div class="col-sm-8"><input class="form-control" type="number" id="qty_isi" name="qty_isi" value="" /></div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <label class="col-sm-3 control-label text-right" for="kd_user">Harga Satuan<span class="required">*</span></label>
                                                                    <div class="col-sm-8"><input class="form-control" type="number" id="hrg_isi" name="hrg_isi" value="" /></div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- MODAL END -->
                                                <tr>
                                                    <td><?= $d->nama_barang ?></td>
                                                    <td><?= $d->deskripsi ?></td>
                                                    <td><?= $d->keterangan ?></td>
                                                    <td><?= $d->qty_req ?></td>
                                                    <td><?= $d->qty_ready ?></td>
                                                    <td><?= $d->nm_satuan ?></td>
                                                    <?php if ($d->sts != '0') : ?>
                                                        <td><a href="" class="btn btn-info btn-block"></a></td>
                                                    <?php else : ?>
                                                        <?php if ($tot == '0' && $d->sts == '0') : ?>
                                                            <td><a href="" class="btn btn-success btn-block"></a></td>
                                                        <?php elseif ($tot < '0' && $d->sts == '0') : ?>
                                                            <td><a href="" class="btn btn-danger btn-block"></a></td>
                                                        <?php elseif ($tot > '0' && $d->sts == '0') : ?>
                                                            <td><a href="" class="btn btn-success btn-block"></a></td>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                    <?php if ($d->sts == '0') : ?>

                                                        <td>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="<?= base_url('actconfirm/' . $d->id) ?>" class="btn btn-block btn-success btn-sm"><i class="fas fa-check"></i></a>
                                                                </div>
                                                                <!-- <div class="col">
                                                                <a href="<?= base_url('actpending/' . $d->id . '/' . $d->kode_po) ?>" class="btn btn-block btn-warning btn-sm"><i class="fas fa-times"></i></a>
                                                            </div> -->
                                                                <div class="col">
                                                                    <a href="" class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modaledited<?= $d->id ?>"><i class="fas fa-plus"></i></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php else : ?>
                                                        <td><a href="#" class="btn btn-block btn-info btn-sm"><i class="fas fa-clipboard-check "></i></a></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?php foreach ($countitm as $c) :
                                    $tot    = $c->total;
                                    $toty   = $c->tot_yes + $c->tot_no;
                                    $totacc = $c->tot_yes;
                                    $totpnd = $c->tot_no;
                                ?>
                                    <!-- AKSI UNTUK DAPAT MELAKUKAN PO RESTOCK  -->
                                    <?php if ($totpnd > '0') : ?>
                                        <?php echo form_open_multipart('acc_req_admin'); ?>
                                        <?php $now = date("Y-m-d"); ?>
                                        <input type="text" id="kdreqpo" name="kdreqpo" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                        <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $kdponks ?>" class="form-control" readonly hidden>
                                        <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $now ?>" class="form-control" readonly hidden>
                                        <input type="text" id="pic" name="pic" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>
                                        <input type="text" id="kdpic" name="kdpic" style="max-width: 550px;" value="<?= $s->kd_user ?>" class="form-control" readonly hidden>
                                        <input type="text" id="dep" name="dep" style="max-width: 550px;" value="<?= $s->departemen ?>" class="form-control" readonly hidden>
                                        <input type="number" id="jml" name="jml" style="max-width: 550px;" value="<?= $totpnd ?>" class="form-control" readonly hidden>
                                        <?php foreach ($countjmlharga as $ct) : ?>
                                            <input type="number" id="jmltot" name="jmltot" style="max-width: 550px;" value="<?= $ct->hrg ?>" class="form-control" readonly hidden>
                                        <?php endforeach; ?>
                                        <input type="text" id="tjbuy" name="tjbuy" style="max-width: 550px;" value="<?= $s->tj_pembelian ?>" class="form-control" readonly hidden>
                                        <button type="submit" class="btn btn-block btn-primary btn-md"><B>ORDER CONFIRMED</B></button>
                                        <!-- END AKSI RESTOCK -->
                                        <!-- AKSI TRANSAKSI / STOCK BARANG READY -->
                                    <?php else : ?>
                                        <?php echo form_open_multipart('acc_req_admin_plus'); ?>
                                        <?php $now = date("Y-m-d"); ?>
                                        <input type="text" id="kdreqpo" name="kdreqpo" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                        <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $kdponks ?>" class="form-control" readonly hidden>
                                        <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $now ?>" class="form-control" readonly hidden>
                                        <input type="text" id="pic" name="pic" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>
                                        <input type="text" id="kdpic" name="kdpic" style="max-width: 550px;" value="<?= $s->kd_user ?>" class="form-control" readonly hidden>
                                        <input type="text" id="dep" name="dep" style="max-width: 550px;" value="<?= $s->departemen ?>" class="form-control" readonly hidden>
                                        <input type="number" id="jml" name="jml" style="max-width: 550px;" value="<?= $totpnd ?>" class="form-control" readonly hidden>
                                        <?php foreach ($countjmlharga as $ct) : ?>
                                            <input type="number" id="jmltot" name="jmltot" style="max-width: 550px;" value="<?= $ct->hrg ?>" class="form-control" readonly hidden>
                                        <?php endforeach; ?>
                                        <input type="text" id="tjbuy" name="tjbuy" style="max-width: 550px;" value="<?= $s->tj_pembelian ?>" class="form-control" readonly hidden>
                                        <button type="submit" class="btn btn-block btn-primary btn-md"><B>ORDER CONFIRMED</B></button>
                                    <?php endif; ?>
                                    <!-- END TRANSAKSI /STOCK BARANG READY -->
                                <?php endforeach; ?>

                                <!-- END ON PROGRESS -->

                                <!-- STATUS : BARANG TERSEDIA -->
                            <?php elseif ($s->status == 'BARANG TERSEDIA') : ?>
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">item list</b></a>
                                <table class="table table-bordered table-striped mb-2">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:20%;">Keterangan</td>
                                            <td style="width:10%;text-align: center;">QTY</td>
                                            <td style="width:10%;text-align: center;">Satuan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($gettr as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->descnk ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td style="text-align: center;"><?= $d->qty ?></td>
                                                <td style="text-align: center;"><?= $d->nm_satuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php if (!empty($stspo)) : ?>
                                    <?php foreach ($stspo as $st) : ?>
                                        <div class="col">
                                            <?php echo form_open_multipart('reqpicdone'); ?>
                                            <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                            <input type="text" id="kdponks" name="kdponks" style="max-width: 550px;" value="<?= $st->kdpo ?>" class="form-control" readonly hidden>
                                            <input type="text" id="kd_user" name="kd_user" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>
                                            <input type="text" id="actdone" name="actdone" style="max-width: 550px;" value="1" class="form-control" readonly hidden>
                                            <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly hidden>
                                            <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-cloud-upload-alt"></i>&nbsp;REQUEST DONE</button>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <?php echo form_open_multipart('reqpicdone'); ?>
                                    <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                    <input type="text" id="kd_user" name="kd_user" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>
                                    <input type="text" id="actdone" name="actdone" style="max-width: 550px;" value="2" class="form-control" readonly hidden>
                                    <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-cloud-upload-alt"></i>&nbsp;REQUEST DONE</button>
                                <?php endif; ?>

                                <!-- END BARANG TERSEDIA -->

                                <!-- STATUS : DONE -->
                            <?php elseif ($s->status == 'DONE') : ?>
                                <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">REQUEST DONE</b></a>
                                <table class="table table-bordered table-striped mb-2">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:30%">Keterangan</td>
                                            <td style="width:10%">QTY</td>
                                            <td style="width:10%">Satuan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($gettr as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->descnk ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td style="text-align: center;"><?= $d->qty ?></td>
                                                <td style="text-align: center;"><?= $d->nm_satuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                        </div> <!-- END BODY CARD  -->
                    </div> <!-- END CARD -->

                    <!-- START NOTE  -->
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
                    <!-- END NOTE -->

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        </div>
    <?php endforeach; ?>
<?php endif; ?>