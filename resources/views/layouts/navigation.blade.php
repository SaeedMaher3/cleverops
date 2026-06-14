<aside class="app-sidebar fixed left-0 top-0 h-full">
    <div class="sidebar-logo text-center">
        <img src="{{ asset('images/logo (3).png') }}"
             alt="CleverOps Logo"
             class="w-24 h-24 mx-auto mb-3 rounded-full bg-white p-2">

        <div>CleverOps</div>
        <p class="text-xs text-slate-400 mt-1">Internal Company System</p>
    </div>

    <nav class="mt-4">
        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            📊 Dashboard
        </a>

        <div class="px-6 mt-5 mb-2 text-xs uppercase text-slate-500 font-bold">
            Workforce
        </div>

        <a href="{{ route('departments.index') }}"
           class="sidebar-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
            🏢 Departments
        </a>

        <a href="{{ route('roles.index') }}"
           class="sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
            🔐 Roles
        </a>

       <a href="{{ route('employees.index') }}"
   class="sidebar-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
    👥 Employees
</a>
        <div class="px-6 mt-5 mb-2 text-xs uppercase text-slate-500 font-bold">
            Modules
        </div>

        <a href="#" class="sidebar-link">📋 Tasks</a>
        <a href="#" class="sidebar-link">💰 Finance</a>
        <a href="#" class="sidebar-link">📁 Documents</a>

        <div class="px-6 mt-5 mb-2 text-xs uppercase text-slate-500 font-bold">
            Account
        </div>

        <a href="{{ route('profile.edit') }}"
           class="sidebar-link">
            ⚙️ Profile
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="sidebar-link w-full text-left">
                🚪 Logout
            </button>
        </form>
    </nav>
</aside>