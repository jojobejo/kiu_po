<?php foreach($lreqmbarang as $l) : ?>
<div class="modal fade" id="reqmasterbarang">
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
<?php endforeach; ?>