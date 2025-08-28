<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\JudulHalaman;
use App\Models\Link;
use App\Models\User;

class dashboardController extends Controller
{

    // Fungsi untuk halaman dashboard utama
    public function dashboard()
    {
        $totalLinks = Link::count();
        $totalUsers = User::count();
        $newLinksLastWeek = Link::where('created_at', '>=', now()->subWeek())->count();

        $activityLimit = 5;
        $recentLinks = Link::with('user')->latest('updated_at')->take($activityLimit)->get()->map(function ($link) {
            return [
                'type' => 'link',
                'judul' => $link->judul,
                'action' => $link->created_at->equalTo($link->updated_at) ? 'created' : 'updated',
                'user_name' => $link->user->name ?? 'Sistem',
                'user_email' => $link->user->email ?? null,
                'timestamp' => $link->updated_at,
            ];
        });

        // Ambil aktivitas terbaru dari Judul Halaman
        $recentJudulHalaman = JudulHalaman::with('user')->latest('updated_at')->take($activityLimit)->get()->map(function ($judul) {
            return [
                'type' => 'judul_halaman',
                'judul' => $judul->judul,
                'action' => $judul->created_at->equalTo($judul->updated_at) ? 'created' : 'updated',
                'user_name' => $judul->user->name ?? 'Sostem',
                'user_email' => $judul->user->email ?? null,
                'timestamp' => $judul->updated_at,
            ];
        });

        // Gabungkan, urutkan berdasarkan waktu, dan ambil aktivitas teratas untuk ditampilkan
        $recentActivities = $recentLinks
            ->merge($recentJudulHalaman)
            ->sortByDesc('timestamp')
            ->take($activityLimit);

        return view('dashboard', compact(
            'totalLinks',
            'totalUsers',
            'newLinksLastWeek',
            'recentActivities'
        ));
    }

}
