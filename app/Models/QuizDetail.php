<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizDetail extends Model
{
    use HasFactory,  SoftDeletes;

    protected $fillable = [
      'quiz_id', 'question_id', 'answer_id', 'question_number', 'time', 'score'
    ];
  
    protected $hidden = [];

    public function quiz()
    {
      return $this->belongsTo(Quiz::class, 'quiz_id', 'id');
    }

    public function answer(){
      return $this->belongsTo(Answer::class, 'answer_id', 'id');
    }

    public function question(){
      return $this->belongsTo(Question::class, 'question_id', 'id');
    }
}
