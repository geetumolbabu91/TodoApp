<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $casts = [
        'is_complete' => 'boolean',
     ];
    protected $table = 'todo';
    protected $fillable = ['name', 'description', 'due_date','is_complete'];

    
    
    public function getIsCompleteAttribute($value)
    {
            return $value ? 'True' : 'False';
    }

    function getDueDateAttribute($value)
    {
        return (new Carbon($value))->format('d-m-Y');

    
    }
}
