<?php
#
require_once 'config.php';
require_once 'lib/Medoo.php';
require_once 'lib/jdf.php';
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


if($_get !== null) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    $step_type = $_GET['type'];
    $roomid = $_GET['roomid'];
    $pm = $_GET['pm'];
    $TO_ID = $_GET['TOID'];
    $time = jdate('Y-m-d H:i:s');
}


if(in_array($step_type,['gotroom','sendpm','login','register','getinfo']) == false){
    #make error message code : 502 for  false step_type
    echo json_encode(array('Error_code' => '502'));
    exit();
}
elseif($username == null or $password == null) {
    #make error message code  : 501 for null parametr
    echo json_encode(array('Error_code' =>"501"));
    exit;

}
if ($step_type == 'login') {
    if ($database->select('users',['username'],[$username])[0] !== null){
        if($database->select('login',['logintime'],[$username])[0] == null ){
            $database->insert('users',['username'=>$username,'login_warn' => 0,'logintime'=>$time]);
        }else{
            $database->update('login',['logintime'=>$time,'login_warn' => 0],[$username]);
        }
        echo json_encode(array('login'=>true , 'server_time'=>$time));

    }else{
        $database->update('login',['logintime'=>$time,'login_warn' => +1],[$username]);

        echo json_encode(array('login'=>false ,'login_warn'=>$database->select('login',['login_warn'],['username']), ''=>$time));
    }
    
}

if($step_type == 'sendpm'){
    if($_GET['RoomID'] == null){
        
    }
}