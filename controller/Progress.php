<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: *');
	

	class Progress {
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

        function getProgress(){

            if(AuthController::checkAuth()){
                $linha = new Users();
                $linha=$linha->buscaPorEmail(AuthController::returnEmail());
                $id=$linha->{'id'};
                try {
                    if(isset($id)){
                        $query = $this->pgadmin->prepare("SELECT * FROM progress WHERE id_progress='$id';");      
                        $query->execute();
                    }else{
                        return false;
                    }
        
                    return $query->fetchObject();
                    
                }catch(PDOException $e) {
                        echo 'Error: ' . $e->getMessage();
                    } 
                }else
                throw new \Exception('Nao autenticado, impossivel retornar progresso...');
    
            }

        function updateProgress(){//($money,$stars,$life,$fase_1,$fase_2,$fase_3,$fase_4,$fase_5,$fase_6,$fase_7,$fase_8,$fase_9){
            if(AuthController::checkAuth()){
                $linha = new Users();
                $linha=$linha->buscaPorEmail(AuthController::returnEmail());
                // return $linha->{'id'};
                $id=$linha->{'id'};
                $money=$_POST['money'];
                $stars=$_POST['stars'];
                $life=$_POST['life'];
                $fase_1=$_POST['fase_1'];
                $fase_2=$_POST['fase_2'];
                $fase_3=$_POST['fase_3'];
                $fase_4=$_POST['fase_4'];
                $fase_5=$_POST['fase_5'];
                $fase_6=$_POST['fase_6'];
                $fase_7=$_POST['fase_7'];
                $fase_8=$_POST['fase_8'];
                $fase_9=$_POST['fase_9'];
                $stmt = $this->pgadmin->prepare("UPDATE progress SET  money='$money', stars='$stars', life='$life', 
                                                fase_1='$fase_1', fase_2='$fase_2', fase_3='$fase_3', fase_4='$fase_4', fase_5='$fase_5', fase_6='$fase_6', fase_7='$fase_7', fase_8='$fase_8', fase_9='$fase_9'
                                                WHERE id_progress= '$id';");
                $stmt->execute();
                return true;
            }else
                throw new \Exception('Nao autenticado, impossivel salvar progresso...');
        }
	}