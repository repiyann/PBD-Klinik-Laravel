<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RecordController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
            $records = Record::where('user_id', $user->id)->get();

            return view('user.record', compact('records'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to fetch records: ' . $e->getMessage()]);
        }
    }

    public function create(): View
    {
        return view('user.addRecord');
    }

    public function storeRecord(Request $request): RedirectResponse
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

            return redirect()->route('viewRecord')->with('success', 'Record added successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors(['error' => 'Sorry, we are experiencing technical difficulties. Please try again later.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function editRecord(string $id): View
    {
        try {
            $records = Record::findOrFail($id);

            return view('user.editRecord', ['record' => $records]);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to edit record: ' . $e->getMessage()]);
        }
    }

    public function updateRecord(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'nationalID' => 'required|min:16',
                'birthDate' => 'required|date|date_format:Y-m-d',
                'address' => 'required',
                'notes' => 'nullable',
            ]);

            $record = Record::findOrFail($id);

            $record->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'nationalID' => $request->input('nationalID'),
                'birthDate' => $request->input('birthDate'),
                'address' => $request->input('address'),
                'notes' => $request->input('notes'),
            ]);

            return redirect()->route('viewRecord')->with('success', 'Record updated successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withErrors(['error' => 'Sorry, we are experiencing technical difficulties. Please try again later.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function deleteRecord($recordId): RedirectResponse
    {
        try {
            $record = Record::findOrFail($recordId);
            $record->delete();

            return redirect()->route('viewRecord')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Unable to delete record: ' . $e->getMessage()]);
        }
    }
}
