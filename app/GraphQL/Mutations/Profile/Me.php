<?php

namespace App\GraphQL\Mutations\User;

use App\Http\Controllers\Api\AuthController;

class Me
{
    public function __construct(){
        $this->auth = new AuthController();        
    }
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        
         return [
             "user" => $this->auth->me(),
         ];
    }
}
