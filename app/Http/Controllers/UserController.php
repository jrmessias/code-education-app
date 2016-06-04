<?php

namespace JrMessias\Http\Controllers;

use Illuminate\Http\Request;

use JrMessias\Http\Requests;
use JrMessias\Http\Controllers\Controller;
use JrMessias\Repositories\UserRepository;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->respository = $repository;
    }

    public function authenticated(){
        $user = Authorizer::getResourceOwnerId();
        return $this->respository->find($user);
    }
}
