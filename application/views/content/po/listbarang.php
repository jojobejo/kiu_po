<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div style="display: flex; text-align: center;">
                <?php foreach ($kode_suplier as $b) : ?>
                    <a href="<?= base_url('purchase/sup/') . $b->kd_suplier ?>">
                        <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                    </a>
                    <h3>Kembali</h3>
                <?php endforeach; ?>
            </div>
            <?php $this->load->view('content/po/modalpo') ?>
            <table class="table table-bordered table-striped" id="list_suplier">
                <thead>
                    <tr>
                        <td>Nama Barang</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($barang as $s) : ?>
                            <td><?= $s->nama_barang ?></td>
                            <td>
                                <a class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modalAddItem<?= $s->id_barang ?>">
                                    <i class="fas fa-check-double"></i>
                                    Tambah Barang
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