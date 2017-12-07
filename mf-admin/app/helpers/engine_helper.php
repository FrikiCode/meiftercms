<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Core Engine for Meifter CMS
// Created by CodeMeifter
// All Rights Reserved.
// 2016

// Operative Functions
function getMyID()
{
    $ci =& get_instance();
    $user = $ci->ion_auth->user()->row();
    if(isset($user->id)) { 
        return $user->id;
    }else{	
    	return null;
    }
}
function getUserNfo($user_id)
{
    $ci =& get_instance();
    $ci->db->from('users');
    $ci->db->where('id', $user_id);
    $user = $ci->db->get();
    $userNfo = null;
    if ($user->num_rows() > 0)
    {
        foreach ($user->result() as $p)
        {
            $userNfo = array(
                'id' => $p->id,
                'ip_address' => $p->ip_address,
                'username' => $p->username,
                'password' => $p->password,
                'salt' => $p->salt,
                'email' => $p->email,
                'activation_code' => $p->activation_code,
                'forgotten_password_code' => $p->forgotten_password_code,
                'forgotten_password_time' => $p->forgotten_password_time,
                'remember_code' => $p->remember_code,
                'created_on' => $p->created_on,
                'last_login' => $p->last_login,
                'active' => $p->active,
                'first_name' => $p->first_name,
                'last_name' => $p->last_name,
                'image' => $p->image_path,
                'company' => $p->company,
                'phone' => $p->phone,
                'adress' => $p->adress,
                'pais' => $p->pais,
                'provincia' => $p->provincia,
                'partido' => $p->partido,
                'localidad' => $p->localidad,
                'barrio' => $p->barrio,
                'subbarrio' => $p->subbarrio,
                'zip' => $p->zip,
                'about' => $p->about,
                'userPic' => $p->image_path
            );
        }
    }
    return $userNfo;
}

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

/*
    parametros
    propertyName (string):  Nombre de la propiedad de la img a subir
    imgName (string):       Nombre "unico" para no pisar otras fotos
    folder (string):        Carpeta destino, default seria carpeta "uploads"   

    Return nombre de img     
*/
function do_upload($propertyName, $imgName, $folder = '')
{  

    $config['upload_path'] = './assets/uploads/' . $folder;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '10000';
    $config['max_width']  = '2048';
    $config['max_height']  = '1768';  
    $config['file_name'] = $imgName . $_FILES[$propertyName]['name'];

    $ci =& get_instance();
    $ci->load->library('upload');
    $ci->upload->initialize($config);

    if ( !$ci->upload->do_upload($propertyName))
    {
        $error = array('error' => $ci->upload->display_errors());
        print_r($error); 
        die;
    }
    else
    {
        return  $imgName . $ci->upload->data()["client_name"];        
    }
}

function remove_file ($filepathToRemove) {

    $ci =& get_instance();
    $ci->load->helper("file");
    var_dump(delete_files($filepathToRemove));die;
    if ( !delete_files($filepathToRemove) ) {
        echo "Error al borrar archivo " . $filepathToRemove; die;
    } else echo "JAJAJ";die;

}