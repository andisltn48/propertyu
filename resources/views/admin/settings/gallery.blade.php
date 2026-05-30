@extends('layouts.admin')

@section('title', 'Galeri Foto')

@section('content')
<div class="space-y-8">
    <div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-4">Add Photos to Gallery</label>
                <div class="relative group">
                    <input type="file" name="images[]" multiple required
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full py-16 border-2 border-dashed border-[#E5DDD4] rounded-2xl flex flex-col items-center justify-center bg-[#F6F3EF] group-hover:bg-[#FDFBF9] group-hover:border-[#B8914A]/40 transition-all">
                        <div class="w-14 h-14 bg-[#FDFBF9] rounded-xl shadow-sm flex items-center justify-center text-[#6B6B6B] mb-4 group-hover:text-[#B8914A] transition-colors">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <p class="text-base font-bold text-[#6B6B6B]">Select multiple images to upload</p>
                        <p class="text-xs text-[#6B6B6B] mt-2 font-medium opacity-70">JPG, PNG, WEBP (Max 3MB per file)</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                    Start Uploading
                </button>
            </div>
        </form>
    </div>

    <div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h3 class="text-2xl font-bold text-[#1C1C1C] tracking-tight">Gallery Assets</h3>
                <p class="text-sm text-[#6B6B6B] font-medium">Sorted by newest upload first</p>
            </div>
            <div class="px-4 py-2 bg-[#F6F3EF] rounded-xl text-xs font-bold text-[#6B6B6B] uppercase tracking-widest border border-[#E5DDD4]">
                Total: {{ $galleries->count() }} Photos
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse($galleries as $gallery)
            <div class="relative group aspect-[4/5] rounded-xl overflow-hidden bg-[#F6F3EF] shadow-sm hover:shadow-md transition-all duration-500 hover:-translate-y-1">
                <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                <div class="absolute inset-0 bg-gradient-to-t from-[#1C1C1C]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    <form action="{{ route('admin.gallery.delete', $gallery->id) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full py-3 bg-white/20 backdrop-blur-md text-white rounded-xl hover:bg-[#1C1C1C] transition-all flex items-center justify-center gap-2 border border-white/30 font-bold text-xs uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Delete
                        </button>
                    </form>
                </div>

                <div class="absolute top-4 left-4">
                    <span class="px-3 py-1 bg-white/10 backdrop-blur-md text-[10px] text-white font-bold rounded-lg border border-white/20 uppercase tracking-tighter">
                        {{ $gallery->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 flex flex-col items-center justify-center text-[#E5DDD4]">
                <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class="font-bold uppercase tracking-widest text-xs text-[#6B6B6B]">Gallery is empty</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
