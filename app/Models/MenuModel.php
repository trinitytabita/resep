<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $tables='menu_model';
    protected $fillable = [
        'name', 
        'category_id',
        'description',
        'image',
    ];

    /**
     * Relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function recipe()
{
    return $this->hasOne(Recipe::class);
}
}
