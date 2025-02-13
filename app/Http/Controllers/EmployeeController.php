<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        try{
            $employees = Employee::with('division')
                ->when($request->name, fn($q) => $q->where('name', 'like', "%{$request->name}%"))
                ->when($request->division_id, fn($q) => $q->where('division_id', $request->division_id))
                ->paginate(10);

                if ($employees->isEmpty()) {
                    return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan!'], 404);
                }

            return response()->json([
                'status' => 'success',
                'data' => ['employees' => $employees->map(fn($e) => [
                    'id' => $e->id,
                    'image' => $e->image,
                    'name' => $e->name,
                    'phone' => $e->phone,
                    'division' => $e->division,
                    'position' => $e->position,
                ])],
                'pagination' => [
                    'current_page' => $employees->currentPage(),
                    'total' => $employees->total(),
                    'per_page' => $employees->perPage(),
                    'last_page' => $employees->lastPage(),
                ],
            ]);
            } catch (\Exception $e) {
                Log::error('Error saat mengambil Employees: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);

                return response()->json([
                    'status'  => 'error',
                    'message' => 'Terjadi kesalahan pada server',
                ], 500);
            }
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'image' => 'required|image',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'division' => 'required|uuid|exists:divisions,id',
                'position' => 'required|string|max:255',
            ]);

            $path = $request->file('image')->store('images', 'public');

            $validated['image'] = Storage::url($path);

            $validated['division_id'] = $validated['division'];
            unset($validated['division']);

            Employee::create($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
            ], 201);

        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data yang dikirim tidak valid',
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error saat menyimpan data karyawan: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server ' . $e->getMessage(),
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::where('id', $id)->firstOrFail();

            $validated = $request->validate([
                'image' => 'sometimes|image|max:2048',
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'division' => 'required|uuid|exists:divisions,id',
                'position' => 'required|string|max:255',
            ]);


            DB::transaction(function () use ($request, $employee, $validated) {
                if ($request->hasFile('image')) {
                    $validated['image'] = $this->updateEmployeeImage($request->file('image'), $employee);
                }
                $validated['division_id'] = $validated['division'];
                unset($validated['division']);

                $employee->update($validated);
            });

            return response()->json([
                'status'  => 'success',
                'message' => 'Data berhasil diperbarui',
                'data'    => $employee->fresh()
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan',
            ], 404);

        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data yang dikirim tidak valid',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error saat memperbarui data karyawan: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Terjadi kesalahan pada server' . $e->getMessage(),
            ], 500);
        }
    }
    private function updateEmployeeImage($image, Employee $employee)
    {
        if ($employee->image) {
            Storage::delete(str_replace('/storage', 'public', $employee->image));
        }
        $path = $image->store('images', 'public');
        return asset('storage/' . $path);
    }
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            Storage::delete(str_replace('/storage', 'public', $employee->image));
            $employee->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
            ]);

        } catch (\Exception $e) {
            Log::error('Error saat menghapus data karyawan: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan pada server',
            ], 500);
        }
        }
    }
