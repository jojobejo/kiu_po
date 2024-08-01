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

                <table class="table table-bordered table-striped" id="list_stocknonkomersil">
                    <thead>
                        <tr>
                            <td>Nama Barang</td>
                            <td>Deskripsi / Spesifikasi</td>
                            <td>Stock Tersedia</td>
                            <td>Satuan</td>
                            <td>Gambar Produk</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stocknk as $s) :
                            if ($s->gbr_barang == 'Karisma.png') {
                                $imagePath = "../images/gbrbarang/masterbr/Karisma.png";
                            } else {
                                $imagePath = "../images/gbrbarang/masterbr/" . $s->gbr_barang;
                            }
                        ?>
                            <tr>
                                <td><?= $s->nama_barang ?></td>
                                <td><?= $s->descnk ?></td>
                                <td>10</td>
                                <td><?= $s->nm_satuan ?></td>
                                <td>
                                    <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox">Buka File
                                    </a>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <a href="#" class="btn btn-block btn-success btn-sm " data-toggle="modal" data-target="#addchartponk<?= $s->kd_barang ?>">
                                                <i class="fa fa-solid fa-cart-plus"></i>
                                            </a>
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