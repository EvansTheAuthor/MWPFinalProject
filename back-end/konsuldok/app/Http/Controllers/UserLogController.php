<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLog;

class UserLogController extends Controller
{
    public function index()
    {
        $logs = UserLog::where('user_id', auth()->id())->latest()->get();
        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $log = UserLog::create([
            'user_id' => auth()->id(),
            'activity' => $request->activity,
        ]);

        return response()->json(['success' => true, 'log' => $log]);
    }
}
