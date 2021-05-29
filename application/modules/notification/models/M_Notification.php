<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Notification extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function update_transaction($order_id, $data)
    {
        $this->db->where('order_id', $order_id);
        $update = $this->db->update('tb_transaction', $data);
    }
}
