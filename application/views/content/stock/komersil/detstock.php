<?php foreach ($lbarangdet as $l) : ?>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h3>
                        <b style="text-transform:uppercase" class="ml-3"><?= $l->nmbarang ?></b>
                    </h3>
                </div><!-- /.row -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label for="naSupp" class="">STOK RULES : </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $l->qtymin ?>" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="naSupp" class="">STOK TERSEDIA : </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="naSupp" class="">SATUAN QTY : </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $l->qtysatuan ?>" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="naSupp" class="">NAMA SUPLIER : </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $l->nmsup ?>" class="form-control" readonly>
                            </div>
                        </div>
                        <a href="#" class="btn btn-block btn-primary mt-2">Edit data produk</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col mt-2">
                            <h3>
                                <b style="text-transform:uppercase">Histori Transaksi - PO</b>
                            </h3>
                        </div>
                        <div class="col">
                            <table class="table table-bordered">
                                <thead style="background-color: #212529; color:white;">
                                    <tr>
                                        <td>No Faktur</td>
                                        <td>Tanggal Transaksi</td>
                                        <td>Keterangan</td>
                                        <td>PIC</td>
                                        <td>Qty</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
<?php endforeach; ?>