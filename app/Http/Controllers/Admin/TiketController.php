<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tiket;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //validasi input untuk menambahkan tiket baru ke database
        $validatedData = request()->validate([
            'event_id' => 'required|exists:events,id', //untuk memastikan event yang dipilih benar-benar ada di database
            'tipe' => 'required|string|max:255', //memastikan tipe tiket(premium/reguler) tidak kosong dan maksimal 255 karakter.
            'harga' => 'required|numeric|min:0', //memastikan harga adalah angka dan tidak boleh negatif.
            'stok' => 'required|integer|min:0', //memastikan stok adalah angka bulat (bukan desimal) dan tidak boleh negatif
        ]);

        // Setelah validasi berhasil, data disimpan ke database menggunakan method Tiket::create()
        Tiket::create($validatedData);

        //Setelah berhasil menyimpan, admin diarahkan kembali ke halaman detail event dengan pesan sukses
        return redirect()->route('admin.events.show', $validatedData['event_id'])->with('success', 'Ticket berhasil ditambahkan.');
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
    public function update(Request $request, string $id)
    {
        //mengupdate data tiket yang ada di database
        $ticket = Tiket::findOrFail($id);

        //validasi input untuk memperbarui data tiket di database
        $validatedData = $request->validate([
            'tipe' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        //memperbarui data tiket di database
        $ticket->update($validatedData);

        //mengembalikan user ke halaman detail event dengan pesan sukses setelah berhasil memperbarui data tiket
        return redirect()->route('admin.events.show', $ticket->event_id)->with('success', 'Ticket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //menghapus data tiket dari database berdasarkan id tiket yang dipilih user
        $ticket = Tiket::findOrFail($id);
        $eventId = $ticket->event_id;
        $ticket->delete();

        return redirect()->route('admin.events.show', $eventId)->with('success', 'Ticket berhasil dihapus.');
    }
}
