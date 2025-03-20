<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'parent_id'];

    // Parent Relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Child Relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Recursive function to get full category path
    public function getFullPathAttribute()
    {
        return $this->parent ? $this->parent->full_path . ' > ' . $this->name : $this->name;
    }
}