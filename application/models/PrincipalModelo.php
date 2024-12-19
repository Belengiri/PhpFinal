<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalModelo extends Ci_Model {

    //lista los usuarios
    public function listar(){
        //ordena
        $this->db->order_by('Apellido','ASC');
        //selecciona la tabla y lo baja a una variable
        $lista = $this->db->get("usuarios");
        //retorna el array de resultado de la variable
        return $lista->result_array();
    }
    //carga uno nuevo 
    public function nuevo($apellido,$nota1,$nota2,$nota3){
        //setea por cada campo en la bd una variable traida por parametro
        $this->db->set('Apellido',$apellido);
        $this->db->set('Nota1',$nota1);
        $this->db->set('Nota2',$nota2);
        $this->db->set('Nota3',$nota3);
        //inserta en la tabla 
        $this->db->insert('usuarios');
        //retorna la insercion de ese id 
        return $this->db->insert_id();
    }
    //elimina un usuario
    public function delete($id){
        //hace la comprobacion del id 
        $this->db->where('id_usuario',$id);
        //retorna la eliminacion de ese registro en la tabla
        return $this->db->delete('usuarios');
    }
   
}