<?php if ($this->session->userdata('lv') == '4') : ?>

    <?php foreach ($totsts as $tot) : ?>
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
                                <?php elseif ($s->status == 'REQUEST ACC') : ?>
                                    <a href="#" class="btn btn-success btn-block mt-4">BARANG ACC</a>
                                    <table class="table table-bordered table-striped mb-2 ">
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
                                            <?php foreach ($detreqpic as $d) : ?>
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
                                    <a href="#" class="btn btn-warning btn-block mt-4">BARANG PENDING</a>
                                    <table class="table table-bordered table-striped mb-2 ">
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
                                            <?php foreach ($detreqpic1 as $d) : ?>
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
                                <?php elseif ($s->status == 'DONE') : ?>
                                    <a href="#" class="btn btn-success btn-block mt-4">BARANG ACC</a>
                                    <table class="table table-bordered table-striped mb-2 ">
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
                                            <?php foreach ($detreqpic1 as $d) : ?>
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
                                    <a href="#" class="btn btn-warning btn-block mt-4">BARANG PENDING</a>
                                    <table class="table table-bordered table-striped mb-2 ">
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
                                            <?php foreach ($detreqpic2 as $d) : ?>
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
                                <a href="#" class="btn btn-success btn-block mt-4"><b>BARANG ACC</b></a>
                                <table class="table table-bordered table-striped mb-2 ">
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
                                        <?php foreach ($detreq1 as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->qty_req ?></td>
                                                <td><?= $d->nm_satuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <a href="#" class="btn btn-warning btn-block mt-4"><b>BARANG PENDING</b></a>
                                <table class="table table-bordered table-striped mb-2 ">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:30%">Keterangan</td>
                                            <td>QTY</td>
                                            <td>Satuan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detreq2 as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->qty_req ?></td>
                                                <td><?= $d->nm_satuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?php echo form_open_multipart('reqpicdone'); ?>
                                <?php $now = date("Y-m-d"); ?>
                                <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $now ?>" class="form-control" readonly hidden>
                                <input type="text" id="pic" name="pic" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>

                                <button type="submit" class="btn btn-block btn-primary btn-sm">DONE</button>
                                <!-- END REQUEST ACC  -->

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
                                            <td>#</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detreq as $d) :
                                            $tot = ($d->qty_ready) - ($d->qty_req); ?>
                                            <?php if ($tot <= '0') : ?>
                                                <tr>
                                                    <td class="table-danger"><?= $d->nama_barang ?></td>
                                                    <td class="table-danger"><?= $d->deskripsi ?></td>
                                                    <td class="table-danger"><?= $d->keterangan ?></td>
                                                    <td class="table-danger"><?= $d->qty_req ?></td>
                                                    <td class="table-danger"><?= $d->qty_ready ?></td>
                                                    <td class="table-danger"><?= $d->nm_satuan ?></td>
                                                    <?php if ($d->sts == "0") : ?>
                                                        <td class="table-danger">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="<?= base_url('confirmreq/') . $d->id ?>" class="btn btn-block btn-success btn-sm"><i class="fas fa-check"></i></a>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="<?= base_url('pendingreq/') . $d->id ?>" class="btn btn-block btn-warning btn-sm"><i class="fas fa-times "></i></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php else : ?>
                                                        <td class="table-danger"><a href="#" class="btn btn-block btn-info btn-sm"><i class="fas fa-clipboard-check "></i></a></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php else : ?>
                                                <tr>
                                                    <td><?= $d->nama_barang ?></td>
                                                    <td><?= $d->deskripsi ?></td>
                                                    <td><?= $d->keterangan ?></td>
                                                    <td><?= $d->qty_req ?></td>
                                                    <td><?= $d->qty_ready ?></td>
                                                    <td><?= $d->nm_satuan ?></td>
                                                    <?php if ($d->sts == "0") : ?>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="<?= base_url('confirmreq/') . $d->id ?>" class="btn btn-block btn-success btn-sm"><i class="fas fa-check"></i></a>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="<?= base_url('pendingreq/') . $d->id ?>" class="btn btn-block btn-warning btn-sm"><i class="fas fa-times "></i></a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php else : ?>
                                                        <td><a href="#" class="btn btn-block btn-info btn-sm"><i class="fas fa-clipboard-check "></i></a></td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="col">
                                    <?php foreach ($countitm as $c) :
                                        $tot    = $c->total;
                                        $toty   = $c->tot_yes + $c->tot_no;
                                    ?>
                                        <?php if ($toty == $tot) : ?>
                                            <?php echo form_open_multipart('accreqpic'); ?>
                                            <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                            <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly hidden>
                                            <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-cloud-upload-alt"></i>&nbsp;CONFIRM REQUEST</button>
                                        <?php else : ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <!-- END ON PROGRESS -->

                                <!-- STATUS : DONE -->
                            <?php elseif ($s->status == 'DONE') : ?>

                                <table class="table table-bordered table-striped mb-2 ">
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
                                        <?php foreach ($detreq as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->qty_req ?></td>
                                                <td><?= $d->nm_satuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <h1 class="mt-3 mb-2">Barang Pending</h1>
                                <table class="table table-bordered table-striped mb-2 ">
                                    <thead style="background-color: #212529; color:white;">
                                        <tr>
                                            <td>Nama Barang</td>
                                            <td>Deskripsi</td>
                                            <td style="width:30%">Keterangan</td>
                                            <td>QTY</td>
                                            <td>Satuan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detreq2 as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->qty_req ?></td>
                                                <td><?= $d->nm_satuan ?></td>
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