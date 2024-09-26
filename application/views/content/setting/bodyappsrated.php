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
                                <a href="#" data-toggle="modal" data-target="#modalAddItem" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp; Tambah Module Baru</a>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr style="text-align: center;">
                                    <td>Nama Module</td>
                                    <td>Rating</td>
                                    <td>Detail Review</td>
                                    <td>-</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getallmodule as $g) : ?>
                                    <tr>
                                        <td><?= $g->nm_module ?></td>
                                        <td style="width: 10%; text-align: center;">4.8 / 5 <i class="fas fa-star"></i></td>
                                        <td style="width: 10%;text-align: center;"><a href="<?= base_url('detailreview/' . $g->kd_module) ?>" class="btn btn-info"><i class="fas fa-info-circle"></i></a></td>
                                        <td style="width: 5%;">
                                            <?php if ($g->m_status == '1') : ?>
                                                <div class="custom-control custom-switch custom-switch-off-success disabled">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch3<?= $g->id_qmodule ?>">
                                                    <label class="custom-control-label" for="customSwitch3<?= $g->id_qmodule ?>"></label>
                                                </div>
                                            <?php elseif ($g->m_status == '2') : ?>
                                                <div class="custom-control custom-switch custom-switch-off-danger disabled">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch3<?= $g->id_qmodule ?>">
                                                    <label class="custom-control-label" for="customSwitch3<?= $g->id_qmodule ?>"></label>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <?php if ($g->m_status == '1') : ?>
                                            <td style="width: 15%;"><a href="<?= base_url('mdulaktif') ?>" class="btn btn-danger btn-block">Non Aktif</a></td>
                                        <?php elseif ($g->m_status == '2') : ?>
                                            <td style="width: 15%;"><a href="<?= base_url('mdulnonaktif') ?>" class="btn btn-success btn-block">Aktif</a></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php elseif ($this->session->userdata('lv') == '4') : ?>
                <div class="card">
                    <div class="card-body">
                        <h3> </h3>
                        <h1 class="mb-2 mt-2"><b>Berikan penilaian anda terhadap module/fitur yang ada pada aplikasi ini</b></h1>
                        <table>
                            <table class="table table-bordered table-striped mb-2">
                                <thead style="background-color: #212529; color:white;">
                                    <tr>
                                        <td>Nama Module</td>
                                        <td>#</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($module as $m) : ?>
                                        <tr>
                                            <td><?= $m->nm_module ?></td>
                                            <td style="width: 15%;"><a href="<?= base_url('questionreviewpic/' . $m->kd_module) ?>" class="btn btn-info btn-block"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            <?php endif; ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>