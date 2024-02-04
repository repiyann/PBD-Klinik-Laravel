<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Record;
use App\Models\Service;
use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    public function showRecord(Request $request)
    {
        $user = Auth::user();
        $records = Record::where('user_id', $user->id)->get();
        $userHasRecord = $records->isNotEmpty();
        $services = Service::all();

        $selectedServiceId = $request->input('clinicService');
        $doctors = Doctor::whereHas('services', function ($query) use ($selectedServiceId) {
            $query->where('services.id', $selectedServiceId);
        })->get();

        return view('dashboard', ['userHasRecord' => $userHasRecord, 'records' => $records, 'services' => $services, 'doctors' => $doctors]);
    }

    public function getRecordData($id)
    {
        $record = Record::find($id);

        return response()->json($record);
    }

    public function getDoctors($serviceId)
    {
        $doctors = Doctor::whereHas('services', function ($query) use ($serviceId) {
            $query->where('services.id', $serviceId);
        })->get();

        return response()->json($doctors);
    }

    public function submitForm(Request $request): RedirectResponse
    {
        $recordOption = $request->input('recordOption');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $nationalID = $request->input('nationalID');
        $birthDate = $request->input('birthDate');
        $address = $request->input('address');
        $notes = $request->input('notes');

        if ($recordOption) {
            if ($recordOption === 'new') {
                $record = new Record;
                $record->firstName = $firstName;
                $record->lastName = $lastName;
                $record->nationalID = $nationalID;
                $record->birthDate = $birthDate;
                $record->address = $address;
                $record->notes = $notes;
                $record->save();
            }
        } else {
            $record = new Record;
            $record->firstName = $firstName;
            $record->lastName = $lastName;
            $record->nationalID = $nationalID;
            $record->birthDate = $birthDate;
            $record->address = $address;
            $record->notes = $notes;
            $record->save();
        }

        $reservation = new Appointment();
        $reservation->record_id = $record->id;
        $reservation->save();

        return redirect()->route('dashboard');
    }
}
