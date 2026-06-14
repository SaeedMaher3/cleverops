@extends('layouts.app')

@section('content')

<div class="w-full px-6 py-6">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Dashboard
        </h1>

        <p class="text-slate-500 mt-2">
            Welcome to CleverOps Internal Management System
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-sm text-slate-500">Employees</div>
            <div class="text-4xl font-bold text-blue-600 mt-2">0</div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-sm text-slate-500">Departments</div>
            <div class="text-4xl font-bold text-green-600 mt-2">0</div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-sm text-slate-500">Roles</div>
            <div class="text-4xl font-bold text-purple-600 mt-2">3</div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="text-sm text-slate-500">Tasks</div>
            <div class="text-4xl font-bold text-orange-500 mt-2">0</div>
        </div>

    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-xl shadow-lg p-8">

        <div class="flex items-center gap-6">

            <img src="{{ asset('images/logo (3).png') }}"
                 class="w-28 h-28 rounded-xl bg-slate-50 p-2"
                 alt="Logo">

            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Welcome to CleverOps
                </h2>

                <p class="text-slate-500 mt-2">
                    Smart internal management system for departments,
                    employees, tasks, finance and documents.
                </p>

                <div class="mt-4">
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                        System Online
                    </span>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection