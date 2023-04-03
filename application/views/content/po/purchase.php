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
                <a href="<?= base_url('purchase') ?>">
                    <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                </a>
                <?php $this->load->view('content/po/modal/msuplier') ?>
                <?php foreach ($kode_suplier as $b) : ?>
                    <h3 class=""><?= $b->nama_suplier ?> </h3>
                    &nbsp;
                    <a href="#" class=" ml-3 btn btn-warning " data-toggle="modal" data-target="#editSuplier<?= $b->id_suplier ?>">
                        <i class="fa fa-solid fa-pencil-alt"></i>
                    </a>
            </div>
            <a href="<?= base_url('purchase/listBarang/') . $b->kd_suplier ?>" class="btn btn-primary mb-2 mt-2">
                <i class="fas fa-folder-plus"></i> &nbsp; Tambah Barang
            </a>
        <?php endforeach; ?>

        <form action="#">
            <div class="row mb-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Nomor PO" value="" name="po_isi" id="po_isi">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="date" class="form-control" placeholder="Tanggal Transaksi" value="" name="tgl_isi" id="tgl_isi">
                    </div>
                </div>
                <div class="col-md-5" hidden>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tanggal Transaksi" value="<?= $kdpo ?>" name="kd_po_isi" id="kd_po_isi" readonly>
                    </div>
                </div>
            </div>

            <?php $this->load->view('content/po/modalpo') ?>

            <table id="" class="table table-striped">
                <thead style="background-color: #212529; color:white;">
                    <tr>
                        <td>No</td>
                        <td>Nama Barang</td>
                        <td>Satuan</td>
                        <td>Qty</td>
                        <td>Harga</td>
                        <td>Tax(%)</td>
                        <td>Total Harga</td>
                        <td>#</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($tmp as $t) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $t->nama_barang ?></td>
                            <td><?= $t->satuan ?></td>
                            <td><?= $t->qty ?></td>
                            <td>Rp. <?= number_format($t->harga_satuan) ?></td>
                            <td><?= $t->tax ?> (%)</td>
                            <td>Rp. <?= number_format($t->total_harga) ?></td>
                            <td><a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusChart<?= $t->id_tmp ?>">
                                    <i class="fa fa-solid fa-trash-alt"></i>
                                </a>
                                <input type="text" class="form-control" id="kdsuplier" name="kdsuplier" value="<?= $t->kode_suplier ?>" hidden readonly>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php foreach ($total as $tot) : ?>
                        <tr>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                            <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($tot->total_harga) ?>
                                <input type="number" class="form-control" id="jmlitem" name="jmlitem" value="<?= $tot->total_item ?>" readonly hidden>
                                <input type="number" class="form-control" id="jmlharga" name="jmlharga" value="<?= $tot->total_harga ?>" readonly hidden>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="btnBawah">
                <button class="btn btn-warning mr-2" type="reset">Reset</button>
                <button type="button" id="selesai" class="btn btn-primary">
                    <i class="fa fa-print pr-1"></i>Rekam Order
                </button>
            </div>
        </div>

        </form>

    </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->
</div>