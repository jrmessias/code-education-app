<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 20/01/2016
 * Time: 21:10
 */

namespace JrMessias\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'required',
        'file' => 'required|mimes:jpeg,bmp,png,pdf,docx,doc,xls,xlsx',
        'description' => 'required|max:255'
    ];

}