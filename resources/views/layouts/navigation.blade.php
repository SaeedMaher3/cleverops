@php
    $user = auth()->user();

    $canViewProjects = $user->hasPermission('projects.view') || $user->hasRole('admin');
    $canViewTeams = $user->hasPermission('teams.view') || $user->hasRole('admin');
    $canViewTasks = $user->hasPermission('tasks.view') || $user->hasRole('admin');
    $canViewDocuments = $user->hasPermission('documents.view') || $user->hasRole('admin');

    $canViewEmployees = $user->hasPermission('employees.view') || $user->hasRole('admin');
    $canViewDepartments = $user->hasPermission('departments.view') || $user->hasRole('admin');
    $canViewUsers = $user->hasPermission('users.view') || $user->hasRole('admin');
    $canViewRoles = $user->hasPermission('roles.view') || $user->hasRole('admin');

    $canViewFinance = $user->hasPermission('finance.view') || $user->hasPermission('income.view') || $user->hasPermission('expenses.view') || $user->hasRole('admin');
@endphp

<aside
    class="fixed left-0 top-0 h-screen bg-gradient-to-b from-[#1A0040] via-[#160033] to-[#0D1B3E] text-white overflow-y-auto sidebar-scroll z-50 transition-all duration-300"
    :class="sidebarOpen ? 'w-[300px]' : 'w-[72px]'"
>
    <div class="px-3 pt-7 pb-5 text-center border-b border-white/10 overflow-hidden">
        <img src="{{ asset('images/logo (3).png') }}"
             class="mx-auto object-contain transition-all duration-300"
             :class="sidebarOpen ? 'w-24 h-24' : 'w-12 h-12'"
             alt="Logo">

        <h2 x-show="sidebarOpen" x-transition class="mt-3 text-3xl font-black leading-tight">
            CleverOps
        </h2>

        <p x-show="sidebarOpen" x-transition class="text-cyan-300 text-xs mt-1 font-bold tracking-wide">
            Clever Mind POB
        </p>
    </div>

    <nav class="px-4 py-5 pb-28">

        <div class="sidebar-section" x-show="sidebarOpen" x-transition>Main</div>

        @if($user->hasPermission('dashboard.view') || $user->hasRole('admin'))
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
                <span class="sidebar-icon">📊</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Dashboard</span>
            </a>
        @endif

        <a href="{{ route('my-tasks.index') }}" class="sidebar-link {{ request()->routeIs('my-tasks.*') ? 'active' : '' }}" title="My Tasks">
            <span class="sidebar-icon">✅</span>
            <span class="sidebar-text" x-show="sidebarOpen" x-transition>My Tasks</span>
        </a>

        @if($user->hasPermission('notifications.view') || $user->hasRole('admin'))
            <a href="{{ route('notifications.index') }}" class="sidebar-link {{ request()->routeIs('notifications.*') ? 'active' : '' }}" title="Notifications">
                <span class="sidebar-icon">🔔</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Notifications</span>
            </a>
        @endif

        @if($canViewProjects || $canViewTeams || $canViewTasks)
            <div class="sidebar-section" x-show="sidebarOpen" x-transition>Workspace</div>
        @endif

        @if($canViewProjects)
            <a href="{{ route('projects.index') }}" class="sidebar-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" title="Projects">
                <span class="sidebar-icon">🚀</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Projects</span>
            </a>
        @endif

        @if($canViewTeams)
            <a href="{{ route('teams.index') }}" class="sidebar-link {{ request()->routeIs('teams.*') ? 'active' : '' }}" title="Teams">
                <span class="sidebar-icon">👥</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Teams</span>
            </a>
        @endif

        @if($canViewTasks)
            <a href="{{ route('team-tasks.index') }}" class="sidebar-link {{ request()->routeIs('team-tasks.*') ? 'active' : '' }}" title="Team Tasks">
                <span class="sidebar-icon">🧩</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Team Tasks</span>
            </a>
        @endif

        @if($canViewEmployees || $canViewDepartments || $canViewTasks || $canViewDocuments)
            <div class="sidebar-section" x-show="sidebarOpen" x-transition>Management</div>
        @endif

        @if($canViewEmployees)
            <a href="{{ route('employees.index') }}" class="sidebar-link {{ request()->routeIs('employees.*') ? 'active' : '' }}" title="Employees">
                <span class="sidebar-icon">👤</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Employees</span>
            </a>
        @endif

        @if($canViewDepartments)
            <a href="{{ route('departments.index') }}" class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" title="Departments">
                <span class="sidebar-icon">🏢</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Departments</span>
            </a>
        @endif

        @if($canViewTasks)
            <a href="{{ route('tasks.index') }}" class="sidebar-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}" title="Tasks">
                <span class="sidebar-icon">📋</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Tasks</span>
            </a>
        @endif

        @if($canViewDocuments)
            <a href="{{ route('documents.index') }}" class="sidebar-link {{ request()->routeIs('documents.*') ? 'active' : '' }}" title="Documents">
                <span class="sidebar-icon">📁</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Documents</span>
            </a>
        @endif

        @if($canViewUsers || $canViewRoles)
            <div class="sidebar-section" x-show="sidebarOpen" x-transition>Administration</div>
        @endif

        @if($canViewUsers)
            <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}" title="Users">
                <span class="sidebar-icon">🧑‍💻</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Users</span>
            </a>
        @endif

        @if($canViewRoles)
            <a href="{{ route('roles.index') }}" class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" title="Roles">
                <span class="sidebar-icon">🔐</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Roles</span>
            </a>
        @endif

        @if($canViewFinance)
            <div class="sidebar-section" x-show="sidebarOpen" x-transition>Business</div>
        @endif

        @if($user->hasPermission('finance.view') || $user->hasRole('admin'))
            <a href="{{ route('finance.index') }}" class="sidebar-link {{ request()->routeIs('finance.*') ? 'active' : '' }}" title="Finance">
                <span class="sidebar-icon">📈</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Finance</span>
            </a>
        @endif

        @if($user->hasPermission('income.view') || $user->hasRole('admin'))
            <a href="{{ route('incomes.index') }}" class="sidebar-link {{ request()->routeIs('incomes.*') ? 'active' : '' }}" title="Income">
                <span class="sidebar-icon">💵</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Income</span>
            </a>
        @endif

        @if($user->hasPermission('expenses.view') || $user->hasRole('admin'))
            <a href="{{ route('expenses.index') }}" class="sidebar-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}" title="Expenses">
                <span class="sidebar-icon">💸</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Expenses</span>
            </a>
        @endif

        <div class="sidebar-section" x-show="sidebarOpen" x-transition>Account</div>

        <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" title="Profile">
            <span class="sidebar-icon">⚙️</span>
            <span class="sidebar-text" x-show="sidebarOpen" x-transition>Profile</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link logout w-full" title="Logout">
                <span class="sidebar-icon">🚪</span>
                <span class="sidebar-text" x-show="sidebarOpen" x-transition>Logout</span>
            </button>
        </form>

        <div class="sidebar-footer" x-show="sidebarOpen" x-transition>
            <span>CleverOps v1.0</span>
            <small>Enterprise Workspace</small>
        </div>

    </nav>
</aside>

<style>
.sidebar-scroll{
    scrollbar-width:none;
}

.sidebar-scroll::-webkit-scrollbar{
    display:none;
}

.sidebar-section{
    margin:24px 10px 10px;
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:.12em;
    color:rgba(255,255,255,.42);
    font-weight:900;
}

.sidebar-link{
    position:relative;
    display:flex;
    align-items:center;
    gap:12px;
    min-height:48px;
    padding:12px 16px;
    border-radius:18px;
    color:rgba(255,255,255,.82);
    font-weight:800;
    font-size:14px;
    transition:.25s ease;
    margin-bottom:6px;
    white-space:nowrap;
}

.sidebar-link:hover{
    background:rgba(255,255,255,.10);
    color:white;
    transform:translateX(3px);
}

.sidebar-link.active{
    color:white;
    background:linear-gradient(135deg,#9333EA,#D946EF);
    box-shadow:0 18px 38px rgba(217,70,239,.35);
}

.sidebar-link.active::before{
    content:"";
    position:absolute;
    left:-8px;
    top:13px;
    width:4px;
    height:22px;
    border-radius:999px;
    background:#22D3EE;
}

.sidebar-icon{
    width:24px;
    height:24px;
    min-width:24px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:17px;
    flex-shrink:0;
}

.sidebar-text{
    overflow:hidden;
}

aside.w-\[72px\] nav{
    padding-left:10px;
    padding-right:10px;
}

aside.w-\[72px\] .sidebar-link{
    justify-content:center;
    padding:12px 0;
}

aside.w-\[72px\] .sidebar-icon{
    margin:auto;
}

aside.w-\[72px\] .sidebar-link.active::before{
    left:-4px;
}

.logout{
    color:#fecaca;
}

.logout:hover{
    background:rgba(239,68,68,.16);
    color:#fff;
}

.sidebar-footer{
    margin:26px 10px 0;
    padding:18px;
    border-radius:22px;
    background:rgba(255,255,255,.07);
    border:1px solid rgba(255,255,255,.10);
}

.sidebar-footer span{
    display:block;
    font-weight:900;
    color:white;
    font-size:13px;
}

.sidebar-footer small{
    display:block;
    margin-top:4px;
    color:rgba(255,255,255,.45);
    font-size:11px;
    font-weight:700;
}
</style>