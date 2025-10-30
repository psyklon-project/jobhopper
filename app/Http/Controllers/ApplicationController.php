<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Position;
use App\Models\Message;

class ApplicationController extends Controller
{
    public function apply(Request $request, $positionId)
	{
		$user = $request->user();

		// Check if profile is complete
		if (empty($user->bio) || empty($user->profile_picture)) {
			return redirect()->back()->with('error', 'Please upload a profile picture and fill your bio before applying.');
		}

		// Check if the user has already applied for this position
		$existingApplication = Application::where('user_id', $user->id)
			->where('position_id', $positionId)
			->first();

		if ($existingApplication) {
			return redirect()->back()->with('error', 'You have already applied for this position.');
		}

		// Check if the position is still open for applications and has not reached max applicants
		$position = Position::where('status', 'open')->findOrFail($positionId);
		if ($position->applications->count() >= $position->max_applicants) {
			return redirect()->back()->with('error', 'This position is no longer accepting applications.');
		}

		// Create a new application
		\App\Models\Application::create([
			'user_id' => $user->id,
			'position_id' => $positionId,
		]);

		return redirect()->back()->with('success', 'Application submitted successfully.');
	}

	public function accept($applicationId)
	{
		$application = Application::findOrFail($applicationId);
		$application->status = 'accepted';
		$application->save();

		$message = new Message();
		$message->user_id = $application->user_id;
		$message->message = 'Congratulations! Your application for the position "' . $application->position->title . '" has been accepted.';
		$message->save();

		return redirect()->back()->with('success', 'Application accepted successfully.');
	}

	public function reject($applicationId)
	{
		$application = Application::findOrFail($applicationId);
		$application->status = 'rejected';
		$application->save();

		$message = new Message();
		$message->user_id = $application->user_id;
		$message->message = 'We are sorry to inform you that your application for the position "' . $application->position->title . '" has been rejected.';
		$message->save();

		return redirect()->back()->with('success', 'Application rejected successfully.');
	}
}
