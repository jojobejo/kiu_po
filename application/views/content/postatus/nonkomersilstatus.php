<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '5') : ?>
                        <h1 class="m-0">PO STATUS</h1>
                    <?php elseif ($this->session->userdata('lv') == '3') : ?>
                        <h1 class="m-0">Purchase Order To Do</h1>
                    <?php endif; ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <?php if ($this->session->userdata('lv') != '4') : ?>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="<?= base_url('historidone/') . $this->session->userdata('lv') . '/' . $this->session->userdata('kode') ?>" class="btn btn-warning"><i class="fas fa-history"></i> Histori PO Non Komersil &nbsp;</a>
                    </div>
                </div>
            <?php else : ?>
            <?php endif; ?>
            <?php if ($this->session->userdata('lv') == '4') : ?>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="<?= base_url('stsviewpo/1') ?>" class="btn btn-success btn-block"><i class="fas fa-history"></i> Data DONE </a>
                    </div>
                    <div class="col-sm-6">
                        <a href="<?= base_url('stsviewpo/2') ?>" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Data REJECT </a>
                    </div>
                </div>
            <?php else : ?>
            <?php endif; ?>

            <!-- NEW LINE -->
            <?php if ($this->session->userdata('lv') == '2') : ?>
                <div class="card">
                    <div class="card-body">
                        <?php echo form_open_multipart('srcponkbytgl') ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Start :</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Transaksi" value="" name="tglstart" id="tglstart">
                                </div>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal End :</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Transaksi" value="" name="tglend" id="tglend">
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-search"></i>
                                Cari Data
                            </button>
                        </div>
                    </div>
                </div>
            <?php else : ?>
            <?php endif; ?>

            <!-- KADEP VIEW -->
            <div class="row mb-3" id="ponkStatusFilter">
                <div class="col-12">
                    <div class="d-flex flex-wrap">
                        <button type="button" class="btn btn-dark btn-sm mr-2 mb-2 btn-filter-status-ponk active" data-status="" data-default-class="btn-dark">
                            <i class="fas fa-list"></i>&nbsp; SEMUA
                        </button>
                        <button type="button" class="btn btn-warning btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="ON PROGRESS" data-default-class="btn-warning">
                            <i class="fas fa-clock"></i>&nbsp; ON PROGRESS
                        </button>
                        <button type="button" class="btn btn-warning btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="ON PROGRESS - KADEP" data-default-class="btn-warning">
                            <i class="fas fa-clock"></i>&nbsp; ON PROGRESS - KADEP
                        </button>
                        <button type="button" class="btn btn-warning btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="SEDANG DIAJUKAN" data-default-class="btn-warning">
                            <i class="fas fa-clock"></i>&nbsp; SEDANG DIAJUKAN
                        </button>
                        <button type="button" class="btn btn-warning btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="PO REVISI" data-default-class="btn-warning">
                            <i class="fas fa-undo"></i>&nbsp; PO REVISI
                        </button>
                        <button type="button" class="btn btn-warning btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="PENDING" data-default-class="btn-warning">
                            <i class="fas fa-pause"></i>&nbsp; PENDING
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="ACC-KADEP" data-default-class="btn-primary">
                            <i class="fas fa-thumbs-up"></i>&nbsp; ACC-KADEP
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="ACC DIREKTUR" data-default-class="btn-primary">
                            <i class="fas fa-user-tie"></i>&nbsp; ACC DIREKTUR
                        </button>
                        <button type="button" class="btn btn-primary btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="PROSES PEMBELIAN" data-default-class="btn-primary">
                            <i class="fas fa-truck-moving"></i>&nbsp; PROSES PEMBELIAN
                        </button>
                        <button type="button" class="btn btn-danger btn-sm mr-2 mb-2 btn-filter-status-ponk" data-status="PENGAJUAN DIBATALKAN" data-default-class="btn-danger">
                            <i class="fas fa-times-circle"></i>&nbsp; PENGAJUAN DIBATALKAN
                        </button>
                    </div>
                </div>
            </div>

            <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '5' && $this->session->userdata('departemen') == 'KEUANGAN') : ?>
                <table class="table table-bordered table-striped" id="tballstatus">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nomor PO</td>
                            <td>Status Order</td>
                            <td>Tanggal PO</td>
                            <td>Nama Pembuat</td>
                            <td>Departement</td>
                            <td>Tujuan Pembelian</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($ponk as $p) : ?>
                            <tr data-status-order="<?= $p->status ?>">
                                <td><?= $no++; ?></td>
                                <td><?= $p->nopo ?></td>
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
                                            <?php elseif ($p->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '2') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
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
                                            <?php elseif ($p->status == 'PENGAJUAN DIBATALKAN') : ?>
                                                <a class="btn btn-block btn-danger btn-sm">
                                                    <i class="fas fa-times-circle"></i>&nbsp;
                                                    <?= $p->status ?>
                                                </a>
                                            <?php elseif ($p->status == 'PO REVISI') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-undo"></i>&nbsp;
                                                    <?= $p->status ?>
                                                </a>
                                            <?php elseif ($p->status == 'PENDING') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-pause"></i>&nbsp;
                                                    <?= $p->status ?>
                                                </a>
                                            <?php elseif ($p->status == 'ACC-KADEP') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    <?= $p->status ?>
                                                </a>
                                            <?php elseif ($p->status == 'PROSES PEMBELIAN') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    <?= $p->status ?>
                                                </a>
                                            <?php elseif ($p->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
                                                </a>
                                            <?php elseif ($p->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') != '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    <?= $p->status ?>
                                                </a>
                                            <?php elseif ($p->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') == '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    PENGAJUAN PEMBELIAN BARU
                                                </a>
                                            <?php elseif ($p->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '2' || $p->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '4' || $p->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    ACC DIREKTUR
                                                </a>
                                            <?php elseif ($p->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '2' || $p->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '4' || $p->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    PROSES PEMBELIAN
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td data-order="<?= $p->tgl_transaksi ?>"><?= $p->tgl_transaksi ?></td>
                                <td><?= $p->nama_user ?></td>
                                <td><?= $p->departement ?></td>
                                <td><?= $p->tj_pembelian ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <a class="btn btn-block btn-primary btn-sm" href="<?= base_url('detailponk/') . $p->kd_po_nk ?>">
                                                <i class="fas fa-eye"></i>
                                                Detail
                                            </a>
                                        </div>
                                        <?php if ($this->session->userdata('lv') == '1') : ?>
                                            <div class="col-md">
                                                <a class="btn btn-block btn-success btn-sm" href="<?= base_url('konfirmasiOrderNK/') . $p->kd_po_nk ?>">
                                                    <i class="fas fa-clipboard-check"></i>
                                                    Accept
                                                </a>
                                            </div>
                                            <div class="col-md">
                                                <a class="btn btn-block btn-warning btn-sm" href="<?= base_url('tolakOrderNK/') . $p->kd_po_nk ?>">
                                                    <i class="fas fa-times"></i>
                                                    Reject
                                                </a>
                                            </div>
                                        <?php elseif ($this->session->userdata('lv') == '2' && $p->status == 'REJECT') : ?>
                                            <div class="col">
                                                <a class="btn btn-block btn-info btn-sm" href="<?= base_url('unpostponk/') . $p->kd_po_nk ?>">
                                                    <i class="fas fa-sync"></i> &nbsp;
                                                    UNPOST
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="btn btn-block btn-warning btn-sm" href="<?= base_url('hapusponk/') . $p->kd_po_nk ?>">
                                                    <i class="fas fa-trash"></i> &nbsp;
                                                    DELETE
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif ($this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '3') : ?>
                <table class="table table-bordered table-striped" id="tballstatus">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nomor PO</td>
                            <td>Status Order</td>
                            <td>Tanggal PO</td>
                            <td>Nama Pembuat</td>
                            <td>Departement</td>
                            <td>Tujuan Pembelian</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($po as $p1) : ?>
                            <tr data-status-order="<?= $p1->status ?>">
                                <td><?= $no++; ?></td>
                                <td><?= $p1->nopo ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <?php if ($p1->status == 'ON PROGRESS') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '2') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-exclamation"></i>&nbsp;
                                                    Terdapat Update Dari Direktur
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    ON PROGRESS
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-exclamation"></i>&nbsp;
                                                    Terdapat Update Dari Keuangan
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '2') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    ON PROGRESS
                                                </a>
                                            <?php elseif ($p1->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '2') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
                                                </a>
                                            <?php elseif ($p1->status == 'DONE') : ?>
                                                <a class="btn btn-block btn-success btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'REJECT') : ?>
                                                <a class="btn btn-block btn-danger btn-sm">
                                                    <i class="fas fa-times"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'PENGAJUAN DIBATALKAN') : ?>
                                                <a class="btn btn-block btn-danger btn-sm">
                                                    <i class="fas fa-times-circle"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'PO REVISI') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-undo"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'PENDING') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-pause"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'ACC-KADEP') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
                                                </a>
                                            <?php elseif ($p1->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '4') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
                                                </a>
                                            <?php elseif ($p1->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') != '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') == '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    PENGAJUAN PEMBELIAN BARU
                                                </a>
                                            <?php elseif ($p1->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '2' || $p1->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '4' || $p1->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    ACC DIREKTUR
                                                </a>
                                            <?php elseif ($p1->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '2' || $p1->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '4' || $p1->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-truck-moving"></i>&nbsp;
                                                    PROSES PEMBELIAN
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td data-order="<?= $p1->tgl_transaksi ?>"><?= $p1->tgl_transaksi ?></td>
                                <td><?= $p1->nama_user ?></td>
                                <td><?= $p1->departement ?></td>
                                <td><?= $p1->tj_pembelian ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <a class="btn btn-block btn-primary btn-sm" href="<?= base_url('detailponk/') . $p1->kd_po_nk ?>">
                                                <i class="fas fa-eye"></i>
                                                Detail
                                            </a>
                                        </div>
                                        <?php if ($this->session->userdata('lv') == '1') : ?>
                                            <div class="col-md">
                                                <a class="btn btn-block btn-success btn-sm" href="<?= base_url('konfirmasiOrderNK/') . $p1->kd_po_nk ?>">
                                                    <i class="fas fa-clipboard-check"></i>
                                                    Accept
                                                </a>
                                            </div>
                                            <div class="col-md">
                                                <a class="btn btn-block btn-warning btn-sm" href="<?= base_url('tolakOrderNK/') . $p1->kd_po_nk ?>">
                                                    <i class="fas fa-times"></i>
                                                    Reject
                                                </a>
                                            </div>
                                        <?php elseif ($this->session->userdata('lv') == '2' && $p1->status == 'REJECT') : ?>
                                            <div class="col">
                                                <a class="btn btn-block btn-info btn-sm" href="<?= base_url('unpostponk/') . $p1->kd_po_nk ?>">
                                                    <i class="fas fa-sync"></i> &nbsp;
                                                    UNPOST
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="btn btn-block btn-warning btn-sm" href="<?= base_url('hapusponk/') . $p1->kd_po_nk ?>">
                                                    <i class="fas fa-trash"></i> &nbsp;
                                                    DELETE
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <!-- TAMBAHAN RE STOCK ADMIN -->
            <?php elseif ($this->session->userdata('lv') == '5') : ?>
                <table class="table table-bordered table-striped" id="tballstatus">
                    <thead>
                        <tr>
                            <td>Nos</td>
                            <td>Nomor PO</td>
                            <td>Status Order</td>
                            <td>Tanggal PO</td>
                            <td>Nama Pembuat</td>
                            <td>Departement</td>
                            <td>Tujuan Pembelian</td>
                            <td>#</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($po as $p1) : ?>
                            <tr data-status-order="<?= $p1->status ?>">
                                <td><?= $no++; ?></td>
                                <td><?= $p1->nopo ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <?php if ($p1->status == 'ON PROGRESS') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '2') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-exclamation"></i>&nbsp;
                                                    Terdapat Update Dari Direktur
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE DIREKTUR' && $this->session->userdata('lv') == '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    ON PROGRESS
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-exclamation"></i>&nbsp;
                                                    Terdapat Update Dari Keuangan
                                                </a>
                                            <?php elseif ($p1->status == 'NOTE KEUANGAN' && $this->session->userdata('lv') == '2') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    ON PROGRESS
                                                </a>
                                            <?php elseif ($p1->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '2') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
                                                </a>
                                            <?php elseif ($p1->status == 'DONE') : ?>
                                                <a class="btn btn-block btn-success btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'REJECT') : ?>
                                                <a class="btn btn-block btn-danger btn-sm">
                                                    <i class="fas fa-times"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'PENGAJUAN DIBATALKAN') : ?>
                                                <a class="btn btn-block btn-danger btn-sm">
                                                    <i class="fas fa-times-circle"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'PO REVISI') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-undo"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'PENDING') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-pause"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'ACC-KADEP') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
                                                </a>
                                            <?php elseif ($p1->status == 'ON PROGRESS - KADEP' && $this->session->userdata('lv') == '4') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    MENUNGGU ACC KADEP
                                                </a>
                                            <?php elseif ($p1->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') != '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    <?= $p1->status ?>
                                                </a>
                                            <?php elseif ($p1->status == 'SEDANG DIAJUKAN' && $this->session->userdata('lv') == '3') : ?>
                                                <a class="btn btn-block btn-warning btn-sm">
                                                    <i class="fas fa-clock"></i>&nbsp;
                                                    PENGAJUAN PEMBELIAN BARU
                                                </a>
                                            <?php elseif ($p1->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '2' || $p1->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '4' || $p1->status == 'ACC DIREKTUR' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-thumbs-up"></i>&nbsp;
                                                    ACC DIREKTUR
                                                </a>
                                            <?php elseif ($p1->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '2' || $p1->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '4' || $p1->status == 'PROSES PEMBELIAN' && $this->session->userdata('lv') == '5') : ?>
                                                <a class="btn btn-block btn-primary btn-sm">
                                                    <i class="fas fa-truck-moving"></i>&nbsp;
                                                    PROSES PEMBELIAN
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td data-order="<?= $p1->tgl_transaksi ?>"><?= $p1->tgl_transaksi ?></td>
                                <td><?= $p1->nama_user ?></td>
                                <td><?= $p1->departemen ?></td>
                                <td><?= $p1->tj_pembelian ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md">
                                            <a class="btn btn-block btn-primary btn-sm" href="<?= base_url('detailponk/') . $p1->kd_po_nk ?>">
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
    <?php endif; ?>
    </div>
</div>
<!-- /.content-header -->
<script>
    (function initPonkStatusFilter() {
        if (typeof window.jQuery === 'undefined' || !window.jQuery.fn.DataTable || !window.jQuery.fn.DataTable.isDataTable('#tballstatus')) {
            setTimeout(initPonkStatusFilter, 50);
            return;
        }

        var $ = window.jQuery;
        var selectedStatus = '';
        var table = $('#tballstatus').DataTable();
        table.order([3, 'desc']).draw();

        if (!window.ponkStatusFilterRegistered) {
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                if (settings.nTable.id !== 'tballstatus' || selectedStatus === '') {
                    return true;
                }

                var rowStatus = $(settings.aoData[dataIndex].nTr).attr('data-status-order');
                return rowStatus === selectedStatus;
            });
            window.ponkStatusFilterRegistered = true;
        }

        function resetFilterButton($button) {
            var defaultClass = $button.attr('data-default-class');
            $button.removeClass('btn-default active').addClass(defaultClass);
        }

        function activateFilterButton($button) {
            var defaultClass = $button.attr('data-default-class');
            $button.removeClass(defaultClass).addClass('btn-default active');
        }

        $(document).off('click.ponkStatusFilter', '.btn-filter-status-ponk').on('click.ponkStatusFilter', '.btn-filter-status-ponk', function() {
            var $button = $(this);
            selectedStatus = $button.attr('data-status');

            $('.btn-filter-status-ponk').each(function() {
                resetFilterButton($(this));
            });
            activateFilterButton($button);

            table.draw();
        });
    })();
</script>
</div>
