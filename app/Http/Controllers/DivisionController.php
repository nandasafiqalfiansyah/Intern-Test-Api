<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Support\Facades\Log;

class DivisionController extends Controller
{
    public function index(Request $request)
    { try {
        $divisions = Division::when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
            ->paginate(10);

        if (empty($divisions->items())) {
                return response()->json(['message' => 'Data tidak ditemukan!'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => ['divisions' => $divisions->items()],
            'pagination' => [
                'current_page' => $divisions->currentPage(),
                'total' => $divisions->total(),
                'per_page' => $divisions->perPage(),
                'last_page' => $divisions->lastPage(),
            ],
        ]);

        } catch (\Exception $e) {
            Log::error('Error saat mengambil Division: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan pada server',
            ], 500);
        }

    }
}
