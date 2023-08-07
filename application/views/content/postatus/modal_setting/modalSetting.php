    <?php foreach ($status as $s) : ?>
        <div class="modal fade" id="modalPembayaran<?= $s->kd_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tempo Pembayaran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('tempoPembayaran'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $s->kd_po ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Tempo Pembayaran<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="number" id="tempo_isi" name="tempo_isi" value="" /></div>
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
        <div class="modal fade" id="modalPengiriman<?= $s->kd_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Gudang Pengiriman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('frankoPengiriman'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $s->kd_po ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Gudang Pengiriman<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="gdg_isi" name="gdg_isi" value="" /></div>
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
        <div class="modal fade" id="modalDiskon<?= $s->kd_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Diskon</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('addDiskon'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $s->kd_po ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Keterangan Diskon<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="keterangan_isi" name="keterangan_isi" value="" /></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Nominal<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="number" id="nominal_isi" name="nominal_isi" value="" /></div>
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
        <div class="modal fade" id="modalTax<?= $s->kd_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Tax (Pajak)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('tambahTax'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $s->kd_po ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Total Harga<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <?php foreach ($total as $t) : ?>
                                        <input class="form-control" type="number" id="total_harga" name="total_harga" value="<?= $t->total_harga ?>" />
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Tax(%)<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <select name="tax_isi_status" id="tax_isi_status" class="form-control">
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
    <?php endforeach; ?>

    <?php foreach ($diskon as $d) : ?>
        <div class="modal fade" id="modalDiskonEdit<?= $d->id_diskon ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Diskon</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('diskonEdit'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="id_diskon" name="id_diskon" value="<?= $d->id_diskon ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">kdpo<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $d->kd_po ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Keterangan Diskon<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="Text" id="keterangan_isi" name="keterangan_isi" value="<?= $d->keterangan ?>" /></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Nominal<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="number" id="nominal_isi" name="nominal_isi" value="<?= $d->nominal ?>" /></div>
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
        <div class="modal fade" id="modalnotebarang<?= $s->kd_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Note Barang Suplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('note_barang_suplier'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $s->kd_po ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Isi Note<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="isi_note" name="isi_note" value="" /></div>
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

    <?php foreach ($notebarang as $n) : ?>
        <div class="modal fade" id="modalnotebarangedit<?= $n->id_nt_barang ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Edit Note Barang Suplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('note_barang_suplier_edit'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $n->kd_po ?>" readonly />
                                    <input class="form-control" type="text" id="idnote" name="idnote" value="<?= $n->id_nt_barang ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2" for="kd_user">Isi Note<span class="required">*</span></label>
                                <div class="col-sm-9"><input class="form-control" type="text" id="isi_note" name="isi_note" value="<?= $n->isi_note ?>" /></div>
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
    <?php foreach ($notebarang as $n) : ?>
        <div class="modal fade" id="modalnotebaranghapus<?= $n->id_nt_barang ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Note Barang Suplier</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('note_barang_suplier_hapus'); ?>
                        <div class="form-group" hidden>
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                                <div class="col-sm-8"><input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $n->kd_po ?>" readonly />
                                    <input class="form-control" type="text" id="idnote" name="idnote" value="<?= $n->id_nt_barang ?>" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <h4>Note akan terhapus secara permanen !!!</h4>
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