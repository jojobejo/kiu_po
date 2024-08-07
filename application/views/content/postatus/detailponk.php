<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div style="display: flex; text-align: center;">
                        <a href="<?= base_url('postatusnk') ?>">
                            <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                        </a>
                        <h3>Kembali</h3>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    <section class="content">
        <div class="card">
            <div class="m-2">
                <div class="">
                    <div class="row">
                        <?php foreach ($status as $s) : ?>
                            <div class="col-2">
                                <label for="naSupp" class="">NOMOR PO : </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nopo ?>" class="form-control" readonly>
                            </div>
                            <div class="col-2">
                                <label for="tgTrans" class="">Tanggal Transaksi : &nbsp;&nbsp; </label>
                                <input type="date" id="tgTrans" name="tgTrans" style="max-width: 250px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly>
                            </div>
                            <div class="col-2">
                                <label for="naSupp" class="">Nama Pengaju: </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nm_user ?>" class="form-control" readonly>
                            </div>
                            <div class="col-2">
                                <label for="noInv" class="">Departemen</label>
                                <input type="text" id="noInv" name="noInv" value="<?= $s->departemen ?>" class="form-control" readonly>
                            </div>

                            <!--USER -->

                            <?php if ($this->session->userdata('lv') == '4') : ?>
                                <div class="col-lg">
                                    <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>
                                    <?php if ($s->status == 'DONE') : ?>
                                        <div>
                                            <a href="<?= base_url('printOrdernk/') . $s->kd_po_nk ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                        </div>
                                    <?php elseif ($s->status == 'ON PROGRESS') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'NOTE KEUANGAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'UPDATE DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-exclamation"></i> Terdapat Update</a>
                                        </div>
                                    <?php elseif ($s->status == 'REJECT') : ?>
                                        <div>
                                            <a href="#" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Order Ditolak</a>
                                        </div>
                                    <?php elseif ($s->status == 'PO REVISI') : ?>
                                        <div>
                                            <a href="<?= base_url('repostponk/') . $s->kd_po_nk ?>" class="btn btn-warning btn-block"><i class="fas fa-undo"></i> PO REVISI</a>
                                        </div>
                                    <?php elseif ($s->status == 'PENDING') : ?>
                                        <div class="row">
                                            <div class="col">
                                                <a href="#" class="btn btn-warning btn-block"><i class="fas fa-pause"></i> PO PENDING</a>
                                            </div>
                                            <div class="col">
                                                <a href="<?= base_url('repostponk/') . $s->kd_po_nk ?>" class="btn btn-success btn-block"><i class="fas fa-undo"></i> REPOST PO </a>
                                            </div>
                                        </div>
                                    <?php elseif ($s->status == 'ACC-KADEP') : ?>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-thumbs-up"></i> PO ACCEPT KADEP</a>
                                        </div>
                                    <?php elseif ($s->status == 'SEDANG DIAJUKAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> SEDANG DIAJUKAN</a>
                                        </div>

                                    <?php elseif ($s->status == 'ON PROGRESS - KADEP') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> MENUNGGU ACC KADEP</a>
                                        </div>
                                    <?php elseif ($s->status == 'ACC DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-thumbs-up"></i>ACC DIREKTUR</a>
                                        </div>
                                    <?php elseif ($s->status == 'PROSES PEMBELIAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-truck-moving"></i>PROSES PEMBELIAN</a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!--PURCHASING -->

                            <?php elseif ($this->session->userdata('lv') == '2') : ?>
                                <div class="col-lg">
                                    <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>
                                    <?php if ($s->status == 'DONE') : ?>
                                        <div>
                                            <a href="<?= base_url('printOrdernk/') . $s->kd_po_nk ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                        </div>

                                    <?php elseif ($s->status == 'ON PROGRESS') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'NOTE KEUANGAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'UPDATE DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-exclamation"></i> Terdapat Update</a>
                                        </div>
                                    <?php elseif ($s->status == 'REJECT') : ?>
                                        <div>
                                            <a href="#" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Order Ditolak</a>
                                        </div>
                                    <?php elseif ($s->status == 'PO REVISI') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-undo"></i> PO REVISI</a>
                                        </div>
                                    <?php elseif ($s->status == 'PENDING') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-pause"></i> PO PENDING</a>
                                        </div>
                                    <?php elseif ($s->status == 'ON PROGRESS - KADEP') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-pause"></i> ON PROGRESS - KADEP</a>
                                        </div>
                                    <?php elseif ($s->status == 'ACC-KADEP') : ?>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-thumbs-up"></i> PO ACCEPT KADEP</a>
                                        </div>
                                    <?php elseif ($s->status == 'SEDANG DIAJUKAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-thumbs-up"></i> PO SEDANG DIAJUKAN</a>
                                        </div>
                                    <?php elseif ($s->status == 'ACC DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-thumbs-up"></i>ACC DIREKTUR</a>
                                        </div>
                                    <?php elseif ($s->status == 'PROSES PEMBELIAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-truck-moving"></i> PROSES PEMBELIAN</a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!--KADEP-->

                            <?php elseif ($this->session->userdata('lv') == '5') : ?>
                                <div class="col-lg">
                                    <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>
                                    <?php if ($s->status == 'DONE') : ?>
                                        <div>
                                            <a href="<?= base_url('printOrdernk/') . $s->kd_po_nk ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                        </div>
                                    <?php elseif ($s->status == 'ACC-KADEP') : ?>
                                        <div class="row">
                                            <div class="col">
                                                <a href="#" class="btn btn-block btn-primary thumbs-up"><i class="fas fa-thumbs-up"></i> ACC - KADEP</a>
                                            </div>
                                            <div class="col">
                                                <a href="#" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modalReject"><i class="fas fa-times"></i> REJECT PO</a>
                                            </div>
                                        </div>
                                    <?php elseif ($s->status == 'UPDATE DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-exclamation"></i> Terdapat Update</a>
                                        </div>
                                    <?php elseif ($s->status == 'REJECT') : ?>
                                        <div>
                                            <a href="#" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Order Ditolak</a>
                                        </div>
                                    <?php elseif ($s->status == 'PO REVISI') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-undo"></i> PO REVISI</a>
                                        </div>
                                    <?php elseif ($s->status == 'PENDING') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-pause"></i> PO PENDING</a>
                                        </div>
                                    <?php elseif ($s->status == 'ON PROGRESS' || $s->status == 'ON PROGRESS - KADEP') : ?>
                                        <div class="row">
                                            <div class="col">
                                                <a class="btn btn-block btn-success btn-md" href="<?= base_url('konfirmasiOrderNK/') . $s->kd_po_nk . '/' . $this->session->userdata('kode') ?>">
                                                    <i class="fas fa-clipboard-check"></i>
                                                    Accept
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="btn btn-block btn-danger btn-md" href="<?= base_url('tolakordernk/') . $s->kd_po_nk . '/' . $this->session->userdata('kode') ?>">
                                                    <i class="fas fa-times"></i> &nbsp;
                                                    Reject
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="btn btn-block btn-warning btn-md" data-toggle="modal" data-target="#modalrev<?= $s->kd_po_nk ?>">
                                                    <i class="fab fa-rev"></i> &nbsp;
                                                    Revisi
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a class="btn btn-block btn-warning btn-md" data-toggle="modal" data-target="#modalPending<?= $s->kd_po_nk ?>">
                                                    <i class="fas fa-clock"></i> &nbsp;
                                                    Pending
                                                </a>
                                            </div>
                                        </div>
                                    <?php elseif ($s->status == 'SEDANG DIAJUKAN') : ?>
                                        <div class="row">
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-thumbs-up"></i> PO SEDANG DIAJUKAN</a>
                                        </div>
                                    <?php elseif ($s->status == 'ACC DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-thumbs-up"></i>ACC DIREKTUR</a>
                                        </div>
                                    <?php elseif ($s->status == 'PROSES PEMBELIAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-truck-moving"></i> PROSES PEMBELIAN</a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- DIREKTUR -->

                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'SEDANG DIAJUKAN') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Status Order : </label>
                                            <a class="btn btn-block btn-success btn-md" href="<?= base_url('konfirmasiOrderdirNK/') . $s->kd_po_nk . '/' . $this->session->userdata('kode') ?>">
                                                <i class="fas fa-clipboard-check"></i>
                                                Accept
                                            </a>
                                        </div>
                                        <div class="col">
                                            <label for="tgTrans" class=""> &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-danger btn-md" href="<?= base_url('tolakordernk/') . $s->kd_po_nk . '/' . $this->session->userdata('kode') ?>">
                                                <i class="fas fa-times"></i> &nbsp;
                                                Reject
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'REJECT') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Status Order : </label>
                                            <a href="#" class="btn btn-danger btn-block"><i class="fas fa-times"></i> Order Ditolak</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->userdata('lv') == '4' && $s->status == 'ACC-KADEP') : ?>

                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ON PROGRESS') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalAddNote">
                                                <i class="fas fa-clipboard-check"></i> &nbsp;
                                                Update
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC-KADEP') : ?>
                                <div class="col">
                                    <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                    <div class="row">
                                        <div class="col">
                                            <a class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalAddNote">
                                                <i class="fas fa-clipboard-check"></i>
                                                PEMBELIAN
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="btn btn-block btn-warning btn-md" data-toggle="modal" data-target="#modalrev<?= $s->kd_po_nk ?>">
                                                <i class="fab fa-rev"></i>
                                                PO REVISI
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'PROSES PEMBELIAN') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-success btn-md" data-toggle="modal" data-target="#modalonhand">
                                                <i class="fas fa-check-circle"></i> &nbsp;
                                                ON HAND
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC DIREKTUR') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#ajukanpembelian<?= $s->kd_po_nk ?>">
                                                <i class="fas fa-clipboard-check"></i> &nbsp;
                                                PROSES PEMBELIAN
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col">
                <label for="noInv" class="">Tujuan Pembelian</label>
                <textarea type="text" id="noInv" name="noInv" class="form-control mb-2" readonly><?= $s->tj_pembelian ?></textarea>
            </div>
        </div>
        <!-- FITUR ADD -->
        <?php $this->load->view('content/postatus/modal_setting/modalponk') ?>
        <?php if ($this->session->userdata('lv') == '4' && $s->status == 'DONE') : ?>

        <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'REJECT') : ?>
        <?php elseif ($this->session->userdata('lv') == '5' && $s->status == 'DONE') : ?>
        <?php elseif ($this->session->userdata('lv') == '5' && $s->status == 'REJECT') : ?>
        <?php elseif ($this->session->userdata('lv') == '5' && $s->status != 'DONE') : ?>
        <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ACC-KADEP') : ?>
        <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ACC DIREKTUR') : ?>
        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'SEDANG DIAJUKAN') : ?>
        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ON PROGRESS - KADEP') : ?>
        <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'SEDANG DIAJUKAN') : ?>
        <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'PROSES PEMBELIAN') : ?>
        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'DONE') : ?>
        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'PROSES PEMBELIAN') : ?>
        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC DIREKTUR') : ?>

        <?php elseif ($this->session->userdata('lv') == '2' && $s->status != 'ON PROGRESS') : ?>
            <div class="row">
                <div class="col-md mb-2">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#addnopo<?= $s->kd_po_nk ?>">
                        <i class="fas fa-plus"> </i>
                        Input Nomor PO
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#addtax">
                        <i class="fas fa-percent"> </i>
                        Setting Tax
                    </a>
                </div>
                <?php if ($this->session->userdata('lv') == '2' && $s->status_hrg_nyata == '0') : ?>
                    <div class="col-md">
                        <a href="<?= base_url('hrgnyataon/' . $s->kd_po_nk) ?>" class="btn btn-secondary btn-sm btn-block">
                            <i class="fas fa-toggle-off"></i>
                            Harga Nyata OFF
                        </a>
                    </div>
                <?php elseif ($this->session->userdata('lv') == '2' && $s->status_hrg_nyata == '1') : ?>
                    <div class="col-md">
                        <a href="<?= base_url('hrgnyataoff/' . $s->kd_po_nk) ?>" class="btn btn-success btn-sm btn-block">
                            <i class="fas fa-toggle-on"></i>
                            Harga Nyata ON
                        </a>
                    </div>
                <?php endif; ?>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#add_note_pembelian">
                        <i class="fas fa-vote-yea"> </i>
                        Add Note Pembelian
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#addfileupload<?= $s->kd_po_nk ?>">
                        <i class="fa fa-solid fa-file-image"></i>
                        Add file pendukung
                    </a>
                </div>
            </div>
            <!-- ELSEIF == 4 -->
        <?php elseif ($this->session->userdata('lv') == '4' && $s->status != 'DONE' && $s->status != 'ON PROGRESS - KADEP') : ?>
            <div class="row">
                <div class="col-md mb-2">
                    <a class="btn btnAtas btn-sm btn-block" href="<?= base_url('listbarangnk/1/2/3/' . $s->kd_po_nk) ?>">
                        <i class="fas fa-plus"> </i>
                        Tambah Barang
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#edponk<?= $s->kd_po_nk ?>">
                        <i class="fas fa-server"> </i>
                        Edit Data Po
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#add_note_pembelian">
                        <i class="fas fa-vote-yea"> </i>
                        Tambah Note Pembelian
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#addfileupload<?= $s->kd_po_nk ?>">
                        <i class="fa fa-solid fa-file-image"></i>
                        Add file pendukung
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped ">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Deskripsi</td>
                    <td>Keterangan</td>
                    <td>Qty</td>
                    <td>Harga</td>
                    <td>Total Harga</td>

                    <!-- HARGA NYATA -->

                    <!-- <?php if ($this->session->userdata('lv') == '2' && $s->status_hrg_nyata == '1') : ?>
                        <td>Harga Nyata</td>
                        <td>Total Harga Nyata</td>
                    <?php elseif ($this->session->userdata('lv') == '2' && $s->status_hrg_nyata == '0') : ?>
                    <?php endif; ?> -->

                    <!-- END HARGANYATA -->

                    <td>Gambar Barang</td>
                    <?php if ($this->session->userdata('lv') == '4' && $s->status == 'ACC-KADEP') : ?>
                    <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC-KADEP') : ?>
                        <td>#</td>
                    <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ON PROGRESS' || $s->status == 'PO REVISI') : ?>
                        <td>#</td>
                    <?php elseif ($this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '2' && $s->status == 'DONE') : ?>
                    <?php elseif ($this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '2' && $s->status == 'REJECT') : ?>
                    <?php elseif ($this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '2' && $s->status == 'SEDANG DIAJUKAN') : ?>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                            foreach ($detail as $d) :
                                if ($d->gbr_barang == 'Karisma.png') {
                                    $imagePath = "../images/gbrbarang/Karisma.png";
                                } else {
                                    $imagePath = "../images/gbrbarang/masterbr/" . $d->gbr_barang;
                                }

                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $d->nama_barang ?></td>
                        <td><?= $d->deskripsi ?></td>
                        <td><?= $d->keterangan ?></td>
                        <td><?= $d->qty ?></td>
                        <td>Rp. <?= number_format($d->hrg_satuan) ?></td>
                        <td>Rp. <?= number_format($d->total_harga) ?></td>
                        <!-- HARGA NYATA -->
                        <!-- <?php if ($this->session->userdata('lv') == '2' && $s->status_hrg_nyata == '1') : ?>
                            <td>Rp. <?= number_format($d->hrg_nyata) ?></td>
                            <td>Rp. <?= number_format($d->total_nyata) ?></td>
                        <?php elseif ($this->session->userdata('lv') == '2' && $s->status_hrg_nyata == '0') : ?>
                        <?php endif; ?> -->
                        <!-- END HARGA NYATA -->
                        <td>
                            <!-- GAMBAR -->

                            <?php if ($this->session->userdata('lv') == '4' && $s->status == 'ON PROGRESS') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ACC-KADEP') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ACC DIREKTUR') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ON PROGRESS - KADEP') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'PROSES PEMBELIAN') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'DONE') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'SEDANG DIAJUKAN') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'PO REVISI') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'SEDANG DIAJUKAN') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'DONE') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'PROSES PEMBELIAN') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC DIREKTUR') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC-KADEP') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'SEDANG DIAJUKAN') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '5' && $s->status == 'ON PROGRESS - KADEP') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '5' && $s->status == 'PO REVISI') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '5' && $s->status == 'ON PROGRESS') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php elseif ($this->session->userdata('lv') == '5' && $s->status == 'ACC-KADEP') : ?>
                                <a href="<?= $imagePath ?>" target="_blank"><img src="<?php echo $imagePath ?>" style="width:50px; height:50px"></a>
                            <?php endif; ?>
                        </td>
                        <?php if ($this->session->userdata('lv') == '4' && $s->status == 'PO REVISI') : ?>
                            <td>
                                <div class="row">
                                    <a class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#edititem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#hapusitem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ON PROGRESS') : ?>
                            <td>
                                <div class="row">
                                    <a class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#edititem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#hapusitem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Hapus
                                    </a>
                                </div>
                            </td>

                        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC-KADEP') : ?>
                            <td>
                                <div class="row">
                                    <a class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#edititem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#hapusitem<?= $d->id_det_po_nk ?>">
                                        <i class="fas fa-trash-alt"></i>
                                        Hapus
                                    </a>
                                    <?php if ($this->session->userdata('lv') == '2' && $s->status_hrg_nyata == '1') : ?>
                                        <a class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#hrgnyata<?= $d->id_det_po_nk ?>">
                                            <i class="fas fa-plus"></i>
                                            Add Harganyata
                                        </a>
                                    <?php else : ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                        <?php elseif ($this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '2' && $s->status == 'DONE') : ?>
                        <?php elseif ($this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '2' && $s->status == 'REJECT') : ?>
                        <?php elseif ($this->session->userdata('lv') == '4' || $this->session->userdata('lv') == '2' && $s->status == 'SEDANG DIAJUKAN') : ?>

                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                <!-- VIEW PIC  -->
                <?php if ($this->session->userdata('lv') == '4' && $s->status == 'ACC-KADEP' || $s->status == 'PO REVISI') : ?>
                    <?php foreach ($total as $t) : ?>
                        <tr>
                            <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                            <td colspan="3" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
                    </tr>
                    <?php foreach ($flupload as $f) :
                                    $imagePath = "../images/filepndukung/" . $f->file_uploaded;
                    ?>
                        <tr>
                            <td colspan="4" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                            <td colspan="4" style="padding-right:3%; font-weight: bold;">
                                <a href="<?= base_url('downloadfile/') . $imagePath ?>" class="btn btn-secondary btn-sm btn-block">Download File</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
                    </tr>
                    <?php foreach ($diskon as $d) : ?>
                        <?php if ($diskon > 0) : ?>
                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                                <td colspan="3" style="font-weight: bold;">
                                    Rp. <?= number_format($d->nominal, 2) ?>
                                    <?php if ($this->session->userdata('lv') < '5' && $s->status == 'DONE') : ?>
                                    <?php elseif ($this->session->userdata('lv') < '5' && $s->status == 'REJECT') : ?>
                                    <?php elseif ($this->session->userdata('lv') < '5' && $s->status != 'DONE') : ?>
                                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskonNk/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
                    </tr>
                    <?php foreach ($ntpembelian as $ntpm) : ?>
                        <tr>
                            <td colspan="9" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
                    </tr>
                    <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                <td colspan="3" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                <td colspan="3" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                                <td colspan="3" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'SEDANG DIAJUKAN') : ?>
                    <?php foreach ($total as $t) : ?>
                        <tr>
                            <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                            <td colspan="3" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
                    </tr>
                    <?php foreach ($flupload as $f) :
                                    $imagePath = "../images/filepndukung/" . $f->file_uploaded;
                    ?>
                        <tr>
                            <td colspan="4" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                            <td colspan="4" style="padding-right:3%; font-weight: bold;">
                                <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $f->keterangan ?>">Buka File
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
                    </tr>
                    <?php foreach ($diskon as $d) : ?>
                        <?php if ($diskon > 0) : ?>
                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                                <td colspan="3" style="font-weight: bold;">
                                    Rp. <?= number_format($d->nominal, 2) ?>
                                    <?php if ($this->session->userdata('lv') < '5' && $s->status == 'DONE') : ?>
                                    <?php elseif ($this->session->userdata('lv') < '5' && $s->status == 'REJECT') : ?>
                                    <?php elseif ($this->session->userdata('lv') < '5' && $s->status != 'DONE') : ?>
                                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskonNk/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
                    </tr>
                    <?php foreach ($ntpembelian as $ntpm) : ?>
                        <tr>
                            <td colspan="9" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="9" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
                    </tr>
                    <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                <td colspan="3" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                                <td colspan="3" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                                <td colspan="3" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

            </tbody>
        </table>
        <!-- AKSES LV 4 || PIC  -->
    <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ON PROGRESS') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="4" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="4" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                        <?php if ($this->session->userdata('lv') < '5' && $s->status == 'DONE') : ?>
                        <?php elseif ($this->session->userdata('lv') < '5' && $s->status == 'REJECT') : ?>
                        <?php elseif ($this->session->userdata('lv') < '5' && $s->status != 'DONE') : ?>
                            <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskonNk/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="6" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
                <td colspan="3" style="font-weight: bold;">
                    <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#edit_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <!-- UPLOAD FILE PENDUKUNG -->
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
        </tr>
        <?php foreach ($flupload as $f) :
                                    $imagePath = "../images/filepndukung/" . $f->file_uploaded;
        ?>
            <tr>
                <td colspan="3" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                <td colspan="3" style="padding-right:3%; font-weight: bold;">
                    <?php if ($f->kdfile == 'csv') : ?>
                        <a href="<?= base_url('downloadfile/') . $imagePath ?>" class="btn btn-secondary btn-sm btn-block">Download File</a>
                    <?php elseif ($f->kdfile == 'png') : ?>
                        <a href="" class="btn btn-secondary btn-sm btn-block">Buka Files</a>
                    <?php endif; ?>
                </td>
                <td colspan="3" style="font-weight: bold;">
                    <div class="row">
                        <div class="col">
                            <a class="btn  btn-success btn-sm btn-block" data-toggle="modal" data-target="#edit_gbr_pndukung<?= $f->id_file_nk ?>">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#reuoploadimg_pndukung<?= $f->id_file_nk ?>">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </a>
                        </div>
                        <div class="col">
                            <a class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#delete_gbr_pendukung<?= $f->id_file_nk ?>">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="4" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="4" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="4" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>
    <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ON PROGRESS - KADEP') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="4" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
        </tr>
        <?php foreach ($flupload as $f) :
                                    $imagePath = "../images/filepndukung/" . $f->file_uploaded;
        ?>
            <tr>
                <td colspan="4" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                <td colspan="4" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $f->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="4" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                        <?php if ($this->session->userdata('lv') < '5' && $s->status == 'DONE') : ?>
                        <?php elseif ($this->session->userdata('lv') < '5' && $s->status == 'REJECT') : ?>
                        <?php elseif ($this->session->userdata('lv') < '5' && $s->status != 'DONE') : ?>
                            <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskonNk/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="9" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="4" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="4" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="4" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>

    <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC-KADEP') : ?>

        <!-- TOTAL HARGA || status_hrg_nyata 1 -->
        <?php if ($this->session->userdata('lv') == '2' && $s->status == 'ACC-KADEP' && $s->status_hrg_nyata == '1') : ?>
            <?php foreach ($total as $t) : ?>
                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                    <td colspan="4" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($totalnyata as $tn) : ?>
                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Nyata</td>
                    <td colspan="4" style="font-weight: bold;">Rp. <?= number_format($tn->total_nyata) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="11" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
            </tr>
            <?php foreach ($diskon as $d) : ?>
                <?php if ($diskon > 0) : ?>
                    <tr>
                        <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                        <td colspan="4" style="font-weight: bold;">
                            Rp. <?= number_format($d->nominal, 2) ?>
                            <?php if ($this->session->userdata('lv') < '5' && $s->status == 'DONE') : ?>
                            <?php elseif ($this->session->userdata('lv') < '5' && $s->status == 'REJECT') : ?>
                            <?php elseif ($this->session->userdata('lv') < '5' && $s->status != 'DONE') : ?>
                                <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskonNk/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="12" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
            </tr>
            <?php foreach ($ntpembelian as $ntpm) : ?>
                <tr>
                    <td colspan="8" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
                    <td colspan="4" style="font-weight: bold;">
                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#edit_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="12" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
            </tr>
            <?php foreach ($flupload as $f) : ?>
                <tr>
                    <td colspan="8" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                    <td colspan="4" style="font-weight: bold;">

                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#edit_note_pembelian<?= $f->id_file_nk ?>">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_note_pembelian<?= $f->id_file_nk ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="12" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
            </tr>
            <?php foreach ($totalnyata as $t) :
                                        foreach ($totalDiskon as $d) :
                                            $stlhDiskon = $t->total_nyata - $d->total_diskon;
                                            $tax = $s->tax / 100;
                                            $hargaPajak = $stlhDiskon * $tax;
                                            $hargaAll = $stlhDiskon + $hargaPajak; ?>
                    <tr>
                        <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                        <td colspan="4" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                    </tr>

                    <tr>
                        <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                        <td colspan="4" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                    </tr>

                    <tr>
                        <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                        <td colspan="4" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>

        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'SEDANG DIAJUKAN' && $s->status_hrg_nyata == '1') : ?>
            <?php foreach ($total as $t) : ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                    <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="7" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
            </tr>
            <?php foreach ($diskon as $d) : ?>
                <?php if ($diskon > 0) : ?>
                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                        <td colspan="1" style="font-weight: bold;">
                            Rp. <?= number_format($d->nominal, 2) ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="7" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
            </tr>
            <?php foreach ($ntpembelian as $ntpm) : ?>
                <tr>
                    <td colspan="7" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="7" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
            </tr>
            <?php foreach ($total as $t) :
                                        foreach ($totalDiskon as $d) :
                                            $stlhDiskon = $t->total_harga - $d->total_diskon;
                                            $tax = $s->tax / 100;
                                            $hargaPajak = $stlhDiskon * $tax;
                                            $hargaAll = $stlhDiskon + $hargaPajak; ?>
                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                        <td colspan="1" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                    </tr>

                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                        <td colspan="1" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                    </tr>

                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                        <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
            </table>



            <!-- TOTAL HARGA || status_hrg_nyata 0 -->
        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC-KADEP' && $s->status_hrg_nyata == '0') : ?>
            <?php foreach ($total as $t) : ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                    <td colspan="3" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="9" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
            </tr>
            <?php foreach ($diskon as $d) : ?>
                <?php if ($diskon > 0) : ?>
                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                        <td colspan="3" style="font-weight: bold;">
                            Rp. <?= number_format($d->nominal, 2) ?>
                            <?php if ($this->session->userdata('lv') < '5' && $s->status == 'DONE') : ?>
                            <?php elseif ($this->session->userdata('lv') < '5' && $s->status == 'REJECT') : ?>
                            <?php elseif ($this->session->userdata('lv') < '5' && $s->status != 'DONE') : ?>
                                <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d->id_diskon ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskonNk/') . $d->id_diskon . '/' . $d->kd_po ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="9" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
            </tr>
            <?php foreach ($ntpembelian as $ntpm) : ?>
                <tr>
                    <td colspan="6" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
                    <td colspan="3" style="font-weight: bold;">
                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#edit_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_note_pembelian<?= $ntpm->id_nt_pembelian ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
            </tr>
            <?php foreach ($flupload as $f) :
                                        $imagePath = "../images/filepndukung/" . $f->file_uploaded;
            ?>
                <tr>
                    <td colspan="3" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                    <td colspan="3" style="padding-right:3%; font-weight: bold;">
                        <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $f->keterangan ?>">Buka File
                        </a>
                    </td>
                    <td colspan="3" style="font-weight: bold;">
                        <div class="row">
                            <div class="col">
                                <a class="btn  btn-success btn-sm btn-block" data-toggle="modal" data-target="#edit_gbr_pndukung<?= $f->id_file_nk ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                            </div>
                            <div class="col">
                                <a class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#delete_gbr_pendukung<?= $f->id_file_nk ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="9" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
            </tr>
            <?php foreach ($total as $t) :
                                        foreach ($totalDiskon as $d) :
                                            $stlhDiskon = $t->total_harga - $d->total_diskon;
                                            $tax = $s->tax / 100;
                                            $hargaPajak = $stlhDiskon * $tax;
                                            $hargaAll = $stlhDiskon + $hargaPajak; ?>
                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                        <td colspan="3" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                    </tr>

                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                        <td colspan="3" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                    </tr>

                    <tr>
                        <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                        <td colspan="3" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
        </table>
        <!-- FILE PENDUKUNG || VIEW ADMIN || SEDANG DIAJUKAN -->
    <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'SEDANG DIAJUKAN') : ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
        </tr>
        <?php foreach ($flupload as $f) :
                                    $imagePath = "../images/filepndukung/" . $f->file_uploaded;
        ?>
            <tr>
                <td colspan="3" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                <td colspan="6" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $f->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <!-- PROSES PEMBELIAN || LV 2 ADMIN -->
    <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'PROSES PEMBELIAN') : ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">Bukti Pembelian</td>
        </tr>
        <?php foreach ($fluploadbukti as $fb) :
                                    $imagePathb = "../images/upbukti/" . $fb->file_uploaded;
        ?>
            <tr>
                <td colspan="5" style="padding-right:3%; font-weight: bold;"><?= $fb->keterangan ?></td>
                <td colspan="5" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePathb ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $fb->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <!-- ACC DIREKTUR || LV 2 ADMIN -->
    <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'ACC DIREKTUR') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($totalnyata as $tn) : ?>
            <tr>
                <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Nyata</td>
                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($tn->total_nyata) ?></td>
            </tr>
        <?php endforeach; ?>
        <!-- BUKTI PEMBELIAN -->
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">Bukti Pembelian</td>
        </tr>
        <?php foreach ($fluploadbukti as $fb) :
                                    $imagePathb = "../images/upbukti/" . $fb->file_uploaded;
        ?>
            <tr>
                <td colspan="5" style="padding-right:3%; font-weight: bold;"><?= $fb->keterangan ?></td>
                <td colspan="5" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePathb ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $fb->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="10" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>

        <!-- PROSES PEMBELIAN || LV 4 USER -->
    <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'PROSES PEMBELIAN') : ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">Bukti Pembelian</td>
        </tr>
        <?php foreach ($fluploadbukti as $fb) :
                                    $imagePathb = "../images/upbukti/" . $fb->file_uploaded;
        ?>
            <tr>
                <td colspan="5" style="padding-right:3%; font-weight: bold;"><?= $fb->keterangan ?></td>
                <td colspan="5" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePathb ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $fb->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

        <!-- ACC DIREKTUR || LV 4 USER -->

    <?php elseif ($this->session->userdata('lv') == '4' && $s->status == 'ACC DIREKTUR') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <!-- BUKTI PEMBELIAN -->
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">Bukti Pembelian</td>
        </tr>
        <?php foreach ($fluploadbukti as $fb) :
                                    $imagePathb = "../images/upbukti/" . $fb->file_uploaded;
        ?>
            <tr>
                <td colspan="4" style="padding-right:3%; font-weight: bold;"><?= $fb->keterangan ?></td>
                <td colspan="4" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePathb ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $fb->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="8" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>

        <!-- ACC DIREKTUR || LV 5 KADEP -->

    <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'SEDANG DIAJUKAN' && $s->status_hrg_nyata == '1') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($totalnyata as $tn) : ?>
            <tr>
                <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Nyata</td>
                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($tn->total_nyata) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="2" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="10" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="10" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="2" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="2" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="8" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>

            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>

        <!-- DIREKTUR -->
    <?php elseif ($this->session->userdata('lv') == '3') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
        </tr>
        <?php foreach ($flupload as $f) :
                                    $imagePath = "../images/filepndukung/" . $f->file_uploaded;
        ?>
            <tr>
                <td colspan="4" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                <td colspan="4" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $f->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="1" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="8" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="1" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="1" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>
        <!-- KADEP -->
    <?php elseif ($this->session->userdata('lv') == '5') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="6" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="2" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="9" class="bg-black color-palette" style="text-align: center;">File Pendukung</td>
        </tr>
        <?php foreach ($flupload as $f) :
                                    $imagePath = "../images/filepndukung/" . $f->file_uploaded;
        ?>
            <tr>
                <td colspan="4" style="padding-right:3%; font-weight: bold;"><?= $f->keterangan ?></td>
                <td colspan="4" style="padding-right:3%; font-weight: bold;">
                    <a href="<?= $imagePath ?>" class="btn btn-secondary btn-sm btn-block" data-toggle="lightbox" data-title="<?= $f->keterangan ?>">Buka File
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="1" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="8" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="1" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="1" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>
    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
        <?php foreach ($total as $t) : ?>
            <tr>
                <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga</td>
                <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
        </tr>
        <?php foreach ($diskon as $d) : ?>
            <?php if ($diskon > 0) : ?>
                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d->keterangan ?> : </td>
                    <td colspan="1" style="font-weight: bold;">
                        Rp. <?= number_format($d->nominal, 2) ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">Note Pembelian</td>
        </tr>
        <?php foreach ($ntpembelian as $ntpm) : ?>
            <tr>
                <td colspan="8" style="padding-right:3%; font-weight: bold;"><?= $ntpm->keterangan ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="8" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
        </tr>
        <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = $t->total_harga - $d->total_diskon;
                                        $tax = $s->tax / 100;
                                        $hargaPajak = $stlhDiskon * $tax;
                                        $hargaAll = $stlhDiskon + $hargaPajak; ?>
                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                    <td colspan="1" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Tax : <?= $s->tax ?>(%)</td>
                    <td colspan="1" style="font-weight: bold;"> Rp. <?= number_format($hargaPajak, 2) ?> </td>
                </tr>

                <tr>
                    <td colspan="7" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga</td>
                    <td colspan="1" style="font-weight: bold;">Rp. <?= number_format($hargaAll, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </tbody>
        </table>
    <?php endif; ?>


    <div class="row mr-2">
        <div class="col-md-8">
            <div class="noteDirektur">
                <table class="table table-bordered table-stripeds">
                    <thead style="background-color: #212529; color:white;">
                        <tr>
                            <td class="tdnote">ISI NOTE</td>
                            <td class="tduser">USER</td>
                            <td style="text-align: center;">TANGGAL</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($log as $l) : ?>
                            <tr>
                                <td><?= $l->isi_note ?></td>
                                <td><?= $l->nama_user ?></td>
                                <td><?= $l->log_create ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </section>
    <!-- /.content-header -->

</div>
<?php endforeach; ?>