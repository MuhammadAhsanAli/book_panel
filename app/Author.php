<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
   
   protected $fillable = ['author_name', 'email', 'phone'];

    
}

