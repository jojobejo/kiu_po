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

                <?php foreach ($kode_suplier as $b) : ?>
                    <h3><?= $b->nama_suplier ?> </h3>
            </div>
            <a href="<?= base_url('purchase/addBarang/') . $b->kd_suplier ?>" class="btn btn-primary mb-2 mt-2">
                <i class="fas fa-folder-plus"></i> &nbsp; Tambah Barang
            </a>
        <?php endforeach; ?>


        <div class="row mb-2">
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nomor PO">
                </div>
            </div>
            <div class="col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                    </div>
                    <input type="date" class="form-control" placeholder="Tanggal Transaksi">
                </div>
            </div>
        </div>


        <table id="" class="table table-striped">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Isi Kemasan</td>
                    <td>Satuan</td>
                    <td>Qty</td>
                    <td>Harga</td>
                    <td>Tax(%)</td>
                    <td>Total Harga</td>
                    <td>#</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Abacell 18 EC</td>
                    <td>10 X 1 ltr</td>
                    <td>Btl</td>
                    <td>50</td>
                    <td>Rp. 17,500</td>
                    <td>0%</td>
                    <td>Rp. 875,000</td>
                    <td><a href="#" class="btn btn-danger btn-sm " data-toggle="modal" data-target="#modalEditUser">
                            <i class="fa fa-solid fa-trash-alt"></i>
                        </a></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                    <td colspan="2" style="font-weight: bold;">Rp. 875,000
                        <input type="number" class="form-control" id="total_item" name="total_item" value="" readonly hidden>
                        <input type="number" class="form-control" id="total_harga" name="total_harga" value="" readonly hidden>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btnBawah">
            <button class="btn btn-warning mr-2" type="reset">Reset</button>
            <button type="button" id="selesai" class="btn btn-primary">
                <i class="fa fa-print pr-1"></i>Rekam Order
            </button>
        </div>
        </div>

    </div><!-- /.container-fluid -->

</div>

<!-- /.content-header -->
</div>