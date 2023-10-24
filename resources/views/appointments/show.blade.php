@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Appointment</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('appointments.index') }}"> Back</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Date:</strong>
                {{ $appointment->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>AppointmentType:</strong>
                {{ $appointment->appointmentType }}
            </div>
        </div>
    </div>
@endsection
<p class="text-center text-primary"><small>Doctor-Appointment.com</small></p>