<!-- MODAL ADD -->
<?php foreach ($kode_suplier as $b) : ?>
    <div class="modal fade" id="editSuplier<?= $b->id_suplier ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('editSuplier'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $b->kd_suplier ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="<?= $b->nama_suplier ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Alamat Suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="alamat_isi" name="alamat_isi" value="<?= $b->alamat_suplier ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nomor Telfon Suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="telp_isi" name="telp_isi" value="<?= $b->no_telpon ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nomor Fax Suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="fax_isi" name="fax_isi" value="<?= $b->no_fax ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Email Suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="email_isi" name="email_isi" value="<?= $b->email ?>" /></div>
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

<div class="modal fade" id="modalnotebarang">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Note Suplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('addnotebarangsupliertmp'); ?>
                <div class="form-group" hidden>
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $kdsuplier ?>" readonly /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi Note<span class="required">*</span></label>
                        <div class="col-sm-8">
                            <textarea name="isi" id="isi" cols="30" rows="10" class="form-control"></textarea>
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

<div class="modal fade" id="modaldiskon">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Diskon</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('add_diskon_po'); ?>
                <div class="form-group" hidden>
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $kdsuplier ?>" readonly /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi Diskon<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="deskripsi_isi" name="deskripsi_isi" value="" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Nominal Diskon<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="nominal_isi" name="nominal_isi" value="" /></div>
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

<?php foreach ($tmpdiskon as $td) : ?>
    <div class="modal fade" id="editdiskon<?= $td->id_tmp_diskon ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Diskon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('edit_diskon_po'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $kdsuplier ?>" readonly /></div>
                            <div class="col-sm-8"><input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $td->id_tmp_diskon ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi Diskon<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="deskripsi_isi" name="deskripsi_isi" value="<?= $td->nama_diskon ?>" /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nominal Diskon<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="nominal_isi" name="nominal_isi" value="<?= $td->nominal ?>" /></div>
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

    <div class="modal fade" id="hapusdiskon<?= $td->id_tmp_diskon ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Diskon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('hapus_diskon_po'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $kdsuplier ?>" readonly /></div>
                            <div class="col-sm-8"><input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $td->id_tmp_diskon ?>" readonly /></div>
                        </div>
                    </div>
                    <h3>Data akan terhapus secara permanen !!</h3>
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
<?php foreach ($tmpnote as $tn) : ?>
    <div class="modal fade" id="editnote<?= $tn->id_nt_tmp_barang ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Note Suplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('edit_note_tmp_barang'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $kdsuplier ?>" readonly /></div>
                            <div class="col-sm-8"><input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $tn->id_nt_tmp_barang ?>" readonly /></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi Note<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea name="isi" id="isi" cols="30" rows="10" class="form-control"><?= $tn->isi_note ?></textarea>
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
    <div class="modal fade" id="hapusnote<?= $tn->id_nt_tmp_barang ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Note Suplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('hapus_note_tmp_barang'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">kode_suplier<span class="required">*</span></label>
                            <div class="col-sm-8"><input class="form-control" type="text" id="kd_sup" name="kd_sup" value="<?= $kdsuplier ?>" readonly /></div>
                            <div class="col-sm-8"><input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $tn->id_nt_tmp_barang ?>" readonly /></div>
                        </div>
                    </div>
                    <h3>Data akan terhapus secara permanen !!</h3>
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
<?php foreach ($tmp as $d) : ?>
    <div class="modal fade" id="diskonbarang<?= $d->id_tmp ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Diskon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('add_diskon_barang_tmp'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-2" for="kd_user">Persentase Diskon<span class="required">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="number" id="disc_isi" name="disc_isi" value="" step=".01" />
                                <input class="form-control" type="text" id="tot_harga" name="tot_harga" value="<?= $d->total_harga ?>" readonly hidden />
                                <input class="form-control" type="text" id="kdsup" name="kdsup" value="<?= $d->kode_suplier ?>" readonly hidden />
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

<?php foreach ($tmp as $d) : ?>
    <div class="modal fade" id="diskonbarangs<?= $d->id_tmp ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Diskon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('add_diskon_barangs_tmp'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3" for="kd_user">Deskripsi Diskon<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="desc_isi" name="desc_isi" value="" />
                                <input class="form-control" type="text" id="kdsup" name="kdsup" value="<?= $d->kode_suplier ?>" readonly hidden />
                                <input class="form-control" type="text" id="nmbarang" name="nmbarang" value="<?= $d->nama_barang ?>" readonly hidden />
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3" for="kd_user">Nominal Diskon<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="number" id="disc_isi" name="disc_isi" value="" />
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
<?php foreach ($taxpo as $tp) : ?>
    <div class="modal fade" id="taxsett<?= $tp->kd_suplier ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Setting Tax</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('update_tax_tmp'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3" for="kd_user">Tax (%)<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" id="kd_suplier_isi" name="kd_suplier_isi" value="<?= $kdsuplier ?>" hidden>
                                <select name="tax_isi_status" id="tax_isi_status" class="form-control">
                                    <option value="<?= $tp->tax ?>"><?= $tp->tax ?> %</option>
                                    <?php foreach ($taxx as $t) : ?>
                                        <option value="<?= $t->nm_tax ?>"><?= $t->nm_tax ?>%</option>
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

<div class="modal fade" id="taxsetts">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setting Tax</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('add_tax_tmp'); ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3" for="kd_user">Tax (%)<span class="required">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" id="kd_suplier_isi" name="kd_suplier_isi" value="<?= $kdsuplier ?>" hidden>
                            <select name="tax_isi_status" id="tax_isi_status" class="form-control">
                                <?php foreach ($taxx as $t) : ?>
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