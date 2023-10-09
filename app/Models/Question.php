<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'name', 'photo_path'
    ];
  
    protected $hidden = [];

    public function Answer()
    {
      return $this->hasMany(Answer::class, 'question_id', 'id');
    }
}
