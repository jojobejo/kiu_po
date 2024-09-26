<?php $this->load->view('content/setting/modal/modalqna.php') ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <?php foreach ($countqna as $ctot) :
                $tot_asw = $ctot->tot_asw + 1;
                $tot_question = $ctot->tot_question + 1;
            ?>
                <!-- REVIEW ON PROGRESS  -->
                <?php if ($tot_asw == $tot_question) : ?>
                    <?php foreach ($judul as $j) :
                        if ($j->type == '2') {
                            $type = 'NON KOMERSIL';
                        } else {
                            $type = 'KOMERSIL';
                        }
                    ?>
                        <h1 class="mb-2 mt-2"><b style="text-transform:uppercase">MODULE(<?= $type ?>) - <?= $j->nm_module ?></b></h1>
                    <?php endforeach; ?>
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($getanswer as $gtansw) : ?>
                                <h1 class="mb-4 ml-2">
                                    <li><?= $gtansw->question ?></li>
                                </h1>
                                <div class="form-group">
                                    <div class="row ml-5 mb-4">
                                        <label class="control-label text-left" for="kd_user"><span class="required"></span></label>
                                        <div class="col">
                                            <textarea name="asnwer[]" id="asnwer" class="form-control" readonly><?= $gtansw->isi_review ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php foreach ($countqna as $ctot) :
                                $tot_asw = $ctot->tot_asw;
                                $tot_question = ($ctot->tot_question) + 1;
                            ?>
                                <?php if ($tot_asw == $tot_question) : ?>
                                    <h1 class="mb-4 ml-2">
                                        <li>Berikan penilaian anda pada module ini</li>
                                    </h1>
                                    <div class="row ml-5 mb-4">
                                        <div class="col">
                                            <select name="nilai" id="nilai" class="form-control">
                                                <?php foreach ($getnilai as $n) : ?>
                                                    <option value="<?= $n->nilai ?>" disabled selected><?= $n->nilai ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <center>
                                        <h3 class="mb-2 mt-2"><b style="text-transform:uppercase;text-align: center;">terimakasih , masukan dan penilaian anda dapat membantu kami untuk mengembangkan aplikasi ini </b></h1>
                                    </center>
                                <?php else : ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- REVIEW DONE  -->
                <?php else : ?>
                    <?php foreach ($judul as $j) :
                        if ($j->type == '2') {
                            $type = 'NON KOMERSIL';
                        } else {
                            $type = 'KOMERSIL';
                        }
                    ?>
                        <h1 class="mb-2 mt-2"><b style="text-transform:uppercase">MODULE(<?= $type ?>) - <?= $j->nm_module ?></b></h1>
                    <?php endforeach; ?>
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($question as $q) : ?>
                                <h1 class="mb-4 ml-2">
                                    <li><?= $q->qeustion ?></li>
                                </h1>
                                <?php echo form_open_multipart('reviewanswer'); ?>
                                <div class="form-group">
                                    <div class="row ml-5 mb-4">
                                        <label class="control-label text-left" for="kd_user"><span class="required"></span></label>
                                        <div class="col">
                                            <textarea name="asnwer[]" id="asnwer" class="form-control"></textarea>
                                        </div>
                                        <input type="text" name="kodem[]" id="kodem" class="form-control" value="<?= $q->kode ?>" hidden>
                                        <input type="text" name="koder[]" id="kodem" class="form-control" value="<?= $q->kode_r ?>" hidden>
                                        <input type="text" name="user" id="kodem" class="form-control" value="<?= $this->session->userdata('kode') ?>" hidden>
                                    </div>
                                </div>
                            <?php endforeach; ?>


                            <?= $ctot->tot_question ?>
                            <h1 class="mb-4 ml-2">
                                <li>Berikan penilaian anda pada module ini</li>
                            </h1>
                            <div class="row ml-5 mb-4">
                                <div class="col">
                                    <select name="nilai" id="nilai" class="form-control">
                                        <option value="0" selected disabled>-- PILIH PENILAIAN MODUL INI --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
                <?php endif; ?>

        </div><!-- /.container-fluid -->
    <?php endforeach; ?>
    </div>

    <!-- /.content-header -->
</div>