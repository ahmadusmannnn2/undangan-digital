<nav x-data="{ open: false }" class="glass border-b border-white/40 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-indigo-600 tracking-tight hover:scale-105 transition-transform">
                        Undangan<span class="text-slate-800">Pro</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-indigo-600 transition-colors">
                        <i class="fas fa-layer-group mr-2 opacity-70"></i> Workspace
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                    <x-nav-link :href="route('admin.templates.index')" :active="request()->routeIs('admin.templates.*')">
                        <i class="fas fa-paint-brush mr-2 opacity-70"></i> Tema
                    </x-nav-link>
                    <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('admin.orders.*')">
                        <i class="fas fa-inbox mr-2 opacity-70"></i> Transaksi
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-white/50 text-sm leading-4 font-bold rounded-full text-slate-600 bg-white/40 hover:bg-white/80 hover:text-indigo-600 focus:outline-none transition shadow-sm backdrop-blur-md">
                            <div class="w-6 h-6 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-full text-white flex items-center justify-center mr-2 text-xs">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1"><i class="fas fa-chevron-down text-[10px]"></i></div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="glass border border-white/50 rounded-lg shadow-xl overflow-hidden p-1">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded hover:bg-indigo-50 hover:text-indigo-600 font-medium transition">
                                <i class="fas fa-user-circle mr-2"></i> {{ __('Profile Settings') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="rounded hover:bg-red-50 hover:text-red-600 font-medium transition text-red-500">
                                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-white/50 focus:outline-none transition">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>