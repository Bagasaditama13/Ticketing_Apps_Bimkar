<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class HistoriesController extends Controller
{
    public function index()
    {
        //mengambil semua data order dari database untuk ditampilkan di halaman riwayat pemesanan admin
        $histories = Order::latest()->get();
        return view('admin.history.index', compact('histories'));
    }

    public function show(string $history)
    {
        //mengambil data order berdasarkan id order yang dipilih untuk ditampilkan di halaman detail riwayat pemesanan admin
        $order = Order::findOrFail($history);
        return view('admin.history.show', compact('order'));
    }
}
