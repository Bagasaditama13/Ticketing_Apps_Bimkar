<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model Tiket merepresentasikan tiket yang terkait dengan event
class Tiket extends Model
{
    use HasFactory;

    // Menentukan atribut yang dapat diisi secara massal
    // yaitu event_id, tipe, harga, dan stok
    // sehingga kita dapat membuat atau memperbarui tiket dengan atribut ini
    // tanpa harus menetapkannya satu per satu
    protected $fillable = [
        'event_id',
        'tipe',
        'harga',
        'stok',
        // 'created_at' dan 'updated_at' diatur otomatis oleh Eloquent
        // jadi tidak perlu dimasukkan dalam fillable
    ];

    // Relasi many-to-one dengan model Event
    public function event()
    {
        return $this->belongsTo(Event::class);
        // Satu tiket terkait dengan satu event
        // Misalnya tiket premium/regular terkait dengan event Seminar
    }

    // Relasi one-to-many dengan model DetailOrder
    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
        // Satu tiket bisa muncul di banyak detail order
        // Misalnya tiket premium bisa dibeli di banyak order berbeda
        // sehingga ada banyak detail order yang merujuk ke tiket yang sama
    }

    // Relasi many-to-many dengan model Order melalui tabel pivot detail_orders
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'detail_orders')
            ->withPivot('jumlah', 'subtotal_harga');
        // Ini adalah relasi many-to-many, karena: 
        //Satu tiket bisa dibeli di banyak order
        //Satu order bisa membeli banyak tiket
    }
}