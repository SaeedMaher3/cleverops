@extends('layouts.app')

@section('content')

@php
    $completed = $tasks->where('status','done')->count();
    $pending = $tasks->where('status','!=','done')->count();
@endphp

<div class="mytasks-page">

    <div class="page-header">
        <div>
            <span>Employee Workspace</span>
            <h1>My Tasks</h1>
            <p>All tasks assigned to you.</p>
        </div>

        <div class="header-stats">

            <div class="head-card">
                <h2>{{ $tasks->count() }}</h2>
                <span>Total</span>
            </div>

            <div class="head-card green">
                <h2>{{ $completed }}</h2>
                <span>Completed</span>
            </div>

            <div class="head-card orange">
                <h2>{{ $pending }}</h2>
                <span>Pending</span>
            </div>

        </div>
    </div>

    @forelse($tasks as $task)

        <div class="task-card">

            <div class="left">

                <h2>{{ $task->title }}</h2>

                <p>
                    {{ $task->description ?? 'No description.' }}
                </p>

                <div class="badges">

                    <span class="priority {{ $task->priority }}">
                        {{ ucfirst($task->priority) }}
                    </span>

                    <span>
                        {{ ucfirst(str_replace('_',' ',$task->status)) }}
                    </span>

                    <span>
                        {{ $task->project->name }}
                    </span>

                </div>

            </div>

            <div class="right">

                <small>Due Date</small>

                <strong>
                    {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}
                </strong>

            </div>

        </div>

    @empty

        <div class="empty">
            No tasks assigned to you.
        </div>

    @endforelse

</div>

<style>

.mytasks-page{
    padding:35px;
}

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.page-header h1{
    font-size:38px;
    font-weight:900;
}

.page-header p{
    color:#64748b;
}

.header-stats{
    display:flex;
    gap:15px;
}

.head-card{
    width:130px;
    background:white;
    border-radius:18px;
    padding:18px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.head-card.green{
    background:#dcfce7;
}

.head-card.orange{
    background:#fef3c7;
}

.head-card h2{
    margin:0;
    font-size:30px;
}

.task-card{
    background:white;
    border-radius:22px;
    padding:22px;
    display:flex;
    justify-content:space-between;
    margin-bottom:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.task-card h2{
    margin-bottom:8px;
}

.task-card p{
    color:#64748b;
}

.badges{
    display:flex;
    gap:8px;
    margin-top:18px;
    flex-wrap:wrap;
}

.badges span{
    padding:7px 12px;
    border-radius:999px;
    background:#eef2ff;
    font-size:12px;
    font-weight:800;
}

.priority.high{
    background:#fee2e2 !important;
}

.priority.medium{
    background:#fef3c7 !important;
}

.priority.low{
    background:#dcfce7 !important;
}

.right{
    text-align:right;
}

.empty{
    background:white;
    border-radius:22px;
    padding:50px;
    text-align:center;
    color:#64748b;
}

</style>

@endsection