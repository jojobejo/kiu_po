<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
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
            <?php $this->load->view('content/po/modal/modalList') ?>
            <a class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#modalAddItem">
                <i class="fas fa-folder-plus"></i> &nbsp; Tambah Produk Barang
            </a>
            <?php $this->load->view('content/po/modalpo') ?>
            <table class="table table-bordered table-striped" id="list_suplier">
                <thead>
                    <tr>
                        <td>Nama Barang</td>
                        <td>Isi</td>
                        <td>Kemasan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($barang as $s) : ?>
                            <td><?= $s->nama_barang ?></td>
                            <td><?= isset($s->isi) ? $s->isi : '-' ?></td>
                            <td><?= isset($s->kemasan) ? $s->kemasan : '-' ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-md">
                                        <a class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modalAddItem<?= $s->id_barang ?>">
                                            <i class="fas fa-check-double"></i>
                                            Tambah Barang Ke Chart
                                        </a>
                                    </div>
                                    <div class="col-md">
                                        <a class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modalAddBonus<?= $s->id_barang ?>">
                                            <i class="fas fa-gift"></i>
                                            Barang Bonus
                                        </a>
                                    </div>
                                    <div class="col-md">
                                        <a class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modal_edit<?= $s->id_barang ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit Barang
                                        </a>
                                    </div>
                                    <div class="col-md">
                                        <a class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $s->id_barang ?>">
                                            <i class="fas fa-trash"></i>
                                            Hapus Barang
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
