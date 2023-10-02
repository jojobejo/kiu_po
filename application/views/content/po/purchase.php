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
            <div class="row">
                <div class="col-md">
                    <a href="<?= base_url('purchase/listBarang/') . $b->kd_suplier ?>" class="btn btn-primary mb-2 mt-2 btn-block">
                        <i class="fas fa-folder-plus"></i> &nbsp; Tambah Barang
                    </a>
                </div>

                <div class="col-md">
                    <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#modalnotebarang">
                        <i class="fas fa-notes-medical"> </i>
                        Tambah Note Barang
                    </a>
                </div>
                <?php foreach ($taxpo as $tp) : ?>
                    <?php if ($tp->tot == '0') : ?>
                        <div class="col-md">
                            <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#taxsetts">
                                <i class="fas fa-percent"> </i>
                                Input Tax (%)
                            </a>
                        </div>
                    <?php else : ?>
                        <div class="col-md">
                            <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#taxsett<?= $kdsuplier ?>">
                                <i class="fas fa-percent"> </i>
                                Input Tax (%)
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="col-md">
                    <a class="btn btn-primary mb-2 mt-2 btn-block" data-toggle="modal" data-target="#modaldiskon">
                        <i class="fas fa-tags"> </i>
                        Tambah Diskon
                    </a>
                </div>
            </div>

        </div>
    <?php endforeach; ?>

    <form action="#">
        <div class="row mb-2">
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nomor PO" value="" name="po_isi" id="po_isi">
                </div>
            </div>
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" class="form-control" placeholder="Tanggal Transaksi" value="" name="tgl_isi" id="tgl_isi">
                </div>
            </div>
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-truck"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Franko Pengiriman" value="" name="gdgpengiriman" id="gdgpengiriman">
                </div>
            </div>
            <div class="col-md">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Tempo Pembayaran" value="" name="tmpo" id="tmpo">
                </div>
            </div>
            <div class="col-md" hidden>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Tanggal Transaksi" value="<?= $kdpo ?>" name="kd_po_isi" id="kd_po_isi" hidden readonly>
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
                        <td>Rp. <?= number_format($t->harga_satuan,2) ?></td>
                        <td>Rp. <?= number_format($t->total_harga,2) ?></td>
                        <td><a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#modalEdit<?= $t->id_tmp ?>">
                                <i class="fa fa-solid fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusChart<?= $t->id_tmp ?>">
                                <i class="fa fa-solid fa-trash-alt"></i>
                            </a>
                            <a class="btn btn-sm bg-lightblue" data-toggle="modal" data-target="#diskonbarang<?= $t->id_tmp ?>">
                                <i class="fas fa-tags"></i>
                                Diskon(%)Barang
                            </a>
                            <a class="btn btn-sm btn-info" data-toggle="modal" data-target="#diskonbarangs<?= $t->id_tmp ?>">
                                <i class="fas fa-tags"></i>
                                Diskon Barang
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
                        <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                        <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($tot->total_harga,2) ?>
                            <input type="number" class="form-control" id="jmlitem" name="jmlitem" value="<?= $tot->total_item ?>" readonly hidden>
                            <input type="number" class="form-control" id="jmlharga" name="jmlharga" value="<?= $tot->total_harga ?>" readonly hidden>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php foreach ($tax as $tx) : ?>
                    <tr>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td style="display: none;"></td>
                        <td colspan="5" style="text-align: end; padding-right:3%; font-weight: bold;">Tax </td>
                        <td colspan="2" style="font-weight: bold;"> <?= $tx->tax ?> (%)</td>
                        <input type="number" class="form-control" id="taxisi" name="taxisi" value="<?= $tx->tax ?>" readonly hidden>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table id="" class="table table-striped mt-2">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td colspan="3" style="text-align: center;">LIST DISKON</td>
                </tr>
                <tr>
                    <td style="text-align: center;">Deskripsi Diskon</td>
                    <td style="text-align: center;">Nominal Diskon</td>
                    <td style="text-align: center;"></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tmpdiskon as $d) : ?>
                    <tr>
                        <td style="text-align: center;"><?= $d->nama_diskon ?></td>
                        <td style="text-align: center;">Rp. <?= number_format($d->nominal) ?></td>
                        <td style="text-align: center;">
                            <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#editdiskon<?= $d->id_tmp_diskon ?>">
                                <i class="fa fa-solid fa-pencil-alt"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusdiskon<?= $d->id_tmp_diskon ?>">
                                <i class="fa fa-solid fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table id="" class="table table-striped mt-2">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td style="text-align: center;">LIST Note Barang</td>
                </tr>
                <tr>
                    <td>Deskripsi Note</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tmpnote as $n) : ?>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col">
                                    <?= $n->isi_note ?>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-warning btn-sm " data-toggle="modal" data-target="#editnote<?= $n->id_nt_tmp_barang ?>">
                                        <i class="fa fa-solid fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#hapusnote<?= $n->id_nt_tmp_barang ?>">
                                        <i class="fa fa-solid fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
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