<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\JudulHalaman;
use Illuminate\Http\Request;

class JudulHalamanController extends Controller
{
    public function index(Request $request)
    {
        $query = JudulHalaman::query();
        $search = $request->input('search');

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        $judulHalamans = $query->latest()->paginate(5)->withQueryString();
        return view('judul-halaman.index', compact('judulHalamans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:judul_halaman,judul',
            'deskripsi' => 'nullable|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul.unique' => 'Judul sudah terdaftar, silakan gunakan judul lain.'
        ]);

        $imagePath = null;
        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('judul_halaman', 'public');
        }

        JudulHalaman::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'images' => $imagePath,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('judul-halaman.index')
            ->with('success', 'Judul halaman berhasil ditambahkan!');
    }

    public function update(Request $request, JudulHalaman $judulHalaman)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:judul_halaman,judul,' . $judulHalaman->id,
            'deskripsi' => 'nullable|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul.unique' => 'Judul sudah terdaftar, silakan gunakan judul lain.'
        ]);

        $data = $request->only('judul', 'deskripsi');
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('images')) {
            // Hapus gambar lama jika ada
            if ($judulHalaman->images && Storage::disk('public')->exists($judulHalaman->images)) {
                Storage::disk('public')->delete($judulHalaman->images);
            }
            // Upload gambar baru
            $data['images'] = $request->file('images')->store('judul_halaman', 'public');
        }


        $judulHalaman->update($data);

        return redirect()->route('judul-halaman.index')
            ->with('success', 'Judul halaman berhasil diubah!');
    }

    public function destroy(JudulHalaman $judulHalaman)
    {
        // Hapus gambar dari storage
        if ($judulHalaman->images && Storage::disk('public')->exists($judulHalaman->images)) {
            Storage::disk('public')->delete($judulHalaman->images);
        }

        $judulHalaman->delete();
        return redirect()->route('judul-halaman.index')
            ->with('success', 'Judul halaman berhasil dihapus!');
    }

    public function toggleStatus(Request $request, JudulHalaman $judulHalaman)
    {
        $newStatus = $request->input('is_active') === 'true';

        $judulHalaman->update([
            'is_active' => $newStatus
        ]);

        $message = $newStatus ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('judul-halaman.index')
            ->with('success', "Judul halaman berhasil {$message}!");
    }
}
