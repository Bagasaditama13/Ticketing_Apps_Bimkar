<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model Kategori merepresentasikan kategori dari event
class Kategori extends Model
{
    use HasFactory;

    // Menentukan atribut yang dapat diisi secara massal
    // yaitu nama kategori
    // sehingga kita dapat membuat atau memperbarui kategori dengan atribut ini
    // tanpa harus menetapkannya satu per satu
    protected $fillable = [
        'nama',
        // 'created_at' dan 'updated_at' diatur otomatis oleh Eloquent
        // jadi tidak perlu dimasukkan dalam fillable\
    ];

    // Relasi one-to-many dengan model Event
    public function events()
    {
        return $this->hasMany(Event::class);
        // Satu kategori dapat memiliki banyak event
        // Misalnya kategori 'Musik' bisa memiliki event 'Konser Jazz', 'Festival Rock', dan sebagainya
    }
}