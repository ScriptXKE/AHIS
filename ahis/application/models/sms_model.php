<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This class contains persons model code
 * 
 * @author ScriptX Consulting Ltd (sales@scriptx.co.ke / sales@scriptx.org) | 02 August 2013
 * 
 */
class Sms_model extends CI_Model {

    private $tbl_sms = 'sms';

    function __construct() {
        parent::__construct();
    }

    function get($where = '', $perpage = 0, $start = 0) {

        $this->db->select('*');
        $this->db->from($this->tbl_sms);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();
        //var_dump($query->result());

        return $query->result();
    }

    function add($data) {
        $this->db->insert($this->tbl_sms, $data);
        if ($this->db->affected_rows() == '1') {
            return $this->db->insert_id();
            ;
        }
        return NULL;
    }

    function edit($data, $fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->update($this->tbl_sms, $data);

        if ($this->db->affected_rows() >= 0) {
            return TRUE;
        }
        //echo $this->db->last_query();
        return FALSE;
    }

    function delete($fieldID, $ID) {
        $this->db->where($fieldID, $ID);
        $this->db->delete($this->tbl_sms);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    function count() {
        return $this->db->count_all($this->tbl_sms);
    }

    function is_unique($fieldID, $value) {
        $result = $this->get($fieldID . ' = ' . $this->db->escape($value), 1);
        return count($result) > 0 ? FALSE : TRUE;
    }


}
