<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Note Setting</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php $this->load->view('content/setting/modal/modalsatuan') ?>
            <div class=" m-2">
                <a class="btn btn-block btn-success btn-sm " data-toggle="modal" data-target="#modalAddItem">
                    <i class="fas fa-check-double"></i>
                    Tambah Data Note Penerima
                </a>
            </div>
            <table class="table table-bordered table-striped" id="list_suplier">
                <thead>
                    <tr>
                        <td>Nama Penerima (Penanggung Jawab)</td>
                        <td>Telefon</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($note as $n) : ?>
                            <td></td>
                            <td>
                                <div class="row">
                                    <div class="col-md">
                                        <a class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit">
                                            <i class="fas fa-check-double"></i>
                                            Edit Satuan Barang
                                        </a>
                                    </div>
                                    <div class="col-md">
                                        <a class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#hapusBarang">
                                            <i class="fas fa-check-double"></i>
                                            Hapus Satuan Barang
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