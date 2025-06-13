<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index(Request $request){
        try {
            $limit = $request->query('limit', 10);
            $appointments = $request->user()
            ->appointments()
            ->with('doctor')
            ->latest()
            ->paginate($limit);

            return response()->json([
                'success' => true,
                'appointments' => $appointments->items(),
                'hasMore' => $appointments->hasMorePages(),
                'page' => $appointments->currentPage(),
                'total' => $appointments->total()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil daftar janji temu.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'appointment_date' => 'required|date|after:today',
                'notes' => 'nullable|string|max:255'
            ]);

            $appointment = $request->user()->appointments()->create([
                'doctor_id' => $request->doctor_id,
                'appointment_date' => $request->appointment_date,
                'notes' => $request->notes,
                'status' => 'pending'
            ]);

            return response()->json(['success' => true ,'appointment' => $appointment]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat janji temu.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request, $id)
    {
        $appointment = $request->user()->appointments()->with('doctor')->find($id);
        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Janji temu tidak ditemukan.'
            ], 404);
        }
        return response()->json(['success' => true, 'appointment' => $appointment]);
    }

    public function cancel(Request $request, $id)
    {
        $appointment = $request->user()->appointments()->find($id);
        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Janji temu tidak ditemukan.'
            ], 404);
        }

        $now = now();
        $diffInDays = $now->diffInDays($appointment->appointment_date, false);

        if ($diffInDays < 3) {
            return response()->json([
                'success' => false,
                'message' => 'Janji temu hanya bisa dibatalkan minimal 3 hari sebelum tanggal janji.'
            ], 400);
        }

        if ($appointment->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Janji temu sudah tidak bisa dibatalkan.'
            ], 400);
        }

        try {
            $appointment->status = 'cancelled';
            $appointment->save();
            return response()->json(['success' => true, 'message' => 'Janji temu berhasil dibatalkan.']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membatalkan janji temu.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
