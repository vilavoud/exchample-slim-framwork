<?php
use \Firebase\JWT\JWT;
use MyClassPath\ProductClass;
use MyClassPath\UserClass;

    // Root Route
    $app->get('/', function ($request, $response)
    {
        echo "<h1 style='text-align:center; margin-top:45vh'>PHP Slim 3 Simple Rest API</h3>";
        echo "<p  style='text-align:center'>By ITGenius Eng.</p>";
    });

    // Login และ รับ Token
    $app->post('/login', function ($request, $response) {
 
        $input = $request->getParsedBody();

        $password = sha1($input['password']);

        $sql = "SELECT * FROM users WHERE username=:username and password=:password";
        $sth = $this->db->prepare($sql);
        $sth->bindParam("username", $input['username']);
        $sth->bindParam("password", $password);
        $sth->execute();

        $count = $sth->rowCount();
        if($count){
            $user = $sth->fetchObject();
            $settings = $this->get('settings'); // get settings array.
            $token = JWT::encode(['id' => $user->id, 'username' => $user->username], $settings['jwt']['secret'], "HS256");
            return $this->response->withJson(['token' => $token]);
        }else{
            return $this->response->withJson(['error' => true, 'message' => 'These credentials do not match our records.']);
        }
    });

    // Routing Group
    $app->group('/api', function () use ( $app )
    {

        // ----------------------------------------------------------------------------------------------------
        // Products Route
        // ----------------------------------------------------------------------------------------------------

        // Get All Products (Method GET)
        $app->get('/products', function ($request, $response)
        {
            $getProduct = new ProductClass($this->db);
            return $getProduct->getProduct($request, $response);
        });

        // Get  Product By ID (Method GET)
        $app->get('/products/{id}', function ($request, $response, $args)
        {
            $getProductByID = new ProductClass($this->db);
            return $getProductByID->getProductByID($request, $response, $args);
        });

         // Add new Product  (Method Post)
         $app->post('/products', function ($request, $response)
         {
            $addProduct = new ProductClass($this->db);
            return $addProduct->addProduct($request, $response);
         });

        // Edit Product  (Method Put)
        $app->put('/products/{id}', function ($request, $response, $args) {
            $editProduct = new ProductClass($this->db);
            return $editProduct->editProduct($request, $response, $args);
        });

        // Delete Product  (Method Delete)
        $app->delete('/products/{id}', function ($request, $response, $args) {
            $deleteProduct = new ProductClass($this->db);
            return $deleteProduct->deleteProduct($request, $response, $args);
        });

        // ----------------------------------------------------------------------------------------------------
        // Users Route
        // ----------------------------------------------------------------------------------------------------
        
         // Get All Users (Method GET)
         $app->get('/users', function ($request, $response)
         {
             $getUser = new UserClass($this->db);
             return $getUser->getUser($request, $response);
         });

        // Get  User By ID (Method GET)
        $app->get('/users/{id}', function ($request, $response, $args)
        {
            $getUserByID = new UserClass($this->db);
            return $getUserByID->getUserByID($request, $response, $args);
        });

        // Other Method
        // Something like this guy...
        // ...
        // ...

    });

//};
