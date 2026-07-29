<style>
    .pojasa-page .small-box,
    .pojasa-page .card,
    .pojasa-page .modal-content {
        border-radius: 8px;
    }

    .pojasa-page .pojasa-total-panel {
        background: #f4f6f9;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 14px;
    }

    .pojasa-page .pojasa-row-fade {
        animation: pojasaFade .24s ease-in-out;
    }

    .pojasa-page .status-pill {
        display: inline-block;
        min-width: 96px;
        border-radius: 4px;
        padding: 4px 8px;
        font-size: 12px;
        font-weight: 700;
        text-align: center;
    }

    .pojasa-page .timeline {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .pojasa-page .timeline li {
        border-left: 3px solid #17a2b8;
        margin-left: 8px;
        padding: 0 0 14px 14px;
    }

    .pojasa-page .timeline li:last-child {
        padding-bottom: 0;
    }

    @keyframes pojasaFade {
        from {
            opacity: .25;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="content-wrapper pojasa-page">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PO Jasa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">PO Jasa</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <?php if (!$tables_ready) : ?>
                <div class="alert alert-warning">
                    <strong>Tabel PO Jasa belum tersedia.</strong>
                    Import SQL migration <code>db/MIGRASI/20260728_po_jasa.sql</code> terlebih dahulu.
                    Missing: <code><?= html_escape(implode(', ', $missing_tables)) ?></code>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="sum-diaju">0</h3>
                            <p>Diajukan</p>
                        </div>
                        <div class="icon"><i class="fas fa-paper-plane"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="sum-review">0</h3>
                            <p>Review Biaya</p>
                        </div>
                        <div class="icon"><i class="fas fa-search-dollar"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3 id="sum-proses">0</h3>
                            <p>Pelaksanaan</p>
                        </div>
                        <div class="icon"><i class="fas fa-tools"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="sum-closed">0</h3>
                            <p>Closed</p>
                        </div>
                        <div class="icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="pojasa-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-form-request" data-toggle="pill" href="#panel-form-request" role="tab">
                                <i class="fas fa-plus-circle"></i> Request Jasa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-list-request" data-toggle="pill" href="#panel-list-request" role="tab">
                                <i class="fas fa-list"></i> List Request
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-vendor-jasa" data-toggle="pill" href="#panel-vendor-jasa" role="tab">
                                <i class="fas fa-id-card"></i> Vendor Jasa
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="panel-form-request" role="tabpanel">
                            <form id="form-pojasa-request">
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Vendor Jasa</label>
                                                    <select class="form-control" id="request-kd-vendor" name="kd_vendor_jasa"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Prioritas</label>
                                                    <select class="form-control" name="prioritas" id="request-prioritas">
                                                        <option value="NORMAL">NORMAL</option>
                                                        <option value="URGENT">URGENT</option>
                                                        <option value="RENDAH">RENDAH</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Judul Jasa</label>
                                                    <input type="text" class="form-control" name="judul_jasa" id="request-judul" placeholder="Contoh: Service AC ruang meeting">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Tgl Kebutuhan</label>
                                                    <input type="date" class="form-control" name="tgl_kebutuhan" id="request-tgl">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Lokasi</label>
                                                    <input type="text" class="form-control" name="lokasi_jasa" id="request-lokasi" placeholder="Lokasi pekerjaan vendor">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Kegiatan Vendor</label>
                                                    <textarea class="form-control" name="kegiatan_jasa" id="request-kegiatan" rows="3" placeholder="Jelaskan pekerjaan atau aktivitas yang dilakukan vendor"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Alasan Kebutuhan</label>
                                                    <textarea class="form-control" name="alasan_kebutuhan" id="request-alasan" rows="2" placeholder="Dasar bisnis/operasional kenapa jasa ini diperlukan"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Catatan Pengajuan</label>
                                                    <textarea class="form-control" name="catatan_pengajuan" id="request-catatan" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="mb-0">Rincian Biaya</h5>
                                            <button type="button" class="btn btn-sm btn-info" id="btn-add-biaya">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-sm" id="table-biaya">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 120px;">Jenis</th>
                                                        <th>Nama Biaya</th>
                                                        <th style="width: 70px;">Qty</th>
                                                        <th style="width: 80px;">Satuan</th>
                                                        <th style="width: 130px;">Nominal</th>
                                                        <th style="width: 42px;">#</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                        <div class="pojasa-total-panel">
                                            <div class="form-group mb-2">
                                                <label>PPN / Pajak (%)</label>
                                                <input type="number" class="form-control" id="request-tax" name="tax_percent" min="0" step="0.01" value="0">
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Total Estimasi</span>
                                                <strong id="total-estimasi">Rp 0</strong>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span>Pajak</span>
                                                <strong id="total-tax">Rp 0</strong>
                                            </div>
                                            <hr class="my-2">
                                            <div class="d-flex justify-content-between">
                                                <span>Grand Total</span>
                                                <strong id="grand-total">Rp 0</strong>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex justify-content-end">
                                            <button type="button" class="btn btn-secondary mr-2" id="btn-save-draft">
                                                <i class="fas fa-save"></i> Draft
                                            </button>
                                            <button type="button" class="btn btn-success" id="btn-submit-request">
                                                <i class="fas fa-paper-plane"></i> Ajukan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="panel-list-request" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <select class="form-control" id="filter-status">
                                        <option value="">Semua Status</option>
                                        <?php foreach ($status_options as $status) : ?>
                                            <option value="<?= html_escape($status) ?>"><?= html_escape($status) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" id="filter-tgl-awal">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" id="filter-tgl-akhir">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary btn-block" id="btn-filter-request">
                                        <i class="fas fa-sync"></i> Load Data
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table-pojasa-request">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Kebutuhan</th>
                                            <th>Judul</th>
                                            <th>Vendor</th>
                                            <th>Departemen</th>
                                            <th>User</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="panel-vendor-jasa" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4">
                                    <form id="form-pojasa-vendor">
                                        <input type="hidden" name="id_vendor_jasa" id="vendor-id">
                                        <div class="form-group">
                                            <label>Nama Vendor</label>
                                            <input type="text" class="form-control" name="nama_vendor" id="vendor-nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori Jasa</label>
                                            <input type="text" class="form-control" name="kategori_jasa" id="vendor-kategori" placeholder="Service, konstruksi, ekspedisi, maintenance">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat_vendor" id="vendor-alamat" rows="2"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Kontak Person</label>
                                            <input type="text" class="form-control" name="kontak_person" id="vendor-kontak">
                                        </div>
                                        <div class="form-group">
                                            <label>No Telpon</label>
                                            <input type="text" class="form-control" name="no_telpon" id="vendor-telpon">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="vendor-email">
                                        </div>
                                        <div class="form-group">
                                            <label>NPWP</label>
                                            <input type="text" class="form-control" name="npwp" id="vendor-npwp">
                                        </div>
                                        <button type="button" class="btn btn-success" id="btn-save-vendor">
                                            <i class="fas fa-save"></i> Simpan Vendor
                                        </button>
                                        <button type="button" class="btn btn-default" id="btn-reset-vendor">Reset</button>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" id="table-pojasa-vendor">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Vendor</th>
                                                    <th>Kategori</th>
                                                    <th>Kontak</th>
                                                    <th>Telpon</th>
                                                    <th>Status</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-pojasa-detail">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail PO Jasa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="detail-kd-pojasa">
                <div id="detail-pojasa-content"></div>
            </div>
            <div class="modal-footer justify-content-between">
                <div class="input-group" style="max-width: 520px;">
                    <select class="form-control" id="detail-action"></select>
                    <input type="text" class="form-control" id="detail-catatan" placeholder="Catatan status">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="btn-update-status">
                            <i class="fas fa-check"></i> Update
                        </button>
                    </div>
                </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
