<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="<?= base_url('reqpic') ?>" class="btn btn-success"><i class="fas fa-home"></i> BACK</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <!-- END CONTAINER CONTENT -->
            <table class="table table-bordered table-striped" id="list_stocknonkomersil">
                <thead>
                    <tr>
                        <td>Nama Barang</td>
                        <td>Deskripsi / Spesifikasi</td>
                        <td>Satuan</td>
                        <td>Gambar Produk</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lstock as $l) :
                        if ($l->gbr_barang == 'Karisma.png') {
                            $imagePath = "images/gbrbarang/masterbr/Karisma.png";
                        } else {
                            $imagePath = "images/gbrbarang/masterbr/" . $l->gbr_barang;
                        }
                    ?>
                        <tr>
                            <td><?= $l->nama_barang ?></td>
                            <td><?= $l->descnk ?></td>
                            <td><?= $l->nm_satuan ?></td>
                            <td>
                                <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox">Buka File</a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-block btn-success btn-sm " data-toggle="modal" data-target="#addreq<?= $l->kode_sys ?>">
                                    <i class="fa fa-solid fa-cart-plus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END VIEW CONTENT -->
</div>