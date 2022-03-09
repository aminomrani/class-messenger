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


if(isset($_GET)) {
    if($_GET['username'] == null){
        $username = null ;
    }else {
        $username = $_GET['username'];
    }
    if($_GET['password'] == null){
        $password = null ;
    }else {
        $password = $_GET['password'];
    }
    if($_GET['type'] == null){
        $step_type = null;
    }else {
        $step_type = $_GET['type'];
    }
    if($_GET['RoomID'] == null){
        $RoomID = null;
    }else{
        $RoomID = $_GET['RoomID'];
    }
    if($_GET['Pm'] == null){
        $pm = null;
    }else{
        $pm = $_GET['Pm'];
    }
    if($_GET['TO_ID'] == null){
        $TO_ID = null;
    }else{
        $TO_ID = $_GET['TO_ID'];
    }
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
    if($RoomID == null){
        if($pm !== null){
            $database->insert('pm',['to_id'=>'all','text_pm'=>$pm]);
            echo json_encode(array('ans'=>200));
        }else{
            echo json_encode(array('ans'=>['Error'=>'501']));
        }
    }else{ 
        if($pm !== null){
            $database->insert('pm',['to_id'=>$RoomID,'text_pm'=>$pm]);
            echo json_encode(array('ans'=>200));
        }else{
            echo json_encode(array('ans'=>['Error'=>'501']));
        }
    }
}