<?php
    header('Access-Control-Allow-Origin: *');
    include "controller/config.php"; // inclui o arquivo conecta.php
    include "classes/users.php";


    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
        $q = $_REQUEST["id"];

        if($q=="all"){
            $usuarios = new Users($conexao);
            $pessoas=$usuarios->listarUsuarios();
            echo json_encode($pessoas);
        }else{
            $usuarios = new Users($conexao);
            $umFulano=$usuarios->buscaPorId($q);
            echo json_encode($umFulano);
        }
    }

?>