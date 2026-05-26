<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <?php if ($this->session->flashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($this->session->flashdata('error'), ENT_QUOTES, 'UTF-8') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <style>
                .po-detail-table-wrap {
                    overflow-x: auto;
                }

                .po-detail-table {
                    font-size: 14px;
                    min-width: 1280px;
                }

                .po-detail-table td {
                    padding: .5rem .6rem;
                    vertical-align: middle;
                    white-space: nowrap;
                }

                .po-detail-table thead td {
                    font-weight: 600;
                    text-align: center;
                }

                .po-detail-table .col-item {
                    max-width: 360px;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: normal;
                }

                .po-detail-table .text-number {
                    text-align: right;
                }

                .po-detail-table .action-cell {
                    display: flex;
                    flex-wrap: wrap;
                    gap: .25rem;
                    justify-content: center;
                }

                .po-detail-table .btn-icon {
                    align-items: center;
                    display: inline-flex;
                    height: 32px;
                    justify-content: center;
                    margin: 0;
                    padding: 0;
                    width: 32px;
                }
            </style>
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div style="display: flex; text-align: center;">
                        <a href="<?= base_url('postatus') ?>">
                            <i class="fa fa-arrow-left  ml-4 mr-4 mt-2"></i>
                        </a>
                        <h3>Kembali</h3>
                    </div>
                </div><!-- /.col -->
                <?php $this->load->view('content/postatus/modalNote') ?>
                <?php $this->load->view('content/postatus/modalEditPO') ?>
            </div><!-- /.row -->
        </div>
    </div>

    <section class="content">
        <div class="card ">
            <div class="m-2">
                <div class="">
                    <div class="row">
                        <?php foreach ($status as $s) : ?>
                            <div class="col">
                                <label for="noInv" class="">No Po</label>
                                <input type="text" id="noInv" name="noInv" value="<?= $s->no_po ?>" class="form-control" readonly>
                            </div>
                            <?php if ($this->session->userdata('lv') == '2' && $s->status == 'PO REVISI') : ?>
                                <div class="col">
                                    <label for="noInv" class=""> Edit No.Po</label>
                                    <a class="btn btn-block btn-success" data-toggle="modal" data-target="#modaleditnopo<?= $s->id_po ?>"><i class=" fas fa-pencil-alt"></i></a>
                                </div>
                            <?php endif; ?>

                            <div class="col">
                                <label for="naSupp" class="">Nama Suplier : </label>
                                <input type="text" id="naCus" name="naSupp" style="max-width: 550px;" value="<?= $s->nama_suplier ?>" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="tgTrans" class="">Tanggal Transaksi : &nbsp;&nbsp; </label>
                                <input type="date" id="tgTrans" name="tgTrans" style="max-width: 250px;" value="<?= $s->tgl_transaksi ?>" class="form-control" readonly>
                            </div>
                            <?php if ($this->session->userdata('lv') == '2') : ?>
                                <div class="col-lg">
                                    <label for="tgTrans" class="">Status Order : &nbsp;&nbsp; </label>

                                    <?php if ($s->status == 'DONE') : ?>
                                        <div>
                                            <a href="<?= base_url('print_po/') . $s->kd_po ?>" target="_blank" class="btn btn-primary btn-block mb-2">
                                                <i class="fas fa-file-invoice"></i> Print PO
                                            </a>
                                            <?php if ($s->kd_printout_note != '') : ?>
                                                <a href="<?= base_url('print_po_supplier/') . $s->kd_po ?>" target="_blank" class="btn btn-secondary btn-block">
                                                    <i class="fas fa-shipping-fast"></i> Print PO - Supplier
                                                </a>
                                            <?php elseif ($s->kd_printout_note == '') : ?>
                                                <a href="#" class="btn btn-secondary btn-block btn-select-template" data-toggle="modal" data-target="#modalSelectTemplate" data-kdpo="<?= $s->kd_po ?>">
                                                    <i class="fas fa-shipping-fast"></i> Print PO - Supplier
                                                </a>
                                            <?php endif; ?>
                                        </div>


                                    <?php elseif ($s->status == 'CANCEL') : ?>
                                        <?php if ($s->status == 'CANCEL' && $s->kd_printout_note != '') : ?>
                                            <div>
                                                <a href="<?= base_url('printOrder/') . $s->kd_po ?>" target="_blank" class="btn btn-success btn-block"><i class="fas fa-print"></i> Cetak Form Order</a>
                                            </div>
                                        <?php elseif ($s->status == 'CANCEL' && $s->kd_printout_note == '') : ?>
                                            <a class="btn btn-success btn-block" onclick='alert("Format Printout Belum Terpilih")'><i class="fas fa-print"></i> Cetak Form Order</a>
                                        <?php endif; ?>
                                    <?php elseif ($s->status == 'ON PROGRESS') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'NOTE KEUANGAN') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block"><i class="fas fa-clock"></i> ON PROGRESS</a>
                                        </div>
                                    <?php elseif ($s->status == 'NOTE DIREKTUR') : ?>
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
                                    <?php elseif ($s->status == 'ON DELIVERY') : ?>
                                        <div>
                                            <a href="#" class="btn btn-warning btn-block status-order-badge" data-kdpo="<?= $s->kd_po ?>"><i class="fas fa-truck-moving"></i> ON DELIVERY</a>
                                        </div>
                                    <?php elseif ($s->status == 'ACC DIREKTUR') : ?>
                                        <div>
                                            <a href="#" class="btn btn-primary btn-block"><i class="fas fa-user-tie"></i> ACC DIREKTUR</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'ON PROGRESS' || $this->session->userdata('lv') == '3' && $s->status == 'PO REVISI' || $this->session->userdata('lv') == '3' && $s->status == 'NOTE DIREKTUR' || $this->session->userdata('lv') == '3' && $s->status == 'NOTE KEUANGAN' || $this->session->userdata('lv') == '3' && $s->status == 'UPDATE KEUANGAN') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Status Order : </label>
                                            <a href="<?= base_url('konfirmasiOrder/') . $s->kd_po . '/' . $this->session->userdata('kode') ?>" class="btn btn-block btn-success btn-md btn-konfirmasi" data-url="<?= base_url('konfirmasiOrder/') . $s->kd_po . '/' . $this->session->userdata('kode') ?>">
                                                <i class="fas fa-clipboard-check"></i>
                                                Accept
                                            </a>
                                        </div>
                                        <div class="col">
                                            <label for="tgTrans" class="">Status Order : </label>
                                            <a href="<?= base_url('tolakOrder/') . $s->kd_po . '/' . $this->session->userdata('kode') ?>" class="btn btn-block btn-danger btn-md btn-reject" data-url="<?= base_url('tolakOrder/') . $s->kd_po . '/' . $this->session->userdata('kode') ?>">
                                                <i class="fas fa-times"></i> Reject
                                            </a>
                                        </div>
                                    </div>

                                </div>
                                <div class="col">
                                    <label for="tgTrans" class="">Note Direktur : &nbsp;&nbsp; </label>
                                    <div>
                                        <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modalAddNote"><i class="fas fa-exclamation"> </i> &nbsp; Add Note</a>
                                    </div>
                                </div>

                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'DONE') : ?>
                                <div class="col">
                                    <label for="tgTrans" class="">Status Order :</label>
                                    <a class="btn btn-success btn-block"><i class="fas fa-thumbs-up"></i> PO - DONE</a>
                                </div>
                                <div class="col">
                                    <label for="tgTrans" class="">Status Order :</label hidden>
                                    <a class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalcancelpo<?= $s->id_po ?>"><i class="fas fa-times"></i> PO - CANCEL</a>
                                </div>

                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'REJECT') : ?>
                                <div class="col">
                                    <label for="tgTrans" class=""> Status Order :</label>
                                    <a class="btn btn-block btn-danger btn-md"><i class="fas fa-times"></i> PO - REJECT</a>
                                </div>

                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'ON DELIVERY') : ?>
                                <div class="col">
                                    <label for="tgTrans" class=""> Status Order :</label>
                                    <a class="btn btn-block btn-primary btn-md"><i class="fas fa-truck-moving"></i>ON - DELIVERY</a>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'ACC DIREKTUR') : ?>
                                <div class="col">
                                    <label for="tgTrans" class=""> Status Order :</label>
                                    <a class="btn btn-block btn-primary btn-md"><i class="fas fa-user-tie"></i> ACC DIREKTUR</a>
                                </div>

                            <?php endif; ?>
                            <?php if ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-primary btn-md" href="<?= base_url('unpostpo/') . $s->kd_po ?>">
                                                <i class="fas fa-sync"></i> &nbsp;
                                                UNPOST
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class=""> &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-warning btn-md" href="<?= base_url('hapuspo/') . $s->kd_po ?>">
                                                <i class="fas fa-trash"></i> &nbsp;
                                                HAPUS PO
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <div hidden>
                                                <input type="text" name="kd_lama" id="kd_lama" value="<?= $s->kd_po ?>">
                                                <input type="text" name="kdpoisi" id="kdpoisi" value="<?= $kdpo ?>">
                                                <input type="text" name="nopoisi" id="nopoisi" value="<?= $s->no_po ?>/REV">
                                                <input type="text" name="tgltisi" id="tgltisi" value="<?= date("Y-m-d") ?>">
                                                <input type="text" name="kdsupisi" id="kdsupisi" value="<?= $s->kd_suplier ?>">
                                                <input type="text" name="jmlitemisi" id="jmlitemisi" value="<?= $s->jml_item ?>">
                                                <input type="text" name="tothrgisi" id="tothrgisi" value="<?= $s->total_harga ?>">
                                                <input type="text" name="taxisi" id="taxisi" value="<?= $s->tax ?>">
                                                <input type="text" name="hrgpjkisi" id="hrgpjkisi" value="<?= $s->hrg_pajak ?>">
                                                <input type="text" name="tmpobayarisi" id="tmpobayarisi" value="<?= $s->tmpo_pembayaran ?>">
                                                <input type="text" name="gdgkirimisi" id="gdgkirimisi" value="<?= $s->gdg_pengiriman ?>">
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary btn-block" id="repost"><i class="fas fa-sync"></i>&nbsp;RE-POST</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'ON DELIVERY') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col konfirmasi-update-wrapper">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-success btn-md btn-onhand-po"
                                                href="#"
                                                data-kdpo="<?= $s->kd_po ?>"
                                                data-shipment="<?= htmlspecialchars((string) $s->kd_printout_note, ENT_QUOTES, 'UTF-8') ?>"
                                                data-url="<?= base_url('onhandpo_ajax') ?>">
                                                <i class="fas fa-clipboard-check"></i> &nbsp;
                                                ON HAND
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'ACC DIREKTUR') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-success btn-md" href="<?= base_url('poconfirmacc/') . $s->kd_po ?>">
                                                <i class="fas fa-clipboard-check"></i> &nbsp;
                                                PO CONFIRM
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'PO REVISI') : ?>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tgTrans" class="">Konfirmasi Update : &nbsp;&nbsp; </label>
                                            <a class="btn btn-block btn-primary btn-md" data-toggle="modal" data-target="#modalAddNoteRev">
                                                <i class="fas fa-clipboard-check"></i> &nbsp;
                                                Update
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status != 'DONE') : ?>
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
                            <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                            <?php endif; ?>
                            <div class="col">
                                <label for="historiDiskon" class="">Histori Diskon : &nbsp;&nbsp; </label>
                                <a class="btn btn-block btn-info btn-md" data-toggle="modal" data-target="#modalHistoriDiskon<?= $s->kd_po ?>">
                                    <i class="fas fa-history"></i> &nbsp;
                                    Histori Diskon
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('content/postatus/modal_setting/modalSetting') ?>
        <div class="modal fade" id="modalHistoriDiskon<?= $s->kd_po ?>">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Histori Diskon
                            <small class="text-muted d-block mt-1" style="font-size: 12px;">
                                Kode PO: <?= htmlspecialchars($s->kd_po, ENT_QUOTES, 'UTF-8') ?> | No PO: <?= htmlspecialchars($s->no_po, ENT_QUOTES, 'UTF-8') ?>
                            </small>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead style="background-color: #212529; color:white;">
                                    <tr>
                                        <td>No</td>
                                        <td>Tanggal PO</td>
                                        <td>Suplier</td>
                                        <td>Keterangan Diskon</td>
                                        <td>Nominal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($historiDiskon)) : ?>
                                        <?php $noHistoriDiskon = 1; ?>
                                        <?php foreach ($historiDiskon as $hd) : ?>
                                            <tr>
                                                <td><?= $noHistoriDiskon++; ?></td>
                                                <td><?= htmlspecialchars($hd->tgl_transaksi, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= htmlspecialchars($hd->nama_suplier, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td><?= htmlspecialchars($hd->keterangan, ENT_QUOTES, 'UTF-8') ?></td>
                                                <td>Rp. <?= number_format($hd->nominal, 2) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada histori diskon untuk kode PO ini.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($this->session->userdata('lv') < '3' && $s->status == 'ON DELIVERY') : ?>
            <div class="col-md mb-2">
                <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalshipment<?= $s->kd_po ?>">
                    <i class="fas fa-shipping-fast"> </i>
                    Shipment Setting
                </a>
            </div>
        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>
        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'CANCEL') : ?>
        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'ON PROGRESS' || $this->session->userdata('lv') == '2' &&  $s->status == 'PO REVISI') : ?>


            <div class="row">
                <div class="col-md mb-2">
                    <a class="btn btnAtas btn-sm btn-block" href="<?= base_url('addBarangRevisi/') . $s->kd_suplier . '/' . $s->kd_po ?>">
                        <i class="fas fa-plus"> </i>
                        Tambah Barang
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalTax<?= $s->kd_po ?>">
                        <i class="fas fa-percent"> </i>
                        Setting Tax
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalPembayaran<?= $s->kd_po ?> ">
                        <i class="fas fa-calendar-alt"> </i>
                        Syarat Pembayaran
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalPengiriman<?= $s->kd_po ?> ">
                        <i class="fas fa-truck"> </i>
                        Franko Pengiriman
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalDiskon<?= $s->kd_po ?>  ">
                        <i class="fas fa-tags"> </i>
                        Tambah Diskon
                    </a>
                </div>
                <div class="col-md">
                    <a class="btn btnAtas btn-sm btn-block" data-toggle="modal" data-target="#modalnotebarang<?= $s->kd_po ?>  ">
                        <i class="fas fa-notes-medical"> </i>
                        Tambah Note Barang
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <?php
                            $showAction = false;
                            if ($this->session->userdata('lv') < '3' && $s->status != 'DONE' && $s->status != 'REJECT' && $s->status != 'CANCEL' && $s->status != 'ACC DIREKTUR' && $s->status != 'ON DELIVERY') {
                                $showAction = true;
                            }
                            $allowEditDone = $this->session->userdata('lv') < '3' && $s->status == 'DONE';
                            $showDiskonAction = $this->session->userdata('lv') < '3' && $s->status != 'DONE' && $s->status != 'REJECT' && $s->status != 'CANCEL' && $s->status != 'ACC DIREKTUR' && $s->status != 'ON DELIVERY';
                            $showActionColumn = $showAction || $allowEditDone;
                            $totalColspan = 10 + ($showActionColumn ? 1 : 0);
                            $totalValueColspan = 2;
                            $totalLabelColspan = max($totalColspan - $totalValueColspan, 1);
        ?>
        <div class="table-responsive po-detail-table-wrap">
        <table class="table table-bordered table-striped po-detail-table">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td>No</td>
                    <td>Nama Barang</td>
                    <td>Satuan</td>
                    <td>Qty</td>
                    <td>Qty Kecil</td>
                    <td>Harga Satuan</td>
                    <td>Harga Satuan Kecil</td>
                    <td>Harga Diskon</td>
                    <td>Total Harga</td>
                    <td>Total Harga Setelah Diskon</td>
                    <?php if ($showActionColumn) : ?>
                        <td>#</td>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                            $totalHargaSetelahDiskon = 0;
                            foreach ($detail as $d) :
                                $isBonus = isset($d->is_bonus) && (int) $d->is_bonus === 1;
                                $hargaDiskon = $isBonus ? 0 : (isset($d->hrg_diskon) && $d->hrg_diskon > 0 ? $d->hrg_diskon : $d->hrg_satuan);
                                $totalSetelahDiskon = $isBonus ? 0 : (isset($d->hrg_total_diskon) && $d->hrg_total_diskon > 0 ? $d->hrg_total_diskon : $d->hrg_total);
                                $qtyKecil = isset($d->qty_kecil) && (float) $d->qty_kecil > 0 ? $d->qty_kecil : $d->qty;
                                $qtyKecilDisplay = ceil((float) $qtyKecil);
                                $hargaSatuanKecil = isset($d->harga_satuan_kecil) && ((float) $d->harga_satuan_kecil > 0 || $isBonus) ? $d->harga_satuan_kecil : $d->hrg_satuan;
                                $totalHargaSetelahDiskon += $totalSetelahDiskon;
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td class="col-item" title="<?= htmlspecialchars($d->nama_barang, ENT_QUOTES, 'UTF-8') ?>">
                            <?= $d->nama_barang ?>
                            <?php if ($isBonus) : ?>
                                <span class="badge badge-primary ml-1">BONUS</span>
                                <?php if (!empty($d->keterangan_bonus)) : ?>
                                    <div><small><?= $d->keterangan_bonus ?></small></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td><?= $d->satuan ?></td>
                        <td class="text-number"><?= $d->qty ?></td>
                        <td class="text-number"><?= number_format($qtyKecilDisplay, 0, ',', '.') ?></td>
                        <td class="text-number">Rp. <?= number_format($d->hrg_satuan, 2) ?></td>
                        <td class="text-number">Rp. <?= number_format($hargaSatuanKecil, 2) ?></td>
                        <td class="text-number">Rp. <?= number_format($hargaDiskon, 2) ?></td>
                        <td class="text-number">Rp. <?= number_format($d->hrg_total, 2) ?></td>
                        <td class="text-number">Rp. <?= number_format($totalSetelahDiskon, 2) ?></td>
                        <?php if ($showActionColumn) : ?>
                            <td>
                                <div class="action-cell">
                                    <a class="btn btn-success btn-sm btn-icon" data-toggle="modal" data-target="#modalEdit<?= $d->id_det_po ?>" title="Edit" aria-label="Edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <?php if ($showAction) : ?>
                                        <a class="btn btn-danger btn-sm btn-icon" href="<?= base_url('hapusBarangPO/') . $d->id_det_po . '/' . $d->kd_po ?>" title="Hapus" aria-label="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <?php if (!$isBonus) : ?>
                                            <a class="btn btn-sm btn-info btn-icon color-palette" data-toggle="modal" data-target="#diskonbarangs<?= $d->id_det_po ?>" title="Tambah Diskon" aria-label="Tambah Diskon">
                                                <i class="fas fa-percent"></i>
                                            </a>
                                            <a class="btn btn-sm bg-lightblue btn-icon color-palette" data-toggle="modal" data-target="#diskonbarang<?= $d->id_det_po ?>" title="Diskon Barang" aria-label="Diskon Barang">
                                                <i class="fas fa-tags"></i>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </td>

                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                <?php
                            $totalDiskonNominal = 0;
                            foreach ($totalDiskon as $td) {
                                $totalDiskonNominal = $td->total_diskon ?: 0;
                            }

                            $listDiskonPo = array();
                            foreach ($diskon as $diskonItem) {
                                $listDiskonPo[] = array(
                                    'keterangan' => $diskonItem->keterangan,
                                    'nominal' => $diskonItem->nominal,
                                    'id_diskon' => $diskonItem->id_diskon,
                                    'kd_po' => $diskonItem->kd_po,
                                    'is_bonus_item' => false,
                                );
                            }
                            foreach ($detail as $bonusItem) {
                                if (isset($bonusItem->is_bonus) && (int) $bonusItem->is_bonus === 1) {
                                    $listDiskonPo[] = array(
                                        'keterangan' => $bonusItem->nama_barang . ' - ' . (!empty($bonusItem->keterangan_bonus) ? $bonusItem->keterangan_bonus : 'Bonus'),
                                        'nominal' => 0,
                                        'id_diskon' => null,
                                        'kd_po' => $bonusItem->kd_po,
                                        'is_bonus_item' => true,
                                    );
                                }
                            }
                ?>
                <?php foreach ($total as $t) : ?>
                    <?php $totalHargaSetelahDiskonAll = max($t->total_harga - $totalDiskonNominal, 0); ?>
                    <tr>
                        <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Sebelum Diskon</td>
                        <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($t->total_harga) ?></td>
                    </tr>
                    <tr>
                        <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon</td>
                        <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($totalHargaSetelahDiskonAll) ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- TAMPILAN KEUANGAN TOTAL HARGA STATUS ON PROGRESS -->
                <?php if ($this->session->userdata('lv') == '2' && $s->status != 'DONE') : ?>
                    <tr>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                        <td colspan="2" style="font-weight: bold;"> <?= $s->tmpo_pembayaran ?> Hari </td>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                        <td colspan="<?= max($totalColspan - 6, 1) ?>" style="font-weight: bold;"> <?= $s->gdg_pengiriman ?> </td>
                    </tr>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
                    </tr>
                    <?php foreach ($listDiskonPo as $d) : ?>
                        <?php if (!empty($d['keterangan'])) : ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d['keterangan'] ?> : </td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">
                                    Rp. <?= number_format($d['nominal']) ?>
                                    <?php if ($showDiskonAction && !$d['is_bonus_item']) : ?>
                                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d['id_diskon'] ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskon/') . $d['id_diskon'] . '/' . $d['kd_po'] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
                    </tr>
                    <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = max($t->total_harga - $d->total_diskon, 0);
                                        $tax = $s->tax / 100;
                                        $hargaPajakTanpaDiskon = $t->total_harga * $tax;
                                        $hargaPajakDenganDiskon = $stlhDiskon * $tax;
                                        $hargaAllTanpaDiskon = $t->total_harga + $hargaPajakTanpaDiskon;
                                        $hargaAllDenganDiskon = $stlhDiskon + $hargaPajakDenganDiskon; ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Sebelum Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($t->total_harga) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Tanpa Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakTanpaDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Dengan Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakDenganDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Tanpa Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllTanpaDiskon) ?></td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Dengan Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllDenganDiskon) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <!-- TAMPILAN KEUANGAN TOTAL HARGA STATUS DONE -->
                <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'DONE') : ?>
                    <tr>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                        <td colspan="2" style="font-weight: bold;"><?= $s->tmpo_pembayaran ?> Hari</td>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                        <td colspan="<?= max($totalColspan - 6, 1) ?>" style="font-weight: bold;"><?= $s->gdg_pengiriman ?></td>
                    </tr>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
                    </tr>
                    <?php foreach ($listDiskonPo as $d) : ?>
                        <?php if (!empty($d['keterangan'])) : ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d['keterangan'] ?> : </td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">
                                    Rp. <?= number_format($d['nominal']) ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
                    </tr>
                    <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = max($t->total_harga - $d->total_diskon, 0);
                                        $tax = $s->tax / 100;
                                        $hargaPajakTanpaDiskon = $t->total_harga * $tax;
                                        $hargaPajakDenganDiskon = $stlhDiskon * $tax;
                                        $hargaAllTanpaDiskon = $t->total_harga + $hargaPajakTanpaDiskon;
                                        $hargaAllDenganDiskon = $stlhDiskon + $hargaPajakDenganDiskon; ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Sebelum Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($t->total_harga) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Tanpa Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakTanpaDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Dengan Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakDenganDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Tanpa Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllTanpaDiskon) ?></td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Dengan Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllDenganDiskon) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <!-- TAMPILAN DIREKTUR TOTAL HARGA STATUS BELUM DONE -->
                <?php elseif ($this->session->userdata('lv') == '3' && $s->status != 'DONE') : ?>
                    <tr>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                        <td colspan="2" style="font-weight: bold;"> <?= $s->tmpo_pembayaran ?> Hari </td>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                        <td colspan="<?= max($totalColspan - 6, 1) ?>" style="font-weight: bold;"> <?= $s->gdg_pengiriman ?> </td>
                    </tr>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
                    </tr>
                    <?php foreach ($listDiskonPo as $d) : ?>
                        <?php if (!empty($d['keterangan'])) : ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d['keterangan'] ?> : </td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">
                                    Rp. <?= number_format($d['nominal']) ?>
                                    <?php if ($this->session->userdata('lv') != '3' && !$d['is_bonus_item']) : ?>
                                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d['id_diskon'] ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskon/') . $d['id_diskon'] . '/' . $d['kd_po'] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
                    </tr>
                    <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = max($t->total_harga - $d->total_diskon, 0);
                                        $tax = $s->tax / 100;
                                        $hargaPajakTanpaDiskon = $t->total_harga * $tax;
                                        $hargaPajakDenganDiskon = $stlhDiskon * $tax;
                                        $hargaAllTanpaDiskon = $t->total_harga + $hargaPajakTanpaDiskon;
                                        $hargaAllDenganDiskon = $stlhDiskon + $hargaPajakDenganDiskon; ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Sebelum Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($t->total_harga) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Tanpa Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakTanpaDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Dengan Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakDenganDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Tanpa Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllTanpaDiskon) ?></td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Dengan Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllDenganDiskon) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <!-- TAMPILAN DIREKTUR TOTAL HARGA STATUS DONE -->
                <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'DONE') : ?>
                    <tr>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Syarat Pembayaran : </td>
                        <td colspan="2" style="font-weight: bold;"> <?= $s->tmpo_pembayaran ?> Hari </td>
                        <td colspan="2" style="text-align: end; padding-right:3%; font-weight: bold;"> Franko Pengiriman : </td>
                        <td colspan="<?= max($totalColspan - 6, 1) ?>" style="font-weight: bold;"> <?= $s->gdg_pengiriman ?> </td>
                    </tr>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">LIST DISKON</td>
                    </tr>
                    <?php foreach ($listDiskonPo as $d) : ?>
                        <?php if (!empty($d['keterangan'])) : ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;"><?= $d['keterangan'] ?> : </td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">
                                    Rp. <?= number_format($d['nominal'], 2) ?>
                                    <?php if ($this->session->userdata('lv') != '3' && !$d['is_bonus_item']) : ?>
                                        <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalDiskonEdit<?= $d['id_diskon'] ?>">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="<?= base_url('hapusDiskon/') . $d['id_diskon'] . '/' . $d['kd_po'] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="<?= $totalColspan ?>" class="bg-black color-palette" style="text-align: center;">TOTAL HARGA</td>
                    </tr>
                    <?php foreach ($total as $t) :
                                    foreach ($totalDiskon as $d) :
                                        $stlhDiskon = max($t->total_harga - $d->total_diskon, 0);
                                        $tax = $s->tax / 100;
                                        $hargaPajakTanpaDiskon = $t->total_harga * $tax;
                                        $hargaPajakDenganDiskon = $stlhDiskon * $tax;
                                        $hargaAllTanpaDiskon = $t->total_harga + $hargaPajakTanpaDiskon;
                                        $hargaAllDenganDiskon = $stlhDiskon + $hargaPajakDenganDiskon; ?>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Sebelum Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($t->total_harga) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Total Harga Setelah Diskon :</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp.<?= number_format($stlhDiskon) ?> </td>
                            </tr>

                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Tanpa Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakTanpaDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Tax Dengan Diskon : <?= $s->tax ?>(%)</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;"> Rp. <?= number_format($hargaPajakDenganDiskon) ?> </td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Tanpa Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllTanpaDiskon) ?></td>
                            </tr>
                            <tr>
                                <td colspan="<?= $totalLabelColspan ?>" style="text-align: end; padding-right:3%; font-weight: bold;">Grand Total Harga Dengan Diskon</td>
                                <td colspan="<?= $totalValueColspan ?>" style="font-weight: bold;">Rp. <?= number_format($hargaAllDenganDiskon) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        </div>
        <table class="table table-bordered table-striped ">
            <thead style="background-color: #212529; color:white;">
                <tr>
                    <td>Note Untuk Suplier</td>
                    <?php if ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>
                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'CANCEL') : ?>
                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'ACC DIREKTUR') : ?>
                    <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'ON DELIVERY') : ?>
                    <?php elseif ($this->session->userdata('lv') == '2' && $s->status != 'DONE') : ?>
                        <td>#</td>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notebarang as $n) : ?>
                    <tr>
                        <td>
                            <?= $n->isi_note ?>
                        </td>
                        <?php if ($this->session->userdata('lv') < '3' && $s->status == 'DONE') : ?>
                        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'REJECT') : ?>
                        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'CANCEL') : ?>
                        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'ACC DIREKTUR') : ?>
                        <?php elseif ($this->session->userdata('lv') < '3' && $s->status == 'ON DELIVERY') : ?>
                        <?php elseif ($this->session->userdata('lv') == '2' && $s->status != 'DONE') : ?>
                            <td>
                                <a class="btn  btn-success btn-sm" data-toggle="modal" data-target="#modalnotebarangedit<?= $n->id_nt_barang ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalnotebaranghapus<?= $n->id_nt_barang ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        <?php elseif ($this->session->userdata('lv') == '2' && $s->status == 'DONE') : ?>

                        <?php elseif ($this->session->userdata('lv') == '3' && $s->status == 'DONE') : ?>

                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row ml-2 mr-2">
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
                            <?php foreach ($noted as $n) : ?>
                                <tr>
                                    <td class="tdnote"><?= $n->isi_note ?></td>
                                    <td class="tduser"><?= $n->nama_user ?></td>
                                    <td style="text-align: center;"><?= $n->log_create ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php if ($this->session->userdata('lv') != '3') : ?>
            <div class="row ml-2 mr-2">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead style="background-color: #212529; color:white;">
                            <tr>
                                <td>User</td>
                                <td>Aktivitas</td>
                                <td>Data Lama</td>
                                <td>Data Baru</td>
                                <td>Waktu</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($log)) : ?>
                                <?php foreach ($log as $l) : ?>
                                    <tr>
                                        <td><?= isset($l->user_log) && $l->user_log != '' ? $l->user_log : '-' ?></td>
                                        <td><?= isset($l->status) ? $l->status : '-' ?></td>
                                        <td><small><?= isset($l->data_lama) && $l->data_lama != '' ? $l->data_lama : '-' ?></small></td>
                                        <td><small><?= isset($l->data_baru) && $l->data_baru != '' ? $l->data_baru : '-' ?></small></td>
                                        <td><?= isset($l->createat) ? $l->createat : '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada activity log.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <!-- /.content-header -->

</div>
<?php endforeach; ?>
