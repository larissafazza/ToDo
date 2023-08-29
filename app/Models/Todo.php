<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file',
        'date',
        'priority',
        'done',
        'completed'
    ];

    protected $casts = [
        'completed' => 'datetime',
        'date' => 'datetime',
    ];

    public function user(){

        return $this->BelongsTo(User::class);
    }
    
}
