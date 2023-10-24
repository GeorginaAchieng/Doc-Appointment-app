<?php
    
namespace App\Http\Controllers;
    
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class AppointmentController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:appointment-list|appointment-create|appointment-edit|appointment-delete', ['only' => ['index','show']]);
         $this->middleware('permission:appointment-create', ['only' => ['create','store']]);
         $this->middleware('permission:appointment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:appointment-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $appointments = Appointment::latest()->paginate(5);
        return view('appointments.index',compact('appointments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('appointments.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'date' => 'required',
            'appointmentType' => 'required',
        ]);
    
        Appointment::create($request->all());
    
        return redirect()->route('appointments.index')
                        ->with('success','Appointment created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment): View
    {
        return view('appointments.show',compact('appointment'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment): View
    {
        return view('appointments.edit',compact('appointment'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment): RedirectResponse
    {
         request()->validate([
            'date' => 'required',
            'appointmentType' => 'required',
        ]);
    
        $appointment->update($request->all());
    
        return redirect()->route('appointments.index')
                        ->with('success','Appointment updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        $appointment->delete();
    
        return redirect()->route('appointments.index')
                        ->with('success','Appointments deleted successfully');
    }
}