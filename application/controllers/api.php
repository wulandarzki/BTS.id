<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/JWT.php';
require APPPATH . '/libraries/ExpiredException.php';
require APPPATH . '/libraries/BeforeValidException.php';
require APPPATH . '/libraries/SignatureInvalidException.php';
require APPPATH . '/libraries/JWK.php';

use chriskacerguis\RestServer\RestController;
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;

function configToken(){
    $cnf['exp'] = 3600; //milisecond
    $cnf['secretkey'] = '2212336221';
    return $cnf;        
}

public function getToken_post(){               
    $exp = time() + 3600;
    $token = array(
        "iss" => 'apprestservice',
        "aud" => 'pengguna',
        "iat" => time(),
        "nbf" => time() + 10,
        "exp" => $exp,
        "data" => array(
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password')
        )
    );       

$jwt = JWT::encode($token, $this->configToken()['secretkey']);
$output = [
        'status' => 200,
        'message' => 'Berhasil login',
        "token" => $jwt,                
        "expireAt" => $token['exp']
    ];      
$data = array('kode'=>'200', 'pesan'=>'token', 'data'=>array('token'=>$jwt, 'exp'=>$exp));
$this->response($data, 200 );       
}

public function authtoken(){
    $secret_key = $this->configToken()['secretkey']; 
    $token = null; 
    $authHeader = $this->input->request_headers()['Authorization'];  
    $arr = explode(" ", $authHeader); 
    $token = $arr[1];        
    if ($token){
        try{
            $decoded = JWT::decode($token, $this->configToken()['secretkey'], array('HS256'));          
            if ($decoded){
                return 'benar';
            }
        } catch (\Exception $e) {
            $result = array('pesan'=>'Kode Signature Tidak Sesuai');
            return 'salah';
            
        }
    }       
}