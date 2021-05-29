<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Welcome extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    // Get Data
    public function get_transaction()
    {
        $query = $this->db->get('tb_transaction');
        return $query->result();
    }
}
