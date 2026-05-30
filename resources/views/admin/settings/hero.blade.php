@extends('layouts.admin')

@section('title', 'Hero Settings')

@section('content')
<div class="space-y-8">
    <div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <form action="{{ route('admin.settings.hero.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Overlay Heading Text</label>
                <input type="text" name="overlay_text" value="{{ $setting->overlay_text ?? '' }}"
                    class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium"
                    placeholder="Contoh: Space to Breath.">
                <p class="text-[11px] text-[#6B6B6B] mt-2 ml-1 font-medium">Gunakan tag &lt;br&gt; untuk baris baru.</p>
            </div>

            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Add New Hero Images</label>
                <div class="relative group">
                    <input type="file" name="images[]" multiple
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full py-12 border-2 border-dashed border-[#E5DDD4] rounded-2xl flex flex-col items-center justify-center bg-[#F6F3EF] group-hover:bg-[#FDFBF9] group-hover:border-[#B8914A]/40 transition-all">
                        <div class="w-12 h-12 bg-[#FDFBF9] rounded-xl shadow-sm flex items-center justify-center text-[#6B6B6B] mb-3 group-hover:text-[#B8914A] transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <p class="text-sm font-bold text-[#6B6B6B]">Click or drag images to upload</p>
                        <p class="text-xs text-[#6B6B6B] mt-1 opacity-70">Supports JPG, PNG, WEBP (Max 2MB)</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <div class="mb-8">
            <h3 class="text-xl font-bold text-[#1C1C1C]">Current Slideshow</h3>
            <p class="text-sm text-[#6B6B6B] font-medium">Manage existing hero background images</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($images as $img)
            <div class="relative group aspect-square rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <form action="{{ route('admin.settings.hero.delete', $img->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="w-12 h-12 bg-white/20 backdrop-blur-md text-white rounded-xl hover:bg-red-500 transition-all flex items-center justify-center border border-white/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
