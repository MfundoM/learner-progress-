<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
    ];

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class);
    }

    public function scopeWithAverageProgress($query)
    {
        return $query
            ->join('enrolments', 'learners.id', '=', 'enrolments.learner_id')
            ->select('learners.*')
            ->selectRaw('AVG(enrolments.progress) as avg_progress')
            ->groupBy('learners.id');
    }

    public function scopeFilterByCourse($query, $courseId)
    {
        if ($courseId) {
            $query->whereHas('enrolments', fn($q) => $q->where('course_id', $courseId));
        }

        return $query;
    }
}
