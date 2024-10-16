<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ml-2">
                <div class="col-sm-0">

                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- VIEW ADMIN PURCHASING -->
            <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '1') : ?>
                <div class="card">
                    <div class="card-body">
                        <h1 class="m-0">
                            <b style="text-transform:uppercase">List Stock Barang - stock controller</b>
                        </h1>
                        <a href="<?= base_url('nkrestok') ?>" class="btn btn-md mt-2 mb-2 btn-info"><b style="text-transform:uppercase">List Stock Barang Kosong</b></a>
                        <table class="table table-bordered" id="list_stocknonkomersil">
                            <thead>
                                <tr>
                                    <td>Kode Barang</td>
                                    <td>Nama Barang</td>
                                    <td>Deskripsi</td>
                                    <td>Stock</td>
                                    <td>Satuan</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stocknk as $s) : ?>
                                    <?php if ($s->qty_ready == '0' || $s->qty_ready < '0') : ?>
                                        <tr>
                                            <td><?= $s->kode_barang ?></td>
                                            <td><?= $s->nama_barang ?></td>
                                            <td><?= $s->deskripsi ?></td>
                                            <td class="table-warning"><?= $s->qty_ready ?></td>
                                            <td><?= $s->satuan ?></td>
                                            <td>
                                                <a href="<?= base_url('detailtransaksi/') . $s->kode_barangs ?>" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td><?= $s->kode_barang ?></td>
                                            <td><?= $s->nama_barang ?></td>
                                            <td><?= $s->deskripsi ?></td>
                                            <td><?= $s->qty_ready ?></td>
                                            <td><?= $s->satuan ?></td>
                                            <td>
                                                <a href="<?= base_url('detailtransaksi/') . $s->kode_barangs ?>" target="_blanks" class="btn btn-block btn-primary"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($this->session->userdata('lv') != '2' || $this->session->userdata('lv') != '1') : ?>
                <?php $this->load->view('content/stock/nonkomersil/modal/modal_add_itm.php') ?>
                <div class="card">
                    <div class="card-body">
                        <h1 class="m-0">
                            <b style="text-transform:uppercase">Stock Barang Tersedia</b>
                        </h1>
                        <table class="table table-bordered" id="list_stocknonkomersil">
                            <thead>
                                <tr>
                                    <td>Kode Barang</td>
                                    <td>Nama Barang</td>
                                    <td>Deskripsi</td>
                                    <td>Stock</td>
                                    <td>Satuan</td>
                                    <!-- <td>#</td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($stocknk as $s) : ?>
                                    <tr>
                                        <td><?= $s->kode_barang ?></td>
                                        <td><?= $s->nama_barang ?></td>
                                        <td><?= $s->deskripsi ?></td>
                                        <?php if ($s->qty_ready == '0' || $s->qty_ready < '0') : ?>
                                            <td class="table-warning"><?= $s->qty_ready ?></td>
                                        <?php else : ?>
                                            <td><?= $s->qty_ready ?></td>
                                        <?php endif; ?>
                                        <td><?= $s->satuan ?></td>
                                        <!-- <td>
                                            <a href="#" class="btn btn-block btn-success btn-sm " data-toggle="modal" data-target="#addchartdetponk<?= $s->kode_barangs ?>">
                                                <i class="fa fa-solid fa-cart-plus"></i>
                                            </a>
                                        </td> -->
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
</div>