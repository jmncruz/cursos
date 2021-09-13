<?php

namespace App\GraphQL\Mutations\User;

use App\Models\User;

class Create
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try{
            $user = new User;

            $user->name = $args["name"];
            $user->email = $args["email"];
            $user->password = bcrypt($args["password"]);
    
            $user->save();
            return [
                "code" => 200,
                "message" => "User save successfully"
            ];
        }catch(\Exception $e){
            if($e->getCode() == 23000){
                return [
                    "code" => $e->getCode(),
                    "message" => "Duplicate entry"
                ];
            }
            
        }

    }
}
