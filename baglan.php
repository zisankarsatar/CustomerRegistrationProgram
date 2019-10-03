<?php

try{
    $db=new PDO("mysql: host=localhost; dbname=crm", "root", "root");
} catch (PDOException $e){
    echo $e->getMessage();
}

?>