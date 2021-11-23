<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

use DateTimeInterface;

class Module extends Model
{
    // use HasFactory;
    use SoftDeletes;
    use NodeTrait;
    
    protected $table = 'modules';
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'route',
        'param', 
        'parent_id', 
        '_lft',
        '_rgt',
        'icon',
        'deleted_at',   
        'created_by', 
        'created_at',
        'updated_by', 
        'updated_at'
    ];
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
