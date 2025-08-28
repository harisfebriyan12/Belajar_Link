<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $query = Link::query();
        $search = $request->input('search');

        // Tambahkan fungsionalitas pencarian
        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
        }

        // Ambil data dengan paginasi 5 item per halaman dan urutkan dari yang terbaru
        $links = $query->latest()->paginate(5)->withQueryString();

        return view('links.index', compact('links'));
    }

    public function create()
    {
        return view('links.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'url' => 'required|url|max:2048',
            ]);

            $imagePath = $request->file('gambar')->store('links', 'public');

            Link::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar' => $imagePath,
                'url' => $request->url,
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('links.index')->with('success', 'Link berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('links.index')->with('error', 'Gagal menambahkan link: ' . $e->getMessage());
        }
    }

    public function edit(Link $link)
    {
        return view('links.edit', compact('link'));
    }

    public function update(Request $request, Link $link)
    {
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'url' => 'required|url|max:2048',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $data = $request->all();
            $data['user_id'] = auth()->id();

            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($link->gambar && Storage::disk('public')->exists($link->gambar)) {
                    Storage::disk('public')->delete($link->gambar);
                }
                // Upload gambar baru
                $data['gambar'] = $request->file('gambar')->store('links', 'public');
            }

            $link->update($data);

            return redirect()->route('links.index')->with('success', 'Link berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('links.index')->with('error', 'Gagal memperbarui link: ' . $e->getMessage());
        }
    }

    public function destroy(Link $link)
    {
        try {
            // Hapus gambar dari storage sebelum menghapus record dari database
            if ($link->gambar && Storage::disk('public')->exists($link->gambar)) {
                Storage::disk('public')->delete($link->gambar);
            }

            $link->delete();
            return redirect()->route('links.index')->with('success', 'Link berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('links.index')->with('error', 'Gagal menghapus link: ' . $e->getMessage());
        }
    }

    public function toggleStatus(Request $request, Link $link)
    {
        $request->validate([
            'is_active' => 'required|boolean',
        ]);

        $newStatus = $request->boolean('is_active');

        $link->update([
            'is_active' => $newStatus,
        ]);

        $message = $newStatus ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('links.index')->with('success', "Link '{$link->judul}' berhasil {$message}!");
    }

}
