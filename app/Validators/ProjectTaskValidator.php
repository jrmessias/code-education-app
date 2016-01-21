<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 20/01/2016
 * Time: 21:10
 */

namespace JrMessias\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'name' => 'required|max:255',
        'start_date' => 'required',
        'due_date' => 'required',
        'status' => 'required'
    ];

}