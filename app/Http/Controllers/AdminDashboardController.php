<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

	public function users()
	{
		$users = \App\Models\User::all();
		return view('admin.users.index', compact('users'));
	}

	public function viewUser($userId)
	{
		$user = \App\Models\User::findOrFail($userId);
		return view('admin.users.show', compact('user'));
	}
}
