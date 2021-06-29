<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Utils
{
    public static function validateOrThrow(array $validationRules, array $data): array
    {
        $validator = Validator::make($data, $validationRules);
        
        // dd($validator->fails());

        throw_if($validator->fails(), ValidationException::withMessages($validator->getMessageBag()->toArray()));
        // dd('hello');
        return $validator->validated();
    }
}
