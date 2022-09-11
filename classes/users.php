<?php
	include "enviaEmail/envia_email.php"; 

class Users
{
    private $pgadmin;

    public function __construct()
    {
        $this->pgadmin = $this->criaConexaoDB();
    }

    public function criaConexaoDB(){
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
            return  $conexao;
            }catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
            }
    }

    function listarUsuarios(){

        if(AuthController::checkAuth()){

            try {
                $query = $this->pgadmin->prepare("SELECT * FROM users");      
                $query->execute();
                $stocks = [];
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $stocks[] = [
                        'id' => $row['id'],
                        'username' => $row['username'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'password' => $row['password'],
                        'timestamp' => $row['timestamp']
                    ];
                }
                return $stocks;
            }catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
            } 
        }else throw new \Exception('Usuario nao autenticado');
    }

    function buscaPorId($id){

        if(AuthController::checkAuth()){
            try {
                if(isset($id)){
                    $query = $this->pgadmin->prepare("SELECT * FROM users WHERE id=$id");      
                    $query->execute();
                }else{
                    return false;
                }
    
                return $query->fetchObject();
                
            }catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                } 
            }else
            throw new \Exception('Não autenticado ne');

    }

    function buscaPorEmail($email){
        try {
            if(isset($email)){
                $query = $this->pgadmin->prepare("SELECT * FROM users WHERE email='$email';");      
                $query->execute();
            }else{
                return false;
            }

            return $query->fetchObject();
            
        }catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            } 
    }

    function buscaPorUser($user){
        try {
            $query = $this->pgadmin->prepare("SELECT * FROM users WHERE username = '$user';");      
            $query->execute();
            return $query->fetchObject();
            
        }catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            } 
    }

    function verifyOnlyEmail($email){
        try {
            $query = $this->pgadmin->prepare("SELECT * FROM users WHERE email = '$email';");      
            $query->execute();
            if(gettype($query->fetchObject())==='boolean')
                return true;
            else
                return false;
            
        }catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
    }

    function addUser(){

        $username=$_POST['username'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $timestamp=$_POST['timestamp'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Invalid email format');
        }else if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
            throw new \Exception('Invalid name format');
        }else{
            if(self::verifyOnlyEmail($email)){    
                $stmt = $this->pgadmin->prepare("INSERT INTO Users (username,name,email,password,timestamp,verificacao) VALUES (:username,:name,:email,:password,:timestamp,false)");
                $stmt->bindParam(':username',   $username);
                $stmt->bindParam(':name',       $name);
                $stmt->bindParam(':email',      $email);
                $stmt->bindParam(':password',   $password);
                $stmt->bindParam(':timestamp',  $timestamp);
                // $stmt->bindParam(':verificacao',  'false');
                $stmt->execute();
                enviaEmail($email);
                return true;
            }else throw new \Exception('Email utilizado');
        }       
    }

    function validaEmail($email){
        $stmt = $this->pgadmin->prepare("UPDATE Users SET  verificacao=true WHERE email= '$email';");
        $stmt->execute();
        return true;
    }
}

?>


