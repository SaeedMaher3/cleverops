<aside
    x-show="sidebarOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed left-0 top-0 h-screen w-[300px] bg-gradient-to-b from-[#1A0040] via-[#160033] to-[#0D1B3E] text-white overflow-y-auto sidebar-scroll z-50"
>

    <!-- Logo -->
    <div class="text-center pt-8 pb-8">

        <img
            src="{{ asset('images/logo (3).png') }}"
            class="w-32 h-32 mx-auto mb-4 object-contain"
            alt="Logo">

        <h2 class="text-4xl font-extrabold leading-tight">
            Clever Mind POB
        </h2>

        <p class="text-cyan-400 text-sm mt-2 font-semibold">
            Power Of Believing
        </p>

    </div>

    <nav class="px-4 pb-24">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-4 transition-all duration-300
           {{ request()->routeIs('dashboard')
                ? 'bg-gradient-to-r from-purple-600 to-fuchsia-500 shadow-lg'
                : 'hover:bg-white/10' }}">

            📊 <span class="font-semibold">Dashboard</span>
        </a>

        <!-- Workforce -->
        <div class="text-xs uppercase tracking-wider text-slate-400 px-4 mt-8 mb-4 font-bold">
            Workforce
        </div>

        <a href="{{ route('departments.index') }}"
           class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-2 hover:bg-white/10 transition">
            🏢 <span>Departments</span>
        </a>

        <a href="{{ route('roles.index') }}"
           class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-2 hover:bg-white/10 transition">
            🔐 <span>Roles</span>
        </a>

        <a href="{{ route('employees.index') }}"
           class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-2 hover:bg-white/10 transition">
            👥 <span>Employees</span>
        </a>

        <!-- Modules -->
        <div class="text-xs uppercase tracking-wider text-slate-400 px-4 mt-8 mb-4 font-bold">
            Modules
        </div>

        <a href="#" class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-2 hover:bg-white/10 transition">
            📋 <span>Tasks</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-2 hover:bg-white/10 transition">
            💰 <span>Finance</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-2 hover:bg-white/10 transition">
            📁 <span>Documents</span>
        </a>

        <!-- Account -->
        <div class="text-xs uppercase tracking-wider text-slate-400 px-4 mt-8 mb-4 font-bold">
            Account
        </div>

        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-5 py-4 rounded-2xl mb-2 hover:bg-white/10 transition">
            ⚙️ <span>Profile</span>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="flex items-center gap-3 px-5 py-4 rounded-2xl w-full text-left hover:bg-red-500/20 transition">
                🚪 <span>Logout</span>
            </button>
        </form>

    </nav>

</aside>

<style>
.sidebar-scroll{
    scrollbar-width:none;
}

.sidebar-scroll::-webkit-scrollbar{
    display:none;
}
</style>