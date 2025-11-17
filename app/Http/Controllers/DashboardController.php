<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $report = Dashboard::all();

        // Hitung jumlah berdasarkan status
        $totalLaporan = Dashboard::count();
        $jumlahTerkirim = Dashboard::where('status', 'terkirim')->count();
        $jumlahDiproses = Dashboard::where('status', 'diproses')->count();
        $jumlahSelesai = Dashboard::where('status', 'selesai')->count();

        return view('admin.index', compact(
            'report',
            'totalLaporan',
            'jumlahTerkirim',
            'jumlahDiproses',
            'jumlahSelesai'
        ));
    }

    public function detail($id)
    {
        $report = Dashboard::findOrFail($id);
        return view('admin.detail', compact('report'));
    }

    public function update($id)
    {
        $report = Dashboard::findOrFail($id);
        return view('admin.update', compact('report'));
    }

    public function updateProcess(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:terkirim,diproses,selesai'
        ]);

        $report = Dashboard::findOrFail($id);
        $report->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Status laporan berhasil diupdate!');
    }

    public function destroy($id)
    {
        try {
            $report = Dashboard::findOrFail($id);
            $reportTitle = $report->title;

            // Hapus file foto jika ada
            if ($report->photo && $report->photo != 'nophoto.jpg') {
                $photoPath = public_path('image/' . $report->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            $report->delete();

            return redirect()->route('admin.dashboard')
                ->with('success', "Laporan '{$reportTitle}' berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }
}
