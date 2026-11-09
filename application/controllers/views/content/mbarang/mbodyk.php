<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- VIEW ADMIN PURCHASING -->
            <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '1') : ?>

                <table class="table table-bordered table-striped" id="list_mbarangnk">
                    <thead style="background-color: #212529; color:white;">
                        <tr>
                            <td>Nama Barang</td>
                            <td>Bahan Aktif</td>
                            <td>Nama Satuan</td>
                            <td>Panjang</td>
                            <td>Lebar</td>
                            <td>Tinggi</td>
                            <td>#</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang as $b) : ?>
                            <tr>
                                <td><?= $b->nama_barang ?></td>
                                <td><?= $b->bahan_aktif ?></td>
                                <td><?= $b->nm_satuan ?></td>
                                <td><?= $b->panjang ?></td>
                                <td><?= $b->lebar ?></td>
                                <td><?= $b->tinggi ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <a href="" class="btn btn-block btn-info"><i class="fas fa-eye"></i></a>
                                        </div>
                                        <div class="col">
                                            <a href="" class="btn btn-block btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                        </div>
                                        <div class="col">
                                            <a href="" class="btn btn-block btn-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php elseif ($this->session->userdata('lv') != '2' || $this->session->userdata('lv') != '1') : ?>
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
</div>