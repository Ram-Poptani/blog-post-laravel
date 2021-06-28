<?php


namespace App\Interfaces;


interface TagConstants
{
    const CREATE_RULES = [
        'name'=>'required|unique:tags'
    ];
    const UPDATE_RULES = [
        'name' => 'required|unique:tags,name,'
    ];
}
