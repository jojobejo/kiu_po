<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <?php if ($this->session->userdata('lv') == '2') : ?>
                <?php $this->load->view('content/setting/modal/modalappseting.php') ?>
                <div class="card">
                    <div class="card-body">
                        <h3>List Module</h3>
                        <div class="row mb-2">
                            <div class="col mt-2">
                                <a href="#"  data-toggle="modal" data-target="#modalAddItem" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp; Tambah Module Baru</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Nama Module</td>
                                    <td>Status</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getallmodule as $g) : ?>
                                    <tr>
                                        <td><?= $g->nm_module ?></td>
                                        <td><?= $g->m_status ?></td>
                                        <td></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($this->session->userdata('lv') == '4') : ?>
                <div class="card">
                    <div class="card-body">
                        <h3>berikan penilaian anda terhadap module/fitur yang ada pada aplikasi ini </h3>
                    </div>
                </div>
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>