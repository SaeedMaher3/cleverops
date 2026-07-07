window.closeTaskPanel = function () {
    document.getElementById('taskPanel')?.classList.remove('open');
    document.getElementById('panelOverlay')?.classList.remove('open');
};

window.openCreateTaskModal = function () {
    document.getElementById('createTaskModal')?.classList.add('open');
    document.getElementById('createTaskOverlay')?.classList.add('open');
};

window.closeCreateTaskModal = function () {
    document.getElementById('createTaskModal')?.classList.remove('open');
    document.getElementById('createTaskOverlay')?.classList.remove('open');
};

document.addEventListener('DOMContentLoaded', function () {
    if (window.defaultWorkspaceTab) {
        document.querySelectorAll('.workspace-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        document.querySelectorAll('.workspace-tab-content').forEach(content => {
            content.classList.remove('active');
        });

        const activeTab = document.querySelector(
            `.workspace-tab[data-tab="${window.defaultWorkspaceTab}"]`
        );

        const activeContent = document.getElementById(window.defaultWorkspaceTab);

        if (activeTab) {
            activeTab.classList.add('active');
        }

        if (activeContent) {
            activeContent.classList.add('active');
        }
    }

    document.querySelectorAll('.workspace-tab').forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelectorAll('.workspace-tab').forEach(item => item.classList.remove('active'));
            document.querySelectorAll('.workspace-tab-content').forEach(content => content.classList.remove('active'));

            this.classList.add('active');

            const target = document.getElementById(this.dataset.tab);
            if (target) {
                target.classList.add('active');
            }
        });
    });

    let draggedTask = null;

    document.querySelectorAll('.kanban-task').forEach(task => {
        task.addEventListener('click', function (e) {
            if (e.target.tagName === 'BUTTON') return;
            if (e.target.closest('form')) return;

            document.getElementById('panelTitle').innerText = this.dataset.title;
            document.getElementById('panelPriority').innerText = 'Priority: ' + this.dataset.priority;
            document.getElementById('panelAssignee').innerText = 'Assignee: ' + this.dataset.assignee;
            document.getElementById('panelDue').innerText = 'Due: ' + this.dataset.due;
            document.getElementById('panelDescription').innerText = this.dataset.description;

            document.getElementById('taskPanel')?.classList.add('open');
            document.getElementById('panelOverlay')?.classList.add('open');
        });

        task.addEventListener('dragstart', function () {
            draggedTask = this;
            this.classList.add('dragging');
        });

        task.addEventListener('dragend', function () {
            this.classList.remove('dragging');
            draggedTask = null;
        });
    });

    document.querySelectorAll('.kanban-list').forEach(list => {
        list.addEventListener('dragover', function (e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        list.addEventListener('dragleave', function () {
            this.classList.remove('drag-over');
        });

        list.addEventListener('drop', function () {
            this.classList.remove('drag-over');

            if (!draggedTask) return;

            this.appendChild(draggedTask);

            const taskId = draggedTask.dataset.taskId;
            const newStatus = this.dataset.status;

            fetch(`${window.projectWorkspace.statusUrlBase}/${taskId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.projectWorkspace.csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: newStatus
                })
            });
        });
    });

    initProjectCalendar();
});

document.addEventListener('click', function (e) {
    const sendButton = e.target.closest('#sendChatMessage');

    if (!sendButton) return;

    const input = document.getElementById('chatMessageInput');
    const chatBody = document.getElementById('chatBody');

    if (!input || !chatBody) return;

    const text = input.value.trim();

    if (!text) return;

    const time = new Date().toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });

    const message = document.createElement('div');
    message.className = 'message sent';
    message.innerHTML = `
        <p>${text}</p>
        <span>${time} ✓✓</span>
    `;

    chatBody.appendChild(message);
    input.value = '';
    chatBody.scrollTop = chatBody.scrollHeight;
});

document.addEventListener('keydown', function (e) {
    if (e.key !== 'Enter') return;
    if (e.target.id !== 'chatMessageInput') return;

    e.preventDefault();

    document.getElementById('sendChatMessage')?.click();
});

function initProjectCalendar() {
    const calendarBox = document.querySelector('.calendar-workspace');
    if (!calendarBox) return;

    const calendarDays = document.getElementById('calendarDays');
    const monthLabel = document.getElementById('calendarMonthLabel');
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');

    const addModal = document.getElementById('calendarModal');
    const closeAddModal = document.getElementById('closeCalendarModal');
    const eventDateInput = document.getElementById('calendarEventDate');

    const viewModal = document.getElementById('calendarViewModal');
    const closeViewModal = document.getElementById('closeViewCalendarModal');

    const viewTitle = document.getElementById('viewEventTitle');
    const viewDate = document.getElementById('viewEventDate');
    const viewTime = document.getElementById('viewEventTime');
    const viewType = document.getElementById('viewEventType');
    const viewDescription = document.getElementById('viewEventDescription');
    const viewDescriptionWrap = document.getElementById('viewEventDescriptionWrap');
    const deleteEventForm = document.getElementById('deleteEventForm');

    let currentDate = new Date();
    let events = [];

    try {
        events = JSON.parse(calendarBox.dataset.calendarItems || '[]');
    } catch (e) {
        events = [];
    }

    function formatDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return `${year}-${month}-${day}`;
    }

    function renderCalendar() {
        if (!calendarDays || !monthLabel) return;

        calendarDays.innerHTML = '';

        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);

        const startDay = firstDay.getDay();
        const totalDays = lastDay.getDate();

        monthLabel.textContent = currentDate.toLocaleDateString('en-US', {
            month: 'long',
            year: 'numeric'
        });

        for (let i = 0; i < startDay; i++) {
            const empty = document.createElement('div');
            empty.className = 'calendar-day empty';
            calendarDays.appendChild(empty);
        }

        for (let day = 1; day <= totalDays; day++) {
            const date = new Date(year, month, day);
            const dateString = formatDate(date);

            const dayBox = document.createElement('div');
            dayBox.className = 'calendar-day';

            if (dateString === formatDate(new Date())) {
                dayBox.classList.add('today');
            }

            dayBox.innerHTML = `<div class="calendar-day-number">${day}</div>`;

            const dayEvents = events.filter(event => event.date === dateString);

            dayEvents.forEach(event => {
                const item = document.createElement('div');
                item.className = 'calendar-event';
                item.style.background = event.color || '#64748b';
                item.textContent = event.time ? `${event.time} - ${event.title}` : event.title;

                item.addEventListener('click', function (e) {
                    e.stopPropagation();
                    openViewModal(event);
                });

                dayBox.appendChild(item);
            });

            dayBox.addEventListener('click', function () {
                if (!addModal || !eventDateInput) return;

                eventDateInput.value = dateString;
                addModal.classList.add('show');
            });

            calendarDays.appendChild(dayBox);
        }
    }

    function openViewModal(event) {
        if (!viewModal) return;

        viewTitle.textContent = event.title;
        viewDate.textContent = event.date;
        viewTime.textContent = event.time || 'Not set';
        viewType.textContent = event.type || 'Event';

        if (event.description) {
            viewDescriptionWrap.style.display = 'block';
            viewDescription.textContent = event.description;
        } else {
            viewDescriptionWrap.style.display = 'none';
        }

        if (event.system || !event.id) {
            deleteEventForm.style.display = 'none';
        } else {
            deleteEventForm.style.display = 'block';
            deleteEventForm.action = `/project-events/${event.id}`;
        }

        viewModal.classList.add('show');
    }

    prevBtn?.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextBtn?.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    closeAddModal?.addEventListener('click', function () {
        addModal.classList.remove('show');
    });

    closeViewModal?.addEventListener('click', function () {
        viewModal.classList.remove('show');
    });

    addModal?.addEventListener('click', function (e) {
        if (e.target === addModal) {
            addModal.classList.remove('show');
        }
    });

    viewModal?.addEventListener('click', function (e) {
        if (e.target === viewModal) {
            viewModal.classList.remove('show');
        }
    });

    renderCalendar();
}