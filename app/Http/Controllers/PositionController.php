<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;

class PositionController extends Controller
{
    public function index()
	{
		$positions = Position::all();
		return view('admin.positions.index', compact('positions'));
	}

	public function show(Position $position)
	{
		return view('admin.positions.show', compact('position'));
	}

	public function create()
	{
		return view('admin.positions.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'title' => 'required|string|max:255',
			'description' => 'required|string',
		]);

		Position::create($request->all());
		return redirect()->route('admin.positions.index')->with('success', 'Position created successfully.');
	}

	public function edit(Position $position)
	{
		return view('admin.positions.edit', compact('position'));
	}

	public function update(Request $request, Position $position)
	{
		$request->validate([
			'title' => 'required|string|max:255',
			'description' => 'required|string',
		]);

		$position->update($request->all());
		return redirect()->route('admin.positions.index')->with('success', 'Position updated successfully.');
	}

	public function destroy(Position $position)
	{
		$position->delete();
		return redirect()->route('admin.positions.index')->with('success', 'Position deleted successfully.');
	}
}
