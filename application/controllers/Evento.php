<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evento extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/gen seral/urls.html
	 */

   function __construct() {
        parent::__construct();
        $this->load->model('eventos', 'meven');
    }

   private $defaultData = array(
 		'title'			=> 'Eventos',
 		'layout' 		=> 'layout/lytDefault',
 		'contentView' 	=> 'vUndefined',
 		'stylecss'		=> '',
 	);

   private function _renderView($data = array()){
     $data = array_merge($this->defaultData, $data);
     $this->load->view($data['layout'], $data);
   }
   public function salir() {
      $this->session->sess_destroy();
      $data = array();
      redirect('usuario/ingresar');
      $this->_renderView($data);
  }

   public function lista(){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
    $data = array();
    $data['contentView'] = 'evento/lista';
    $data['eventos'] = $this->meven->getAllEventos();
    // View render
    $this->_renderView($data);
  } else {
    $this->session->sess_destroy();
    redirect('usuario/ingresar');
  }
   }
   public function crear() {
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
         $data = array();
         $data['contentView'] = 'evento/crear';
         $this->_renderView($data);
         //$this->load->view('welcome_message');
       } else {
         $this->session->sess_destroy();
         redirect('usuario/ingresar');
       }
     }

     public function crearevento() {
       if (!$this->session->userdata('correo') ) {
              $this->session->sess_destroy();
              redirect('usuario/ingresar');
        }
        if ($this->session->userdata('tipo_usuario') == 0) {
        $nombre_evento = $this->input->post('nombre-evento');
        $descripcion_evento = $this->input->post('descripcion-evento');
        $datos = array(
        'nombre_evento' => $nombre_evento,
        'descripcion' => $descripcion_evento,
        'activo' => 1,
        'fecha_creado' => date('Y-m-d H:i:s'));
        //die(print_r($datos));
        if ($this->meven->addEvento($datos)) {
            redirect('/evento/lista');
        }
      } else {
        $this->session->sess_destroy();
        redirect('usuario/ingresar');
      }
    }

   public function editar($id_evento) {
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
    $data = array();
    $data['evento'] = $this->meven->getEvento($id_evento);
    $data['contentView'] = 'evento/editar';
    $this->_renderView($data);
    //$this->load->view('welcome_message');
  } else {
    $this->session->sess_destroy();
    redirect('usuario/ingresar');
  }
}
  public function editarevento($id_evento) {
    if (!$this->session->userdata('correo') ) {
           $this->session->sess_destroy();
           redirect('usuario/ingresar');
     }
     if ($this->session->userdata('tipo_usuario') == 0) {
       $nombre_evento = $this->input->post('nombre-evento');
      $descripcion_evento = $this->input->post('descripcion-evento');
      $estatus_evento = $this->input->post('estatus-evento');
      $datos = array(
      'nombre_evento' => $nombre_evento,
      'descripcion' => $descripcion_evento,
      'activo' => $estatus_evento,
      'fecha_actualizado' => date('Y-m-d H:i:s'));
      //die(print_r($datos));
      if ($this->meven->editarEvento($datos, $id_evento)) {
          redirect('/evento/lista');
      }
    } else {
      $this->session->sess_destroy();
      redirect('usuario/ingresar');
    }
  }
 }
