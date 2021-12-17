<?php

class menu_model extends CI_Model 
{
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu` FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";

        return $this->db->query($query)->result_array();
    }

    public function getMenubyID($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function addMenu()
    {   
        $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);

        $max_id = $this->db->query("SELECT MAX(id) FROM user_menu")->result_array();

        $this->db->insert('user_access_menu', ['role_id' =>  $this->session->userdata('role_id'), 'menu_id' => $max_id[0]["MAX(id)"]]);
    }

    public function deleteMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu'); 
    }

    public function UpdateMenu($id)
    {
        $data = [
            "menu" => $this->input->post('menu', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
    }

    public function deleteSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function updateSubMenu($id)
    {
        $data = [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

    // public function addRole()
    // {
    //     $this->db->insert('user_role', ['role' => $this->input->post('role')]);

    //     $max_id = $this->db->query("SELECT MAX(id) FROM user_role")->result_array();
    // }

    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }


    public function updateRole($id) 
    {
        $data = [
            "role" => $this->input->post('Role', true)
        ];

        $this->db->where('id', $id);
        $this->db->update('user_role', $data);
    }

    public function addRole()
    {
        $data = [
            'role' => $this->input->post('role')
        ];

        $this->db->insert('user_role', $data);
    }

    public function showProductList()
    {
        // $query = "SELECT `produk_list`.*, `user_menu`.`menu` FROM `user_sub_menu` JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";

        return $this->db->get('produk_list')->result_array();
        // return $this->db->query($query)->result_array();
    }
}
?>