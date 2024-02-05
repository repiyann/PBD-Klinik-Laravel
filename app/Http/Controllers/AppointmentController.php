<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Record;
use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    public function showRecordAndDoctor(Request $request)
    {
        $user = Auth::user();
        $records = Record::where('user_id', $user->id)->get();
        $services = Doctor::distinct('service')->pluck('service');

        return view('dashboard', [
            'userHasRecord' => $records->isNotEmpty(),
            'records' => $records,
            'services' => $services
        ]);
    }

    public function getRecordData($id)
    {
        return response()->json(Record::find($id));
    }

    public function getAvailableDates($service)
    {
        $availableDates = Doctor::where('service', $service)
            ->pluck('work_days')
            ->flatten()
            ->unique()
            ->values();

        return response()->json($availableDates);
    }

    public function getAvailableDoctors($service, $selectedDate)
    {
        $availableDoctors = Doctor::where('service', $service)
            ->whereJsonContains('work_days', $selectedDate)
            ->get();

        return response()->json($availableDoctors);
    }
}