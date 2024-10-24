<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <?php $this->load->view('content/mbarang/modal/modalmbarang.php'); ?>

            <!-- VIEW ADMIN PURCHASING -->
            <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '1') : ?>

                <table class="table table-bordered table-striped" id="list_mbarangnk">
                    <thead>
                        <div class="row">
                            <a class="btn btn-info btn-md ml-2" data-toggle="modal" data-target="#addmbarangnk">
                                <i class="fas fa-plus"></i>
                                Add Barang
                            </a>
                        </div>
                        <tr>
                            <td>No</td>
                            <td>Kode Barang</td>
                            <td>Kode Sistem</td>
                            <td>Nama Barang</td>
                            <td>Deskripsi / Spesifikasi</td>
                            <td>Satuan</td>
                            <td>Gambar Produk</td>
                            <td>QR CODE</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($barangnk as $brnk) :
                            if ($brnk->gbr_barang == 'Karisma.png') {
                                $imagePath = "images/gbrbarang/masterbr/Karisma.png";
                            } else {
                                $imagePath = "images/gbrbarang/masterbr/" . $brnk->gbr_barang;
                            }
                            $nullimg    = "./images/qrcodebr/";
                            $imgqrcode  = "./images/qrcodebr/" . $brnk->qrcode_path;

                            $str    = $brnk->nama_barang;
                            $strnew = str_replace(' ', '', $str);
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $brnk->kd_barang ?></td>
                                <td><?= $brnk->kd_br_adm ?></td>
                                <td><?= $brnk->nama_barang ?></td>
                                <td><?= $brnk->descnk ?></td>
                                <td><?= $brnk->nm_satuan ?></td>
                                <td>
                                    <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $brnk->nama_barang ?>">Buka File
                                    </a>
                                </td>
                                <?php if ($imgqrcode == $nullimg) : ?>
                                    <td><a href="#" class="btn btn-danger btn-sm btn-block"><i class="fas fa-times-circle"></i></a></td>
                                <?php else : ?>
                                    <td><a href="<?= $imgqrcode ?>" class="btn btn-success btn-sm btn-block" data-toggle="lightbox" data-title="<?= $brnk->nama_barang . '(' . $brnk->kd_br_adm . ')' ?>">Buka File</a></td>
                                <?php endif; ?>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <a href="#" class="btn btn-block btn-warning btn-sm " data-toggle="modal" data-target="#editbarang<?= $brnk->id_brg_nk ?>">
                                                <i class="fa fa-solid fa-pencil-alt"></i>
                                            </a>
                                        </div>
                                        <div class="col-md">
                                            <a href="#" class="btn btn-block btn-danger btn-sm " data-toggle="modal" data-target="#hapusbarang<?= $brnk->id_brg_nk ?>">
                                                <i class="fa fa-solid fa-trash-alt"></i>
                                            </a>
                                        </div>
                                        <div class="col-md">
                                            <a href="#" class="btn btn-block btn-success btn-sm " data-toggle="modal" data-target="#uploadmbrang<?= $brnk->id_brg_nk ?>">
                                                <i class="fas fa-camera"></i>
                                            </a>
                                        </div>
                                        <?php if ($imgqrcode == $nullimg) : ?>
                                            <div class="col-md">
                                                <a href="<?= base_url('genqrcode/') . $brnk->id_brg_nk . "/" . $kdqrcode . "/" . $strnew ?>" class="btn btn-block btn-info btn-sm ">
                                                    <i class="fas fa-qrcode"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
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