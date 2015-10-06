<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}
class Eventos extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
		}

	function getAllEventos() {
		$where = "";
		$this->db->select('*');
		if($where != NULL){
			$this->db->where($where,NULL,FALSE);
			$this->db->order_by('id', 'asc');
			}
		$query = $this->db->get('cat_eventos');
		return $query->result();
	}

	function getEvento($id_evento) {
		$where = "id = ".$id_evento."";
		$this->db->select('*');
		if($where != NULL){
				$this->db->where($where,NULL,FALSE);
			}
		$query = $this->db->get('cat_eventos');
		return $query->row();
	}

	function addEvento($serv = array()){
			$this->db->trans_begin();
			$this->db->insert('cat_eventos', $serv);
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
			} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}
	function editarEvento($serv = array(),$id_evento) {
		//die(print_r($serv));
			$this->db->trans_begin();
		$this->db->where('id', $id_evento);
		$this->db->update('cat_eventos', $serv);
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function eliminarEvento($id_evento) {
		//die(print_r($serv));
			$this->db->trans_begin();
		$this->db->where('id', $id_evento);
		$this->db->delete('cat_eventos');
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}
}
