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
                                <div class="col-sm-8"><input class="form-control" type="number" id="nominal_isi" name="nominal_isi" value="" step="0.000000000001" /></div>
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
                                <div class="col-sm-8"><input class="form-control" type="number" id="nominal_isi" name="nominal_isi" value="<?= $d->nominal ?>" step="0.000000000001" /></div>
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
                                <div class="col-sm-8">
                                    <textarea name="isi_note" id="isi_note" cols="30" rows="10" class="form-control"></textarea>
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
                                <label class="col-sm-3" for="kd_user">Isi Note<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <textarea name="isi_note" id="isi_note" cols="30" rows="10" class="form-control"><?= $n->isi_note ?></textarea>
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

    <?php foreach ($detail as $d) : ?>
        <div class="modal fade" id="diskonbarang<?= $d->id_det_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Diskon</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('add_diskon_barang'); ?>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3" for="kd_user">Persentase Diskon<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="number" id="disc_isi" name="disc_isi" value="" />
                                    <input class="form-control" type="text" id="tot_harga" name="tot_harga" value="<?= $d->hrg_total ?>" readonly hidden />
                                    <input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $d->kd_po ?>" readonly hidden />
                                    <input class="form-control" type="text" id="kdsup" name="kdsup" value="<?= $d->kd_suplier ?>" readonly hidden />
                                    <input class="form-control" type="text" id="nmbarang" name="nmbarang" value="<?= $d->nama_barang ?>" readonly hidden />
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

    <?php foreach ($detail as $d) : ?>
        <div class="modal fade" id="diskonbarangs<?= $d->id_det_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Diskon</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('add_diskon_barangs'); ?>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3" for="kd_user">Deskripsi Diskon<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="desc_isi" name="desc_isi" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3" for="kd_user">Nominal<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="number" id="disc_isi" name="disc_isi" value="" step="0.000000000001" />
                                    <input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $d->kd_po ?>" readonly hidden />
                                    <input class="form-control" type="text" id="kdsup" name="kdsup" value="<?= $d->kd_suplier ?>" readonly hidden />
                                    <input class="form-control" type="text" id="nmbarang" name="nmbarang" value="<?= $d->nama_barang ?>" readonly hidden />
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

    <?php foreach ($status as $s) : ?>
        <div class="modal fade" id="modalshipment<?= $s->kd_po ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Print Note Setting Format</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('update_printout_po'); ?>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label text-right" for="kd_user">Pilih Format Printout<span class="required">*</span></label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" id="kdpo" name="kdpo" value="<?= $s->kd_po ?>" readonly hidden />
                                    <select name="frmt_option" id="frmt_option" class="form-control">
                                        <option value="-">-- Pilih Format Note --</option>
                                        <?php foreach ($ntformat as $nf) :
                                            $selected = $s->kd_printout_note != '' ? 'selected' : '';
                                        ?>
                                            <option value="<?= $nf->kd_nt_template ?>" <?= $selected ?>><?= $nf->nama_note ?></option>
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