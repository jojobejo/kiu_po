<!-- MODAL ADD -->
<div class="modal fade" id="modalAddItem">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('addBarangSuplier'); ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Kode Barang<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="kd_isi" name="kd_isi" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="isi">Isi<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="number" step="any" id="isi" name="isi" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kemasan">Kemasan<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="number" step="any" id="kemasan" name="kemasan" value="" /></div>
                    </div>
                </div>
                <?php foreach ($kode_suplier as $s) ?>
                <div class="form-group" hidden>
                    <div class="row">
                        <label for="kd_suplier" class="col-sm-3 control-label text-right">Kode Suplier <span class="required" *></span></label>
                        <div class="col-sm-8"><input type="text" class="form-control" id="kd_sup_isi" name="kd_sup_isi" value="<?= $s->kd_suplier ?>" readonly></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php foreach ($barang as $i) : ?>
    <div class="modal fade" id="modal_edit<?= $i->id_barang ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('editbarangsuplier'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Kode Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_isi" name="kd_isi" value="<?= $i->kode_barang ?>" /></div>
                            <div class="col-sm-8" hidden><input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $i->id_barang ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="<?= $i->nama_barang ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="isi<?= $i->id_barang ?>">Isi<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" step="any" id="isi<?= $i->id_barang ?>" name="isi" value="<?= isset($i->isi) ? $i->isi : '' ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kemasan<?= $i->id_barang ?>">Kemasan<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" step="any" id="kemasan<?= $i->id_barang ?>" name="kemasan" value="<?= isset($i->kemasan) ? $i->kemasan : '' ?>" /></div>
                        </div>
                    </div>
                    <?php foreach ($kode_suplier as $s) ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label for="kd_suplier" class="col-sm-3 control-label text-right">Kode Suplier <span class="required" *></span></label>
                            <div class="col-sm-8"><input type="text" class="form-control" id="kd_sup_isi" name="kd_sup_isi" value="<?= $s->kd_suplier ?>" readonly></div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<!-- MODAL ADD -->
<?php foreach ($tmp as $t) : ?>
    <div class="modal fade" id="modalEdit<?= $t->id_tmp ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Item Chart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('edit_barang_tmp', array('class' => 'ppn-price-form', 'data-ppn-rate' => '11')); ?>
                    <input type="hidden" name="is_bonus" value="<?= isset($t->is_bonus) ? (int) $t->is_bonus : 0 ?>">
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">idbarang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $t->id_tmp ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Kode Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_isi" name="kd_isi" value="<?= $t->kode_barang ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="<?= $t->nama_barang ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label for="kd_suplier" class="col-sm-3 control-label text-right">Kode Suplier <span class="required" *></span></label>
                            <div class="col-sm-8"><input type="text" class="form-control" id="kd_sup_isi" name="kd_sup_isi" value="<?= $t->kode_suplier ?>" readonly></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select name="satuan_isi" id="satuan_isi" class="form-control">
                                    <option value="">-- QTY --</option>
                                    <?php foreach ($satuan as $s) : ?>
                                        <option value="<?= $s->nm_satuan ?>" <?= $s->nm_satuan == $t->satuan ? 'selected' : '' ?>> <?= $s->nm_satuan ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Qty<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control number-format" type="text" inputmode="decimal" value="<?= rtrim(rtrim(number_format((float) $t->qty, 12, ',', '.'), '0'), ',') ?>" autocomplete="off" />
                                <input type="hidden" name="qty_isi" class="number-raw" value="<?= $t->qty ?>" />
                            </div>
                        </div>
                    </div>
                    <?php if (isset($t->is_bonus) && (int) $t->is_bonus === 1) : ?>
                        <input type="hidden" name="hrg_isi" value="0">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Keterangan Bonus<span class="required">*</span></label>
                                <div class="col-sm-8"><textarea class="form-control" name="bonus_keterangan" rows="3"><?= isset($t->keterangan_bonus) ? $t->keterangan_bonus : '' ?></textarea></div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="edit_harga_satuan_<?= $t->id_tmp ?>">Harga Satuan<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <input class="form-control number-format ppn-price-input" type="text" inputmode="decimal" id="edit_harga_satuan_<?= $t->id_tmp ?>" value="<?= rtrim(rtrim(number_format((float) $t->harga_satuan, 12, ',', '.'), '0'), ',') ?>" autocomplete="off" />
                                    <input type="hidden" name="hrg_isi" class="number-raw ppn-price-raw" value="<?= $t->harga_satuan ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right">Harga PPN<span class="required">*</span></label>
                                <div class="col-sm-8 pt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="edit_ppn_exclude_<?= $t->id_tmp ?>" name="ppn_mode" value="exclude" class="custom-control-input" checked>
                                        <label class="custom-control-label" for="edit_ppn_exclude_<?= $t->id_tmp ?>">Exclude PPN</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="edit_ppn_include_<?= $t->id_tmp ?>" name="ppn_mode" value="include" class="custom-control-input">
                                        <label class="custom-control-label" for="edit_ppn_include_<?= $t->id_tmp ?>">Include PPN</label>
                                    </div>
                                    <small class="form-text text-muted">Exclude PPN dihitung menggunakan PPN 11%; Include PPN tidak dihitung ulang.</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="edit_harga_hasil_ppn_<?= $t->id_tmp ?>">Harga Satuan Hasil Kalkulasi</label>
                                <div class="col-sm-8">
                                    <input class="form-control ppn-calculated-display" type="text" id="edit_harga_hasil_ppn_<?= $t->id_tmp ?>" value="<?= rtrim(rtrim(number_format((float) $t->harga_satuan, 4, ',', '.'), '0'), ',') ?>" readonly />
                                    <input type="hidden" name="hrg_hasil_ppn" class="ppn-calculated-raw" value="<?= $t->harga_satuan ?>" />
                                    <small class="form-text text-muted">Nilai harga setelah perhitungan PPN yang digunakan untuk penyimpanan.</small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>

<script>
    (function() {
        function normalizeNumberInput(value) {
            var parts = value.replace(/[^\d,]/g, '').split(',');
            var integerPart = parts[0].replace(/[^\d]/g, '');
            var decimalPart = parts.length > 1 ? parts.slice(1).join('').replace(/[^\d]/g, '') : '';
            var formattedInteger = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            return {
                display: decimalPart !== '' ? formattedInteger + ',' + decimalPart : formattedInteger,
                raw: decimalPart !== '' ? integerPart + '.' + decimalPart : integerPart
            };
        }

        function formatCalculatedPrice(value) {
            if (!isFinite(value)) {
                return '';
            }

            return value.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 4
            });
        }

        function updateCalculatedPrice(form) {
            if (!form || !form.classList.contains('ppn-price-form')) {
                return;
            }

            var rawInput = form.querySelector('.ppn-price-raw');
            var displayOutput = form.querySelector('.ppn-calculated-display');
            var rawOutput = form.querySelector('.ppn-calculated-raw');
            var selectedMode = form.querySelector('input[name="ppn_mode"]:checked');

            if (!rawInput || !displayOutput || !rawOutput || !selectedMode || rawInput.value === '') {
                return;
            }

            var inputPrice = parseFloat(rawInput.value);
            var ppnRate = parseFloat(form.getAttribute('data-ppn-rate')) || 0;
            var calculatedPrice = selectedMode.value === 'exclude'
                ? inputPrice / (1 + (ppnRate / 100))
                : inputPrice;

            displayOutput.value = formatCalculatedPrice(calculatedPrice);
            rawOutput.value = calculatedPrice;
        }

        document.addEventListener('input', function(event) {
            if (!event.target.classList.contains('number-format')) {
                return;
            }

            var normalized = normalizeNumberInput(event.target.value);
            var rawInput = event.target.parentNode.querySelector('.number-raw');

            event.target.value = normalized.display;

            if (rawInput) {
                rawInput.value = normalized.raw;
            }

            if (event.target.classList.contains('ppn-price-input')) {
                updateCalculatedPrice(event.target.closest('form'));
            }
        });

        document.addEventListener('change', function(event) {
            if (event.target.name === 'ppn_mode') {
                updateCalculatedPrice(event.target.closest('form'));
            }
        });

        document.addEventListener('submit', function(event) {
            event.target.querySelectorAll('.number-format').forEach(function(input) {
                var normalized = normalizeNumberInput(input.value);
                var rawInput = input.parentNode.querySelector('.number-raw');

                if (rawInput) {
                    rawInput.value = normalized.raw;
                }
            });

            updateCalculatedPrice(event.target);
        });
    })();
</script>

<?php foreach ($barang as $i) : ?>
    <div class="modal fade" id="hapus<?= $i->id_barang ?>">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa fa-remove" style="margin-top: 1px;"></i>
                    </div>
                    <h4 class="modal-title w-100">Hapus Barang </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apa kamu yakin akan menghapus <?= $i->nama_barang ?></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger"><a style="text-decoration: none; color:white;" href="<?php echo base_url("hapusBarang/$i->id_barang/$i->kd_suplier") ?>">Hapus</a></button>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($tmp as $t) : ?>
    <div class="modal fade" id="hapusChart<?= $t->id_tmp ?>">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa fa-remove" style="margin-top: 1px;"></i>
                    </div>
                    <h4 class="modal-title w-100">Hapus Chart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>apakah anda akan menghapus data PO <?= $t->nama_barang ?></p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger"><a style="text-decoration: none; color:white;" href="<?php echo base_url("hapusChart/$t->id_tmp/$t->kode_suplier") ?>">Hapus</a></button>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
    </div>
<?php endforeach; ?>
