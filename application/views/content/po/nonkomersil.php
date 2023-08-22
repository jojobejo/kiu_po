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
                <a href="<?= base_url('dashboard') ?>">
                    <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                </a>
                <h3 class="">Purchase Order Non Kompersial</h3>
            </div>
            <a href="#" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#add_barang_nonkomersil">
                <i class="fas fa-folder-plus"></i> &nbsp; Tambah Barang
            </a>
            <?php $this->load->view('content/po/modal/modalnonkomersil') ?>
            <form action="#">
                <div class="row mb-2">
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nomor PO" value="<?= $nopo ?>" name="po_isi" id="po_isi" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-landmark"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Departemen" value="<?= $this->session->userdata('departemen') ?>" name="dep_isi" id="dep_isi" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-shopping-basket"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Tujuan Pembelian" value="" name="tujuan_isi" id="tujuan_isi">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="date" class="form-control" placeholder="Tanggal Transaksi" value="" name="tgl_isi" id="tgl_isi">
                        </div>
                    </div>
                </div>

                <table id="" class="table table-striped">
                    <thead style="background-color: #212529; color:white;">
                        <tr>
                            <td>No</td>
                            <td>Nama Barang</td>
                            <td>Deskripsi</td>
                            <td>Keterangan</td>
                            <td>Qty</td>
                            <td>Harga Satuan</td>
                            <td>Total Harga</td>
                            <td>#</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tmp as $tmp) :
                            $no = 1; ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $tmp->nama_barang ?></td>
                                <td><?= $tmp->deskripsi ?></td>
                                <td><?= $tmp->keterangan ?></td>
                                <td><?= $tmp->qty ?></td>
                                <td><?= $tmp->hrg_satuan ?></td>
                                <td><?= $tmp->total_harga ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#edititem<?= $tmp->id_tmp_nk ?>">
                                        <i class="fa fa-solid fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusitem<?= $tmp->id_tmp_nk ?>">
                                        <i class="fa fa-solid fa-trash-alt"></i>
                                    </a>
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
                    <button type="button" id="selesaink" class="btn btn-primary">
                        <i class="fa fa-print pr-1"></i>Rekam Order
                    </button>
                </div>
        </div>

        </form>

    </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->
</div>