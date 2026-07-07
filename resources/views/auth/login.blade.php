<x-guest-layout>
<style>
    .login-bg{
        background:
            radial-gradient(circle at 10% 35%, rgba(168,85,247,.45), transparent 28%),
            radial-gradient(circle at 90% 45%, rgba(34,211,238,.35), transparent 30%),
            linear-gradient(135deg,#080018,#160033,#071B3D);
    }

    .moving-grid{
        background-image: radial-gradient(rgba(255,255,255,.18) 1px, transparent 1px);
        background-size: 28px 28px;
        animation: gridMove 18s linear infinite;
    }

    @keyframes gridMove{
        from{ background-position:0 0; }
        to{ background-position:80px 80px; }
    }

    .wave{
        position:absolute;
        left:-10%;
        bottom:-120px;
        width:120%;
        height:330px;
        background:
            radial-gradient(circle, rgba(34,211,238,.9) 1px, transparent 2px);
        background-size:18px 18px;
        opacity:.45;
        transform:rotate(-6deg);
        animation: waveMove 6s ease-in-out infinite alternate;
        filter: drop-shadow(0 0 35px rgba(34,211,238,.5));
    }

    @keyframes waveMove{
        from{ transform:rotate(-6deg) translateY(0); }
        to{ transform:rotate(-3deg) translateY(-25px); }
    }

    .glass-card{
        background:linear-gradient(145deg,rgba(255,255,255,.12),rgba(255,255,255,.04));
        backdrop-filter:blur(22px);
        border:1px solid rgba(255,255,255,.22);
        box-shadow:0 30px 100px rgba(0,0,0,.45);
    }
</style>

<div class="min-h-screen login-bg relative overflow-hidden flex items-center justify-center px-8">

    <div class="absolute inset-0 moving-grid opacity-25"></div>
    <div class="absolute w-[520px] h-[520px] bg-purple-600/30 rounded-full blur-[130px] -left-40 top-20"></div>
    <div class="absolute w-[520px] h-[520px] bg-cyan-400/25 rounded-full blur-[130px] -right-40 bottom-10"></div>
    <div class="wave"></div>

    <div class="relative z-10 w-full max-w-[1250px] grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        <!-- Left Side -->
        <div class="text-center text-white px-6">

            <img src="{{ asset('images/logo (3).png') }}"
                 class="w-40 h-40 mx-auto object-contain mb-8"
                 alt="Logo">

            <h1 class="text-6xl font-extrabold mb-4">
                CleverOps
            </h1>

            <h2 class="text-3xl font-extrabold text-cyan-400 mb-8">
                Clever Mind POB
            </h2>

            <p class="text-2xl text-white/80 leading-relaxed max-w-xl mx-auto">
                Smart internal management system for employees, departments,
                roles, tasks, finance and documents.
            </p>

            <div class="flex justify-center gap-10 mt-14">
                <div>
                    <div class="w-20 h-20 mx-auto rounded-full bg-purple-700/40 flex items-center justify-center text-4xl shadow-lg">
                        ⚡
                    </div>
                    <p class="mt-3 text-xl">Fast</p>
                </div>

                <div>
                    <div class="w-20 h-20 mx-auto rounded-full bg-cyan-500/25 flex items-center justify-center text-4xl shadow-lg">
                        🛡️
                    </div>
                    <p class="mt-3 text-xl">Secure</p>
                </div>

                <div>
                    <div class="w-20 h-20 mx-auto rounded-full bg-purple-700/40 flex items-center justify-center text-4xl shadow-lg">
                        📊
                    </div>
                    <p class="mt-3 text-xl">Smart</p>
                </div>
            </div>

        </div>

        <!-- Login Form -->
        <div class="glass-card rounded-[36px] p-12 lg:p-16 text-white">

            <h2 class="text-5xl font-extrabold mb-3">
                Welcome Back 👋
            </h2>

            <p class="text-xl text-white/75 mb-10">
                Sign in to continue to your dashboard
            </p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" value="Email Address" class="text-white font-bold text-lg" />

                    <div class="relative mt-3">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-2xl text-cyan-300">✉️</span>

                        <x-text-input
                            id="email"
                            class="block w-full pl-16 pr-5 py-5 rounded-2xl bg-white/5 border border-purple-400/70 text-white placeholder:text-white/50 focus:border-cyan-400 focus:ring-cyan-400"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="Enter your email" />
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-300" />
                </div>

                <div class="mt-7">
                    <x-input-label for="password" value="Password" class="text-white font-bold text-lg" />

                    <div class="relative mt-3">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-2xl text-cyan-300">🔒</span>

                        <x-text-input
                            id="password"
                            class="block w-full pl-16 pr-5 py-5 rounded-2xl bg-white/5 border border-purple-400/70 text-white placeholder:text-white/50 focus:border-cyan-400 focus:ring-cyan-400"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password" />
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-300" />
                </div>

                <div class="flex items-center justify-between mt-7">
                    <label for="remember_me" class="inline-flex items-center">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="rounded border-purple-300 bg-transparent text-purple-600 shadow-sm focus:ring-purple-500"
                            name="remember">

                        <span class="ms-3 text-lg text-white">
                            Remember me
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-lg text-cyan-400 hover:text-cyan-300 font-bold"
                           href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="mt-9 w-full py-5 rounded-2xl bg-gradient-to-r from-fuchsia-500 via-purple-600 to-cyan-400 text-white text-xl font-extrabold shadow-[0_20px_45px_rgba(34,211,238,.25)] hover:scale-[1.02] transition">
                    Login
                </button>

            </form>

            <p class="text-center text-white/60 text-lg mt-10">
                © {{ date('Y') }} Clever Mind POB. All rights reserved.
            </p>

        </div>

    </div>

</div>
</x-guest-layout>