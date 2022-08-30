<?php

class Users
{
    private $pgadmin;

    public function __construct($pgadmin)
    {
        $this->pgadmin = $pgadmin;
    }

    function listarUsuarios(){
        try {
            $query = $this->pgadmin->prepare("SELECT * FROM users");      
            $query->execute();
            $usuarios = $query->fetchAll();
            return $usuarios;
            
        }catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
          } 
        }
}

?>


