<div id="taskPanel" class="task-panel">
    <button class="panel-close" onclick="closeTaskPanel()">×</button>

    <p class="panel-label">Task Details</p>
    <h2 id="panelTitle">Task title</h2>

    <div class="panel-info">
        <span id="panelPriority">Priority</span>
        <span id="panelAssignee">Assignee</span>
        <span id="panelDue">Due date</span>
    </div>

    <h4>Description</h4>
    <p id="panelDescription">Description</p>
</div>

<div id="panelOverlay" class="panel-overlay" onclick="closeTaskPanel()"></div>