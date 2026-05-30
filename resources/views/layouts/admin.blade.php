<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — PropertyU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Akt:wght@100..900&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --cream: #F6F3EF;
            --ivory: #FDFBF9;
            --charcoal: #1C1C1C;
            --gold: #B8914A;
            --gold-light: #D4B87A;
            --gold-dark: #8E6F36;
            --teal: #1A2E2A;
            --muted: #6B6B6B;
            --border: #E5DDD4;
            --shadow-sm: 0 4px 20px rgba(26, 30, 30, 0.04);
            --shadow-md: 0 8px 40px rgba(26, 30, 30, 0.06);
        }

        body {
            font-family: 'Akt', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .sidebar-item-active {
            background-color: rgba(184, 145, 74, 0.08);
            color: #B8914A !important;
            border-right: 3px solid #B8914A;
        }

        .sidebar-sub-active {
            color: #B8914A !important;
        }

        .sidebar-sub-dot {
            background-color: #B8914A !important;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 100px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--gold-light); }
    </style>
    @stack('styles')
</head>
<body class="bg-[#F6F3EF] text-[#1C1C1C]">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-72 bg-[#FDFBF9] border-r border-[#E5DDD4] flex-shrink-0 flex flex-col">
            <div class="p-8">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-extrabold tracking-tighter text-[#1C1C1C] flex items-center gap-3">
                    <span class="w-9 h-9 bg-[#B8914A] rounded-xl flex items-center justify-center text-white text-lg font-bold">P</span>
                    Property<span class="text-[#B8914A]">U</span>
                </a>
            </div>

            <nav class="flex-1 px-4 space-y-1">
                <div class="px-4 py-3 text-[10px] font-bold text-[#6B6B6B] uppercase tracking-[2px]">Main</div>

                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-[#6B6B6B] hover:bg-[#F6F3EF] hover:text-[#1C1C1C] rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'sidebar-item-active' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a11 11 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="font-semibold text-sm">Dashboard</span>
                </a>

                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-4 py-3 text-[#6B6B6B] hover:bg-[#F6F3EF] hover:text-[#1C1C1C] rounded-xl transition-all duration-200 {{ request()->routeIs('admin.projects.*') ? 'sidebar-item-active' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-semibold text-sm">Manage Projects</span>
                </a>

                <a href="{{ route('admin.articles.index') }}" class="flex items-center px-4 py-3 text-[#6B6B6B] hover:bg-[#F6F3EF] hover:text-[#1C1C1C] rounded-xl transition-all duration-200 {{ request()->routeIs('admin.articles.*') ? 'sidebar-item-active' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    <span class="font-semibold text-sm">Articles & News</span>
                </a>

                <a href="{{ route('admin.gallery') }}" class="flex items-center px-4 py-3 text-[#6B6B6B] hover:bg-[#F6F3EF] hover:text-[#1C1C1C] rounded-xl transition-all duration-200 {{ request()->routeIs('admin.gallery') ? 'sidebar-item-active' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="font-semibold text-sm">Galeri Foto</span>
                </a>

                <div class="px-4 py-6 text-[10px] font-bold text-[#6B6B6B] uppercase tracking-[2px]">Administration</div>

                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-[#6B6B6B] hover:bg-[#F6F3EF] hover:text-[#1C1C1C] rounded-xl transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'sidebar-item-active' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>
                    <span class="font-semibold text-sm">Admin Users</span>
                </a>

                <div class="px-4 py-6 text-[10px] font-bold text-[#6B6B6B] uppercase tracking-[2px]">Company Profile</div>

                <div x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-[#6B6B6B] hover:bg-[#F6F3EF] hover:text-[#1C1C1C] rounded-xl transition-all duration-200 focus:outline-none">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span class="font-semibold text-sm">Settings</span>
                        </div>
                        <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" class="ml-4 mt-1 space-y-1">
                        <a href="{{ route('admin.settings.hero') }}" class="flex items-center px-4 py-2.5 text-sm text-[#6B6B6B] hover:text-[#B8914A] transition-colors {{ request()->routeIs('admin.settings.hero') ? 'sidebar-sub-active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E5DDD4] mr-3 {{ request()->routeIs('admin.settings.hero') ? 'sidebar-sub-dot' : '' }}"></span>
                            Hero Page
                        </a>
                        <a href="{{ route('admin.settings.about') }}" class="flex items-center px-4 py-2.5 text-sm text-[#6B6B6B] hover:text-[#B8914A] transition-colors {{ request()->routeIs('admin.settings.about') ? 'sidebar-sub-active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E5DDD4] mr-3 {{ request()->routeIs('admin.settings.about') ? 'sidebar-sub-dot' : '' }}"></span>
                            Tentang Kami
                        </a>
                        <a href="{{ route('admin.settings.contact') }}" class="flex items-center px-4 py-2.5 text-sm text-[#6B6B6B] hover:text-[#B8914A] transition-colors {{ request()->routeIs('admin.settings.contact') ? 'sidebar-sub-active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E5DDD4] mr-3 {{ request()->routeIs('admin.settings.contact') ? 'sidebar-sub-dot' : '' }}"></span>
                            Kontak WA
                        </a>
                        <a href="{{ route('admin.settings.maps') }}" class="flex items-center px-4 py-2.5 text-sm text-[#6B6B6B] hover:text-[#B8914A] transition-colors {{ request()->routeIs('admin.settings.maps') ? 'sidebar-sub-active' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E5DDD4] mr-3 {{ request()->routeIs('admin.settings.maps') ? 'sidebar-sub-dot' : '' }}"></span>
                            Maps & Alamat
                        </a>
                    </div>
                </div>
            </nav>

            <div class="p-4 border-t border-[#E5DDD4]">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center justify-center gap-2 px-4 py-3 bg-[#1C1C1C] text-white rounded-xl text-sm font-bold hover:bg-[#B8914A] transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    Lihat Website
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col h-screen overflow-y-auto">
            {{-- Header --}}
            <header class="sticky top-0 z-50 h-20 bg-[#FDFBF9]/80 backdrop-blur-md border-b border-[#E5DDD4] px-10 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-[#1C1C1C] tracking-tight">@yield('title')</h2>
                    <div class="flex items-center gap-2 text-xs text-[#6B6B6B] font-medium">
                        <span>Admin</span>
                        <span class="text-[#E5DDD4]">/</span>
                        <span class="text-[#B8914A] font-semibold">@yield('title')</span>
                    </div>
                </div>

                <div x-data="{ open: false }" class="relative flex items-center gap-6">
                    <button class="text-[#6B6B6B] hover:text-[#B8914A] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                    <div class="h-10 w-px bg-[#E5DDD4]"></div>
                    <div @click="open = !open" class="flex items-center gap-3 group cursor-pointer relative">
                        <div class="text-right">
                            <p class="text-sm font-bold text-[#1C1C1C] group-hover:text-[#B8914A] transition-colors">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] font-bold text-[#6B6B6B] uppercase tracking-widest">Administrator</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-[#F6F3EF] flex items-center justify-center text-[#B8914A] font-bold border-2 border-white shadow-sm">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>

                        {{-- Dropdown --}}
                        <div x-show="open" @click.outside="open = false"
                            class="absolute right-0 top-full mt-3 w-56 bg-[#FDFBF9] border border-[#E5DDD4] rounded-xl shadow-lg overflow-hidden z-50">
                            <div class="px-5 py-4 border-b border-[#F6F3EF]">
                                <p class="text-sm font-bold text-[#1C1C1C]">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-[#6B6B6B]">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-[#6B6B6B] hover:text-[#1C1C1C] hover:bg-[#F6F3EF] rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg>
                                    Manage Users
                                </a>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-[#6B6B6B] hover:text-red-600 hover:bg-[#F6F3EF] rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="p-10 max-w-7xl mx-auto w-full">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-8 p-4 bg-[#F6F3EF] border border-[#E5DDD4] flex items-center justify-between rounded-2xl shadow-sm">
                        <div class="flex items-center text-[#1C1C1C]">
                            <svg class="w-5 h-5 mr-3 text-[#B8914A]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="font-bold text-sm">{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-[#6B6B6B] hover:text-[#1C1C1C]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div x-data="{ show: true }" x-show="show" x-transition class="mb-8 p-6 bg-[#F6F3EF] border border-[#E5DDD4] rounded-2xl shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-[#1C1C1C]">
                                <svg class="w-5 h-5 mr-3 text-[#B8914A]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                <span class="font-black text-sm uppercase tracking-wider">Validation Errors Found</span>
                            </div>
                            <button @click="show = false" class="text-[#6B6B6B] hover:text-[#1C1C1C]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <ul class="space-y-2">
                            @foreach($errors->all() as $error)
                                <li class="flex items-center text-[#1C1C1C] text-sm font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#B8914A] mr-3"></span>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
