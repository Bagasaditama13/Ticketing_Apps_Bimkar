<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //fungsi untuk menampilkan semua kategori yang ada di database
    public function index()
    {
        //mengambil semua data kategori yang ada di database
		$categories = Kategori::all();
		return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
    // fungsi untuk menyimpan kategori baru ke database
    public function store(Request $request)
    {
        //validasi input dari user untuk menambahkan kategori baru ke database
        $payload = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        //cek jika nama kategori tidak diisi oleh user maka akan mengembalikan pesan error ke halaman kategori
        if (!isset($payload['nama'])) {
            return redirect()->route('categories.index')->with('error', 'Nama kategori wajib diisi.');
        }

        //menyimpan data kategori baru ke database menggunakan model Kategori
        Kategori::create([
            'nama' => $payload['nama'],
        ]);

        //mengembalikan user ke halaman kategori dengan pesan sukses setelah berhasil menambahkan kategori baru
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    // fungsi untuk memperbarui kategori yang ada di database
    public function update(Request $request, string $id)
    {
        //validasi input dari user untuk memperbarui kategori yang ada di database
        $payload = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        //cek jika nama kategori tidak diisi oleh user maka akan mengembalikan pesan error ke halaman kategori
        if (!isset($payload['nama'])) {
            return redirect()->route('categories.index')->with('error', 'Nama kategori wajib diisi.');
        }

        //memperbarui data kategori yang ada di database menggunakan model Kategori 
        //berdasarkan id kategori yang dipilih user
        $category = Kategori::findOrFail($id);
        $category->nama = $payload['nama'];
        $category->save();

        //mengembalikan user ke halaman kategori dengan pesan sukses setelah berhasil memperbarui kategori
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    // fungsi untuk menghapus kategori dari database
    public function destroy(string $id)
    {
        //menghapus data kategori dari database berdasarkan id kategori yang dipilih user
        Kategori::destroy($id);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
