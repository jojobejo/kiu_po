<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">ALL - PO STATUS</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2 mt-2">
                <a href="<?= base_url('postatusall') ?>" class="btn btn-primary ml-2">All</a>
                <a href="<?= base_url('postatus/today') ?>" class="btn btn-info ml-3">Today</a>
                <a href="<?= base_url('postatus/postatusall/onprogress') ?>" class="btn btn-warning ml-3">PROGRESS</a>
                <a href="<?= base_url('postatus/postatusall/done') ?>" class="btn btn-success ml-3">DONE</a>
                <a href="<?= base_url('postatus/postatusall/reject') ?>" class="btn btn-danger ml-3">REJET</a>
                <form action="<?= base_url('searchPOdate') ?>" method="POST">
                    <div class="row ml-2">
                        <div class="col">
                            <input type="date" id="dt1" name="dt1" class="form-control date">
                        </div>
                        <div class="col">
                            <h3>-</h3>
                        </div>
                        <div class="col">
                            <input type="date" id="dt2" name="dt2" class="form-control date">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary" id="submit">Cari</button>
                        </div>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="tballstatus">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Status Order</td>
                    <td>No PO</td>
                    <td>Tgl Pembuatan</td>
                    <td>Nama Suplier</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($po as $p) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <div class="row">
                                <div class="col-md">
                                    <?php if ($p->status == 'ON PROGRESS') : ?>
                                        <a class="btn btn-block btn-warning btn-sm">
                                            <i class="fas fa-clock"></i>&nbsp;
                                            <?= $p->status ?>
                                        </a>
                                    <?php elseif ($p->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '2') : ?>
                                        <a class="btn btn-block btn-warning btn-sm">
                                            <i class="fas fa-exclamation"></i>&nbsp;
                                            Terdapat Update Dari Direktur
                                        </a>
                                    <?php elseif ($p->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '3') : ?>
                                        <a class="btn btn-block btn-warning btn-sm">
                                            <i class="fas fa-clock"></i>&nbsp;
                                            ON PROGRESS
                                        </a>
                                    <?php elseif ($p->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '3') : ?>
                                        <a class="btn btn-block btn-warning btn-sm">
                                            <i class="fas fa-exclamation"></i>&nbsp;
                                            Terdapat Update Dari Keuangan
                                        </a>
                                    <?php elseif ($p->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '2') : ?>
                                        <a class="btn btn-block btn-warning btn-sm">
                                            <i class="fas fa-clock"></i>&nbsp;
                                            ON PROGRESS
                                        </a>
                                    <?php elseif ($p->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '2') : ?>
                                        <a class="btn btn-block btn-warning btn-sm">
                                            <i class="fas fa-clock"></i>&nbsp;
                                            ON PROGRESS
                                        </a>
                                    <?php elseif ($p->status == 'ACC DIREKTUR') : ?>
                                        <a class="btn btn-block btn-primary btn-sm">
                                            <i class="fas fa-user-tie"></i>&nbsp;
                                            <?= $p->status ?>
                                        </a>
                                    <?php elseif ($p->status == 'DONE') : ?>
                                        <a class="btn btn-block btn-success btn-sm">
                                            <i class="fas fa-thumbs-up"></i>&nbsp;
                                            <?= $p->status ?>
                                        </a>
                                    <?php elseif ($p->status == 'CANCEL') : ?>
                                        <a class="btn btn-block btn-danger btn-sm">
                                            <i class="fas fa-times"></i>&nbsp;
                                            <?= $p->status ?>
                                        </a>
                                    <?php elseif ($p->status == 'REJECT') : ?>
                                        <a class="btn btn-block btn-danger btn-sm">
                                            <i class="fas fa-times"></i>&nbsp;
                                            <?= $p->status ?>
                                        </a>
                                    <?php elseif ($p->status == 'PO REVISI') : ?>
                                        <a class="btn btn-block btn-warning btn-sm">
                                            <i class="fas fa-undo"></i>&nbsp;
                                            <?= $p->status ?>
                                        </a>
                                    <?php elseif ($p->status == 'ON DELIVERY') : ?>
                                        <a class="btn btn-block btn-info btn-sm">
                                            <i class="fas fa-truck-moving"></i>&nbsp;
                                            <?= $p->status ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td><?= $p->no_po ?></td>
                        <td><?= format_indo($p->tgl_transaksi) ?></td>
                        <td><?= $p->nama_suplier ?></td>
                        <td>
                            <div class="row">
                                <div class="col-md">
                                    <a class="btn btn-block btn-primary btn-sm" href="<?= base_url('detailPO/') . $p->kd_po ?>">
                                        <i class="fas fa-eye"></i>
                                        Detail
                                    </a>
                                </div>
                                <?php if ($this->session->userdata('lv') == '1') : ?>
                                    <div class="col-md">
                                        <a class="btn btn-block btn-success btn-sm" href="<?= base_url('konfirmasiOrder/') . $p->kd_po ?>">
                                            <i class="fas fa-clipboard-check"></i>
                                            Accept
                                        </a>
                                    </div>
                                    <div class="col-md">
                                        <a class="btn btn-block btn-warning btn-sm" href="<?= base_url('tolakOrder/') . $p->kd_po ?>">
                                            <i class="fas fa-times"></i>
                                            Reject
                                        </a>
                                    </div>
                                <?php elseif ($this->session->userdata('lv') == '2' && $p->status == 'REJECT') : ?>
                                    <div class="col">
                                        <a class="btn btn-block btn-info btn-sm" href="<?= base_url('unpostpo/') . $p->kd_po ?>">
                                            <i class="fas fa-sync"></i> &nbsp;
                                            UNPOST
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-block btn-warning btn-sm" href="<?= base_url('hapuspo/') . $p->kd_po ?>">
                                            <i class="fas fa-trash"></i> &nbsp;
                                            DELETE
                                        </a>
                                    </div>
                                <?php elseif ($this->session->userdata('lv') == '2' && $p->status != 'DONE') : ?>
                                    <div class="col">
                                        <a class="btn btn-block btn-warning btn-sm" href="<?= base_url('hapuspo/') . $p->kd_po ?>">
                                            <i class="fas fa-trash"></i> &nbsp;
                                            DELETE
                                        </a>
                                    </div>
                                <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
</div>