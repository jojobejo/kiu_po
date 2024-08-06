<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?= $this->load->view('content\mbarang\modal\mreqbarang.php') ?>
                </div><!-- /.col -->
            </div><!-- /.row -->


            <!-- VIEW ADMIN PURCHASING -->
            <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '1') : ?>

                <table class="table table-bordered table-striped" id="list_stocknonkomersil">
                    <thead>
                        <tr>
                            <td>Nama Barang</td>
                            <td>Deskripsi / Spesifikasi</td>
                            <td>Satuan</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <!-- VIEW PIC -->

            <?php elseif ($this->session->userdata('lv') == '4') : ?>

            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
</div>