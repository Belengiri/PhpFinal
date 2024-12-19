<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModelo extends Ci_Model {
    // consulta en la base de datos si conincide el usuario y la contraseña y te devuelve el id del usuario
	public function control_login($usuario,$contra){
        $this->db->select('*');
        $this->db->from('login');
        $this->db->where('usuario',$usuario);
        $query= $this->db->get()->row_array();
        //comprueba si el usuario existe en la tabla
        if (empty($query)) {
            //error de que el usuario no existe
            $this->session->set_flashdata('errores', ['Usuarios' => 'Usuario inexistente']);
            return false;  // Retorna falso si no se encuentra el usuario
        }
    
        // Si el usuario existe, comprobamos si la contraseña coincide
        if ($query['contrasena'] != $contra) {
            // Si la contraseña no coincide
            $this->session->set_flashdata('errores', ['Contrasenas' => 'Contraseña errónea']);
            return false;  // Retorna falso si la contraseña es incorrecta
        }
        return $query['id_usuarios'];
    }
    // selecciona el usuario y trae los datos del mismo, devuelve la fila con los datos de ese usuario
    public function traer_por_id($id){
        //comprueba id
        $this->db->where('id_usuarios', $id);
        //asigna a una variable el get con la tabla 
        $query= $this->db->get('login');
        //retorna el resultado de una fila de esa variable
        return $query->row_array();
    }
}