<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PO STATUS</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>No PO</td>
                        <td>Nama Suplier</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($po as $p) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p->no_po ?></td>
                            <td><?= $p->nama_suplier ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-md">
                                        <?php if ($p->status == 'ON PROGRESS') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-clock"></i>&nbsp;
                                                <?= $p->status ?>
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
                                    <div class="col-md">
                                        <a class="btn btn-block btn-primary btn-sm" href="<?= base_url('detailPO/') . $p->kd_po ?>">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                    </div>
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