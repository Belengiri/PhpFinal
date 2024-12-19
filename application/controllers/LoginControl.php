<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginControl extends CI_Controller {
	// constructor donde cargo el modelo
	
	public function __construct() {
		parent::__construct();
		$this->load->model("LoginModelo");
		//predefino reglas con mensajes
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
	}
	//index donde cargo la vista 
	public function index()
	{
		$this->load->view('loginview');
	}
	// login donde comprueba si los datos recibidos son validos y envia los datos para hacer el control de ingreso
	public function login(){
		//seteo las reglas
		$this->form_validation->set_rules('usuario','Usuario','required');
		$this->form_validation->set_rules('contrasena','Contraseña','required');
		//compruebo si ahi validaciones o no 
		if($this->form_validation->run()==false){
			//si las ahi creo un array
			$errores = [];
			//guardo los erores en el array dependiendo que error sea
			if (form_error('usuario')) {
				$errores['usuario'] = form_error('usuario');
			}
			if (form_error('contrasena')) {
				$errores['contrasena'] = form_error('contrasena');
			}
			//set_flashdata para cargar datos o errores que esten sucediendo a lo largo de la sesion
			$this->session->set_flashdata('errores',$errores);
			//guardo en el flash data el nombre del usuario traido por post.
			$this->session->set_flashdata('usuario', $this->input->post('usuario'));
			//al redireccionar siempre es al controlador index al cual quieras acceder 
			redirect('LoginControl/index');
		}else{
			//bajo los valores a variables
			$usuario=set_value("usuario");
			$clave = set_value("contrasena");
			//compruebo el control del login
			if($data = $this->LoginModelo->control_login($usuario,md5($clave))){
				//obtengo todos los datos de ese usuario
				$u=$this->LoginModelo->traer_por_id($data);
				//set_userdata para cargar datos del usuario al que pertenece la sesion
				$this->session->set_userdata('usuario', $u['usuario']);
				redirect('PrincipalControl/index');
			}else{
				//envio los datos por que si sale mal tiene que rellenar el nombre del usuario
				$this->session->set_flashdata('usuario', $this->input->post('usuario'));
				redirect('LoginControl/index');
			}
		}
	}
}
