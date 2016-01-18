<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 16/01/2016
 * Time: 00:14
 */

namespace JrMessias\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required|max:255',
        'responsible' => 'required|max:255',
        'email' => 'required|email',
        'phone' => 'required',
        'address' => 'required'
    ];
}