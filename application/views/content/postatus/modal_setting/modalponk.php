<?php foreach ($status as $s) : ?>
    <div class="modal fade" id="addmodalbarang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Item Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('add_faktur_item_nk'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="" /></div>
                            <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $s->kd_po_nk ?>" readonly hidden />
                            <input class="form-control" type="text" id="kdbrponk" name="kdbrponk" value="<?= $kdbarang ?>" readonly hidden />
                            <input class="form-control" type="text" id="tgltr" name="tgltr" value="<?= date('Y-m-d') ?>" readonly hidden />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi / Spesifikasi<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea name="desc_isi" id="desc_isi" class="form-control"></textarea></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Keterangan<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea name="ket_isi" id="ket_isi" class="form-control"></textarea></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Qty<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" id="qty_isi" name="qty_isi" value="" step="0.000000000001" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Harga Satuan<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" id="hrg_isi" name="hrg_isi" value="" step="0.000000000001" /></div>
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
<div class="modal fade" id="addtax">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Tax</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('add_tax_nk'); ?>
                <div class="form-group">
                    <div class="row">
                        <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $s->kd_po_nk ?>" readonly hidden />
                        <input class="form-control" type="text" id="kdbrponk" name="kdbrponk" value="<?= $kdbarang ?>" readonly hidden />
                        <input class="form-control" type="text" id="tgltr" name="tgltr" value="<?= date('Y-m-d') ?>" readonly hidden />
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Pilih Satuan Pajak<span class="required">*</span></label>
                        <div class="col-sm-8">
                            <select name="tax_isi" id="tax_isi" class="form-control">
                                <option value="" class="form-control">Pilih Tax</option>
                                <?php foreach ($tax as $t) : ?>
                                    <option value="<?= $t->nm_tax ?>"><?= $t->nm_tax ?> %</option>
                                <?php endforeach; ?>
                            </select>
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
<div class="modal fade" id="adddiskon">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Diskon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('add_diskon_nk'); ?>
                <div class="form-group">
                    <div class="row">
                        <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $s->kd_po_nk ?>" readonly hidden />
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi Diskon<span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="desc_isi" id="desc_isi" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Nominal Diskon<span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="number" name="nominal_isi" id="nominal_isi" class="form-control">
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
<?php foreach ($detail as $s) : ?>
    <div class="modal fade" id="edititem<?= $s->id_det_po_nk ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('edit_faktur_item_nk'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="<?= $s->nama_barang ?>" /></div>
                            <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $s->kd_po_nk ?>" readonly hidden />
                            <input class="form-control" type="text" id="idisi" name="idisi" value="<?= $s->id_det_po_nk ?>" readonly hidden />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi / Spesifikasi<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea name="desc_isi" id="desc_isi" class="form-control"><?= $s->deskripsi ?></textarea></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Keterangan<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea name="ket_isi" id="ket_isi" class="form-control"><?= $s->keterangan ?></textarea></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Qty<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" id="qty_isi" name="qty_isi" value="<?= $s->qty ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Harga Satuan<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="number" id="hrg_isi" name="hrg_isi" value="<?= $s->hrg_satuan ?>" /></div>
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

<?php foreach ($status as $s) : ?>
    <div class="modal fade" id="modalAddNote">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update PO non komersil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('noteupdatenk'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-2 control-label text-right" for="kd_user">Kd<span class="required">*</span></label>
                            <div class="col-sm-9"><input type="text" id="kdpo" name="kdpo" value="<?= $s->kd_po_nk ?>" readonly></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2 control-label text-right" for="kd_user">Catatan<span class="required">*</span></label>
                            <div class="col-sm-9"><textarea class="form-control" type="text" id="noteDitektur" name="noteDitektur" value=""> </textarea></div>
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

<?php foreach ($detail as $s) : ?>
    <div class="modal fade" id="hapusitem<?= $s->id_det_po_nk ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('hapus_faktur_item_nk'); ?>
                    <div class="form-group">
                        <div class="row">
                            <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $s->kd_po_nk ?>" readonly hidden />
                            <input class="form-control" type="text" id="idisi" name="idisi" value="<?= $s->id_det_po_nk ?>" readonly hidden />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <h3>item akan terhapus secara permanen !</h3>
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

<?php foreach ($status as $s) : ?>
    <div class="modal fade" id="edponk<?= $s->kd_po_nk ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Item Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('editedponk'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="" /></div>
                            <input class="form-control" type="text" id="kdponk" name="kdponk" value="<?= $s->kd_po_nk ?>" readonly hidden />
                            <input class="form-control" type="text" id="kdbrponk" name="kdbrponk" value="<?= $kdbarang ?>" readonly hidden />
                            <input class="form-control" type="text" id="tgltr" name="tgltr" value="<?= date('Y-m-d') ?>" readonly hidden />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Pengaju<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="nm_pengaju" name="nm_pengaju" value="<?= $s->nm_user ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Departemen<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="dep_isi" name="dep_isi" value="<?= $s->departemen ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Tujuan Pembelian<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <textarea name="tj_pem" id="tj_pem" cols="30" rows="10" class="form-control"><?= $s->tj_pembelian ?></textarea>
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