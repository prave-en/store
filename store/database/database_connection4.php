<?php 
 try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=mrp","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
?>