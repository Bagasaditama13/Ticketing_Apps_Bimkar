<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\Tiket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */

    // fungsi untuk menampilkan halaman dashboard admin dengan data statistik
    public function index()
    {
        //menghitung total data event, kategori, dan order untuk ditampilkan di dashboard admin
        $totalEvents = Event::count();
        $totalCategories = \App\Models\Kategori::count();
        $totalOrders = Order::count();
        return view('admin.dashboard', compact('totalEvents', 'totalCategories', 'totalOrders'));
    }
}