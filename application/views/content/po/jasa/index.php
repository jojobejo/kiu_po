<?php
if (!function_exists('pojasa_h')) {
    function pojasa_h($value)
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('pojasa_money')) {
    function pojasa_money($value)
    {
        return 'Rp. ' . number_format((float) $value, 0, ',', '.');
    }
}

$canManageVendor = in_array((string) $lv, array('1', '2'), true);
$canRequestVendor = !$canManageVendor;
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Purchase Order Jasa</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= base_url('pojasa/report') ?>" class="btn btn-warning">
                        <i class="fas fa-chart-line"></i> Report Vendor Jasa
                    </a>
                </div>
            </div>

            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger">
                    <?= pojasa_h($this->session->flashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (!$tables_ready) : ?>
                <div class="alert alert-warning">
                    <strong>Migration database PO Jasa belum tersedia.</strong>
                    Tabel yang belum ditemukan: <?= pojasa_h(implode(', ', $missing_tables)) ?>.
                    Jalankan SQL pada dokumentasi database PO Jasa Tahap 1 sampai Tahap 3 sebelum modul digunakan penuh.
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-2 col-md-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= (int) $summary['total'] ?></h3>
                            <p>Total Request</p>
                        </div>
                        <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= (int) $summary['on_progress'] ?></h3>
                            <p>Menunggu KADEP</p>
                        </div>
                        <div class="icon"><i class="fas fa-clock"></i></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?= (int) $summary['acc_kadep'] + (int) $summary['pengajuan_direktur'] ?></h3>
                            <p>Review Purchasing/Direktur</p>
                        </div>
                        <div class="icon"><i class="fas fa-file-signature"></i></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= (int) $summary['spk_terbit'] ?></h3>
                            <p>SPK Terbit</p>
                        </div>
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3><?= (int) $summary['progress_vendor'] ?></h3>
                            <p>Progress Vendor</p>
                        </div>
                        <div class="icon"><i class="fas fa-tasks"></i></div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= (int) $summary['done'] ?></h3>
                            <p>Project Done</p>
                        </div>
                        <div class="icon"><i class="fas fa-flag-checkered"></i></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-calendar-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Project Overdue</span>
                            <span class="info-box-number"><?= (int) $summary['overdue_active'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-file-invoice-dollar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Payment Pending</span>
                            <span class="info-box-number"><?= (int) $summary['payment_pending'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-money-check-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Payment Lunas</span>
                            <span class="info-box-number"><?= (int) $summary['payment_done'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Avg Vendor Score</span>
                            <span class="info-box-number"><?= number_format((float) $summary['avg_vendor_score'], 2) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs mb-3" id="poJasaTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabRequestList" role="tab">
                        <i class="fas fa-list"></i> List Request
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabRequestForm" role="tab">
                        <i class="fas fa-plus-circle"></i> Request Pekerjaan
                    </a>
                </li>
                <?php if ($canManageVendor) : ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabVendorJasa" role="tab">
                            <i class="fas fa-address-book"></i> Vendor Jasa
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tabRequestList" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="tbPojasa">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>SPK</th>
                                        <th>Vendor</th>
                                        <th>Departemen</th>
                                        <th>Target</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($requests as $request) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= pojasa_h($request->kd_po_jasa) ?></td>
                                            <td><?= pojasa_h($request->no_spk) ?></td>
                                            <td><?= pojasa_h($request->nama_vendor) ?></td>
                                            <td><?= pojasa_h($request->departemen) ?></td>
                                            <td><?= pojasa_h($request->tgl_target) ?></td>
                                            <td><?= pojasa_money($request->estimasi_total) ?></td>
                                            <td>
                                                <span class="badge badge-<?= in_array($request->status, array('SPK TERBIT', 'PROGRESS VENDOR', 'DONE'), true) ? 'success' : ($request->status === 'REJECT' ? 'danger' : 'warning') ?>">
                                                    <?= pojasa_h($request->status) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('pojasa/detail/' . $request->kd_po_jasa) ?>" class="btn btn-info btn-sm">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="tabRequestForm" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <form id="formRequestPojasa" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Nama Pengaju</label>
                                            <input type="text" class="form-control" value="<?= pojasa_h($nmuser) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Departemen</label>
                                            <input type="text" class="form-control" value="<?= pojasa_h($depuser) ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tanggal Request</label>
                                            <input type="date" class="form-control" name="tgl_request" value="<?= date('Y-m-d') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Target Selesai</label>
                                            <input type="date" class="form-control" name="tgl_target">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Vendor Jasa</label>
                                            <?php if ($canRequestVendor) : ?>
                                                <button type="button" class="btn btn-link btn-sm p-0 float-right" data-toggle="modal" data-target="#modalRequestVendorJasa">
                                                    Request Vendor Baru
                                                </button>
                                            <?php endif; ?>
                                            <select class="form-control" name="kd_vendor_jasa" id="kdVendorJasa">
                                                <option value="">Pilih Vendor</option>
                                                <?php foreach ($active_vendors as $vendor) : ?>
                                                    <option value="<?= pojasa_h($vendor->kd_vendor_jasa) ?>">
                                                        <?= pojasa_h($vendor->nama_vendor) ?> - <?= pojasa_h($vendor->kategori_jasa) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lokasi Pekerjaan</label>
                                            <input type="text" class="form-control" name="lokasi_pekerjaan" placeholder="Lokasi pekerjaan">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tujuan Pekerjaan</label>
                                            <input type="text" class="form-control" name="tujuan_pekerjaan" placeholder="Tujuan pekerjaan">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Dokumen Project Jasa</label>
                                            <input type="file" class="form-control" name="dokumen_project_jasa[]" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Keterangan Dokumen</label>
                                            <input type="text" class="form-control" name="keterangan_project_file" placeholder="Penawaran, gambar lokasi, TOR, atau dokumen pendukung">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">Scope & Estimasi Biaya</h5>
                                    <button type="button" class="btn btn-primary btn-sm" id="btnAddScopeJasa">
                                        <i class="fas fa-plus"></i> Tambah Scope
                                    </button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="tbScopeJasa">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width: 22%">Nama Pekerjaan</th>
                                                <th>Deskripsi</th>
                                                <th style="width: 10%">Qty</th>
                                                <th style="width: 12%">Satuan</th>
                                                <th style="width: 15%">Harga</th>
                                                <th style="width: 15%">Total</th>
                                                <th style="width: 6%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="scope-row">
                                                <td><input type="text" class="form-control" name="nama_pekerjaan[]" placeholder="Nama pekerjaan"></td>
                                                <td><input type="text" class="form-control" name="deskripsi[]" placeholder="Detail scope"></td>
                                                <td><input type="number" min="0" step="0.01" class="form-control scope-qty" name="qty[]" value="1"></td>
                                                <td><input type="text" class="form-control" name="satuan[]" value="Lot"></td>
                                                <td><input type="number" min="0" step="0.01" class="form-control scope-price" name="hrg_satuan[]" value="0"></td>
                                                <td><input type="text" class="form-control scope-total" value="0" readonly></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm btnRemoveScopeJasa">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5" class="text-right">Estimasi Total</th>
                                                <th colspan="2" id="grandTotalScopeJasa">Rp. 0</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success" <?= !$tables_ready ? 'disabled' : '' ?>>
                                        <i class="fas fa-save"></i> Rekam Request
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php if ($canManageVendor) : ?>
                    <div class="tab-pane fade" id="tabVendorJasa" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddVendorJasa">
                                    <i class="fas fa-plus"></i> Tambah Vendor
                                </button>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="tbVendorJasa">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama Vendor</th>
                                            <th>Kategori</th>
                                            <th>PIC</th>
                                                <th>Telpon</th>
                                                <th>Request Oleh</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $noVendor = 1; ?>
                                        <?php foreach ($vendors as $vendor) : ?>
                                            <tr>
                                                <td><?= $noVendor++ ?></td>
                                                <td><?= pojasa_h($vendor->kd_vendor_jasa) ?></td>
                                                <td><?= pojasa_h($vendor->nama_vendor) ?></td>
                                                <td><?= pojasa_h($vendor->kategori_jasa) ?></td>
                                                <td><?= pojasa_h($vendor->nama_pic) ?></td>
                                                <td><?= pojasa_h($vendor->no_telpon) ?></td>
                                                <td>
                                                    <?= pojasa_h(isset($vendor->requested_name) ? $vendor->requested_name : $vendor->created_by) ?><br>
                                                    <small><?= pojasa_h(isset($vendor->requested_departemen) ? $vendor->requested_departemen : '') ?></small>
                                                </td>
                                                <td><?= pojasa_h($vendor->status_vendor) ?></td>
                                                <td>
                                                    <?php if ($vendor->status_vendor === 'REQUEST') : ?>
                                                        <button type="button" class="btn btn-success btn-sm btnApproveVendorJasa" data-kd-vendor="<?= pojasa_h($vendor->kd_vendor_jasa) ?>" title="ACC Vendor">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btnRejectVendorJasa" data-kd-vendor="<?= pojasa_h($vendor->kd_vendor_jasa) ?>" title="Tolak Vendor">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    <?php else : ?>
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditVendorJasa<?= (int) $vendor->id_vendor_jasa ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btnDeleteVendorJasa" data-kd-vendor="<?= pojasa_h($vendor->kd_vendor_jasa) ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if ($canRequestVendor) : ?>
    <div class="modal fade" id="modalRequestVendorJasa" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="formRequestVendorJasa">
                    <div class="modal-header">
                        <h5 class="modal-title">Request Vendor Jasa Baru</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <?php $this->load->view('content/po/jasa/vendor_form', array('vendor' => null, 'show_status' => false)); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" <?= !$tables_ready ? 'disabled' : '' ?>>Kirim Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($canManageVendor) : ?>
    <div class="modal fade" id="modalAddVendorJasa" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="formAddVendorJasa">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Vendor Jasa</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <?php $this->load->view('content/po/jasa/vendor_form', array('vendor' => null, 'show_status' => true)); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" <?= !$tables_ready ? 'disabled' : '' ?>>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php foreach ($vendors as $vendor) : ?>
        <div class="modal fade" id="modalEditVendorJasa<?= (int) $vendor->id_vendor_jasa ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form class="formEditVendorJasa">
                        <input type="hidden" name="kd_vendor_jasa" value="<?= pojasa_h($vendor->kd_vendor_jasa) ?>">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Vendor Jasa</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <?php $this->load->view('content/po/jasa/vendor_form', array('vendor' => $vendor, 'show_status' => true)); ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
