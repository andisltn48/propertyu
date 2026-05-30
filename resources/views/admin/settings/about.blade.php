@extends('layouts.admin')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
    <form action="{{ route('admin.settings.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        <div>
            <label class="block text-sm font-bold text-[#1C1C1C] mb-4">Konten Profil Perusahaan</label>
            <div class="rounded-xl overflow-hidden border border-[#E5DDD4]">
                <textarea name="konten" id="editor" class="w-full">{{ $about->konten ?? '' }}</textarea>
            </div>
            <p class="text-[11px] text-[#6B6B6B] mt-2 ml-1 font-medium">Gunakan editor di atas untuk memformat teks, menambahkan link, atau poin-poin.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start">
            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-4">Cover Image</label>
                <div class="relative group">
                    <input type="file" name="foto" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div class="w-full py-10 border-2 border-dashed border-[#E5DDD4] rounded-2xl flex flex-col items-center justify-center bg-[#F6F3EF] group-hover:bg-[#FDFBF9] group-hover:border-[#B8914A]/40 transition-all">
                        <svg class="w-8 h-8 text-[#6B6B6B] mb-2 group-hover:text-[#B8914A] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <p class="text-xs font-bold text-[#6B6B6B] uppercase tracking-wider">Change Photo</p>
                    </div>
                </div>
            </div>

            @if($about->foto)
            <div>
                <label class="block text-sm font-bold text-[#6B6B6B] mb-4 uppercase tracking-widest">Preview Saat Ini</label>
                <div class="aspect-video rounded-2xl overflow-hidden shadow-md border-4 border-white">
                    <img src="{{ asset('storage/' . $about->foto) }}" class="w-full h-full object-cover">
                </div>
            </div>
            @endif
        </div>

        <div class="flex justify-end pt-6 border-t border-[#F6F3EF]">
            <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                Simpan Profil
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor', {
        height: 300,
        removeButtons: 'PasteFromWord'
    });
</script>
@endsection
