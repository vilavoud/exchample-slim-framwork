<?php
namespace MyClassPath;
final class UserClass
{
    protected $db;

    public function __construct($db)
    {
        //$pdo = $this->get('pdo');
        $this->db = $db;
    }

    public function db_connect(){
        return $this->db;
    }

    // Get All  Users
    public function getUser($request, $response)
    {
        // Read product
        $db = $this->db_connect();
        $sql  = "SELECT id,username,fullname,img_profile FROM users";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $product = $stmt->fetchAll();

        if (count($product))
        {
            $input = [
                'status'  => 'success',
                'message' => 'Read User Success',
                'data'    => $product,
            ];
        }
        else
        {
            $input = [
                'status'  => 'fail',
                'message' => 'Empty User Data',
                'data'    => $product,
            ];
        }

        return $response->withJson($input);
    }


    // Get Users By ID
    public function getUserByID($request, $response, $args){

        $db = $this->db_connect();
        $sql  = "SELECT id,username,fullname,img_profile FROM users WHERE id='$args[id]'";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $product = $stmt->fetchAll();
            if (count($product))
            {
                $input = [
                    'status'  => 'success',
                    'message' => 'Read User Success',
                    'data'    => $product,
                ];
            }
            else
            {
                $input = [
                    'status'  => 'fail',
                    'message' => 'Empty User Data',
                    'data'    => $product,
                ];
            }

            return $response->withJson($input);
    }

    // Other Method
        // Something like this guy...
        // ...
        // ...

}