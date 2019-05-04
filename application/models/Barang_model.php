<?php defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    private $_table = "barang";

    public $id_barang;
    public $nama_barang;
    public $stok;

    public function rules()
    {
        return [
            ['field' => 'nama_barang',
            'label' => 'Name Barang',
            'rules' => 'required'],

            ['field' => 'stok',
            'label' => 'stok',
            'rules' => 'numeric']
        ];
    }

    // public function view(){
    //     $this->load->library('pagination');
    //     $query = "SELECT * FROM barang";
    //     $config['base_url'] = base_url('http://localhost/UCI/BarangController');
    //     $config['total_rows'] = $this->db->query($query)->num_rows();
    //     $config['per_page'] = 5;
    //     $config['uri_segment'] = 3;
    //     $config['num_links'] = 3;

    //     $config['full_tag_open']   = '<ul class="pagination pagination-sm m-t-xs m-b-xs">';
    //     $config['full_tag_close']  = '</ul>';
        
    //     $config['first_link']      = 'First'; 
    //     $config['first_tag_open']  = '<li>';
    //     $config['first_tag_close'] = '</li>';
        
    //     $config['last_link']       = 'Last'; 
    //     $config['last_tag_open']   = '<li>';
    //     $config['last_tag_close']  = '</li>';
        
    //     $config['next_link']       = ' <i class="glyphicon glyphicon-menu-right"></i> '; 
    //     $config['next_tag_open']   = '<li>';
    //     $config['next_tag_close']  = '</li>';
        
    //     $config['prev_link']       = ' <i class="glyphicon glyphicon-menu-left"></i> '; 
    //     $config['prev_tag_open']   = '<li>';
    //     $config['prev_tag_close']  = '</li>';
        
    //     $config['cur_tag_open']    = '<li class="active"><a href="#">';
    //     $config['cur_tag_close']   = '</a></li>';
         
    //     $config['num_tag_open']    = '<li>';
    //     $config['num_tag_close']   = '</li>';

    //     $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
    //     $query .= " LIMIT ".$page.", ".$config['per_page'];
    //     $this->pagination->initialize($config);

    //     $data['limit'] = $config['per_page'];
    //     $data['total_rows'] = $config['total_rows'];
    //     $data['pagination'] = $this->pagination->create_links();

    //     $data['barang'] = $this->db->query($query)->result();
    // }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id_barang" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nama_barang = $post["nama_barang"];
        $this->stok = $post["stok"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_barang = $post["id"];
        $this->nama_barang = $post["nama_barang"];
        $this->stok = $post["stok"];
        $this->db->update($this->_table, $this, array('id_barang' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_barang" => $id));
    }
}