<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 20/01/2016
 * Time: 21:10
 */

namespace JrMessias\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectMemberValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'user_id' => 'required|integer'
    ];

}