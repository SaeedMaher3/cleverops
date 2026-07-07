<style>
#calendar .calendar-workspace{
    background:#fff !important;
    border-radius:24px !important;
    padding:24px !important;
    box-shadow:0 18px 45px rgba(15,23,42,.08) !important;
}

#calendar .calendar-header{
    display:flex !important;
    justify-content:space-between !important;
    align-items:center !important;
    margin-bottom:20px !important;
}

#calendar .calendar-actions{
    display:flex !important;
    align-items:center !important;
    gap:12px !important;
}

#calendar .calendar-actions button{
    width:38px !important;
    height:38px !important;
    border:0 !important;
    border-radius:12px !important;
    background:#8b5cf6 !important;
    color:white !important;
    font-size:24px !important;
    cursor:pointer !important;
}

#calendar .calendar-legend{
    display:flex !important;
    gap:12px !important;
    margin-bottom:18px !important;
}

#calendar .calendar-legend span{
    background:#f8fafc !important;
    padding:8px 12px !important;
    border-radius:999px !important;
    font-weight:700 !important;
}

#calendar .calendar-legend i{
    display:inline-block !important;
    width:10px !important;
    height:10px !important;
    border-radius:50% !important;
    margin-right:6px !important;
}

#calendar .calendar-grid{
    display:grid !important;
    grid-template-columns:repeat(7, minmax(0, 1fr)) !important;
    gap:12px !important;
}

#calendar .calendar-weekdays div{
    text-align:center !important;
    font-weight:800 !important;
    color:#64748b !important;
    padding:12px !important;
}

#calendar .calendar-day{
    min-height:120px !important;
    background:#f8fafc !important;
    border:1px solid #e5e7eb !important;
    border-radius:18px !important;
    padding:12px !important;
    cursor:pointer !important;
}

#calendar .calendar-day.empty{
    background:transparent !important;
    border:none !important;
}

#calendar .calendar-day.today{
    background:#f5f3ff !important;
    border:2px solid #8b5cf6 !important;
}

#calendar .calendar-day-number{
    font-weight:900 !important;
    margin-bottom:8px !important;
}

#calendar .calendar-event{
    color:white !important;
    font-size:12px !important;
    padding:6px 8px !important;
    border-radius:10px !important;
    margin-bottom:6px !important;
}
#calendar .calendar-modal {
    position: fixed !important;
    inset: 0 !important;
    background: rgba(15, 23, 42, 0.55) !important;
    display: none !important;
    align-items: center !important;
    justify-content: center !important;
    z-index: 99999 !important;
}

#calendar .calendar-modal.show {
    display: flex !important;
}

#calendar .calendar-modal-box {
    width: 430px !important;
    max-width: 94% !important;
    background: white !important;
    border-radius: 24px !important;
    padding: 22px !important;
    box-shadow: 0 30px 90px rgba(0,0,0,.25) !important;
}

#calendar .calendar-modal-header {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-bottom: 18px !important;
}

#calendar .calendar-modal-header h3 {
    margin: 0 !important;
    font-size: 20px !important;
}

#calendar .calendar-modal-header button {
    border: none !important;
    background: #f1f5f9 !important;
    width: 34px !important;
    height: 34px !important;
    border-radius: 50% !important;
    font-size: 22px !important;
    cursor: pointer !important;
}

#calendar .calendar-modal-box label {
    display: block !important;
    margin: 12px 0 6px !important;
    font-weight: 800 !important;
    color: #334155 !important;
}

#calendar .calendar-modal-box input,
#calendar .calendar-modal-box select,
#calendar .calendar-modal-box textarea {
    width: 100% !important;
    border: 1px solid #e5e7eb !important;
    border-radius: 14px !important;
    padding: 12px 14px !important;
    outline: none !important;
}

#calendar .calendar-modal-box textarea {
    resize: vertical !important;
}

#calendar .calendar-modal-box button[type="submit"] {
    width: 100% !important;
    margin-top: 18px !important;
    border: none !important;
    border-radius: 14px !important;
    padding: 13px !important;
    background: linear-gradient(135deg, #7c3aed, #2563eb) !important;
    color: white !important;
    font-weight: 900 !important;
    cursor: pointer !important;
}

#calendar .calendar-view-details {
    background: #f8fafc !important;
    border-radius: 16px !important;
    padding: 14px !important;
    margin-bottom: 16px !important;
}

#calendar .calendar-delete-btn {
    background: #ef4444 !important;
}
</style>
@php
    $calendarItems = [];

    if ($project->deadline) {
        $calendarItems[] = [
            'title' => 'Project Deadline',
            'date' => \Carbon\Carbon::parse($project->deadline)->format('Y-m-d'),
            'type' => 'deadline',
            'color' => '#ef4444',
            'system' => true,
        ];
    }

    foreach ($projectTasks as $task) {
        if (!empty($task->deadline)) {
            $calendarItems[] = [
                'title' => $task->title,
                'date' => \Carbon\Carbon::parse($task->deadline)->format('Y-m-d'),
                'type' => 'task',
                'color' => '#7c3aed',
                'system' => true,
            ];
        }
    }

    foreach ($project->projectEvents ?? [] as $event) {
        $calendarItems[] = [
            'id' => $event->id,
            'title' => $event->title,
            'date' => \Carbon\Carbon::parse($event->event_date)->format('Y-m-d'),
            'time' => $event->event_time,
            'type' => $event->type,
            'color' => $event->color,
            'description' => $event->description,
            'system' => false,
        ];
    }
@endphp

<div class="calendar-workspace" data-calendar-items='@json($calendarItems)'>

    <div class="calendar-header">
        <div>
            <h2>Project Calendar</h2>
            <p>Manage meetings, deadlines, milestones and project tasks.</p>
        </div>

        <div class="calendar-actions">
            <button type="button" id="prevMonth">‹</button>
            <strong id="calendarMonthLabel"></strong>
            <button type="button" id="nextMonth">›</button>
        </div>
    </div>

    <div class="calendar-legend">
        <span><i style="background:#7c3aed"></i> Task</span>
        <span><i style="background:#ef4444"></i> Deadline</span>
        <span><i style="background:#0ea5e9"></i> Meeting</span>
        <span><i style="background:#f59e0b"></i> Milestone</span>
    </div>

    <div class="calendar-grid calendar-weekdays">
        <div>Sun</div>
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
    </div>

    <div class="calendar-grid" id="calendarDays"></div>
</div>

<div class="calendar-modal" id="calendarModal">
    <div class="calendar-modal-box">
        <div class="calendar-modal-header">
            <h3>Add Calendar Event</h3>
            <button type="button" id="closeCalendarModal">×</button>
        </div>

        <form method="POST" action="{{ route('projects.events.store', $project) }}">
            @csrf

            <input type="hidden" name="event_date" id="calendarEventDate">

            <label>Event Title</label>
            <input type="text" name="title" placeholder="Example: Client Meeting" required>

            <label>Type</label>
            <select name="type">
                <option value="meeting">Meeting</option>
                <option value="deadline">Deadline</option>
                <option value="milestone">Milestone</option>
                <option value="task">Task</option>
            </select>

            <label>Time</label>
            <input type="time" name="event_time">

            <label>Description</label>
            <textarea name="description" rows="3" placeholder="Write event notes..."></textarea>

            <button type="submit">Save Event</button>
        </form>
    </div>
</div>

<div class="calendar-modal" id="calendarViewModal">
    <div class="calendar-modal-box">
        <div class="calendar-modal-header">
            <h3 id="viewEventTitle">Event Details</h3>
            <button type="button" id="closeViewCalendarModal">×</button>
        </div>

        <div class="calendar-view-details">
            <p><strong>Date:</strong> <span id="viewEventDate"></span></p>
            <p><strong>Time:</strong> <span id="viewEventTime"></span></p>
            <p><strong>Type:</strong> <span id="viewEventType"></span></p>
            <p id="viewEventDescriptionWrap">
                <strong>Description:</strong>
                <span id="viewEventDescription"></span>
            </p>
        </div>

        <form method="POST" id="deleteEventForm" style="display:none;">
            @csrf
            @method('DELETE')

            <button type="submit" class="calendar-delete-btn">
                Delete Event
            </button>
        </form>
    </div>
</div>