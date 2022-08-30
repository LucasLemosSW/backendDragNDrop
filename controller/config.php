<?php
    try {

        $servidor = "localhost";
        $porta = 5432;
        $bd = "postgres";
        $usuario = "postgres";
        $senha_banco = "19933991";

        $conexao = new PDO("pgsql:
                                host=$servidor; 
                                port=$porta; 
                                dbname=$bd;
                                user=$usuario; 
                                password=$senha_banco"
                            );

        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
        }
?>
