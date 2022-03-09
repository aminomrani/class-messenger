<?php
#
require_once 'config.php';
require_once 'lib/medoo.php';

use database ; 
$config = new database();
use Medoo\Medoo;

$database = new Medoo([
    'type' => 'mysql',
    'host' => $config->config_data['servername'],
    'database' => $config->config_data['databasename'],
    'username' => $config->config_data['username'],
    'password' => $config->config_data['password'],
]);

$username = $_GET['username'];
$password = $_GET['password'];
$step_type = $_GET['type'];

if(in_array($step_type,['gotroom','sendpm','login','register','getinfo']) == false){
    #make error message code : 502 for  false step_type
    print json_encode(array('Error_code' => '502'));
    exit();
}

elseif($username == null or $password == null) {
    #make error message code  : 501 for null parametr
    print json_encode(array('Error_code' =>"501"));
    exit;

}
elseif ($step_type == 'login') {
    
}
