<?php

class invoice_model extends CI_Model 
{
    public function insertData()
    {
      date_default_timezone_set('Asia/Jakarta');

      $metode = $this->input->post('metode');

      $user['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

      $invoice = [
        'user' => $user['user']['name'],
        'pembayaran' => $metode,
        'tgl_bayar' => date('Y-m-d H:i:s'),
      ];

      $this->db->insert('invoice', $invoice);

      $id_invoice = $this->db->insert_id();

      foreach ($this->cart->contents() as $item){
        $data = [
          'id_invoice' => $id_invoice,
          'id_produk' => $item['id'],
          'nama' => $item['name'],
          'jumlah' => $item['qty'],
          'harga' => $item['price'], 
        ];

        $this->db->insert('pembelian', $data);
      }

      return true;
    }

    public function showData()
    {
      $result = $this->db->get('invoice');

      if($result->num_rows() > 0){
        return $result->result_array();
      }else {
        return false;
      }
    }

    public function getIdInvoice($id)
    {
      $result = $this->db->where('id', $id)->limit(1)->get('invoice');

      if($result->num_rows() > 0){
        return $result->row();
      }else {
        return false;
      }
    }

    public function getIdPembelian($id)
    {
      $result = $this->db->where('id_invoice', $id)->get('pembelian');

      if($result->num_rows() > 0){
        return $result->result();
      }else {
        return false;
      }
    }
}