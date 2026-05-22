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
                    <?php echo form_open_multipart('tambahBarangRevisi'); ?>
                    <div class="form-group" hidden>
                        <?php foreach ($status as $s) : ?>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kd_po" name="kd_po" value="<?= $s->kd_po ?>" readonly /></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group" hidden>
                        <?php foreach ($status as $s) : ?>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="tgl_transaksi" name="tgl_transaksi" value="<?= $s->tgl_transaksi ?>" readonly /></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group" hidden>
                        <?php foreach ($status as $s) : ?>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="no_po" name="no_po" value="<?= $s->no_po ?>" readonly /></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
                            <div class="col-sm-8"><input class="form-control" type="number" id="qty_isi" name="qty_isi" value="" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Harga Satuan<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" id="hrg_isi" name="hrg_isi" value="" /></div>
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
                    <?php echo form_open_multipart('tambahBarangRevisi'); ?>
                    <input type="hidden" name="is_bonus" value="1">
                    <input type="hidden" name="hrg_isi" value="0">
                    <div class="form-group" hidden>
                        <?php foreach ($status as $s) : ?>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" name="kd_po" value="<?= $s->kd_po ?>" readonly /></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group" hidden>
                        <?php foreach ($status as $s) : ?>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">tgl_transaksi<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" name="tgl_transaksi" value="<?= $s->tgl_transaksi ?>" readonly /></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group" hidden>
                        <?php foreach ($status as $s) : ?>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">no_po<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" name="no_po" value="<?= $s->no_po ?>" readonly /></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
                            <div class="col-sm-8"><input class="form-control" type="number" name="qty_isi" value="" /></div>
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
