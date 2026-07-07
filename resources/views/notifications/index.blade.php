@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-8">

    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-black text-slate-800">
                🔔 Notifications
            </h1>

            <p class="text-slate-500 mt-2">
                Your latest task notifications.
            </p>
        </div>
    </div>

    @forelse($notifications as $notification)

        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-6 mb-5">

            <div class="flex justify-between items-start">

                <div>

                    <h3 class="text-xl font-bold">
                        {{ $notification->task->title }}
                    </h3>

                    <p class="text-slate-500 mt-2">
                        {{ $notification->message }}
                    </p>

                    <div class="mt-4 text-sm text-slate-400">
                        {{ $notification->created_at->diffForHumans() }}
                    </div>

                </div>

                @if(!$notification->is_read)

                    <form action="{{ route('notifications.read',$notification) }}"
                          method="POST">

                        @csrf
                        @method('PATCH')

                        <button
                            class="bg-violet-600 text-white px-5 py-2 rounded-xl font-bold hover:bg-violet-700">
                            Mark as read
                        </button>

                    </form>

                @else

                    <span
                        class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-bold">
                        Read
                    </span>

                @endif

            </div>

        </div>

    @empty

        <div class="bg-white rounded-3xl p-12 text-center shadow">

            <h2 class="text-2xl font-bold text-slate-700">
                🎉 No Notifications
            </h2>

            <p class="text-slate-500 mt-3">
                You're all caught up.
            </p>

        </div>

    @endforelse

</div>

@endsection