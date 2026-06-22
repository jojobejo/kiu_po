<!-- MODAL ADD -->
<?php foreach ($barang as $i) : ?>
    <div class="modal fade" id="modalAddItem<?= $i->id_barang ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('tambahChart', array('class' => 'ppn-price-form', 'data-ppn-rate' => '11')); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $i->kd_suplier ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_isi" name="kd_isi" value="<?= $i->kode_barang ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="<?= $i->nama_barang ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select name="satuan_isi" id="satuan_isi" class="form-control">
                                    <option value="-">--PILIH SATUAN--</option>
                                    <?php foreach ($satuan as $s) : ?>
                                        <option value="<?= $s->nm_satuan ?>"> <?= $s->nm_satuan ?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Qty<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control number-format" type="text" inputmode="decimal" value="" autocomplete="off" />
                                <input type="hidden" name="qty_isi" class="number-raw" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="harga_satuan_<?= $i->id_barang ?>">Harga Satuan<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control number-format ppn-price-input" type="text" inputmode="decimal" id="harga_satuan_<?= $i->id_barang ?>" value="" autocomplete="off" />
                                <input type="hidden" name="hrg_isi" class="number-raw ppn-price-raw" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right">Harga PPN<span class="required">*</span></label>
                            <div class="col-sm-8 pt-2">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="ppn_exclude_<?= $i->id_barang ?>" name="ppn_mode" value="exclude" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="ppn_exclude_<?= $i->id_barang ?>">Exclude PPN</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="ppn_include_<?= $i->id_barang ?>" name="ppn_mode" value="include" class="custom-control-input">
                                    <label class="custom-control-label" for="ppn_include_<?= $i->id_barang ?>">Include PPN</label>
                                </div>
                                <small class="form-text text-muted">Exclude PPN dihitung menggunakan PPN 11%; Include PPN tidak dihitung ulang.</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="harga_hasil_ppn_<?= $i->id_barang ?>">Harga Satuan Hasil Kalkulasi</label>
                            <div class="col-sm-8">
                                <input class="form-control ppn-calculated-display" type="text" id="harga_hasil_ppn_<?= $i->id_barang ?>" value="" readonly />
                                <input type="hidden" name="hrg_hasil_ppn" class="ppn-calculated-raw" value="" />
                                <small class="form-text text-muted">Nilai harga setelah perhitungan PPN yang digunakan untuk penyimpanan.</small>
                            </div>
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
                if (displayOutput) {
                    displayOutput.value = '';
                }
                if (rawOutput) {
                    rawOutput.value = '';
                }
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
    <div class="modal fade" id="modalAddBonus<?= $i->id_barang ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Barang Bonus</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('tambahChart'); ?>
                    <input type="hidden" name="is_bonus" value="1">
                    <input type="hidden" name="hrg_isi" value="0">
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="kd_sup" value="<?= $i->kd_suplier ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="kd_isi" value="<?= $i->kode_barang ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" name="nama_isi" value="<?= $i->nama_barang ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select name="satuan_isi" class="form-control">
                                    <option value="-">--PILIH SATUAN--</option>
                                    <?php foreach ($satuan as $s) : ?>
                                        <option value="<?= $s->nm_satuan ?>"> <?= $s->nm_satuan ?></option>
                                    <?php endforeach;  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Qty<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control number-format" type="text" inputmode="decimal" value="" autocomplete="off" />
                                <input type="hidden" name="qty_isi" class="number-raw" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-none">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Harga Satuan<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" value="0" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Keterangan Bonus<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea class="form-control" name="bonus_keterangan" rows="3"></textarea></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
