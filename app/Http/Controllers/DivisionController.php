<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index(Request $request)
    {
        $divisions = Division::when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
            ->paginate(10);

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
    }
}
