<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h3>List Request Status</h3>
                    <?php if ($countreq == '0') : ?>
                        <a href="<?= base_url('listbarangready') ?>" class="btn btn-sm btn-primary mb-2"><i class="fas fa-plus"></i>&nbsp; New Request </a>
                    <?php else : ?>
                    <?php endif; ?>
                    <table class="table table-bordered table-striped" id="">
                        <thead>
                            <tr>
                                <td>Tanggal Request</td>
                                <td>Total Barang</td>
                                <td>Keterangan</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getallreq as $g) : ?>
                                <tr>
                                    <td><?= format_tgl_lahir($g->tgl_transaksi) ?></td>
                                    <td><?= $g->jml_item ?></td>
                                    <td><?= $g->tj_pembelian ?></td>
                                    <td>
                                        <div class="row">
                                            <?php if ($g->status == 'ON PROGRESS') : ?>
                                                <div class="col">
                                                    <a class="btn btn-block btn-warning btn-sm"><?= $g->status ?></a>
                                                </div>
                                            <?php elseif ($g->status == 'ACC-ADM') : ?>
                                                <div class="col">
                                                    <a class="btn btn-block btn-warning btn-sm"><?= $g->status ?></a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-block btn-primary btn-sm" href="<?= base_url('reqpic/detreqbarangpic/' . $g->kd_po_nk) ?>">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- END CARD CONTENT -->
            </div>

            <?php if ($countreq == '1') : ?>
                <div class="card">
                    <div class="card-body">
                        <h3>Draft Request Barang</h3>
                        <div class="row mb-2">
                            <div class="col">
                                <a href="<?= base_url('listbarangready') ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp; Tambah Barang </a>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped" id="">
                            <thead>
                                <tr>
                                    <td>Nama Barang</td>
                                    <td>Deskripsi</td>
                                    <td>Keterangan</td>
                                    <td>QTY</td>
                                    <td>Satuan</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tmpreq as $t) : ?>
                                    <tr>
                                        <td><?= $t->nama_barang ?></td>
                                        <td><?= $t->descnk ?></td>
                                        <td><?= $t->keterangan ?></td>
                                        <td><?= $t->qty ?></td>
                                        <td><?= $t->nm_satuan ?></td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <a class="btn btn-block btn-warning btn-sm" data-toggle="modal" data-target="#hapus<?= $t->id_tmp_nk ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-block btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $t->id_tmp_nk ?>">
                                                        <i class="fas fa-times-circle"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <?php echo form_open_multipart('addnewreq/' . $this->session->userdata('kode')); ?>
                                    <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $generatekd ?>" readonly hidden />
                                    <input class="form-control" type="text" id="totbr" name="totbr" value="<?= $jumlahbr ?>" readonly hidden />
                                    <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-cloud-upload-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <!-- END CARD CONTENT -->
                </div>
            <?php else : ?>
            <?php endif; ?>
            <!-- END CONTAINER CONTENT -->
        </div>
    </div>
    <!-- END VIEW CONTENT -->
</div>