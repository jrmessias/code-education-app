<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 25/01/2016
 * Time: 19:58
 */

namespace JrMessias\OAuth;

use Auth;

class Verifier
{

    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}