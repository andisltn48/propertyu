@extends('layouts.admin')

@section('title', 'Admin Users')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-[#FDFBF9] p-8 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <div>
            <h3 class="text-xl font-bold text-[#1C1C1C]">Admin Users</h3>
            <p class="text-sm text-[#6B6B6B] font-medium">Manage who has access to the admin panel</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-[#B8914A] text-white rounded-xl font-bold hover:bg-[#8E6F36] transition-all flex items-center gap-2 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Create New Admin
        </a>
    </div>

    <div class="bg-[#FDFBF9] rounded-2xl border border-[#E5DDD4] shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-[#F6F3EF] border-b border-[#E5DDD4]">
                    <th class="px-8 py-5 text-xs font-bold text-[#6B6B6B] uppercase tracking-widest">Name</th>
                    <th class="px-8 py-5 text-xs font-bold text-[#6B6B6B] uppercase tracking-widest">Email</th>
                    <th class="px-8 py-5 text-xs font-bold text-[#6B6B6B] uppercase tracking-widest">Joined</th>
                    <th class="px-8 py-5 text-xs font-bold text-[#6B6B6B] uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F6F3EF]">
                @foreach($users as $user)
                <tr class="hover:bg-[#F6F3EF]/50 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-[#F6F3EF] flex items-center justify-center text-[#B8914A] font-bold">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <p class="font-bold text-[#1C1C1C]">{{ $user->name }}</p>
                                @if($user->id === auth()->id())
                                    <span class="text-[10px] font-bold text-[#B8914A] uppercase tracking-wider">You</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm text-[#6B6B6B] font-medium">{{ $user->email }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <p class="text-sm text-[#6B6B6B] font-medium">{{ $user->created_at->format('d M Y') }}</p>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="w-10 h-10 bg-[#F6F3EF] text-[#6B6B6B] rounded-xl flex items-center justify-center hover:bg-[#B8914A] hover:text-white transition-all border border-[#E5DDD4]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this admin user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-[#F6F3EF] text-[#6B6B6B] rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all border border-[#E5DDD4]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
