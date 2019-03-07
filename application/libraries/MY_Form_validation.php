<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
	public $CI;

	function is_unique($str, $field) {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return $this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() === 0;
    }

	function is_unique_update($str, $field) {
        sscanf($field, '%[^.].%[^.].%[^.]', $table, $field, $id);
        return $this->CI->db->limit(1)->get_where($table, array($field => $str, 'id !=' => $id))->num_rows() === 0;
    }
}
/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */