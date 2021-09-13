<?php

namespace App\GraphQL\Mutations\User;

use App\Http\Controllers\Api\AuthController;


class Login
{
    public function __construct(){
        $this->auth = new AuthController();
        $this->objetoRequest = new \Illuminate\Http\Request();
        
    }
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        
       $this->objetoRequest->setMethod('POST');
       $this->objetoRequest->request->add([
           'email' => $args["email"],
          'password' => $args["password"]
       ]);
        
        return [
            "token" => $this->auth->login($this->objetoRequest),
        ];
    }
}
