<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 16/01/2016
 * Time: 00:14
 */

namespace JrMessias\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
    protected $rules = [
        'owner_id' => 'required',
        'client_id' => 'required',
        'name' => 'required|string:255',
        'description' => 'required|string:255',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required'
    ];
}