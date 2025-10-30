<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
		$applications = \App\Models\Application::where('user_id', auth()->id())->get();
		$acceptedCount = $applications->where('status', 'accepted')->count();
		$rejectedCount = $applications->where('status', 'rejected')->count();
		$pendingCount = $applications->where('status', 'pending')->count();
		
        return view('user.dashboard', compact('applications', 'acceptedCount', 'rejectedCount', 'pendingCount'));
    }

	public function positions()
	{
		$positions = \App\Models\Position::all()->where('status', 'open');
		return view('user.positions.index', compact('positions'));
	}

	public function details($positionId)
	{
		$position = \App\Models\Position::findOrFail($positionId);
		return view('user.positions.details', compact('position'));
	}
}
