<?php foreach ($item as $i) : ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2 ml-2">
                    <div class="col-sm-0">
                        <h1 class="m-0">Detail Stock Item : <b style="text-transform:uppercase"><?= $i->nama_barang ?> (<?= $i->satuan ?>) (<?= $i->kode_barang ?>)</b></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-0 ml-2">
                        <a href="<?= base_url('stocknonkomersil') ?>" class="btn btn-sm btn-block btn-success mt-1"><i class="fas fa-undo-alt"></i></a>
                    </div>
                </div><!-- /.row -->
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-0">
                            <h1 class="m-0 mb-2">Stock Tersedia : <b style="text-transform:uppercase"><?= $i->qty_ready ?></b></h1>
                        </div><!-- /.col -->
                        <table class="table table-bordered">
                            <thead style="background-color: #212529; color:white;">
                                <tr>
                                    <td>Kode Transaksi</td>
                                    <td>Kode Akun</td>
                                    <td>Tanggal Transaksi</td>
                                    <td>Qty</td>
                                    <td>Satuan</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
<?php endforeach; ?>