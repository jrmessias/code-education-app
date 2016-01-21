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
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required|max:255',
        'description' => 'required|max:255',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required'
    ];
}