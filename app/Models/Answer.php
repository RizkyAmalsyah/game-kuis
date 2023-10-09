<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'question_id', 'name', 'is_correct'
    ];
  
    protected $hidden = [];

    public function Question()
    {
      return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function QuizDetail(){
      return $this->belongsTo(QuizDetail::class, 'answer_id', 'id');
    }
}
