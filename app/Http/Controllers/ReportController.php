<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
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
        return view('user.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'title' => 'required|max:50',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'contact' => 'required|max:12',
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 50 karakter',
            'title.required' => 'Judul harus diisi',
            'title.max' => 'Judul maksimal 50 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.max' => 'Deskripsi maksimal 255 karakter',
            'location.required' => 'Lokasi harus diisi',
            'location.max' => 'Lokasi maksimal 255 karakter',
            'photo.max' => 'Foto maksimal 2 MB',
            'photo.mimes' => 'File ekstensi hanya bisa png,jpg,jpeg',
            'photo.image' => 'File harus berbentuk image',
            'contact.required' => 'Nomor WhatsApp harus diisi'
        ]);

        // Proses upload foto
        if (!empty($request->photo)) {
            $fileName = 'photo-' . uniqid() . '.' . $request->photo->extension();
            $request->photo->move(public_path('image'), $fileName);
        } else {
            $fileName = 'nophoto.jpg';
        }

        DB::table('dashboards')->insert([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'photo' => $fileName,
            'contact' => $request->contact,
            'status' => 'terkirim',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('user.report.create')
            ->with('success', 'Laporan berhasil dikirim! Terima kasih atas partisipasinya.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
