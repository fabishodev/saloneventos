<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'libraries/swift_mailer/lib/swift_required.php';

class Registro {

  public function EnviarCorreoRegistro($usuario, $email, $pass)
   {
    //echo "Enviando Correos";
    //ini_set('max_execution_time', 28800); //240 segundos = 4 minutos
     //Enviar correo electr�nico
          $url = base_url();
          $transport = Swift_SmtpTransport::newInstance()
                ->setHost('smtp.gmail.com')
                ->setPort(465)
                ->setEncryption('ssl')
                ->setUsername('user@gmail.com')
                ->setPassword('password');

                //Create the Mailer using your created Transport
                $mailer = Swift_Mailer::newInstance($transport);
                //$this->load->model("Solicitud_model", "solicitud");
                //$query = $this->solicitud->getAlumnosCorreo();

                //Pass it as a parameter when you create the message
                $message = Swift_Message::newInstance();
                //Give the message a subject
                //Or set it after like this

                $message->setSubject('Salon Eventos');
                //no_reply@ugto.mx
                $message->setFrom(array('user@gmail.com' => 'SALONEVENTOS '));
                $message->addTo($email);
                //$message->addTo('mgsnikips@gmail.com');

                //$message->addBcc('fabishodev@gmail.com');

                //Add alternative parts with addPart()
                $message->addPart("<h2>Bienvenido </h2>".$usuario."
                <br>
                <h3>Su contraseña para entrar al sistema es:</h3>
                <br>
                ".$pass."<br>
                ---<br>
                ", 'text/html');
                $result = $mailer->send($message);
    }
}
