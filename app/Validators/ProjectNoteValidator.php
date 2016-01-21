<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 20/01/2016
 * Time: 21:10
 */

namespace JrMessias\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'title' => 'required|max:255',
        'note' => 'required|max:255'
    ];

}