<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <?php $this->load->view('content\mbarang\modal\mreqbarang.php') ?>
                </div><!-- /.col -->
            </div><!-- /.row -->


            <!-- VIEW ADMIN PURCHASING -->
            <?php if ($this->session->userdata('lv') == '2' || $this->session->userdata('lv') == '1') : ?>

                <table class="table table-bordered table-striped" id="list_req">
                    <thead>
                        <tr>
                            <td>Nama Inputer</td>
                            <td>Nama Barang</td>
                            <td>Deskripsi / Spesifikasi</td>
                            <td>Satuan</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listreqbr as $l) : ?>
                            <tr>
                                <td><?= $l->nama_user ?></td>
                                <td><?= $l->nama_barang ?></td>
                                <td><?= $l->deskripsi ?></td>
                                <td><?= $l->nm_satuan ?></td>
                                <td>
                                    <a href="#" class="btn btn-block btn-success btn-sm " data-toggle="modal" data-target="#approvedbrgnk<?= $l->id_reqmbarang ?>">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- VIEW PIC -->

            <?php elseif ($this->session->userdata('lv') == '4') : ?>

            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
</div>