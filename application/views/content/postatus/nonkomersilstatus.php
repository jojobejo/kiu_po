<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">PO STATUS</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <table class="table table-bordered table-striped" id="tballstatus">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Status Order</td>
                        <td>Kode PO</td>
                        <td>Nama Pembuat</td>
                        <td>Tujuan Pembelian</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($po as $p) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-md">
                                        <?php if ($p->status == 'ON PROGRESS') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-clock"></i>&nbsp;
                                                <?= $p->status ?>
                                            </a>
                                        <?php elseif ($p->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '2') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-exclamation"></i>&nbsp;
                                                Terdapat Update Dari Direktur
                                            </a>
                                        <?php elseif ($p->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '3') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-clock"></i>&nbsp;
                                                ON PROGRESS
                                            </a>
                                        <?php elseif ($p->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '3') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-exclamation"></i>&nbsp;
                                                Terdapat Update Dari Keuangan
                                            </a>
                                        <?php elseif ($p->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '2') : ?>
                                            <a class="btn btn-block btn-warning btn-sm">
                                                <i class="fas fa-clock"></i>&nbsp;
                                                ON PROGRESS
                                            </a>
                                        <?php elseif ($p->status == 'DONE') : ?>
                                            <a class="btn btn-block btn-success btn-sm">
                                                <i class="fas fa-thumbs-up"></i>&nbsp;
                                                <?= $p->status ?>
                                            </a>
                                        <?php elseif ($p->status == 'REJECT') : ?>
                                            <a class="btn btn-block btn-danger btn-sm">
                                                <i class="fas fa-times"></i>&nbsp;
                                                <?= $p->status ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td><?= $p->kd_po_nk ?></td>
                            <td><?= $p->nama_user ?></td>
                            <td><?= $p->tj_pembelian ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-md">
                                        <a class="btn btn-block btn-primary btn-sm" href="<?= base_url('detailponk/') . $p->kd_po_nk ?>">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>