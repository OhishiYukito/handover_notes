<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    
    public function getPaginateDESC(int $limit_num = 10){
        return $this->orderBy('created_at', 'DESC')->paginate($limit_num);
    }
    
    // function to create select bar
    public function getElements(string $column_name){
        return $this->select($column_name)->distinct()->get();
    }
    
    protected $fillable = [
        'event_year',
        'event_name',
        'tag',
        'title',
        'text',
        'creator',
        'updater'
    ];
}
