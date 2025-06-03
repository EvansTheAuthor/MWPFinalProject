<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index(Request $request, $category)
    {
        $limit = $request->query('limit', 10);
        $page = $request->query('page', 1);

        $query = Doctor::where('category', $category);
        $total = $query->count();
        $doctors = $query->skip(($page - 1) * $limit)->take($limit)->get();

        return response()->json([
            'doctors' => $doctors,
            'hasMore' => $page * $limit < $total,
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
        ]);
    }
}
