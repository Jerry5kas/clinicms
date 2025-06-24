


@extends('layouts.master')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome to ClinicMS</h1>
    <div>
        Welcome to Patient's Dashboard
    </div>

    <p class="text-gray-700">This is the dashboard. You can manage doctors, patients, appointments, and more.</p>

    <div class="bg-[{{ theme_color() }}] text-white p-4">
        Primary color applied
    </div>

@endsection
