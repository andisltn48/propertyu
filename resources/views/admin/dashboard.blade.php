@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-[#FDFBF9] p-6 rounded-2xl border border-[#E5DDD4] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 rounded-xl bg-[#F6F3EF] flex items-center justify-center" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <span class="text-[10px] font-bold px-3 py-1 rounded-full border border-[#E5DDD4] text-[#6B6B6B] uppercase tracking-wider">Images</span>
        </div>
        <h3 class="text-3xl font-bold text-[#1C1C1C]">{{ $stats['hero_count'] }}</h3>
        <p class="text-[#6B6B6B] text-sm font-medium mt-1">Hero Slide Photos</p>
    </div>

    <div class="bg-[#FDFBF9] p-6 rounded-2xl border border-[#E5DDD4] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 rounded-xl bg-[#F6F3EF] flex items-center justify-center" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <span class="text-[10px] font-bold px-3 py-1 rounded-full border border-[#E5DDD4] text-[#6B6B6B] uppercase tracking-wider">Inventory</span>
        </div>
        <h3 class="text-3xl font-bold text-[#1C1C1C]">{{ $stats['project_count'] }}</h3>
        <p class="text-[#6B6B6B] text-sm font-medium mt-1">Active Projects</p>
    </div>

    <div class="bg-[#FDFBF9] p-6 rounded-2xl border border-[#E5DDD4] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 rounded-xl bg-[#F6F3EF] flex items-center justify-center" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <span class="text-[10px] font-bold px-3 py-1 rounded-full border border-[#E5DDD4] text-[#6B6B6B] uppercase tracking-wider">News</span>
        </div>
        <h3 class="text-3xl font-bold text-[#1C1C1C]">{{ $stats['article_count'] }}</h3>
        <p class="text-[#6B6B6B] text-sm font-medium mt-1">Published Articles</p>
    </div>

    <div class="bg-[#FDFBF9] p-6 rounded-2xl border border-[#E5DDD4] shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-5">
            <div class="w-12 h-12 rounded-xl bg-[#F6F3EF] flex items-center justify-center" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            </div>
            <span class="text-[10px] font-bold px-3 py-1 rounded-full border border-[#E5DDD4] text-[#6B6B6B] uppercase tracking-wider">Contact</span>
        </div>
        <h3 class="text-3xl font-bold text-[#1C1C1C]">{{ $stats['has_contact'] ? 'Active' : 'None' }}</h3>
        <p class="text-[#6B6B6B] text-sm font-medium mt-1">WhatsApp Integration</p>
    </div>
</div>

<div class="mt-10 bg-[#FDFBF9] p-8 rounded-2xl border border-[#E5DDD4] shadow-sm">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h4 class="text-xl font-bold text-[#1C1C1C]">Quick Actions</h4>
            <p class="text-sm text-[#6B6B6B] font-medium">Manage your landing page content</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.settings.hero') }}" class="group relative p-5 flex items-center gap-4 bg-[#F6F3EF] rounded-xl hover:bg-[#1C1C1C] transition-all duration-300 overflow-hidden">
            <div class="relative z-10 w-12 h-12 bg-[#FDFBF9] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="font-bold text-[#1C1C1C] group-hover:text-white transition-colors">Update Hero Slideshow</p>
                <p class="text-xs text-[#6B6B6B] group-hover:text-white/70 transition-colors">Ganti foto background utama</p>
            </div>
        </a>

        <a href="{{ route('admin.settings.about') }}" class="group relative p-5 flex items-center gap-4 bg-[#F6F3EF] rounded-xl hover:bg-[#1C1C1C] transition-all duration-300 overflow-hidden">
            <div class="relative z-10 w-12 h-12 bg-[#FDFBF9] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="font-bold text-[#1C1C1C] group-hover:text-white transition-colors">Edit Tentang Kami</p>
                <p class="text-xs text-[#6B6B6B] group-hover:text-white/70 transition-colors">Perbarui profil perusahaan</p>
            </div>
        </a>

        <a href="{{ route('admin.articles.create') }}" class="group relative p-5 flex items-center gap-4 bg-[#F6F3EF] rounded-xl hover:bg-[#1C1C1C] transition-all duration-300 overflow-hidden">
            <div class="relative z-10 w-12 h-12 bg-[#FDFBF9] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="font-bold text-[#1C1C1C] group-hover:text-white transition-colors">Write New Article</p>
                <p class="text-xs text-[#6B6B6B] group-hover:text-white/70 transition-colors">Publikasikan berita terbaru</p>
            </div>
        </a>

        <a href="{{ route('users.create') }}" class="group relative p-5 flex items-center gap-4 bg-[#F6F3EF] rounded-xl hover:bg-[#1C1C1C] transition-all duration-300 overflow-hidden">
            <div class="relative z-10 w-12 h-12 bg-[#FDFBF9] rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform" style="color: #B8914A;">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="font-bold text-[#1C1C1C] group-hover:text-white transition-colors">Create Admin User</p>
                <p class="text-xs text-[#6B6B6B] group-hover:text-white/70 transition-colors">Tambahkan administrator baru</p>
            </div>
        </a>
    </div>
</div>
@endsection
