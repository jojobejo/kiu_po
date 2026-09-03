<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <?php foreach (array('success' => 'success', 'warning' => 'warning', 'error' => 'danger') as $flashKey => $alertClass) : ?>
                <?php if ($this->session->flashdata($flashKey)) : ?>
                    <div class="alert alert-<?= $alertClass ?> alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($this->session->flashdata($flashKey), ENT_QUOTES, 'UTF-8') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Approval Request Barang PIC</h3>
                        <a href="<?= base_url('postatusnk') ?>" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <table class="table table-bordered table-striped" id="list_reqpic">
                        <thead>
                            <tr>
                                <td>Nama Pengaju</td>
                                <td>Departemen</td>
                                <td>Tanggal Request</td>
                                <td>Total Barang</td>
                                <td>Tujuan Request</td>
                                <td>Status</td>
                                <td>#</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getlistpic as $g) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($g->nm_user, ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= htmlspecialchars($g->departemen, ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= function_exists('format_tgl_lahir') ? format_tgl_lahir($g->tgl_transaksi) : htmlspecialchars($g->tgl_transaksi, ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><?= (int) $g->jml_item ?></td>
                                    <td><?= htmlspecialchars($g->tj_pembelian, ENT_QUOTES, 'UTF-8') ?></td>
                                    <td><span class="badge badge-warning"><?= htmlspecialchars($g->status, ENT_QUOTES, 'UTF-8') ?></span></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a class="btn btn-primary" href="<?= base_url('reqpic/detreqbarangpic/' . $g->kd_po_nk) ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="<?= base_url('acc_req_kadep') ?>" method="post" class="d-inline">
                                                <input type="hidden" name="kdreqpo" value="<?= htmlspecialchars($g->kd_po_nk, ENT_QUOTES, 'UTF-8') ?>">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#rejectReqKadep<?= htmlspecialchars($g->kd_po_nk, ENT_QUOTES, 'UTF-8') ?>">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php foreach ($getlistpic as $g) : ?>
    <div class="modal fade" id="rejectReqKadep<?= htmlspecialchars($g->kd_po_nk, ENT_QUOTES, 'UTF-8') ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?= base_url('reject_req_kadep') ?>" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kdreqpo" value="<?= htmlspecialchars($g->kd_po_nk, ENT_QUOTES, 'UTF-8') ?>">
                    <div class="form-group">
                        <label>Catatan Reject</label>
                        <textarea name="note_reject" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
