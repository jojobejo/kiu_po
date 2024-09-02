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
                                            <?php foreach ($datereqpic as $d) : ?>
                                                <tr>
                                                    <td><?= $d->nama_barang ?></td>
                                                    <td><?= $d->deskripsi ?></td>
                                                    <td><?= $d->keterangan ?></td>
                                                    <td style="text-align: center;"><?= $d->qtykebutuhan ?></td>
                                                    <td style="text-align: center;"><?= $d->nm_satuan ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php elseif ($s->status == 'REQUEST ACC') : ?>
                                    <?php foreach ($stspo1 as $tot) : ?>
                                        <?php if ($tot->tot == '0') : ?>
                                            <a href="#" class="btn btn-success btn-block mt-4"><b style="text-transform: uppercase;">barang request</b></a>
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
                                            <a href="#" class="btn btn-success btn-block mt-2"><b style="text-transform: uppercase;">Work in Process</b></a>
                                        <?php else : ?>
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
                                                                <a href="<?= base_url('detailponk/' . $st->kdpo) ?>" class="btn btn-block btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php elseif ($s->status == 'DONE') : ?>
                                    <a href="#" class="btn btn-success btn-block mt-4">ITEM LIST</a>
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
                                                    <a href="<?= base_url('detailponk/' . $st->kdpo) ?>" class="btn btn-block btn-primary btn-sm"><i class="fas fa-eye"></i></a>
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
                                            <td style="width:10%">Stock Ready</td>
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
                                                <?php if ($stkready < '0') :  ?>
                                                    <td><?= $d->qty_ready ?></td>
                                                    <td><a href="#" class="btn btn-block btn-dangger btn-md"><i class="fas fa-times-circle"></i></a></td>
                                                <?php else : ?>
                                                    <td><?= $d->qty_ready ?></td>
                                                    <td><a href="#" class="btn btn-block btn-success btn-md"><i class="fas fa-check-circle"></i></a></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                                <?php echo form_open_multipart('reqpicconfirmed'); ?>
                                <?php $now = date("Y-m-d"); ?>
                                <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $now ?>" class="form-control" readonly hidden>
                                <input type="text" id="pic" name="pic" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>

                                <button type="submit" class="btn btn-block btn-primary btn-md"><B>ORDER CONFIRMED</B></button>


                                <!-- =================================================================================================================================== -->
                                <!-- ==================================================V1===============================================================================  -->
                                <!-- =================================================================================================================================== -->

                                <!-- <a href="#" class="btn btn-success btn-block mt-4"><b>BARANG READY</b></a>
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

                                <button type="submit" class="btn btn-block btn-primary btn-md"><B>ORDER CONFIRMED</B></button> -->
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
                                                                    <?php echo form_open_multipart('pendingreq'); ?>
                                                                    <input type="text" id="idponks" name="idponks" style="max-width: 550px;" value="<?= $d->id ?>" class="form-control" readonly>
                                                                    <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly>
                                                                    <input type="text" id="kdponks" name="kdponks" style="max-width: 550px;" value="<?= $kdponks ?>" class="form-control" readonly>
                                                                    <input type="text" id="nmuser" name="nmuser" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly>
                                                                    <input type="text" id="kduser" name="kduser" style="max-width: 550px;" value="<?= $s->kd_user ?>" class="form-control" readonly>
                                                                    <input type="text" id="dep" name="dep" style="max-width: 550px;" value="<?= $s->departemen ?>" class="form-control" readonly>
                                                                    <input type="text" id="tjbeli" name="tjbeli" style="max-width: 550px;" value="<?= $s->tj_pembelian ?>" class="form-control" readonly>
                                                                    <?php foreach ($countitm as $c) :
                                                                        $tot    = $c->total;
                                                                        $toty   = $c->tot_yes + $c->tot_no;
                                                                        $totn   = $c->tot_no;
                                                                    ?>
                                                                        <input type="text" id="jmls" name="jmls" style="max-width: 550px;" value="<?= $toty ?>" class="form-control" readonly>
                                                                        <input type="text" id="totn" name="totn" style="max-width: 550px;" value="<?= $totn ?>" class="form-control" readonly>
                                                                    <?php endforeach; ?>
                                                                    <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly>
                                                                    <button type="submit" class="btn btn-block btn-warning btn-sm"><i class="fas fa-times "></i></button>
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
                                        $totn   = $c->tot_no;
                                    ?>
                                        <?php if ($toty == $tot) : ?>
                                            <?php echo form_open_multipart('accreqpic'); ?>
                                            <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                            <input type="text" id="kdponks" name="kdponks" style="max-width: 550px;" value="<?= $kdponks ?>" class="form-control" readonly hidden>
                                            <input type="text" id="nmuser" name="nmuser" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>
                                            <input type="text" id="kduser" name="kduser" style="max-width: 550px;" value="<?= $s->kd_user ?>" class="form-control" readonly hidden>
                                            <input type="text" id="dep" name="dep" style="max-width: 550px;" value="<?= $s->departemen ?>" class="form-control" readonly hidden>
                                            <input type="text" id="tjbeli" name="tjbeli" style="max-width: 550px;" value="<?= $s->tj_pembelian ?>" class="form-control" readonly hidden>
                                            <input type="text" id="jmls" name="jmls" style="max-width: 550px;" value="<?= $toty ?>" class="form-control" readonly hidden>
                                            <input type="text" id="totn" name="totn" style="max-width: 550px;" value="<?= $totn ?>" class="form-control" readonly hidden>
                                            <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly hidden>
                                            <button type="submit" class="btn btn-block btn-primary btn-md"><B>ORDER CONFIRMED</B></button>
                                        <?php else : ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

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
                                        <?php foreach ($detreq as $d) : ?>
                                            <tr>
                                                <td><?= $d->nama_barang ?></td>
                                                <td><?= $d->deskripsi ?></td>
                                                <td><?= $d->keterangan ?></td>
                                                <td style="text-align: center;"><?= $d->qty_req ?></td>
                                                <td style="text-align: center;"><?= $d->nm_satuan ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="col">
                                    <?php echo form_open_multipart('reqpicdone'); ?>
                                    <input type="text" id="kdponk" name="kdponk" style="max-width: 550px;" value="<?= $s->kd_po_nk ?>" class="form-control" readonly hidden>
                                    <input type="text" id="kd_user" name="kd_user" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly hidden>
                                    <input type="text" id="tgl" name="tgl" style="max-width: 550px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly hidden>
                                    <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-cloud-upload-alt"></i>&nbsp;REQUEST DONE</button>
                                </div>

                                <!-- END BARANG TERSEDIA -->

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