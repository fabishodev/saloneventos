<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

   function __construct() {
        parent::__construct();
        $this->load->model('usuarios', 'musuario');
        $this->load->model('eventos', 'meven');
        $this->load->library('Registro');
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

  public function ingresar(){
    $data = array();
    $data['contentView'] = 'usuario/login';
    $data['danger'] = '';
    if ($this->session->userdata('danger')) {
      $danger = $this->session->userdata('danger');
      $data['danger'] = $danger;
    }
    $this->_renderView($data);
   }

   public function ingresarusuario(){
     $usuario = $this->musuario->obtenerUsuarioIngreso($this->input->post('correo-usuario'), $this->input->post('pass-usuario'));
     $data = array();
     if ($usuario) {
       //die(print_r($usuario));
       $this->session->set_userdata('tipo_usuario', $usuario->cod_tipo);
       $this->session->set_userdata('id_usuario', $usuario->id);
       $this->session->set_userdata('correo', $usuario->correo);
       $this->session->set_userdata('nombre_completo', $usuario->nombre.' '.$usuario->ape_paterno.' '.$usuario->ape_materno);
       if ($usuario->cod_tipo == 1) {
         	redirect('usuario/listaeventos/'.$usuario->id);
       }else {
         redirect('usuario/lista');
       }

     }else {
       $this->session->set_userdata('danger', 'No existe cuenta. Verifique correo y contraseña.');
       redirect('/usuario/ingresar');
     }

   }

   public function eliminarEventoUsuario($id_fila){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
        }

        $code_evento_usr = $this->session->userdata('id_evento_usr');
        if ($code_evento_usr =='') {
          redirect('/usuario/login');
        }

        $invitados = $this->musuario->obtenerInvitados($code_evento_usr);

        //die(print_r($invitados));

        if ($invitados) {

            $this->session->set_userdata('danger', 'Imposible eliminar, el usuario ya asigno invitados a este evento.');
            redirect('/usuario/detalle/'.$code_evento_usr);


      }else {
        if ($this->musuario->eliminarEventoUsuario($id_fila)) {
            redirect('/usuario/listaeventos/'.$code_evento_usr);
        }
      }



   }

   public function eliminarInvitado($id_fila){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
        }

        $code_evento_usr = $this->session->userdata('id_evento_usr');
        if ($code_evento_usr =='') {
          redirect('/usuario/login');
        }

        if ($this->musuario->eliminarInvitado($id_fila)) {
            redirect('/usuario/detalle/'.$code_evento_usr);
        }

   }

   public function agregarInvitado(){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
        }
      $code_evento_usr = $this->session->userdata('id_evento_usr');
      if ($code_evento_usr =='') {
        redirect('/usuario/login');
      }
      $nombre_invitado = $this->input->post('nombre-invitado');
      $mesa = $this->input->post('mesa');
      $num_acompaniantes = $this->input->post('num-acompaniantes');
      $datos = array(
        'cod_evento_usr' => $code_evento_usr,
        'nombre_invitado' => $nombre_invitado,
        'mesa' => $mesa,
        'num_acompaniantes' => $num_acompaniantes,
        'fecha_creado' => date('Y-m-d H:i:s'));
      //die(print_r($datos));
      if ($this->musuario->agregarInvitado($datos)) {
          redirect('/usuario/detalle/'.$code_evento_usr);
      }
   }

   public function detalle($id_evento_usr){
     if (!$this->session->userdata('correo')) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
        }
     $data = array();
     $data['contentView'] = 'usuario/detalleevento';
     $detalle_evento = $this->musuario->obtenerDetalleEvento($id_evento_usr);
     $invitados = $this->musuario->obtenerInvitados($id_evento_usr);
     $this->session->set_userdata('id_evento_usr', $id_evento_usr);
     $data['detalle_evento'] = $detalle_evento;
     $data['invitados'] = $invitados;
     $data['scripts'] = array('eventos');
     $data['danger'] = '';
     if ($this->session->userdata('danger')) {
       $danger = $this->session->userdata('danger');
       $data['danger'] = $danger;
     }
     // View render
     $this->_renderView($data);
   }

   public function creareventousuario() {
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
        $cod_usuario = $this->session->userdata('id_usuario');
        $cod_evento = $this->input->post('sel-evento');
        $hora_inicio_evento = $this->input->post('hora-inicio-evento');
        $hora_fin_evento = $this->input->post('hora-fin-evento');
        $fecha_inicio = $this->input->post('fecha-inicio-evento');
        $fecha_inicio_evento = date('Y-m-d',  strtotime($fecha_inicio));
        $fecha_fin = $this->input->post('fecha-fin-evento');
        $fecha_fin_evento =   date('Y-m-d',strtotime( $fecha_fin));
        $observacion = $this->input->post('observacion-evento');
        $datos = array(
          'cod_evento' => $cod_evento,
          'cod_usuario' => $cod_usuario,
          'hora_inicio' => $hora_inicio_evento,
          'hora_fin' => $hora_fin_evento,
          'fecha_inicio' => $fecha_inicio_evento,
          'fecha_fin' => $fecha_fin_evento,
          'observacion' => $observacion,
          'fecha_creado' => date('Y-m-d H:i:s'));
        //die(print_r($datos));
        if ($this->musuario->crearEventoUsuario($datos)) {
            redirect('/usuario/lista');
        }
      } else {
        $this->session->sess_destroy();
        redirect('usuario/ingresar');
      }
    }

   public function crearevento(){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
    $data = array();
    $data['contentView'] = 'usuario/crearevento';
    $eventos = $this->meven->getAllEventos();
    $data['eventos'] = $eventos;
    // View render
    $this->_renderView($data);
  } else {
    $this->session->sess_destroy();
    redirect('usuario/ingresar');
  }
   }

   public function listaeventos($id_usuario){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
    $data = array();
    $data['contentView'] = 'usuario/listaeventos';
    $data['eventos_usuario'] = $this->musuario->listaEventosUsuario($id_usuario);
    $data['scripts'] = array('eventos');
    $this->session->set_userdata('id_usuario', $id_usuario);
    // View render
    $this->_renderView($data);
   }

   public function editarUsuario($id_usuario){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
     $usuario_correo = $this->input->post('correo-usuario');
     $nombre_usuario = $this->input->post('nombre-usuario');
     $ape_paterno = $this->input->post('ape-paterno');
     $ape_materno = $this->input->post('ape-materno');
     $domicilio = $this->input->post('domicilio');
     $colonia = $this->input->post('colonia');
     $telefono = $this->input->post('telefono');
     $ciudad = $this->input->post('ciudad');
     $estatus = $this->input->post('estatus-usuario');
     $datos = array(
       'correo' => $usuario_correo,
       'nombre' => $nombre_usuario,
       'ape_paterno' => $ape_paterno,
       'ape_materno' => $ape_materno,
       'domicilio' => $domicilio,
       'colonia' => $colonia,
       'ciudad' => $ciudad,
       'telefono' => $telefono,
       'activo' => $estatus,
       'fecha_actualizado' => date('Y-m-d H:i:s'));
     //die(print_r($datos));
     if ($this->musuario->editarUsuario($datos,$id_usuario)) {
           redirect('/usuario/lista');
       }
     } else {
       $this->session->sess_destroy();
       redirect('usuario/ingresar');
     }

   }

   public function editar($id_usuario) {
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
    $data = array();
    $data['usuario'] = $this->musuario->obtenerUsuario($id_usuario);
    $data['contentView'] = 'usuario/editar';
    $this->_renderView($data);
    //$this->load->view('welcome_message');
  } else {
    $this->session->sess_destroy();
    redirect('usuario/ingresar');
  }

}

   public function lista(){
     if (!$this->session->userdata('correo') ) {
            $this->session->sess_destroy();
            redirect('usuario/ingresar');
      }
      if ($this->session->userdata('tipo_usuario') == 0) {
        $data = array();
        $data['contentView'] = 'usuario/lista';
        $data['usuarios'] = $this->musuario->obtenerUsuarios();
        $data['scripts'] = array('eventos');
        $data['tipo_usuario'] = $this->session->userdata('tipo_usuario');
          //die(print_r($data));
        // View render
        $this->_renderView($data);
      } else {
        $this->session->sess_destroy();
        redirect('usuario/ingresar');
      }
}

   public function index(){
    $data = array();
    $data['contentView'] = 'usuario/login';
    $data['danger'] = '';
    if ($this->session->userdata('danger')) {
      $danger = $this->session->userdata('danger');
      $data['danger'] = $danger;
    }
    // View render
    $this->_renderView($data);
 	}

  //GET Registro
	public function crear(){
    if (!$this->session->userdata('correo') ) {
           $this->session->sess_destroy();
           redirect('usuario/ingresar');
     }
     if ($this->session->userdata('tipo_usuario') == 0) {
    $data = array();
    $data['contentView'] = 'usuario/crear';
    $password = $this->generateRandomString(8);
    $data['danger'] = '';
    if ($this->session->userdata('danger')) {
      $danger = $this->session->userdata('danger');
      $data['danger'] = $danger;
    }
    $data['pass'] = $password;
    //die(print_r($data));
    // View render
    $this->_renderView($data);
  } else {
    $this->session->sess_destroy();
    redirect('usuario/ingresar');
  }
	}

  public function crearUsuario(){
    if (!$this->session->userdata('correo') ) {
           $this->session->sess_destroy();
           redirect('usuario/ingresar');
     }
     if ($this->session->userdata('tipo_usuario') == 0) {
    $pass = $this->input->post('usuario-password');
    $password = md5($pass);
    $usuario_correo = $this->input->post('usuario-correo');
    $nombre_usuario = $this->input->post('nombre-usuario');
    $ape_paterno = $this->input->post('ape-paterno');
    $ape_materno = $this->input->post('ape-materno');
    $nombre_completo = $nombre_usuario.' '.$ape_paterno.' '.$ape_materno;
    $domicilio = $this->input->post('domicilio');
    $colonia = $this->input->post('colonia');
    $telefono = $this->input->post('telefono');
    $codigo = $this->generateRandomString(30);
    $ciudad = $this->input->post('ciudad');
    $datos = array(
      'correo' => $usuario_correo,
      'password' => $password,
      'nombre' => $nombre_usuario,
      'ape_paterno' => $ape_paterno,
      'ape_materno' => $ape_materno,
      'domicilio' => $domicilio,
      'colonia' => $colonia,
      'ciudad' => $ciudad,
      'telefono' => $telefono,
      'activo' => 1,
      'codigo' => $codigo,
      'cod_tipo' => 1,
      'fecha_creado' => date('Y-m-d H:i:s'));
    //die(print_r($datos));
    if (!$this->musuario->existeCorreo($usuario_correo)) {
      if ($this->musuario->crearUsuario($datos)) {
          $this->registro->EnviarCorreoRegistro($nombre_completo,$usuario_correo, $pass);//envía el correo electrónico
          redirect('/usuario/lista');
      }
    }else{
        $this->session->set_userdata('danger', 'Ya existe un correo registrado.');
        redirect('/usuario/crear');
    }
  } else {
    $this->session->sess_destroy();
    redirect('usuario/ingresar');
  }
  }

  //GET Registro
	public function registro(){
    $data = array();
    $data['contentView'] = 'usuario/registro';
    // View render
    $this->_renderView($data);
	}

  public function generateRandomString($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
    return $randomString;
	}

}
