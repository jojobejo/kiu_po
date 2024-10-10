<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class M_Stockkomersil extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->get('tb_user')->result();
    }

    public function addUser($data)
    {
        return $this->db->insert('tb_user', $data);
    }

    public function editUser($iduser, $data)
    {
        $this->db->where('id_user', $iduser);
        return $this->db->update('tb_user', $data);
    }
    public function getdetbr($id)
    {
        return $this->db->query("SELECT
        b.nama_suplier AS nmsup,
        a.kode_barang AS kdbarang,
        a.nama_barang AS nmbarang,
        C.nm_satuan AS qtysatuan,
        a.qty_min AS qtymin
        FROM tb_barang a
        JOIN tb_suplier b ON b.kd_suplier = a.kd_suplier
        JOIN tb_satuan c ON c.id_satuan = a.satuan_qty
        WHERE a.id_barang = '$id'
        ");
    }

    public function getdetbrkd($id)
    {
        return $this->db->query("SELECT
        a.*,
        b.id_barang,
        b.nama_barang,
        b.qty_min,
        b.qty_all,
        c.nama_suplier,
        d.nm_satuan,
        e.no_po,
        f.nama_user
        FROM tb_transaksi a
        JOIN tb_barang b ON b.kode_barang = a.kd_barang
        JOIN tb_suplier c ON c.kd_suplier = b.kd_suplier
        JOIN tb_satuan d ON d.id_satuan = b.satuan_qty
        JOIN tb_po e ON e.kd_po =a.kd_po_nk
        JOIN tb_user f ON f.kode_user = a.inputer 
        WHERE a.kd_akun = '11411' AND a.kd_barang = '$id'
        ");
    }

    var $table = 'v_brgkomersil';
    var $column_order = array('kdbarang', 'nmsup', 'nm_barang', 'satuan', 'qty', 'qty_min', 'idbrg');
    var $column_search = array('nmsup', 'nm_barang');
    var $order = array('nm_barang' => 'asc');

    private function _get_datatables_query()
    {

        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
