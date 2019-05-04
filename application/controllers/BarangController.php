<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BarangController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("barang_model");
        $this->load->library('form_validation');
    }
    
    public function index()
    {
         $data["barang"] = $this->barang_model->getAll();
         $this->load->view("barang/list_barang", $data);
    }

    // public function index(){
    //     $data['model'] = $this->Barang_model->view();
        
    //     $this->load->view('barang/list_barang', $data);
    //   }
    
    public function add()
    {
        $barang = $this->barang_model;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());

        if ($validation->run()) {
            $barang->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("barang/add_barang", $barang);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('barang/edit_barang');
       
        $barang = $this->barang_model;
        $validation = $this->form_validation;
        $validation->set_rules($barang->rules());

        if ($validation->run()) {
            $barang->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $barang->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("barang/edit_barang", $data);
    }

    public function delete($id)
    {   
        $delete = $this->barang_model->delete($id);
        if ($delete) {
            redirect($this->load->view('barang/list_barang'));
        }
    }
}