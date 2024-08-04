<?php foreach ($barangnk as $brnk) : ?>

    <!-- MODAL ADD -->
    <div class="modal fade" id="addmbarangnk">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Master Barang Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('add_mbarang'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Kode Barang<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="kd_isi" name="kd_isi" value="<?= $kdbarang ?>" hidden />
                                <input class="form-control" type="text" id="qrc_isi" name="qrc_isi" value="<?= $kdqrcode ?>" hidden />
                                <input class="form-control" type="text" id="kd_adm" name="kd_adm" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Kategori Barang<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select name="skatbr" id="skatbr" class="form-control">
                                    <option value="0">Pilih kategori barang</option>
                                    <?php foreach ($katbarang as $k) : ?>
                                        <option id="skatbrpil" name="skatbrpil" value="<?= $k->kd_kat ?>"><?= $k->nama_kategori ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="nmbarang" name="nmbarang" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea name="descisi" id="descisi" class="form-control"></textarea></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select name="stuanbr" id="stuanbr" class="form-control">
                                    <?php foreach ($satuan as $s) : ?>
                                        <option id="stuanbrpil" name="stuanbrpil" value="<?= $s->id_satuan ?>"><?= $s->nm_satuan ?></option>
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

    <!-- MODAL EDIT -->
    <div class="modal fade" id="editbarang<?= $brnk->id_brg_nk ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('edit_mbarangnk'); ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Kode Barang<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $brnk->id_brg_nk ?>" hidden />
                                <input class="form-control" type="text" id="kd_adm" name="kd_adm" value="<?= $brnk->kd_br_adm ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Kategori Barang<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select name="skatbr" id="skatbr" class="form-control">
                                    <option value="<?= $brnk->kat_barang ?>"><?= $brnk->nama_kategori ?></option>
                                    <?php foreach ($katbarang as $k) : ?>
                                        <option id="skatbrpil" name="skatbrpil" value="<?= $k->kd_kat ?>"><?= $k->nama_kategori ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="nmbarang" name="nmbarang" value="<?= $brnk->nama_barang ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Deskripsi<span class="required">*</span></label>
                            <div class="col-sm-8"><textarea name="descisi" id="descisi" class="form-control"><?= $brnk->descnk ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Satuan<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <select name="stuanbr" id="stuanbr" class="form-control">
                                    <option id="stuanbrpil" name="stuanbrpil" value="<?= $brnk->id_satuan ?>"><?= $brnk->nm_satuan ?></option>
                                    <?php foreach ($satuan as $s) : ?>
                                        <option id="stuanbrpil" name="stuanbrpil" value="<?= $s->id_satuan ?>"><?= $s->nm_satuan ?></option>
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


    <!-- MODAL DELETE -->
    <div class="modal fade" id="hapusbarang<?= $brnk->id_brg_nk ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('delmbarangnk'); ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $brnk->id_brg_nk ?>" hidden />
                                <h3> MASTER BARANG AKAN TERHAPUS SECARA PERMANENT !!</h3>
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

    <!-- UPLOAD uploadmbrang -->

    <div class="modal fade" id="uploadmbrang<?= $brnk->id_brg_nk ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Gambar Barang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('uploadmbarangnk'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                            <input class="form-control" type="text" id="id_isi" name="id_isi" value="<?= $brnk->id_brg_nk ?>" readonly hidden />
                            <input class="form-control" type="text" id="file_nm" name="file_nm" value="<?= $brnk->gbr_barang ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
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