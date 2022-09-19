<?php
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: *');
	

	class Scores {
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

        function getScores(){

            if(AuthController::checkAuth()){
                $linha = new Users();
                $linha=$linha->buscaPorEmail(AuthController::returnEmail());
                $id=$linha->{'id'};
                try {
                    if(isset($id)){
                        $query = $this->pgadmin->prepare("SELECT * FROM scores WHERE id_user='$id';");      
                        $query->execute();
                        $stocks = [];
                        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                        $stocks[] = [
                            'id' => $row['id_user'],
                            'score' => $row['score'],
                            'hora' => $row['timestamp']
                        ];
                        }
                    }else{
                        return false;
                    }
        
                    return $stocks;
                    // return $query->fetchObject();
                    
                }catch(PDOException $e) {
                        echo 'Error: ' . $e->getMessage();
                    } 
                }else
                throw new \Exception('Nao autenticado, impossivel retornar progresso...');
    
            }
    }