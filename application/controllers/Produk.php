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

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('produk/index', $data);
    $this->load->view('templates/footer');
  }

}