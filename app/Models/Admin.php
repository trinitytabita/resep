<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan (opsional jika tabel default adalah `admins`)
    protected $table = 'admin';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'username',
        'password',
    ];

    // Nonaktifkan timestamps jika tabel tidak memiliki kolom created_at dan updated_at
    public $timestamps = true;
}
