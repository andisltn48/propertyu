@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl">
    <div class="bg-[#FDFBF9] rounded-2xl border border-[#E5DDD4] shadow-sm">
        <div class="px-10 py-8 border-b border-[#F6F3EF]">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="w-10 h-10 bg-[#F6F3EF] rounded-xl flex items-center justify-center text-[#6B6B6B] hover:text-[#1C1C1C] transition-colors border border-[#E5DDD4]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h3 class="text-xl font-bold text-[#1C1C1C]">Edit Admin User</h3>
                    <p class="text-sm text-[#6B6B6B] font-medium">Update user details and permissions</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-10 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-5 py-3.5 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium @error('name') ring-2 ring-red-300 @enderror"
                    placeholder="John Doe">
                @error('name') <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-5 py-3.5 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium @error('email') ring-2 ring-red-300 @enderror"
                    placeholder="admin@propertyu.com">
                @error('email') <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="border-t border-[#F6F3EF] pt-6">
                <p class="text-sm font-bold text-[#1C1C1C] mb-1">Change Password</p>
                <p class="text-xs text-[#6B6B6B] mb-4">Leave blank to keep current password</p>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-[#1C1C1C] mb-2">New Password</label>
                        <input type="password" name="password"
                            class="w-full px-5 py-3.5 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium @error('password') ring-2 ring-red-300 @enderror"
                            placeholder="Min. 8 characters">
                        @error('password') <p class="text-xs text-red-500 mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1C1C1C] mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-5 py-3.5 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium"
                            placeholder="Repeat password">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="px-8 py-3.5 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all text-sm">
                    Update User
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-8 py-3.5 text-[#6B6B6B] font-bold hover:text-[#1C1C1C] transition-colors text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
