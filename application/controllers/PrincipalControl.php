<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalControl extends CI_Controller {
    public function __construct() {
		parent::__construct();
		$this->load->model("PrincipalModelo");
		//predefinimos mensajes para cada una de las validaciones 
		$this->form_validation->set_message('required', 'El campo %s es obligatorio.');
		$this->form_validation->set_message('is_unique', 'El %s ya existe .');
	}
	public function index()
	{
		//linea para impedir que entre si no esta logueado.
		if(!$this->session->userdata("usuario")){
			redirect('LoginControl/index');
		}
		//almaceno los usuarios en un array para poder pasarlos a la vista, es 
		//importante que sea un array si no nunca lo va a mostrar ya que listar devuelve un array.
		$usuarios['usuarios']= $this->PrincipalModelo->listar(); 
		//le envio la lista de usuarios ordenados desde el modelo a la vista 
		$this->load->view('principalview',$usuarios);
		
	}
	public function salir(){
		//destruye la sesion al salir para que los datos no queden almacenados de una vieja session.
		$this->session->sess_destroy();
		//redireccion al login
		redirect('LoginControl/index');
	}
	public function agregar(){
		//is unique hace que si intenta agregar un apellido existente muestre un error que predefinimos en el contructor
		$this->form_validation->set_rules("apellido","Apellido","required|is_unique[usuarios.Apellido]");
		$this->form_validation->set_rules("nota1","Nota1","required");
		$this->form_validation->set_rules("nota2","Nota2","required");
		$this->form_validation->set_rules("nota3","Nota3","required");

		if( $this->form_validation->run() == false ){
			$errores = [];
			//guardamos en el array de errores los diferentes campos que pueden traer errores y como los identificamos
			if (form_error('apellido')) {
				$errores['apellido']= form_error('apellido');
			}
			if (form_error('nota1')) {
				$errores['nota1'] = form_error('nota1');
			}
			if (form_error('nota2')) {
				$errores['nota2'] = form_error('nota2');
			}
			if (form_error('nota3')) {
				$errores['nota3'] = form_error('nota3');
			}
			//cargo los errores en el flashdata  y los datospara usarlos en la vista
			$this->session->set_flashdata('errores', $errores);
			$this->session->set_flashdata('apellido', $this->input->post('apellido'));
			$this->session->set_flashdata('nota1', $this->input->post('nota1'));
			$this->session->set_flashdata('nota2', $this->input->post('nota2'));
			$this->session->set_flashdata('nota3', $this->input->post('nota3'));
			//redireccionamiento
			redirect('PrincipalControl/index');
		}else{
			//bajo los datos a variables 
			$apellido=set_value("apellido");
			$nota1=set_value("nota1");
			$nota2=set_value("nota2");
			$nota3=set_value("nota3");
			//la funcion del apellido hace q la primer letra se almacene en mayuscula
			$this->PrincipalModelo->nuevo(ucfirst(strtolower($apellido)),$nota1,$nota2,$nota3);
			//mensaje que se muestra en la vista si todo salio ok
			$this->session->set_flashdata('mensaje',['agregado'=>'usuario agregado con éxito.']);
			//redireccionamiento
			redirect('PrincipalControl/index');
		}
	}
	public function eliminar($id){
		//primero comprueba el delete
		if ($this->PrincipalModelo->delete($id)) {
			//si salio ok envia un mensaje exitoso a la vista 
            $this->session->set_flashdata('mensaje',['eliminado'=>'usuario eliminado con éxito.']);
			//redirecciona
            redirect('PrincipalControl/index');
        } else {
			//si salio mal envia el error a la vista para ser mostrado
            $this->session->set_flashdata('errores', ['eliminar'=>'Error al eliminar el usuario.']);
			//redirecciona
            redirect('PrincipalControl/index');
        }

	}
}