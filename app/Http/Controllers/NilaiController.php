<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NilaiController extends Controller
{
    public function nilaiRT()
    {
    try {
        $data = DB::select("
           SELECT
            n.nisn,
            n.nama,
            CONCAT(
                '{',
                '\"realistic\":', SUM(CASE WHEN p.kategori = 'realistic' THEN n.skor ELSE 0 END), ',',
                '\"investigative\":', SUM(CASE WHEN p.kategori = 'investigative' THEN n.skor ELSE 0 END), ',',
                '\"artistic\":', SUM(CASE WHEN p.kategori = 'artistic' THEN n.skor ELSE 0 END), ',',
                '\"social\":', SUM(CASE WHEN p.kategori = 'social' THEN n.skor ELSE 0 END), ',',
                '\"enterprising\":', SUM(CASE WHEN p.kategori = 'enterprising' THEN n.skor ELSE 0 END), ',',
                '\"conventional\":', SUM(CASE WHEN p.kategori = 'conventional' THEN n.skor ELSE 0 END),
                '}'
            ) AS nilaiRt
            FROM nilai n
            JOIN pelajaran p ON n.pelajaran_id = p.id
            WHERE n.materi_uji_id = 7 AND p.is_khusus = 0
            GROUP BY n.nisn, n.nama;
    ");

    if (empty($data)) {
        return response()->json(['message' => 'Data tidak ditemukan!'], 404);
    }

    foreach ($data as $key => $value) {
        $data[$key]->nilaiRt = json_decode($value->nilaiRt);
    }

    return response()->json($data);

    } catch (\Exception $e) {
        Log::error('Error saat mengambil data nilaiRT: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'status'  => 'error',
            'message' => 'Terjadi kesalahan pada server' . $e->getMessage(),
        ], 500);
    }
    }
    public function nilaiST()
    {
        try {
            $data = DB::select("
                SELECT
                CONCAT(
                    '{',
                    '\"verbal\":', SUM(CASE WHEN n.pelajaran_id = 44 THEN n.skor * 41.67 ELSE 0 END), ',',
                    '\"kuantitatif\":', SUM(CASE WHEN n.pelajaran_id = 45 THEN n.skor * 29.67 ELSE 0 END), ',',
                    '\"penalaran\":', SUM(CASE WHEN n.pelajaran_id = 46 THEN n.skor * 100 ELSE 0 END), ',',
                    '\"figural\":', SUM(CASE WHEN n.pelajaran_id = 47 THEN n.skor * 23.81 ELSE 0 END),
                    '}'
                ) AS listNilai,
                n.nama,
                n.nisn,
                (
                    SUM(CASE WHEN n.pelajaran_id = 44 THEN n.skor * 41.67 ELSE 0 END) +
                    SUM(CASE WHEN n.pelajaran_id = 45 THEN n.skor * 29.67 ELSE 0 END) +
                    SUM(CASE WHEN n.pelajaran_id = 46 THEN n.skor * 100 ELSE 0 END) +
                    SUM(CASE WHEN n.pelajaran_id = 47 THEN n.skor * 23.81 ELSE 0 END)
                ) AS total
            FROM nilai n
            WHERE n.materi_uji_id = 4
            GROUP BY n.nisn, n.nama
            ORDER BY total DESC;
            ");

            if (empty($data)) {
                return response()->json(['message' => 'Data tidak ditemukan!'], 404);
            }

            foreach ($data as $key => $value) {
                $data[$key]->listNilai = json_decode($value->listNilai);
            }

            return response()->json($data);

            } catch (\Exception $e) {
                Log::error('Error saat mengambil dataST: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);

                return response()->json([
                    'status'  => 'error',
                    'message' => 'Terjadi kesalahan pada server',
                ], 500);
            }
    }
}
