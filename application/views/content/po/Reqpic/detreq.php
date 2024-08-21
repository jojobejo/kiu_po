<?php if ($this->session->userdata('lv') == '4') : ?>
    <?php foreach ($status as $s) : ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Detail Request Barang - PIC - <a class="btn btn-primary btn-sm" href="<?= base_url('reqpic') ?>"><i class="fas fa-home"></i></a></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                    <div class="card">
                        <?php if ($s->status == 'ON PROGRESS') : ?>
                            <a class="btn btn-block btn-warning btn-sm" href=""><i class="fas fa-exclamation-triangle"></i>&nbsp;<?= $s->status ?>&nbsp;<i class="fas fa-exclamation-triangle"></i></a>
                        <?php else : ?>
                        <?php endif; ?>
                        <div class="card-body">
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
                                    <?php foreach ($detreq as $d) : ?>
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
                        </div>
                    </div>
                    <div class="card">
                        <h1 class="ml-4 mt-3">List Aproved & Pending Barang</h1>

                        <div class="card-body">
                            <table class="table table-bordered table-striped mt-4 mb-2 ">
                                <thead>
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>Deskripsi</td>
                                        <td>Keterangan</td>
                                        <td>qty</td>
                                        <td>Satuan</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listtr as $l) : ?>
                                        <tr>
                                            <td><?= $l->nama_barang ?></td>
                                            <td><?= $l->descnk ?></td>
                                            <td><?= $l->keterangan ?></td>
                                            <td><?= $l->tr_qty ?></td>
                                            <td><?= $l->nm_satuan ?></td>
                                            <td>
                                                <?php if ($l->status == 'confirm') : ?>
                                                    <a class="btn btn-block btn-success btn-lg"></a>
                                                <?php else : ?>
                                                    <a class="btn btn-block btn-warning btn-lg"></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div><!-- /.content-header -->
        </div>
    <?php endforeach; ?>

<?php elseif ($this->session->userdata('lv') == '2') : ?>
    <?php foreach ($status as $s) : ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
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
                                        <?php if ($tot < 0) : ?>
                                            <tr>
                                                <td class="table-danger"><?= $d->nama_barang ?></td>
                                                <td class="table-danger"><?= $d->deskripsi ?></td>
                                                <td class="table-danger"><?= $d->keterangan ?></td>
                                                <td class="table-danger"><?= $d->qty_req ?></td>
                                                <td class="table-danger"><?= $d->qty_ready ?></td>
                                                <td class="table-danger"><?= $d->nm_satuan ?></td>
                                                <td class="table-danger">
                                                    <?php if ($d->status == '0') : ?>
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="<?= base_url('confirmreq/') . $d->id ?>" class="btn btn-block btn-success btn-sm"><i class="fas fa-check"></i></a>
                                                            </div>
                                                            <div class="col">
                                                                <a href="<?= base_url('pendingreq/') . $d->id ?>" class="btn btn-block btn-warning btn-sm"><i class="fas fa-times "></i></a>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="#" class="btn btn-block btn-success btn-sm"><i class="fas fa-clipboard-check"></i></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td><?= $d->qtykebutuhan ?></td>
                                                <td><?= $d->qtyready ?></td>
                                                <td><?= $d->nm_satuan ?></td>
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
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- END CARD -->

                    <div class="card">
                        <h1 class="ml-4 mt-3">List Aproved & Pending Barang</h1>
                        <?php echo form_open_multipart('accreqpic'); ?>

                        <div class="card-body">
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <label for="naSupp" class="">Tanggal Jadwal : </label>
                                    </div>
                                    <div class="col">
                                        <input type="text" id="tgljadwal" name="tgljadwal" style="max-width: 550px;" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped mt-4 mb-2 ">
                                <thead>
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>Deskripsi</td>
                                        <td>Keterangan</td>
                                        <td>qty</td>
                                        <td>Satuan</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listtr as $l) : ?>
                                        <tr>
                                            <td><?= $l->nama_barang ?></td>
                                            <td><?= $l->descnk ?></td>
                                            <td><?= $l->keterangan ?></td>
                                            <td><?= $l->tr_qty ?></td>
                                            <td><?= $l->nm_satuan ?></td>
                                            <td>
                                                <?php if ($l->status == 'confirm') : ?>
                                                    <a class="btn btn-block btn-success btn-lg"></a>
                                                <?php else : ?>
                                                    <a class="btn btn-block btn-warning btn-lg"></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $s->kd_po_nk ?>" readonly />
                            <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-cloud-upload-alt"></i></button>
                            </form>
                        </div>
                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        </div>
    <?php endforeach; ?>
<?php endif; ?>