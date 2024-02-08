<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Record;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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

    public function makeAppointment(Request $request): RedirectResponse
    {
        try {
            $user = Auth::user();

            $request->validate([
                'recordOption' => 'required|string|in:new,existing',
                'fName' => 'required|string',
                'lastName' => 'required|string',
                'nik' => ($request->recordOption == 'new') ? 'required|string|min:16|unique:records,nationalID' : 'nullable',
                'dateOfBirth' => 'required|date|date_format:Y-m-d',
                'address' => 'required',
                'notes' => 'nullable',
                'clinicService' => 'required|string',
                'dateAvailable' => 'required|date',
                'doctorSelect' => 'required|numeric',
                'timeSlot' => 'required|date_format:H:i',
            ]);

            if ($request->recordOption == 'new') {
                $user->records()->create([
                    'firstName' => $request->fName,
                    'lastName' => $request->lastName,
                    'nationalID' => $request->nik,
                    'birthDate' => $request->dateOfBirth,
                    'address' => $request->address,
                    'notes' => $request->notes,
                ]);
            }

            $existingAppointment = Appointment::where([
                'clinicService' => $request->clinicService,
                'dateAvailable' => $request->dateAvailable,
                'doctor_id' => $request->doctorSelect,
                'timeSlot' => $request->timeSlot,
            ])->first();

            if ($existingAppointment) {
                return redirect()->back()->with('error', 'Appointment already exists for the selected details.');
            }

            $user->appointment()->create([
                'record_id' => ($request->recordOption == 'existing') ? $request->existingRecord : null,
                'firstName' => $request->fName,
                'lastName' => $request->lastName,
                'clinicService' => $request->clinicService,
                'dateAvailable' => $request->dateAvailable,
                'doctor_id' => $request->doctorSelect,
                'timeSlot' => $request->timeSlot,
            ]);

            return redirect()->route('dashboard')->with('success', 'Appointment successfully made!');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors(['error' => 'Sorry, we are experiencing technical difficulties. Please try again later.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function checkTimeSlotAvailability(Request $request)
    {
        try {
            $request->validate([
                'clinicService' => 'required',
                'dateAvailable' => 'required',
                'doctorID' => 'required',
            ]);

            $clinicService = $request->clinicService;
            $dateAvailable = $request->dateAvailable;
            $doctorID = $request->doctorID;
            $selectedDoctor = Doctor::find($doctorID);

            $startWork = new DateTime('1970-01-01T' . $selectedDoctor->start_work . 'Z');
            $endWork = new DateTime('1970-01-01T' . $selectedDoctor->end_work . 'Z');
            $interval = new DateInterval('PT1H');
            $timeSlots = new DatePeriod($startWork, $interval, $endWork);
            
            $existingTimeSlots = Appointment::where([
                'clinicService' => $clinicService,
                'dateAvailable' => $dateAvailable,
                'doctor_id' => $doctorID,
            ])->pluck('timeSlot')->toArray();

            $availableTimeSlots = [];

            foreach ($timeSlots as $timeSlot) {
                $formattedTime = $timeSlot->format('H:i:s');

                if ($timeSlot >= $endWork) {
                    break;
                }

                if (!in_array($formattedTime, $existingTimeSlots)) {
                    $availableTimeSlots[] = $formattedTime;
                }
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Doctor not found.'], 404);
        }

        return response()->json(['availableTimeSlots' => $availableTimeSlots]);
    }

    public function checkQ(Request $request)
    {
        $data = $request->all();

        dd($data);
    }
}
