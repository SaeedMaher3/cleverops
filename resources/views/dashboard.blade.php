@extends('layouts.app')

@section('content')

@php
    $departments = \App\Models\Department::withCount('employees')->take(4)->get();
    $recentEmployees = \App\Models\Employee::with(['department','role'])->latest()->take(5)->get();
@endphp

<style>
    .dash-page{
        color:#21005D;
    }

    .soft-card{
        background:#fff;
        border-radius:30px;
        box-shadow:0 18px 45px rgba(72, 38, 130, .10);
        border:1px solid rgba(91, 0, 200, .08);
    }

    .stat-card{
        min-height:150px;
        position:relative;
        overflow:hidden;
        transition:.3s;
    }

    .stat-card:hover{
        transform:translateY(-5px);
    }

    .stat-card::after{
        content:"";
        position:absolute;
        right:22px;
        bottom:22px;
        width:95px;
        height:45px;
        background-repeat:no-repeat;
        background-size:100% 100%;
        opacity:.95;
    }

    .wave-purple::after{
        background-image:url("data:image/svg+xml,%3Csvg width='120' height='55' viewBox='0 0 120 55' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 45 C25 5, 40 70, 60 30 S95 10, 116 5' fill='none' stroke='%237A00F5' stroke-width='6' stroke-linecap='round'/%3E%3Ccircle cx='116' cy='5' r='5' fill='%237A00F5'/%3E%3C/svg%3E");
    }

    .wave-cyan::after{
        background-image:url("data:image/svg+xml,%3Csvg width='120' height='55' viewBox='0 0 120 55' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 45 C25 5, 40 70, 60 30 S95 10, 116 5' fill='none' stroke='%2317BFE3' stroke-width='6' stroke-linecap='round'/%3E%3Ccircle cx='116' cy='5' r='5' fill='%2317BFE3'/%3E%3C/svg%3E");
    }

    .wave-yellow::after{
        background-image:url("data:image/svg+xml,%3Csvg width='120' height='55' viewBox='0 0 120 55' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 45 C25 5, 40 70, 60 30 S95 10, 116 5' fill='none' stroke='%23F5B800' stroke-width='6' stroke-linecap='round'/%3E%3Ccircle cx='116' cy='5' r='5' fill='%23F5B800'/%3E%3C/svg%3E");
    }

    .wave-pink::after{
        background-image:url("data:image/svg+xml,%3Csvg width='120' height='55' viewBox='0 0 120 55' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M4 45 C25 5, 40 70, 60 30 S95 10, 116 5' fill='none' stroke='%23F72575' stroke-width='6' stroke-linecap='round'/%3E%3Ccircle cx='116' cy='5' r='5' fill='%23F72575'/%3E%3C/svg%3E");
    }

    .icon-box{
        width:78px;
        height:78px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:36px;
        color:#fff;
        box-shadow:0 14px 26px rgba(0,0,0,.18);
        flex-shrink:0;
    }

    .small-icon{
        width:54px;
        height:54px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:24px;
        color:white;
        box-shadow:0 12px 24px rgba(0,0,0,.16);
    }

    .purple-bg{background:linear-gradient(135deg,#8B00FF,#5B00C8);}
    .cyan-bg{background:linear-gradient(135deg,#22D3EE,#0891B2);}
    .yellow-bg{background:linear-gradient(135deg,#FFD600,#F59E0B);}
    .pink-bg{background:linear-gradient(135deg,#FF3D8B,#E91E63);}

    .welcome-card{
        position:relative;
        overflow:hidden;
        min-height:280px;
        background:
            radial-gradient(circle at 88% 18%, rgba(139,0,255,.12) 0 2px, transparent 3px) 0 0/18px 18px,
            linear-gradient(135deg,#ffffff 0%,#ffffff 60%,#DDF8FF 100%);
    }

    .welcome-card::after{
        content:"";
        position:absolute;
        right:-55px;
        bottom:-65px;
        width:290px;
        height:170px;
        background:linear-gradient(135deg,rgba(34,211,238,.18),rgba(34,211,238,.95));
        border-radius:90% 0 0 0;
    }

    .orbit{
        position:relative;
        width:250px;
        height:250px;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-shrink:0;
    }

    .orbit::before,
    .orbit::after{
        content:"";
        position:absolute;
        border-radius:50%;
        border:2px solid rgba(139,0,255,.20);
    }

    .orbit::before{
        width:230px;
        height:230px;
        border-left-style:dashed;
    }

    .orbit::after{
        width:180px;
        height:180px;
        border-color:rgba(34,211,238,.25);
    }

    .dot{
        position:absolute;
        width:15px;
        height:15px;
        border-radius:50%;
        z-index:3;
    }

    .donut{
        width:205px;
        height:205px;
        border-radius:50%;
        background:conic-gradient(#7A00F5 0 38%, #17BFE3 38% 68%, #F72575 68% 86%, #F5B800 86% 100%);
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .donut-inner{
        width:118px;
        height:118px;
        border-radius:50%;
        background:white;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
    }

    .task-donut{
        width:165px;
        height:165px;
        border-radius:50%;
        background:conic-gradient(#7A00F5 0 38%, #17BFE3 38% 70%, #F72575 70% 100%);
        display:flex;
        align-items:center;
        justify-content:center;
    }

    .task-donut-inner{
        width:106px;
        height:106px;
        border-radius:50%;
        background:white;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
    }

    .quick-box{
        border:1px solid rgba(91,0,200,.12);
        border-radius:24px;
        min-height:138px;
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        gap:12px;
        background:#fff;
        color:#21005D;
        font-weight:900;
        transition:.25s;
    }

    .quick-box:hover{
        transform:translateY(-5px);
        box-shadow:0 18px 35px rgba(91,0,200,.14);
    }

    .quote-card{
        border-radius:28px;
        border:2px solid rgba(168,85,247,.25);
        background:linear-gradient(90deg,#fff,#fff7ff);
        overflow:hidden;
        position:relative;
    }

    .quote-card::after{
        content:"🚀";
        position:absolute;
        right:28px;
        bottom:8px;
        font-size:60px;
        transform:rotate(-20deg);
    }
</style>

<div class="dash-page w-full">

    <div class="mb-6">
        <h1 class="text-4xl font-extrabold text-[#21005D]">Dashboard</h1>
        <p class="text-lg text-[#21005D]/70 mt-1">
            Welcome back, <span class="font-extrabold text-purple-700">{{ Auth::user()->name }}</span> 👋
        </p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-7 mb-7">

        <div class="soft-card stat-card wave-purple p-7 border-l-[5px] border-purple-600">
            <div class="flex items-center gap-6">
                <div class="icon-box purple-bg">👥</div>
                <div>
                    <p class="font-extrabold text-lg">Total Employees</p>
                    <h2 class="text-5xl font-extrabold mt-1">{{ $employeesCount }}</h2>
                    <p class="text-purple-600 text-base font-semibold mt-3">↑ 0% from last month</p>
                </div>
            </div>
        </div>

        <div class="soft-card stat-card wave-cyan p-7 border-l-[5px] border-cyan-400">
            <div class="flex items-center gap-6">
                <div class="icon-box cyan-bg">🏢</div>
                <div>
                    <p class="font-extrabold text-lg">Total Departments</p>
                    <h2 class="text-5xl font-extrabold mt-1">{{ $departmentsCount }}</h2>
                    <p class="text-cyan-500 text-base font-semibold mt-3">↑ 0% from last month</p>
                </div>
            </div>
        </div>

        <div class="soft-card stat-card wave-yellow p-7 border-l-[5px] border-yellow-400">
            <div class="flex items-center gap-6">
                <div class="icon-box yellow-bg">🛡️</div>
                <div>
                    <p class="font-extrabold text-lg">Total Roles</p>
                    <h2 class="text-5xl font-extrabold mt-1">{{ $rolesCount }}</h2>
                    <p class="text-yellow-500 text-base font-semibold mt-3">↑ 0% from last month</p>
                </div>
            </div>
        </div>

        <div class="soft-card stat-card wave-pink p-7 border-l-[5px] border-pink-500">
            <div class="flex items-center gap-6">
                <div class="icon-box pink-bg">📋</div>
                <div>
                    <p class="font-extrabold text-lg">Total Tasks</p>
                    <h2 class="text-5xl font-extrabold mt-1">0</h2>
                    <p class="text-pink-500 text-base font-semibold mt-3">↑ 0% from last month</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Welcome + Departments -->
    <div class="grid grid-cols-1 xl:grid-cols-5 gap-7 mb-7">

        <div class="soft-card welcome-card xl:col-span-3 p-8">
            <div class="relative z-10 flex items-center gap-10 h-full">

                <div class="orbit">
                    <span class="dot bg-cyan-400" style="left:38px; top:45px;"></span>
                    <span class="dot bg-purple-700" style="right:35px; top:42px;"></span>
                    <span class="dot bg-pink-500" style="right:42px; bottom:56px;"></span>
                    <span class="dot bg-cyan-400" style="left:36px; bottom:70px;"></span>

                    <img src="{{ asset('images/logo (3).png') }}"
                         class="relative z-10 w-44 h-44 object-contain"
                         alt="Logo">
                </div>

                <div>
                    <h2 class="text-4xl xl:text-5xl font-extrabold leading-tight">
                        Welcome to <br>
                        <span class="text-purple-700">Clever Mind</span>
                        <span class="text-cyan-500">POB</span>
                    </h2>

                    <div class="w-64 h-2 rounded-full bg-gradient-to-r from-purple-700 via-cyan-400 to-cyan-200 my-5"></div>

                    <p class="text-xl leading-relaxed text-[#21005D]/70 max-w-lg">
                        Smart internal management system for departments, employees,
                        tasks, finance and documents.
                    </p>

                    <span class="inline-flex items-center gap-2 mt-5 bg-emerald-100 text-emerald-700 px-6 py-2 rounded-full text-lg font-extrabold">
                        ● System Online
                    </span>
                </div>

            </div>
        </div>

        <div class="soft-card xl:col-span-2 p-8">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-4">
                    <div class="small-icon purple-bg">📊</div>
                    <h3 class="text-2xl font-extrabold">Employees by Department</h3>
                </div>

                <span class="px-5 py-2 rounded-full border text-sm font-bold">
                    This Month
                </span>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="flex justify-center">
                    <div class="donut">
                        <div class="donut-inner">
                            <div class="text-3xl">👥</div>
                            <b class="text-4xl">{{ $employeesCount }}</b>
                            <span>Total</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-5">
                    @forelse($departments as $index => $department)
                        @php
                            $colors = ['bg-purple-700','bg-cyan-400','bg-pink-500','bg-yellow-400'];
                        @endphp

                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="w-5 h-5 rounded-full {{ $colors[$index] ?? 'bg-purple-700' }}"></span>
                                <span class="font-bold">{{ $department->name }}</span>
                            </div>

                            <b>
                                {{ $department->employees_count }}
                                @if($employeesCount > 0)
                                    <span class="font-normal">({{ round(($department->employees_count / $employeesCount) * 100) }}%)</span>
                                @else
                                    <span class="font-normal">(0%)</span>
                                @endif
                            </b>
                        </div>
                    @empty
                        <p class="text-slate-500 font-semibold">No departments yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-7 mb-7">

        <div class="soft-card p-7 min-h-[330px]">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-2xl font-extrabold">Recent Employees</h3>
                <a href="{{ route('employees.index') }}" class="text-cyan-500 font-extrabold">View all</a>
            </div>

            <div class="space-y-4">
                @forelse($recentEmployees as $employee)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-14 h-14 rounded-full purple-bg text-white flex items-center justify-center text-xl font-extrabold">
                                    {{ strtoupper(substr($employee->full_name, 0, 1)) }}
                                </div>
                                <span class="absolute right-0 bottom-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                            </div>

                            <div>
                                <h4 class="font-extrabold">{{ $employee->full_name }}</h4>
                                <p class="text-sm text-[#21005D]/60">{{ $employee->department->name ?? '-' }}</p>
                            </div>
                        </div>

                        <span class="px-4 py-1 rounded-full bg-purple-100 text-purple-700 font-extrabold text-sm">
                            {{ $employee->role->display_name ?? '-' }}
                        </span>
                    </div>
                @empty
                    <p class="text-slate-500 font-semibold">No employees yet.</p>
                @endforelse
            </div>
        </div>

        <div class="soft-card p-7 min-h-[330px]">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-2xl font-extrabold">Tasks Overview</h3>
                <a href="#" class="text-cyan-500 font-extrabold">View all</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 items-center">
                <div class="flex justify-center">
                    <div class="task-donut">
                        <div class="task-donut-inner">
                            <b class="text-4xl">0</b>
                            <span>Total Tasks</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center p-4 rounded-2xl bg-purple-50">
                        <span class="font-bold">✅ Completed</span><b>0</b>
                    </div>

                    <div class="flex justify-between items-center p-4 rounded-2xl bg-cyan-50">
                        <span class="font-bold">🕒 In Progress</span><b>0</b>
                    </div>

                    <div class="flex justify-between items-center p-4 rounded-2xl bg-yellow-50">
                        <span class="font-bold">⏳ Pending</span><b>0</b>
                    </div>

                    <div class="flex justify-between items-center p-4 rounded-2xl bg-pink-50">
                        <span class="font-bold">🚨 Overdue</span><b>0</b>
                    </div>
                </div>
            </div>
        </div>

        <div class="soft-card p-7 min-h-[330px]">
            <div class="flex items-center gap-4 mb-6">
                <div class="small-icon purple-bg">⚡</div>
                <h3 class="text-2xl font-extrabold">Quick Actions</h3>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <a href="{{ route('employees.create') }}" class="quick-box">
                    <div class="small-icon purple-bg">👥</div>
                    Add Employee
                </a>

                <a href="{{ route('departments.create') }}" class="quick-box">
                    <div class="small-icon cyan-bg">🏢</div>
                    Add Department
                </a>

                <a href="#" class="quick-box">
                    <div class="small-icon pink-bg">📋</div>
                    Add Task
                </a>

                <a href="{{ route('roles.create') }}" class="quick-box">
                    <div class="small-icon yellow-bg">🛡️</div>
                    Add Role
                </a>
            </div>
        </div>

    </div>

    <div class="quote-card px-10 py-6 text-center text-xl font-semibold">
        <span class="text-4xl text-purple-700 align-middle">“</span>
        Great teams don’t just work, they believe, collaborate and achieve together.
        <span class="font-extrabold text-purple-700">– Clever Mind POB</span> 💡
    </div>

</div>

@endsection