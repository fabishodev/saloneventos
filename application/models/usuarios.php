<?php if (!defined('BASEPATH')) {exit('No direct script access allowed'); }


class Usuarios extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}

	function eliminarEventoUsuario($id_fila) {
		//die(print_r($serv));
			$this->db->trans_begin();
		$this->db->where('id', $id_fila);
		$this->db->delete('eventos_usuarios');
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function eliminarInvitado($id_fila) {
		//die(print_r($serv));
			$this->db->trans_begin();
		$this->db->where('id', $id_fila);
		$this->db->delete('asignacion_mesa_evento');
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function obtenerUsuarioIngreso($email, $pass){
      $pass = md5($pass);
      $where = "correo ='".$email."' AND password = '".$pass."' AND activo = 1";
      $this->db->select('*');
      $this->db->from('cat_usuarios');
      if ($where != NULL) {
        $this->db->where($where, NULL, FALSE);
      }
			$query = $this->db->get();
			return $query->row();
    }

	function obtenerInvitados($id_evento_usr){
		$where = "cod_evento_usr = ".$id_evento_usr."";
		$this->db->select('*');
		if($where != NULL){
			$this->db->where($where,NULL,FALSE);
			$this->db->order_by('id', 'asc');
			}
		$query = $this->db->get('asignacion_mesa_evento');
		return $query->result();
	}
	function agregarInvitado($serv = array()){
			$this->db->trans_begin();
			$this->db->insert('asignacion_mesa_evento', $serv);
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
			} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function obtenerDetalleEvento($id_evento_usr) {
		$where = "id = ".$id_evento_usr."";
		$this->db->select('*');
		if($where != NULL){
				$this->db->where($where,NULL,FALSE);
			}
		$query = $this->db->get('vw_lista_eventos_usuario');
		return $query->row();
	}

	function crearEventoUsuario($serv = array()){
			$this->db->trans_begin();
			$this->db->insert('eventos_usuarios', $serv);
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
			} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function listaEventosUsuario($id_usuario){
		$where = "cod_usuario = ".$id_usuario."";
		$this->db->select('*');
		if($where != NULL){
			$this->db->where($where,NULL,FALSE);
			$this->db->order_by('fecha_creado', 'desc');
			}
		$query = $this->db->get('vw_lista_eventos_usuario');
		return $query->result();
	}

	function editarUsuario($serv = array(),$id_usuario) {
		//die(print_r($serv));
			$this->db->trans_begin();
		$this->db->where('id', $id_usuario);
		$this->db->update('cat_usuarios', $serv);
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function obtenerUsuario($id_usuario) {
		$where = "id = ".$id_usuario."";
		$this->db->select('*');
		if($where != NULL){
				$this->db->where($where,NULL,FALSE);
			}
		$query = $this->db->get('cat_usuarios');
		return $query->row();
	}

	function obtenerUsuarios(){
		$where = "cod_tipo = 1";
		$this->db->select('*');
		if($where != NULL){
			$this->db->where($where,NULL,FALSE);
			$this->db->order_by('ape_paterno', 'asc');
			}
		$query = $this->db->get('cat_usuarios');
		return $query->result();
	}

	function crearUsuario($serv = array()){
			$this->db->trans_begin();
			$this->db->insert('cat_usuarios', $serv);
			if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
			} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function existeCorreo($email){
      $where = "correo ='".$email."'";
      $this->db->select('*');
      $this->db->from('cat_usuarios');
      if ($where != NULL) {
        $this->db->where($where, NULL, FALSE);
      }
			$query = $this->db->get();
			return $query->row();
    }
}
