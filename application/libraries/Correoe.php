<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Correoe {
    
    
//resive como  parametros
    /*
     * $from   -> Establece la dirección de email y el nombre de la persona que envía el email:
     * $to     -> Establece la(s) direccion(es) de email del destinatario(s). Puede ser una direccion simple, una lista separada por comas o un arreglo:
                  $this->email->to('alguien@ejemplo.com'); $this->email->to('uno@ejemplo.com, dos@ejemplo.com, tres@ejemplo.com');            
     * $asunto -> Establece el asunto
     * $ms      ->Establece el mensaje
     */
    function enviar($from,$to,$asunto,$ms)
    {
		from = "intranet@bancoi.cu";
        $CI =&get_instance();
        $CI->load->library('email');
        
        //paramentros de configuracion
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = '192.168.5.21';
            $config['smtp_port'] = 25;
            $config['smtp_user'] = 'sad@bancoi.cu'; // correo sin espacio
            $config['smtp_pass'] = '';
            $config['smtp_timeout'] = '7';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            //se inicializa la libreria con los parametros de configuracion
            $CI->email->initialize($config);
 
            $CI->email->from($from);
            $CI->email->to($to);
            $CI->email->subject($asunto);
            $CI->email->message($ms);

            if($CI->email->send())
            {
           // echo 'Correo enviado';
            }
            else
            {
                 echo 'Correo NO enviado';
           // show_error($this->correo->print_debugger());
            }
        // Hacer algo con $params
    }
    function enviar_adjunto($from,$to,$asunto,$ms,$adjunto)
    {
        $CI =&get_instance();
        $CI->load->library('email');
        
        //paramentros de configuracion
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = '192.168.5.21';
            $config['smtp_port'] = 25;
            $config['smtp_user'] = 'sad@bancoi.cu'; // correo sin espacio
            $config['smtp_pass'] = '';
            $config['smtp_timeout'] = '7';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not
            //se inicializa la libreria con los parametros de configuracion
            $CI->email->initialize($config);
 
            $CI->email->from($from);
            $CI->email->to($to);
            $CI->email->subject($asunto);
            $CI->email->message($ms);
            $CI->email->attach($adjunto);

            if($CI->email->send())
            {
           // echo 'Correo enviado';
            }
            else
            {
                 echo 'Correo NO enviado';
           // show_error($this->correo->print_debugger());
            }
        // Hacer algo con $params
    }
}

/* End of file Someclass.php */ 
