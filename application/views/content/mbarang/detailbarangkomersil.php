<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">
                <div class="col-sm-8">
                    <h1 class="m-0">Detail Barang Komersil</h1>
                </div>
                <div class="col-sm-4 text-sm-right mt-2 mt-sm-0">
                    <a href="<?= base_url('masterbarangkomersil') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <div id="detail_barang_komersil" data-id="<?= htmlspecialchars((string)$barang->id_barang, ENT_QUOTES, 'UTF-8') ?>" data-get-url="<?= base_url('masterbarangkomersil/get/') ?>" data-save-url="<?= base_url('masterbarangkomersil/save') ?>" data-delete-url="<?= base_url('masterbarangkomersil/delete') ?>" data-list-url="<?= base_url('masterbarangkomersil') ?>">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-dark">
                                <h3 class="card-title">Data Barang</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Kode Barang</dt>
                                            <dd data-field="kode_barang"><?= htmlspecialchars((string)$barang->kode_barang, ENT_QUOTES, 'UTF-8') ?></dd>
                                            <dt>Nama Barang</dt>
                                            <dd data-field="nama_barang"><?= htmlspecialchars((string)$barang->nama_barang, ENT_QUOTES, 'UTF-8') ?></dd>
                                            <dt>Bahan Aktif</dt>
                                            <dd data-field="bahan_aktif"><?= htmlspecialchars((string)$barang->bahan_aktif, ENT_QUOTES, 'UTF-8') ?></dd>
                                            <dt>Satuan</dt>
                                            <dd data-field="nm_satuan"><?= htmlspecialchars((string)$barang->nm_satuan, ENT_QUOTES, 'UTF-8') ?></dd>
                                            <dt>Merk</dt>
                                            <dd data-field="merk_barang"><?= htmlspecialchars((string)$barang->merk_barang, ENT_QUOTES, 'UTF-8') ?></dd>
                                        </dl>
                                    </div>
                                    <div class="col-md-6">
                                        <dl>
                                            <dt>Stock Minimum</dt>
                                            <dd data-field="stock_minimum"><?= htmlspecialchars((string)$barang->stock_minimum, ENT_QUOTES, 'UTF-8') ?></dd>
                                            <dt>Dimensi</dt>
                                            <dd><span data-field="panjang"><?= htmlspecialchars((string)$barang->panjang, ENT_QUOTES, 'UTF-8') ?></span> x <span data-field="lebar"><?= htmlspecialchars((string)$barang->lebar, ENT_QUOTES, 'UTF-8') ?></span> x <span data-field="tinggi"><?= htmlspecialchars((string)$barang->tinggi, ENT_QUOTES, 'UTF-8') ?></span></dd>
                                            <dt>Berat</dt>
                                            <dd data-field="berat"><?= htmlspecialchars((string)$barang->berat, ENT_QUOTES, 'UTF-8') ?></dd>
                                            <dt>Isi / Kemasan</dt>
                                            <dd><span data-field="isi"><?= htmlspecialchars((string)$barang->isi, ENT_QUOTES, 'UTF-8') ?></span> / <span data-field="kemasan"><?= htmlspecialchars((string)$barang->kemasan, ENT_QUOTES, 'UTF-8') ?></span></dd>
                                            <dt>Status</dt>
                                            <dd data-field="is_active_label"><?= $barang->is_active === 'F' ? 'Nonaktif' : 'Aktif' ?></dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <dt>Kelompok</dt>
                                        <dd data-field="kelompok_barang"><?= htmlspecialchars((string)$barang->kelompok_barang, ENT_QUOTES, 'UTF-8') ?></dd>
                                    </div>
                                    <div class="col-md-4">
                                        <dt>Kategori</dt>
                                        <dd data-field="kategori_barang"><?= htmlspecialchars((string)$barang->kategori_barang, ENT_QUOTES, 'UTF-8') ?></dd>
                                    </div>
                                    <div class="col-md-4">
                                        <dt>Produk Fokus</dt>
                                        <dd data-field="produk_fokus"><?= htmlspecialchars((string)$barang->produk_fokus, ENT_QUOTES, 'UTF-8') ?></dd>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-warning" id="btn_edit_detail_komersil">
                                    <i class="fas fa-pencil-alt"></i> Edit Data
                                </button>
                                <button type="button" class="btn btn-danger" id="btn_delete_detail_komersil">
                                    <i class="fas fa-trash-alt"></i> Hapus Data
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h3 class="card-title">Data Supplier</h3>
                            </div>
                            <div class="card-body">
                                <dl class="mb-0">
                                    <dt>Kode Supplier</dt>
                                    <dd data-field="kd_suplier"><?= htmlspecialchars((string)$barang->kd_suplier, ENT_QUOTES, 'UTF-8') ?></dd>
                                    <dt>Nama Supplier</dt>
                                    <dd data-field="nama_suplier"><?= htmlspecialchars((string)$barang->nama_suplier, ENT_QUOTES, 'UTF-8') ?></dd>
                                </dl>
                            </div>
                        </div>

                        <select id="detail_satuan_options" class="d-none">
                            <?php foreach ($satuan as $sat) : ?>
                                <option value="<?= htmlspecialchars($sat->nm_satuan, ENT_QUOTES, 'UTF-8') ?>" <?= $sat->nm_satuan == $barang->nm_satuan ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($sat->nm_satuan, ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
