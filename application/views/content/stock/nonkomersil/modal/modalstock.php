<?php foreach ($item as $i) : ?>
    <!-- MODAL ADD -->
    <div class="modal fade" id="adjustmentqty<?= $i->kode_sistem ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Adjustmen Stock - <span style="text-transform:uppercase"><b><?= $i->nama_barang ?></b></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('adjustmenqty'); ?>
                    <div class="form-group" hidden>
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">INPUT SYSTEM<span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="kd_system" name="kd_system" value="<?= $kdgenerate ?>" readonly />
                                <input class="form-control" type="text" id="kd_system" name="kd_system" value="<?= $i->kode_sistem ?>" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label text-right" for="kd_user">INPUT QTY ADDJUSTMENT <span class="required">*</span></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="number" id="adjqty" name="adjqty" value="">
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
    </div>
<?php endforeach; ?>