<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Snap extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // log insert
    public function save_transaction($data)
    {
        $save = $this->db->insert('tb_transaction', $data);
        if ($save) {
            return true;
        } else {
            return false;
        }
    }
}
