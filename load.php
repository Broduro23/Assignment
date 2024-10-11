<?php
require "includes/constants.php";
require "includes/dbConnection.php";
function classLoader($class){
    $directories = ["forms","global","layout","plugins","processes"];
        foreach ($directories as $dir){
            $filename = dirname(__FILE__).DIRECTORY_SEPARATOR . $dir.DIRECTORY_SEPARATOR.$class.".php";
            if (file_exists($filename) AND is_readable($filename)){
                require_once $filename;
            }
        }
    
}
spl_autoload_register('classLoader');
    $ObjForm = new userforms();
    $conn = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);
    $ObjGlob = new fncs();
    $ObjSendMail  = new Sendmail();
    $ObjAuth = new auth();
    $ObjAuth->signup($conn, $ObjGlob, $ObjSendMail);
    $ObjAuth->verify_code($conn, $ObjGlob, $ObjSendMail);