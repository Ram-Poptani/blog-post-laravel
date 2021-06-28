<?php


namespace App\Interfaces;


interface PostConstants
{
    const CREATE_RULES = [
        'title'=>'required|unique:posts',
        'excerpt'=>'required|max:255',
        'content'=>'required',
        'image'=>'required|image|mimes:jpeg,png,gif,svg,jpg|max:1024',
        'category_id'=>'exists:categories,id',
        'published_at' => 'required',
        'tags' => 'required'
        
    ];
    const UPDATE_RULES = [
        'title'=>'required|unique:posts,title,',
        'excerpt'=>'required|max:255',
        'content'=>'required',
        'image'=>'image|mimes:jpeg,png,gif,svg,jpg|max:1024',
        'category_id'=>'exists:categories,id'
    ];
}
