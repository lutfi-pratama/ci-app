<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller 
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('menu_model');
  }

  public function index ()
  {
    $data['title'] = "Product Management";
    $data['produk'] = $this->menu_model->showProductList();
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['jenis'] = $this->db->get('produk_jenis')->result_array();
    $data['kategori'] = $this->db->get('produk_kategori')->result_array();

    $this->form_validation->set_rules('produk', 'Produk', 'required');

    if($this->form_validation->run() == false){
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('produk/index', $data);
      $this->load->view('templates/footer');
    } else {
        $this->menu_model->addProduk();
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            New produk successfull added!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        ');

        redirect('produk');
    }
  }

  public function delete($id)
  {
      $this->menu_model->deleteProduk($id);
      $this->session->set_flashdata('message', '
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Data produk has been deleted!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
      ');
      redirect('produk');
  }

}