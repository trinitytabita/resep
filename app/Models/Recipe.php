<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $tables='resep';
    protected $fillable = ['menu_model_id', 'ingredients', 'instructions'];

    public function menu()
    {
        return $this->belongsTo(MenuModel::class, 'menu_model_id');
    }
}
