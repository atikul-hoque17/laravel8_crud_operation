<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    use HasFactory;

     protected $fillable = [
        'name', 'email', 'image', 'gender','skills'
     ];

     
// public function setSkillsAttribute($value)
//     {
//         $this->attributes['skill'] = json_encode($value);
//     }

//     public function getSkillsAttribute($value)
//     {
//         return $this->attributes['skill'] = json_decode($value);
//     };
}
