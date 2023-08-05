<!-- MODAL ADD -->
<div class="modal fade" id="add_barang_nonkomersil">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Item Barang</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('addtmpbarangnonkomersil'); ?>
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label text-right" for="kd_user">Nama Barang<span class="required">*</span></label>
                        <div class="col-sm-8"><input class="form-control" type="text" id="nama_isi" name="nama_isi" value="" />
                            <input class="form-control" type="text" id="kd_isi" name="kd_isi" value="<?= $kdbarang ?>" readonly />
                        </div>
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