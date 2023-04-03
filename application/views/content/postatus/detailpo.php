<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div style="display: flex; text-align: center;">
                        <a href="<?= base_url('postatus') ?>">
                            <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                        </a>
                        <h3>Kembali</h3>
                    </div>
                </div><!-- /.col -->

            </div><!-- /.row -->
            <div class="card ">
                <div class="m-2">
                    <div class="">
                        <div class="row">
                            <?php foreach ($status as $s) : ?>
                                <div class="col">
                                    <label for="noInv" class="">No Po</label>
                                    <input type="text" id="noInv" name="noInv" value="<?= $s->no_po ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="naSupp" class="">Nama Suplier : </label>
                                    <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nama_suplier ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="tgTrans" class="">Tanggal Transaksi : &nbsp;&nbsp; </label>
                                    <input type="date" id="tgTrans" name="tgTrans" style="max-width: 250px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>
                                    <?php if ($s->status == 'ON PROGRESS') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'DONE') : ?>
                                        <div>
                                            <a href="<?= base_url('printOrder/') . $s->kd_po ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                        </div>
                                    <?php elseif ($s->status == 'REJECT') : ?>
                                        <div>
                                            <a href="#" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Order Ditolak</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
            <table class="table table-bordered table-striped">
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
                    <?php $no = 1;
                    foreach ($detail as $d) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $d->nama_barang ?></td>
                            <td><?= $d->satuan ?></td>
                            <td><?= $d->qty ?></td>
                            <td>Rp. <?= number_format($d->hrg_satuan) ?></td>
                            <td><?= $d->tax ?> (%)</td>
                            <td>Rp. <?= number_format($d->hrg_total) ?></td>
                            <td><a class="btn btn-block btn-success btn-sm" data-toggle="modal" data-target="#modalEdit<?= $d->id_det_po ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                    Edit
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
                    <?php foreach ($total as $t) : ?>
                        <tr>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td style="display: none;"></td>
                            <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                            <td colspan="2" style="font-weight: bold;">Rp.<?= number_format($t->total_harga) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>