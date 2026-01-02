<?php

namespace App\Http\Controllers;

use App\Models\Buah;
use App\Models\PenilaianBuah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BuahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ensure only Petani access (though middleware/gates should handle this ideally)
        if ($user->peran !== 'petani') {
            abort(403);
        }

        $buahs = Buah::where('id_pengguna', $user->id_pengguna)
            ->with('penilaian')
            ->latest()
            ->get();

        return view('pages.dashboard.petani.stok.index', compact('buahs'));
    }

    public function create()
    {
        return view('pages.dashboard.petani.stok.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_buah' => 'required|string|max:255',
            'harga_awal' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Assessment validations
            'skor_kulit' => 'required|numeric|min:0|max:1',
            'skor_bentuk' => 'required|numeric|min:0|max:1',
            'skor_tekstur' => 'required|numeric|min:0|max:1',
            // Description validations
            'deskripsi_kulit' => 'nullable|string',
            'deskripsi_bentuk' => 'nullable|string',
            'deskripsi_tekstur' => 'nullable|string',
        ]);

        // Upload Image
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('buahs', 'public');
        }

        // -------------------------------------------------------------
        // LOGIKA PERHITUNGAN HARGA (DEDUCTION / DISKON)
        // -------------------------------------------------------------
        // 1. Hitung Total Skor (Rata-rata)
        $totalSkor = ($request->skor_kulit + $request->skor_bentuk + $request->skor_tekstur) / 3;

        // 2. Hitung Besar Potongan (Diskon Kekurangan)
        // Contoh: Harga 10.000, Skor 0.8 (Kekurangan 0.2) -> Potongan 2.000
        $potongan = $request->harga_awal * (1 - $totalSkor);

        // 3. Harga Akhir = Harga Awal - Potongan
        $hargaAkhir = (int) floor($request->harga_awal - $potongan);
        // -------------------------------------------------------------

        // Create Buah
        $buah = Buah::create([
            'id_pengguna' => Auth::user()->id_pengguna,
            'nama_buah' => $request->nama_buah,
            'harga_awal' => $request->harga_awal,
            'harga_akhir' => $hargaAkhir,
            'stok' => $request->stok,
            'gambar' => $imagePath,
        ]);

        // Create Penilaian
        PenilaianBuah::create([
            'id_buah' => $buah->id_buah,
            'skor_kulit' => $request->skor_kulit,
            'deskripsi_kulit' => $request->deskripsi_kulit,
            'skor_bentuk' => $request->skor_bentuk,
            'deskripsi_bentuk' => $request->deskripsi_bentuk,
            'skor_tekstur' => $request->skor_tekstur,
            'deskripsi_tekstur' => $request->deskripsi_tekstur,
            'total_skor_akhir' => $totalSkor,
        ]);

        return redirect()->route('buah.index')->with('success', 'Stok buah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $buah = Buah::where('id_buah', $id)->where('id_pengguna', Auth::user()->id_pengguna)->with('penilaian')->firstOrFail();
        return view('pages.dashboard.petani.stok.edit', compact('buah'));
    }

    public function update(Request $request, $id)
    {
        $buah = Buah::where('id_buah', $id)->where('id_pengguna', Auth::user()->id_pengguna)->firstOrFail();

        $request->validate([
            'nama_buah' => 'required|string|max:255',
            'harga_awal' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
             // Assessment validations
            'skor_kulit' => 'required|numeric|min:0|max:1',
            'skor_bentuk' => 'required|numeric|min:0|max:1',
            'skor_tekstur' => 'required|numeric|min:0|max:1',
             // Description validations
            'deskripsi_kulit' => 'nullable|string',
            'deskripsi_bentuk' => 'nullable|string',
            'deskripsi_tekstur' => 'nullable|string',
        ]);

        // Update Image if new one provided
        if ($request->hasFile('gambar')) {
            // Delete old
            if ($buah->gambar && Storage::disk('public')->exists($buah->gambar)) {
                Storage::disk('public')->delete($buah->gambar);
            }
            $buah->gambar = $request->file('gambar')->store('buahs', 'public');
        }

        // -------------------------------------------------------------
        // LOGIKA PERHITUNGAN HARGA (DEDUCTION / DISKON)
        // -------------------------------------------------------------
        // 1. Hitung Total Skor (Rata-rata)
        $totalSkor = ($request->skor_kulit + $request->skor_bentuk + $request->skor_tekstur) / 3;
        
        // 2. Hitung Besar Potongan (Diskon Kekurangan)
        $potongan = $request->harga_awal * (1 - $totalSkor);

        // 3. Harga Akhir = Harga Awal - Potongan
        $hargaAkhir = (int) floor($request->harga_awal - $potongan);
        // -------------------------------------------------------------

        $buah->update([
            'nama_buah' => $request->nama_buah,
            'harga_awal' => $request->harga_awal,
            'harga_akhir' => $hargaAkhir,
            'stok' => $request->stok,
        ]);
        
        $buah->penilaian()->updateOrCreate(
            ['id_buah' => $buah->id_buah],
            [
                'skor_kulit' => $request->skor_kulit,
                'deskripsi_kulit' => $request->deskripsi_kulit,
                'skor_bentuk' => $request->skor_bentuk,
                'deskripsi_bentuk' => $request->deskripsi_bentuk,
                'skor_tekstur' => $request->skor_tekstur,
                'deskripsi_tekstur' => $request->deskripsi_tekstur,
                'total_skor_akhir' => $totalSkor,
            ]
        );

        return redirect()->route('buah.index')->with('success', 'Stok buah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $buah = Buah::where('id_buah', $id)->where('id_pengguna', Auth::user()->id_pengguna)->firstOrFail();
        
        if ($buah->gambar && Storage::disk('public')->exists($buah->gambar)) {
            Storage::disk('public')->delete($buah->gambar);
        }

        $buah->delete();

        return redirect()->route('buah.index')->with('success', 'Stok buah berhasil dihapus!');
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_stok_buah.csv"',
        ];

        $columns = [
            'Nama Buah', 
            'Harga Awal', 
            'Stok (Kg)', 
            'Skor Kulit (0-1)', 
            'Deskripsi Kulit',
            'Skor Bentuk (0-1)', 
            'Deskripsi Bentuk',
            'Skor Tekstur (0-1)', 
            'Deskripsi Tekstur',
            'Nama File Gambar (Opsional)' // New column
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            // Example Row
            fputcsv($file, [
                'Apel Malang Super', 
                '15000', 
                '50', 
                '0.9', 
                'Kulit mulus tanpa bercak', 
                '0.8', 
                'Bentuk bulat rata', 
                '1.0', 
                'Tekstur renyah',
                'apel_malang.jpg' // Example filename
            ]);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import()
    {
        return view('pages.dashboard.petani.stok.import');
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // 1. Prepare Images Map [filename => uploaded_file]
        $imageMap = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Key is the original filename (lowercase for safer matching)
                $imageMap[strtolower($image->getClientOriginalName())] = $image;
            }
        }

        // 2. Process CSV
        $file = $request->file('file');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows); // Remove header

        $count = 0;
        foreach ($rows as $row) {
            if (count($row) < 9) continue; // Skip invalid rows

            // Map data
            $namaBuah = $row[0];
            $hargaAwal = (float) $row[1];
            $stok = (int) $row[2];
            $skorKulit = (float) $row[3];
            $deskKulit = $row[4];
            $skorBentuk = (float) $row[5];
            $deskBentuk = $row[6];
            $skorTekstur = (float) $row[7];
            $deskTekstur = $row[8];
            $imageFilename = isset($row[9]) ? trim($row[9]) : null;

            // Validation (Basic & Score Range)
            if (
                !$namaBuah || 
                $hargaAwal < 0 || 
                $stok < 1 || 
                $skorKulit < 0 || $skorKulit > 1 || 
                $skorBentuk < 0 || $skorBentuk > 1 || 
                $skorTekstur < 0 || $skorTekstur > 1
            ) {
                // Skip this row if data is invalid or scores are out of range (0-1)
                continue; 
            }

            // -------------------------------------------------------------
            // LOGIKA PERHITUNGAN HARGA (DEDUCTION / DISKON)
            // -------------------------------------------------------------
            // 1. Hitung Total Skor (Rata-rata)
            $totalSkor = ($skorKulit + $skorBentuk + $skorTekstur) / 3;
            
            // 2. Hitung Besar Potongan (Diskon Kekurangan)
            // Contoh: Harga 10.000, Skor 0.8 (Kekurangan 0.2) -> Potongan 2.000
            $potongan = $hargaAwal * (1 - $totalSkor);
            
            // 3. Harga Akhir = Harga Awal - Potongan
            $hargaAkhir = (int) floor($hargaAwal - $potongan);
            // -------------------------------------------------------------

            // Handle Image
            $imagePath = null;
            if ($imageFilename) {
                $lookupKey = strtolower($imageFilename);
                if (isset($imageMap[$lookupKey])) {
                    // Store the matching application/image
                    $imagePath = $imageMap[$lookupKey]->store('buahs', 'public');
                }
            }

            $buah = Buah::create([
                'id_pengguna' => Auth::user()->id_pengguna,
                'nama_buah' => $namaBuah,
                'harga_awal' => $hargaAwal,
                'harga_akhir' => $hargaAkhir,
                'stok' => $stok,
                'gambar' => $imagePath,
            ]);

            PenilaianBuah::create([
                'id_buah' => $buah->id_buah,
                'skor_kulit' => $skorKulit,
                'deskripsi_kulit' => $deskKulit,
                'skor_bentuk' => $skorBentuk,
                'deskripsi_bentuk' => $deskBentuk,
                'skor_tekstur' => $skorTekstur,
                'deskripsi_tekstur' => $deskTekstur,
                'total_skor_akhir' => $totalSkor,
            ]);

            $count++;
        }

        if ($count == 0) {
             return redirect()->back()->with('error', 'Gagal mengimpor data. Pastikan format CSV benar dan skor penilaian antara 0 sampai 1.');
        }

        return redirect()->route('buah.index')->with('success', "Berhasil mengimpor $count data stok buah!");
    }
}
