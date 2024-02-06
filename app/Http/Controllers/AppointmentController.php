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

    public function getDoctor($id)
    {
        return response()->json(Doctor::find($id));
    }

    public function makeAppointment(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();

            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'nationalID' => 'required|unique:records,nationalID|min:16',
                'birthDate' => 'required|date|date_format:Y-m-d',
                'address' => 'required',
                'notes' => 'nullable',
            ]);

            $user->records()->create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'nationalID' => $request->input('nationalID'),
                'birthDate' => $request->input('birthDate'),
                'address' => $request->input('address'),
                'notes' => $request->input('notes'),
            ]);

            return redirect()->route('user.appointment')->with('success', 'Appointment successfully made!');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors(['error' => 'Sorry, we are experiencing technical difficulties. Please try again later.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function checkQ(Request $request)
    {
        $data = $request->all();
        $doctorSelect = $data['doctorSelect'];
        $doctor = Doctor::find($doctorSelect);
        // dd($doctor);
        return response()->json(['data' => $doctor]);
    }
}
