<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <table class="table table-bordered table-striped" id="list_suplier">
                <thead>
                    <h3>Pilih Suplier</h3>
                    <tr>
                        <td>Nama Suplier</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($suplier as $s) : ?>
                            <td><?= $s->nama_suplier ?></td>
                            <td>
                                <a href="<?= base_url('purchase/sup/') . $s->kd_suplier ?>" class="btn btn-block btn-success btn-sm ">
                                    <i class="fas fa-check-double"></i>
                                    Pilih Suplier
                                </a>
                            </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->

    </div>

    <!-- /.content-header -->
</div>