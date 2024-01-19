<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "task";

    protected $fillable = [
        'id', 'user_id','title','description','finishdate', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    protected $hidden = [
        
    ];
}
