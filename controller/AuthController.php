<?php
    header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Headers: *');

    class AuthController {
        private static $key = '123456'; //Application Key
        
        public function login(){

            // $conexao=criaConexao();
            // $usuarios = new Users($conexao);
            $usuarios = new Users();
            $linha=$usuarios->buscaPorEmail($_POST['email']);
            
            if ($_POST['email'] == $linha->{'email'} && $_POST['password'] == $linha->{'password'}) {
                //Header Token
                $header = [
                    'typ' => 'JWT',
                    'alg' => 'HS256'
                ];

                //Payload - Content
                $payload = [
                    'name' => $linha->{'name'},
                    'email' => $linha->{'email'},
                ];

                //JSON
                $header = json_encode($header);
                $payload = json_encode($payload);

                //Base 64
                $header = self::base64UrlEncode($header);
                $payload = self::base64UrlEncode($payload);

                //Sign
                $sign = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
                $sign = self::base64UrlEncode($sign);

                //Token
                $token = $header . '.' . $payload . '.' . $sign;

                return $token;
            }
            
            throw new \Exception('Usuario nao autenticado');

        }

        private static function returnExplodeToken(){
            $http_header = apache_request_headers();
            if ($http_header['Authorization']!='Bearer null' && isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
                $bearer = explode (' ', $http_header['Authorization']);

                $token = explode('.', $bearer[1]);
                return $token;
            }else return false;
        }

        public static function checkAuth()
        {
            $http_header = apache_request_headers();
            if ($http_header['Authorization']!='Bearer null' && isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
                $bearer = explode (' ', $http_header['Authorization']);

                $token = explode('.', $bearer[1]);
                $header = $token[0];
                $payload = $token[1];
                $sign = $token[2];

                $obj=json_decode(stripslashes(base64_decode($payload,true)));
                return $obj->name;
                
                //Conferir Assinatura
                $valid = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
                $valid = self::base64UrlEncode($valid);
                if ($sign === $valid) {
                    return true;
                }
            }            

            return false;
        }
        
        private static function base64UrlEncode($data){
            // First of all you should encode $data to Base64 string
            $b64 = base64_encode($data);

            // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
            if ($b64 === false) {
                return false;
            }

            // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
            $url = strtr($b64, '+/', '-_');

            // Remove padding character from the end of line and return the Base64URL result
            return rtrim($url, '=');
        }

        public static function returnEmail(){

            $token=self::returnExplodeToken();
            $payload = $token[1];
            $obj=json_decode(stripslashes(base64_decode($payload,true)));
            return $obj->email;
        }

    }
