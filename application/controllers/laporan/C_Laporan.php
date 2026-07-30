<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 */
class C_Laporan extends CI_Controller

{


    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/M_Laporanp');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data['title'] = 'Laporan Cost PO NK Per PIC';
        $tglstart = $this->input->get_post('tglstart') ?: date('Y-m-01');
        $tglend = $this->input->get_post('tglend') ?: date('Y-m-d');
        $pic_filter = $this->get_cost_pic_filter($this->input->get_post('kdpic'));
        $kdpic = $pic_filter['kdpic'];
        $data['tanggal_error'] = '';

        if (!$this->is_valid_date_export($tglstart) || !$this->is_valid_date_export($tglend)) {
            $tglstart = date('Y-m-01');
            $tglend = date('Y-m-d');
            $data['tanggal_error'] = 'Format tanggal tidak valid. Filter dikembalikan ke bulan berjalan.';
        }

        if ($tglstart > $tglend) {
            $tanggal_temp = $tglstart;
            $tglstart = $tglend;
            $tglend = $tanggal_temp;
            $data['tanggal_error'] = 'Tanggal start lebih besar dari tanggal end. Rentang tanggal otomatis disesuaikan.';
        }

        $pic_options = $this->M_Laporanp->getpicfiltercostponk()->result();
        $selected_pic_label = 'Semua PIC';

        foreach ($pic_options as $pic) {
            if ($pic->kd_user === $kdpic) {
                $selected_pic_label = $pic->nama_user;
                break;
            }
        }

        if ($pic_filter['is_pic_report']) {
            $selected_pic_label = $this->session->userdata('nama_user') ?: $selected_pic_label;
        }

        $summary = $this->M_Laporanp->getcostpicponk($tglstart, $tglend, $kdpic)->result();
        $detail = $this->M_Laporanp->getdetailcostpicponk($tglstart, $tglend, $kdpic)->result();

        $data['tglstart'] = $tglstart;
        $data['tglend'] = $tglend;
        $data['kdpic'] = $kdpic;
        $data['pic_options'] = $pic_options;
        $data['selected_pic_label'] = $selected_pic_label;
        $data['is_pic_report'] = $pic_filter['is_pic_report'];
        $data['summary_cost_pic'] = $summary;
        $data['detail_cost_pic'] = $detail;
        $data['grand_total_cost'] = 0;
        $data['grand_total_cost_nyata'] = 0;
        $data['grand_total_po'] = 0;
        $data['grand_total_item'] = 0;
        $po_keys = array();

        foreach ($summary as $row) {
            $data['grand_total_cost'] += (float) $row->total_cost;
            $data['grand_total_cost_nyata'] += (float) $row->total_cost_nyata;
            $data['grand_total_item'] += (int) $row->total_item;
        }

        foreach ($detail as $row) {
            $po_keys[$row->kd_po_nk] = true;
        }

        $data['grand_total_po'] = count($po_keys);

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/laporan/lap_cost_pic_ponk', $data);
        $this->load->view('partial/footer');
    }
    public function srclapbeli()
    {
        $data['title']  = 'Laporan Pembelian';

        $tglstart   = $this->input->post('tglstart');
        $tglend     = $this->input->post('tglend');
        $_SESSION['vartgl1'] = $tglstart;
        $_SESSION['vartgl2'] = $tglend;

        $vartgl1           = $_SESSION['vartgl1'];
        $vartgl2            = $_SESSION['vartgl2'];
        $data['vcari']      = $this->M_Laporanp->getdaterangelap($vartgl1, $vartgl2)->result();
        $data['vartgl1']    = $vartgl1;
        $data['vartgl2']    = $vartgl2;

        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/laporan/srclaporan', $data);
        $this->load->view('partial/footer');
    }

    public function export_cost_pic_ponk()
    {
        error_reporting(error_reporting() & ~E_DEPRECATED & ~E_USER_DEPRECATED);
        require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $tglstart = $this->input->get('tglstart') ?: date('Y-m-01');
        $tglend = $this->input->get('tglend') ?: date('Y-m-d');
        $pic_filter = $this->get_cost_pic_filter($this->input->get('kdpic'));
        $kdpic = $pic_filter['kdpic'];

        if (!$this->is_valid_date_export($tglstart) || !$this->is_valid_date_export($tglend)) {
            show_error('Tanggal harus diisi dengan format YYYY-MM-DD.', 400);
            return;
        }

        if ($tglstart > $tglend) {
            $tanggal_temp = $tglstart;
            $tglstart = $tglend;
            $tglend = $tanggal_temp;
        }

        $pic_options = $this->M_Laporanp->getpicfiltercostponk()->result();
        $selected_pic_label = 'Semua PIC';

        foreach ($pic_options as $pic) {
            if ($pic->kd_user === $kdpic) {
                $selected_pic_label = $pic->nama_user;
                break;
            }
        }

        if ($pic_filter['is_pic_report']) {
            $selected_pic_label = $this->session->userdata('nama_user') ?: $selected_pic_label;
        }

        $summary = $this->M_Laporanp->getcostpicponk($tglstart, $tglend, $kdpic)->result();
        $detail = $this->M_Laporanp->getdetailcostpicponk($tglstart, $tglend, $kdpic)->result();

        $excel = new PHPExcel();
        $excel->getProperties()
            ->setCreator('it_karisma')
            ->setLastModifiedBy('it_karisma')
            ->setTitle('Laporan Cost PO NK Per PIC')
            ->setSubject('Laporan Non Komersil')
            ->setDescription('Laporan Cost Purchase Order Non Komersil Per PIC');

        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet();
        $sheet->setTitle('Cost PIC PO NK');

        $style_title = array(
            'font' => array('bold' => true, 'size' => 14),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            )
        );

        $style_header = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'D9EAD3')
            ),
            'borders' => array(
                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'Ringkasan Cost - ' . $selected_pic_label);
        $sheet->getStyle('A1')->applyFromArray($style_title);
        $sheet->setCellValue('A2', 'Periode: ' . $tglstart . ' s/d ' . $tglend);

        $summary_header_row = 4;
        $sheet->setCellValue('A' . $summary_header_row, 'NO');
        $sheet->setCellValue('B' . $summary_header_row, 'PIC');
        $sheet->setCellValue('C' . $summary_header_row, 'Departemen');
        $sheet->setCellValue('D' . $summary_header_row, 'Total PO');
        $sheet->setCellValue('E' . $summary_header_row, 'Total Item');
        $sheet->setCellValue('F' . $summary_header_row, 'Total Qty');
        $sheet->setCellValue('G' . $summary_header_row, 'Total Qty Nyata');
        $sheet->setCellValue('H' . $summary_header_row, 'Total Cost');
        $sheet->setCellValue('I' . $summary_header_row, 'Total Cost Nyata');
        $sheet->getStyle('A' . $summary_header_row . ':I' . $summary_header_row)->applyFromArray($style_header);

        $row = $summary_header_row + 1;
        $no = 1;
        $grand_total_summary = 0;
        $grand_total_summary_nyata = 0;

        foreach ($summary as $data) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $data->nama_user);
            $sheet->setCellValue('C' . $row, $data->departement);
            $sheet->setCellValue('D' . $row, (int) $data->total_po);
            $sheet->setCellValue('E' . $row, (int) $data->total_item);
            $sheet->setCellValue('F' . $row, (float) $data->total_qty);
            $sheet->setCellValue('G' . $row, (float) $data->total_qty_nyata);
            $sheet->setCellValue('H' . $row, (float) $data->total_cost);
            $sheet->setCellValue('I' . $row, (float) $data->total_cost_nyata);
            $grand_total_summary += (float) $data->total_cost;
            $grand_total_summary_nyata += (float) $data->total_cost_nyata;
            $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray($style_row);
            $sheet->getStyle('H' . $row . ':I' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $row++;
        }

        if (empty($summary)) {
            $sheet->mergeCells('A' . $row . ':I' . $row);
            $sheet->setCellValue('A' . $row, 'Data ringkasan tidak ditemukan.');
            $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray($style_row);
            $row++;
        }

        $sheet->mergeCells('A' . $row . ':G' . $row);
        $sheet->setCellValue('A' . $row, 'Grandtotal');
        $sheet->setCellValue('H' . $row, $grand_total_summary);
        $sheet->setCellValue('I' . $row, $grand_total_summary_nyata);
        $sheet->getStyle('A' . $row . ':I' . $row)->applyFromArray($style_header);
        $sheet->getStyle('H' . $row . ':I' . $row)->getNumberFormat()->setFormatCode('#,##0');
        $row++;

        $detail_title_row = $row + 3;
        $sheet->mergeCells('A' . $detail_title_row . ':N' . $detail_title_row);
        $sheet->setCellValue('A' . $detail_title_row, 'Detail Cost - ' . $selected_pic_label);
        $sheet->getStyle('A' . $detail_title_row)->applyFromArray($style_title);

        $detail_header_row = $detail_title_row + 2;
        $sheet->setCellValue('A' . $detail_header_row, 'NO');
        $sheet->setCellValue('B' . $detail_header_row, 'NOPO');
        $sheet->setCellValue('C' . $detail_header_row, 'Tanggal');
        $sheet->setCellValue('D' . $detail_header_row, 'PIC');
        $sheet->setCellValue('E' . $detail_header_row, 'Departemen');
        $sheet->setCellValue('F' . $detail_header_row, 'Tujuan Pembelian');
        $sheet->setCellValue('G' . $detail_header_row, 'Nama Barang');
        $sheet->setCellValue('H' . $detail_header_row, 'Deskripsi');
        $sheet->setCellValue('I' . $detail_header_row, 'Qty');
        $sheet->setCellValue('J' . $detail_header_row, 'Qty Nyata');
        $sheet->setCellValue('K' . $detail_header_row, 'Harga Satuan');
        $sheet->setCellValue('L' . $detail_header_row, 'Harga Nyata');
        $sheet->setCellValue('M' . $detail_header_row, 'Total Cost');
        $sheet->setCellValue('N' . $detail_header_row, 'Total Nyata');
        $sheet->getStyle('A' . $detail_header_row . ':N' . $detail_header_row)->applyFromArray($style_header);

        $row = $detail_header_row + 1;
        $no = 1;

        foreach ($detail as $data) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $data->nopo);
            $sheet->setCellValue('C' . $row, $data->tgl_transaksi);
            $sheet->setCellValue('D' . $row, $data->nama_user);
            $sheet->setCellValue('E' . $row, $data->departement);
            $sheet->setCellValue('F' . $row, $data->tj_pembelian);
            $sheet->setCellValue('G' . $row, $data->nama_barang);
            $sheet->setCellValue('H' . $row, $data->deskripsi);
            $sheet->setCellValue('I' . $row, (float) $data->qty);
            $sheet->setCellValue('J' . $row, (float) $data->qty_nyata);
            $sheet->setCellValue('K' . $row, (float) $data->hrg_satuan);
            $sheet->setCellValue('L' . $row, (float) $data->hrg_nyata);
            $sheet->setCellValue('M' . $row, (float) $data->total_harga);
            $sheet->setCellValue('N' . $row, (float) $data->total_nyata);
            $sheet->getStyle('A' . $row . ':N' . $row)->applyFromArray($style_row);
            $sheet->getStyle('K' . $row . ':N' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $row++;
        }

        if (empty($detail)) {
            $sheet->mergeCells('A' . $row . ':N' . $row);
            $sheet->setCellValue('A' . $row, 'Data detail tidak ditemukan.');
            $sheet->getStyle('A' . $row . ':N' . $row)->applyFromArray($style_row);
        }

        foreach (range('A', 'N') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $sheet->getStyle('A1:N' . $row)->getAlignment()->setWrapText(true);
        $sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setFitToWidth(1);

        $filename_pic = preg_replace('/[^A-Za-z0-9_-]+/', '_', $selected_pic_label);
        $filename = 'Laporan_Cost_PO_NK_' . $filename_pic . '_' . $tglstart . '_to_' . $tglend . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        while (ob_get_level() > 0 && @ob_end_clean()) {
            // Bersihkan semua output sebelum stream Excel dikirim.
        }

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    private function get_cost_pic_filter($requested_kdpic)
    {
        $is_pic_report = ((string) $this->session->userdata('lv') === '4');
        $session_kdpic = trim((string) $this->session->userdata('kode'));
        $kdpic = trim((string) $requested_kdpic);

        if ($is_pic_report) {
            $kdpic = $session_kdpic;
        }

        return array(
            'kdpic' => $kdpic,
            'is_pic_report' => $is_pic_report
        );
    }

    public function export_laporan_pembelian_nk()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('it_karisma')
            ->setTitle("Rekap Laporan Pembelian non komersil")
            ->setSubject("Laporan Non Komersil")
            ->setDescription("Laporan Pembelian")
            ->setKeywords("Laporan Pembelian Non Komersil");

        $style_col = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekap Laporan Pembelian Non Komersil");
        $excel->getActiveSheet()->mergeCells('A1:J1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Nomor PO");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Tanggal Transaksi");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "PIC");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Departemen");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Nama Barang");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Deskripsi");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "QTY");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "Harga Satuan");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "Total Harga");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);

        $vartgl1           = $_SESSION['vartgl1'];
        $vartgl2            = $_SESSION['vartgl2'];
        $data['vartgl1']    = $vartgl1;
        $data['vartgl2']    = $vartgl2;

        $export = $this->M_Laporanp->getdaterangelap($vartgl1, $vartgl2)->result();
        $vartglexcel1 = date_indo($vartgl1);
        $vartglexcel2 = date_indo($vartgl2);


        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nopo);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->tgl_transaksi);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->nama_user);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->departement);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->nama_barang);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->deskripsi);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->qty);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->hrg_satuan);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->total_harga);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(70);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(70);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("lap_" . $vartglexcel1 . "_" . $vartglexcel2);
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="lap_beli_po_nonkomersil.xlsx"');
        header('Cache-Control: max-age=0');


        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_end_clean();
        $write->save('php://output');
    }

    public function exported_allstock()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('it_karisma')
            ->setLastModifiedBy('it_karisma')
            ->setTitle("Stock Ready non komersil")
            ->setSubject("Laporan Non Komersil")
            ->setDescription("Laporan Stock")
            ->setKeywords("Laporan Stock Non Komersil");

        $style_col = array(
            'font' => array('bold' => true),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Stock Non Komersil");
        $excel->getActiveSheet()->mergeCells('A1:G1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "Kode Barang");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Barang");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "Deskripsi");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "Stock");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "Satuan");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "Lokasi");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);

        $export = $this->M_Laporanp->v_stock();

        $no = 1;
        $numrow = 4;
        foreach ($export as $data) {
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->kode_barangs);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nama_barang);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->deskripsi);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, $data->qty_ready);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $data->satuan);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->nama_lokasi);
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet(0)->setTitle("lap_" . $vartglexcel1 . "_" . $vartglexcel2);
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="lap_stock_po_nonkomersil.xlsx"');
        header('Cache-Control: max-age=0');


        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_end_clean();
        $write->save('php://output');
    }

    public function tr_allstock()
    {
        $data['title'] = 'Laporan Transaksi All Barang';
        $this->load->view('partial/header', $data);
        $this->load->view('partial/sidebar');
        $this->load->view('content/laporan/histori_stock_all_ponk', $data); // view dengan form dan tabel
        $this->load->view('partial/footer');
    }
    public function get_allstock_ajax()
    {
        $tglstart = $this->input->post('tglstart');
        $tglend = $this->input->post('tglend');

        $result = $this->M_Laporanp->getdaterangelaptr($tglstart, $tglend)->result();

        $data = [];
        $no = 1;
        foreach ($result as $row) {
            $data[] = [
                $no++,
                $row->tgl_transaksi,
                $row->departement,
                $row->nama_barang,
                $row->keterangan,
                $row->qty,
                $row->jn_transaksi,
            ];
        }

        echo json_encode(['data' => $data]);
    }
    public function exported_tr_allnk()
    {
        require_once APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $tgl1 = $this->input->get('tglstart');
        $tgl2 = $this->input->get('tglend');

        if (!$tgl1 || !$tgl2 || !$this->is_valid_date_export($tgl1) || !$this->is_valid_date_export($tgl2)) {
            show_error('Tanggal harus diisi dengan format YYYY-MM-DD.', 400);
            return;
        }

        $export = $this->M_Laporanp->getdaterangelaptr($tgl1, $tgl2)->result();

        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('Aplikasi Laporan')
            ->setTitle('Rekap Laporan Transaksi Non Komersil');

        $excel->setActiveSheetIndex(0);
        $sheet = $excel->getActiveSheet()->setTitle('Laporan');

        // Header
        $sheet->setCellValue('A1', 'Rekap Laporan Transaksi Non Komersil');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Table headers
        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'Kode PO');
        $sheet->setCellValue('C3', 'Tanggal Transaksi');
        $sheet->setCellValue('D3', 'Nama Inputer');
        $sheet->setCellValue('E3', 'PIC');
        $sheet->setCellValue('F3', 'Departemen');
        $sheet->setCellValue('G3', 'Nama Barang');
        $sheet->setCellValue('H3', 'Keterangan');
        $sheet->setCellValue('I3', 'Qty');
        $sheet->setCellValue('J3', 'Jenis Transaksi');

        $no = 1;
        $row = 4;

        foreach ($export as $data) {
            $jenis = '';

            switch ($data->jn_transaksi) {
                case '11512':
                    $jenis = 'Pengurangan Barang';
                    break;
                case '11511':
                    $jenis = 'Penambahan Barang';
                    break;
                case '11513':
                    $jenis = 'Adjustmen Stock(+)';
                    break;
                case '11514':
                    $jenis = 'Adjustmen Stock(-)';
                    break;
                default:
                    $jenis = 'Lainnya';
                    break;
            }

            // Cek jika kosong/null, isi dengan "-"
            $departemen = (!empty($data->departement)) ? $data->departement : '-';
            $inputer    = (!empty($data->inputer)) ? $data->inputer : '-';
            $nama_user  = (!empty($data->nama_user)) ? $data->nama_user : '-';

            $sheet->setCellValue("A$row", $no++);
            $sheet->setCellValue("B$row", $data->kdpo);
            $sheet->setCellValue("C$row", $data->tgl_transaksi);
            $sheet->setCellValue("D$row", $inputer);
            $sheet->setCellValue("E$row", $nama_user);
            $sheet->setCellValue("F$row", $departemen);
            $sheet->setCellValue("G$row", $data->nama_barang);
            $sheet->setCellValue("H$row", $data->keterangan);
            $sheet->setCellValue("I$row", $data->qty);
            $sheet->setCellValue("J$row", $jenis);

            $row++;
        }


        // Style borders
        $styleArray = [
            'borders' => [
                'allborders' => [
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ];
        $sheet->getStyle("A3:J" . ($row - 1))->applyFromArray($styleArray);
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(30);
        $sheet->getColumnDimension('I')->setWidth(6);
        $sheet->getColumnDimension('J')->setWidth(20);

        // Download
        $filename = 'Laporan_Transaksi_NonKomersil_' . $tgl1 . '_to_' . $tgl2 . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        while (ob_get_level() > 0 && @ob_end_clean()) {
            // Bersihkan semua output sebelum stream Excel dikirim.
        }

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    private function is_valid_date_export($date)
    {
        $parsed = DateTime::createFromFormat('Y-m-d', $date);

        return $parsed && $parsed->format('Y-m-d') === $date;
    }
}
