<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Srq20result extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'srq20result';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'age', 'q1','q2','q3','q4','q5','q6','q7','q8','q9','q10',
        'q11','q12','q13','q14','q15','q16','q17','q18','q19','q20',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'q1' => 'boolean',
        'q2' => 'boolean',
        'q3' => 'boolean',
        'q4' => 'boolean',
        'q5' => 'boolean',
        'q6' => 'boolean',
        'q7' => 'boolean',
        'q8' => 'boolean',
        'q9' => 'boolean',
        'q10' => 'boolean',
        'q11' => 'boolean',
        'q12' => 'boolean',
        'q13' => 'boolean',
        'q14' => 'boolean',
        'q15' => 'boolean',
        'q16' => 'boolean',
        'q17' => 'boolean',
        'q18' => 'boolean',
        'q19' => 'boolean',
        'q20' => 'boolean',
    ];
}
