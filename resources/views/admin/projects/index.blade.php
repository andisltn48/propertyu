@extends('layouts.admin')

@section('title', 'Projects List')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-[#FDFBF9] p-8 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <div>
            <h3 class="text-xl font-bold text-[#1C1C1C]">Portfolio Properti</h3>
            <p class="text-sm text-[#6B6B6B] font-medium">Kelola semua project hunian PropertyU</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-6 py-3 bg-[#B8914A] text-white rounded-xl font-bold hover:bg-[#8E6F36] transition-all flex items-center gap-2 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add New Project
        </a>
    </div>

    <div class="bg-[#FDFBF9] rounded-2xl border border-[#E5DDD4] shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-[#F6F3EF] border-b border-[#E5DDD4]">
                    <th class="px-8 py-5 text-xs font-bold text-[#6B6B6B] uppercase tracking-widest">Property Name</th>
                    <th class="px-8 py-5 text-xs font-bold text-[#6B6B6B] uppercase tracking-widest">3D Asset</th>
                    <th class="px-8 py-5 text-xs font-bold text-[#6B6B6B] uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F6F3EF]">
                @forelse($projects as $project)
                <tr class="hover:bg-[#F6F3EF]/50 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl overflow-hidden bg-[#F6F3EF] flex-shrink-0">
                                @if($project->images->first())
                                    <img src="{{ asset('storage/' . $project->images->first()->image_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-[#E5DDD4]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-[#1C1C1C]">{{ $project->name }}</p>
                                <p class="text-[11px] text-[#6B6B6B] font-medium">Last updated {{ $project->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($project->file_3d_path)
                            <span class="px-3 py-1 bg-[#F6F3EF] text-[#B8914A] text-[10px] font-bold rounded-lg border border-[#E5DDD4] uppercase tracking-tighter flex items-center gap-1 w-fit">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                                .GLB Ready
                            </span>
                        @else
                            <span class="px-3 py-1 bg-[#F6F3EF] text-[#6B6B6B] text-[10px] font-bold rounded-lg border border-[#E5DDD4] uppercase tracking-tighter w-fit opacity-60">No 3D Asset</span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="w-10 h-10 bg-[#F6F3EF] text-[#6B6B6B] rounded-xl flex items-center justify-center hover:bg-[#B8914A] hover:text-white transition-all border border-[#E5DDD4]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Hapus project ini secara permanen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-[#F6F3EF] text-[#6B6B6B] rounded-xl flex items-center justify-center hover:bg-[#1C1C1C] hover:text-white transition-all border border-[#E5DDD4]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center justify-center text-[#E5DDD4]">
                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            <p class="font-bold uppercase tracking-widest text-xs text-[#6B6B6B]">No Projects Found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
