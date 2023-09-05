<?php
    
    //Conexão LOCALHOST
    //$user = "root";
    //$pass = "";

    //Conexão EPDRJOSÉALVES
    $user = "root";
    $pass = "eeep";

    $conn = new PDO('mysql:host=localhost;dbname=db_biblioteca', $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
