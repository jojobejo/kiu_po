<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PO STATUS</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2 mt-2">
                <a href="<?= base_url('postatus') ?>" class="btn btn-primary ml-2">All</a>
                <a href="<?= base_url('postatus/onprogress') ?>" class="btn btn-warning ml-3">PROGRESS</a>
                <a href="<?= base_url('postatus/done') ?>" class="btn btn-success ml-3">DONE</a>
                <a href="<?= base_url('postatus/reject') ?>" class="btn btn-danger ml-3">REJET</a>
            </div>
            <table class="table table-bordered table-striped" id="tballstatus">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Status Order</td>
                        <td>No PO</td>
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
                                        <?php elseif ($p->status == 'NOTED') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-exclamation"></i>&nbsp;
                                                Terdapat Note Dari Direktur
                                            </a>
                                        <?php elseif ($p->status == 'UPDATE') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-exclamation"></i>&nbsp;
                                                Terdapat Update Dari Keuangan
                                            </a>
                                        <?php elseif ($p->status == 'DONE') : ?>
                                            <a class="btn btn-block btn-success btn-sm">
                                                <i class="fas fa-thumbs-up"></i>&nbsp;
                                                <?= $p->status ?>
                                            </a>
                                        <?php elseif ($p->status == 'REJECT') : ?>
                                            <a class="btn btn-block btn-danger btn-sm">
                                                <i class="fas fa-times"></i>&nbsp;
                                                <?= $p->status ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td><?= $p->no_po ?></td>
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
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>