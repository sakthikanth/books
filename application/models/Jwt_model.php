<?php


require FCPATH."jwt/vendor/autoload.php";
use \Firebase\JWT\JWT;

class Jwt_model extends CI_Model
{

          private $jwt_key = "jwt_key";

          function create_jwt_hash($id,$random,$time){

          $key = $this->jwt_key;
          $token = array(
              "user_id" => $id,
              "rand_key" => $random,
              "time_created" => $time

          );

          /**
           * IMPORTANT:
           * You must specify supported algorithms for your application. See
           * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
           * for a list of spec-compliant algorithms.
           */
          $jwt = JWT::encode($token, $key);

          return $jwt;

     }

      function decode_jwt_hash($jwt){

          $key = $this->jwt_key;

          $decoded = JWT::decode($jwt, $key, array('HS256'));

          $decoded_array = (array) $decoded;

          return $decoded_array;

     }


}
