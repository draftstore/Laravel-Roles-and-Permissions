<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserActivityController extends Controller implements HasMiddleware
{
    //
    public static function middleware():array{
        return [
            new Middleware('permission:view activity',['only' => ['index']]),
        ];
    }

    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->get();
        return view('Activity_logs.list', compact('logs'));
    }
}
