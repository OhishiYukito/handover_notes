<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    
    public function getPaginateDESC(int $limit_num = 10){
        return $this->orderBy('created_at', 'DESC')->paginate($limit_num);
    }
    
    protected $fillable = [
        'url',
        'title',
        'tag',
    ];
}
