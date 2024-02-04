<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Record;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    public function showRecord()
    {
        $user = Auth::user();
        $records = Record::where('user_id', $user->id)->get();

        $userHasRecord = $records->isNotEmpty();

        return view('dashboard', ['userHasRecord' => $userHasRecord, 'records' => $records]);
    }

    public function getRecordData($id)
    {
        $record = Record::find($id);
        return response()->json($record);
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

        $reservation = new Reservation;
        $reservation->record_id = $record->id;
        // Set other reservation details here
        $reservation->save();

        return redirect()->route('dashboard');
    }
}
