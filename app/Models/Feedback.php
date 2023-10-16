<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
  use SoftDeletes, HasFactory;

  protected $fillable = [
    'quiz_id', 'user_id', 'rating'
  ]; 

  protected $hidden = [];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
