<?php


namespace App\Interfaces;


interface CategoryConstants
{
    const CREATE_RULES = [
        'name'=>'required|unique:categories'        
    ];
    const UPDATE_RULES = [
        'name' => 'required|unique:categories,name,'
    ];
}
