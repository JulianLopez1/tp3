<?php
    require_once("config.php");

    //se utiliza para decodificar datos codificados en base64.
    class loginHelpers {
        
        function base64url_encode($data) {
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
        }
        

        // Obtenemos el encabezado de autorización de una solicitud HTTP. (PRIMER PASO)
        function getUserHelpers() {
            $header = "";
            if(isset($_SERVER['HTTP_AUTHORIZATION']))
                $header = $_SERVER['HTTP_AUTHORIZATION'];
            if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
                $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
            return $header;
        }

        function createToken($payload) {
            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            
            //Agregamos al payload un tiempo (ES OPCIONAL)
            $payload['exp'] = time() + 60; //tiempo de 1 minuto para uso práctico
            
            $header = $this->base64url_encode(json_encode($header));
            $payload = $this->base64url_encode(json_encode($payload));
            
            $signature = hash_hmac('SHA256', "$header.$payload", true);
            $signature = $this->base64url_encode($signature);
            
            $token = "$header.$payload.$signature";

            return $token;
        }

    
        function currentUser() {
            $jugador = $this->getUserHelpers(); // "Bearer $token"
            $jugador = explode(" ", $jugador); // ["Bearer", "$token"]
            
            if($jugador[0] != "Bearer")
                return false;

            return $this->verifyToken($jugador[1]); // Si está bien nos devuelve el payload
        }

         private function verifyToken($token) {
             
            $token = explode(".", $token);
            $header = $token[0];
            $payload = $token[1];
            $signature = $token[2];

            $new_signature = hash_hmac('SHA256', "$header.$payload", true);
            $new_signature = $this->base64url_encode($new_signature);

            if($signature!=$new_signature) 
                return false;
        
            $payload = json_decode(base64_decode($payload));

            if($payload->exp<time()) 
                return false;
        
            return $payload;
        }
    }