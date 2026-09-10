<?php
$requestCode = $request ? (string) $request->kd_po_jasa : '';
$status = $request ? (string) $request->status : 'DRAFT';
$vendors = isset($vendors) && is_array($vendors) ? $vendors : array();
$field = static function ($object, $name, $default = '') {
    return $object && isset($object->{$name}) ? $object->{$name} : $default;
};
$h = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-7">
          <h1 class="m-0"><?= $request ? 'Edit Request PO Jasa' : 'Buat Request PO Jasa' ?></h1>
          <small class="text-muted">Simpan sebagai draft sebelum mengunggah dokumen.</small>
        </div>
        <div class="col-sm-5 text-right">
          <a href="<?= base_url('pojasa/pic') ?>" class="btn btn-default"><i class="fas fa-arrow-left mr-1"></i> Daftar</a>
          <?php if ($request) : ?>
            <a href="<?= base_url('pojasa/pic/detail/' . rawurlencode($requestCode)) ?>" class="btn btn-info"><i class="fas fa-eye mr-1"></i> Detail</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-file-signature mr-1"></i> Header Request</h3>
          <div class="card-tools">
            <span id="requestCodeLabel" class="badge badge-light mr-2"><?= $h($requestCode ?: 'Nomor dibuat saat draft disimpan') ?></span>
            <span id="requestStatusBadge" class="badge badge-secondary"><?= $h($status) ?></span>
          </div>
        </div>
        <div class="card-body">
          <form id="pojasaPicForm" novalidate>
            <input type="hidden" id="requestCode" value="<?= $h($requestCode) ?>">
            <div class="row">
              <div class="col-md-6"><div class="form-group"><label>PIC</label><input class="form-control" value="<?= $h($field($request, 'nm_user', $nmuser)) ?>" placeholder="Nama PIC" readonly></div></div>
              <div class="col-md-6"><div class="form-group"><label>Departemen</label><input class="form-control" value="<?= $h($field($request, 'departemen', $depuser)) ?>" placeholder="Departemen PIC" readonly></div></div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Vendor terdaftar</label>
                  <select id="vendorCode" class="form-control">
                    <option value="">-- Pilih vendor terdaftar --</option>
                    <?php foreach ($vendors as $vendor) : ?>
                      <option value="<?= $h($vendor['kd_vendor_jasa']) ?>" <?= (string) $field($request, 'kd_vendor_jasa') === (string) $vendor['kd_vendor_jasa'] ? 'selected' : '' ?>><?= $h($vendor['nama_vendor']) ?><?= trim((string) $vendor['kategori_jasa']) !== '' ? ' — ' . $h($vendor['kategori_jasa']) : '' ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama vendor / toko manual</label>
                  <input id="vendorProposal" class="form-control" maxlength="180" value="<?= $h($field($request, 'vendor_usulan')) ?>" placeholder="Isi bila vendor tidak ada dalam pilihan">
                  <small class="form-text text-muted"><span class="text-danger">* Wajib</span> pilih salah satu: vendor terdaftar atau nama vendor/toko manual.</small>
                </div>
              </div>
            </div>
            <div class="form-group"><label>Tujuan pekerjaan <span class="text-danger">*</span></label><textarea id="workPurpose" rows="3" maxlength="10000" class="form-control" placeholder="Jelaskan tujuan pekerjaan secara lengkap"><?= $h($field($request, 'tujuan_pekerjaan')) ?></textarea></div>
            <div class="form-group"><label>Catatan PIC</label><textarea id="picNotes" rows="2" maxlength="10000" class="form-control" placeholder="Tambahkan catatan khusus untuk proses persetujuan (opsional)"><?= $h($field($request, 'catatan_pic')) ?></textarea></div>
            <div class="alert alert-light border mb-0"><i class="fas fa-info-circle mr-1"></i>Sumber pemenuhan material dan jadwal pelaksanaan ditentukan Purchasing saat review.</div>
          </form>
        </div>
      </div>

      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-tasks mr-1"></i> Scope Pekerjaan</h3>
          <div class="card-tools"><button type="button" id="addScopeRow" class="btn btn-sm btn-info"><i class="fas fa-plus mr-1"></i> Tambah baris</button></div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered table-sm mb-0" id="scopeTable">
              <thead><tr><th style="min-width:180px">Nama scope</th><th style="min-width:220px">Deskripsi</th><th style="width:110px">Qty</th><th style="width:120px">Satuan</th><th style="width:160px">Harga estimasi</th><th style="width:160px">Subtotal</th><th style="width:45px"></th></tr></thead>
              <tbody>
                <?php foreach ($scopes ?: array(array()) as $row) : ?>
                  <tr class="scope-row">
                    <td><input class="form-control form-control-sm line-name" maxlength="180" value="<?= $h(isset($row['nama_scope']) ? $row['nama_scope'] : '') ?>" placeholder="Contoh: Instalasi AC"></td>
                    <td><textarea class="form-control form-control-sm line-description" rows="1" maxlength="5000" placeholder="Uraikan pekerjaan"><?= $h(isset($row['deskripsi']) ? $row['deskripsi'] : '') ?></textarea></td>
                    <td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-qty" value="<?= $h(isset($row['qty']) ? $row['qty'] : '') ?>" placeholder="0"></td>
                    <td><input class="form-control form-control-sm line-unit" maxlength="40" value="<?= $h(isset($row['satuan']) ? $row['satuan'] : '') ?>" placeholder="Unit"></td>
                    <td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-price" value="<?= $h(isset($row['harga_estimasi']) ? $row['harga_estimasi'] : '') ?>" placeholder="0"></td>
                    <td class="line-subtotal text-right align-middle">Rp 0</td>
                    <td class="text-center align-middle"><button type="button" class="btn btn-xs btn-outline-danger remove-line" title="Hapus baris"><i class="fas fa-times"></i></button></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot><tr><th colspan="5" class="text-right">Total estimasi jasa</th><th id="scopeTotal" class="text-right">Rp 0</th><th></th></tr></tfoot>
            </table>
          </div>
        </div>
      </div>

      <div class="card card-outline card-warning">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-tools mr-1"></i> Material / Alat dan Bahan</h3>
          <div class="card-tools"><button type="button" id="addMaterialRow" class="btn btn-sm btn-warning"><i class="fas fa-plus mr-1"></i> Tambah baris</button></div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-bordered table-sm mb-0" id="materialTable">
              <thead><tr><th style="min-width:180px">Nama alat/bahan</th><th style="min-width:200px">Deskripsi / spesifikasi</th><th style="width:100px">Qty</th><th style="width:110px">Satuan</th><th style="width:150px">Estimasi biaya</th><th style="width:150px">Subtotal</th><th style="width:45px"></th></tr></thead>
              <tbody>
                <?php foreach ($materials ?: array(array()) as $row) : ?>
                  <tr class="material-row">
                    <td><input class="form-control form-control-sm line-name" maxlength="180" value="<?= $h(isset($row['nama_material']) ? $row['nama_material'] : '') ?>" placeholder="Contoh: Kabel NYM"></td>
                    <td><textarea class="form-control form-control-sm line-description" rows="1" maxlength="5000" placeholder="Spesifikasi alat/bahan"><?= $h(isset($row['deskripsi']) ? $row['deskripsi'] : '') ?></textarea></td>
                    <td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-qty" value="<?= $h(isset($row['qty_kebutuhan']) ? $row['qty_kebutuhan'] : '') ?>" placeholder="0"></td>
                    <td><input class="form-control form-control-sm line-unit" maxlength="40" value="<?= $h(isset($row['satuan']) ? $row['satuan'] : '') ?>" placeholder="Meter"></td>
                    <td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-price" value="<?= $h(isset($row['harga_estimasi']) ? $row['harga_estimasi'] : '') ?>" placeholder="0"></td>
                    <td class="line-subtotal text-right align-middle">Rp 0</td>
                    <td class="text-center align-middle"><button type="button" class="btn btn-xs btn-outline-danger remove-line" title="Hapus baris"><i class="fas fa-times"></i></button></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot><tr><th colspan="5" class="text-right">Total estimasi material</th><th id="materialTotal" class="text-right">Rp 0</th><th></th></tr></tfoot>
            </table>
          </div>
        </div>
      </div>

      <div class="card card-outline card-success">
        <div class="card-header"><h3 class="card-title"><i class="fas fa-paperclip mr-1"></i> Dokumen Pendukung <span class="text-danger">*</span></h3></div>
        <div class="card-body">
          <div id="documentDraftHint" class="alert alert-info <?= $requestCode ? 'd-none' : '' ?>">Simpan draft terlebih dahulu untuk mengaktifkan upload.</div>
          <div class="border rounded bg-light p-3">
            <div class="row">
              <div class="col-lg-8">
                <div class="form-group mb-lg-0">
                  <label for="documentFiles">Pilih dokumen (maksimum 10 MB per file)</label>
                  <div class="custom-file"><input id="documentFiles" type="file" class="custom-file-input" multiple accept=".txt,.rtf,.csv,.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" <?= $requestCode ? '' : 'disabled' ?>><label class="custom-file-label" for="documentFiles">Pilih satu atau beberapa file</label></div>
                  <small class="form-text text-muted">Format: TXT, RTF, CSV, PDF, Word, Excel, JPG, JPEG, atau PNG.</small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group mb-0"><label for="documentNote">Keterangan dokumen</label><input id="documentNote" maxlength="255" class="form-control" placeholder="Contoh: Penawaran vendor" <?= $requestCode ? '' : 'disabled' ?>></div>
              </div>
            </div>
            <div class="text-right mt-3"><button type="button" id="uploadDocuments" class="btn btn-success px-4" <?= $requestCode ? '' : 'disabled' ?>><i class="fas fa-upload mr-1"></i> Upload dokumen</button></div>
          </div>
          <div class="progress mt-3 d-none" id="uploadProgress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width:0%">0%</div></div>
          <div id="documentList" class="row mt-3"><div class="col-12 text-muted">Belum ada dokumen.</div></div>
        </div>
      </div>

      <div class="card bg-light">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
          <div><span class="text-muted">Total estimasi</span><h3 id="grandTotal" class="mb-0 text-primary">Rp 0</h3></div>
          <div class="mt-2 mt-md-0">
            <button type="button" id="saveDraft" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Draft</button>
            <button type="button" id="submitRequest" class="btn btn-success" <?= $requestCode ? '' : 'disabled' ?>><i class="fas fa-paper-plane mr-1"></i> Ajukan Request</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/template" id="scopeRowTemplate">
  <tr class="scope-row"><td><input class="form-control form-control-sm line-name" maxlength="180" placeholder="Contoh: Instalasi AC"></td><td><textarea class="form-control form-control-sm line-description" rows="1" maxlength="5000" placeholder="Uraikan pekerjaan"></textarea></td><td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-qty" placeholder="0"></td><td><input class="form-control form-control-sm line-unit" maxlength="40" placeholder="Unit"></td><td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-price" placeholder="0"></td><td class="line-subtotal text-right align-middle">Rp 0</td><td class="text-center align-middle"><button type="button" class="btn btn-xs btn-outline-danger remove-line" title="Hapus baris"><i class="fas fa-times"></i></button></td></tr>
</script>
<script type="text/template" id="materialRowTemplate">
  <tr class="material-row"><td><input class="form-control form-control-sm line-name" maxlength="180" placeholder="Contoh: Kabel NYM"></td><td><textarea class="form-control form-control-sm line-description" rows="1" maxlength="5000" placeholder="Spesifikasi alat/bahan"></textarea></td><td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-qty" placeholder="0"></td><td><input class="form-control form-control-sm line-unit" maxlength="40" placeholder="Meter"></td><td><input type="number" min="0" step="0.01" class="form-control form-control-sm line-price" placeholder="0"></td><td class="line-subtotal text-right align-middle">Rp 0</td><td class="text-center align-middle"><button type="button" class="btn btn-xs btn-outline-danger remove-line" title="Hapus baris"><i class="fas fa-times"></i></button></td></tr>
</script>
