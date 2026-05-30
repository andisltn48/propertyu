@extends('layouts.admin')

@section('title', 'Maps & Lokasi')

@section('content')
<div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
    <form action="{{ route('admin.settings.maps.update') }}" method="POST" class="space-y-8">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Iframe Google Maps</label>
                    <textarea name="link_maps" rows="6"
                        class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-mono text-xs"
                        placeholder="Tempelkan tag <iframe> dari Google Maps di sini...">{{ $map->link_maps ?? '' }}</textarea>
                    <p class="text-[11px] text-[#6B6B6B] mt-2 ml-1 font-medium italic">Buka Google Maps > Share > Embed a map > Copy HTML</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Alamat Lengkap (Teks)</label>
                    <textarea name="alamat_teks" rows="4"
                        class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-medium"
                        placeholder="Contoh: Jl. Arsitektur No. 123, Jakarta Selatan...">{{ $map->alamat_teks ?? '' }}</textarea>
                </div>
            </div>

            <div class="space-y-4">
                <label class="block text-sm font-bold text-[#6B6B6B] uppercase tracking-widest">Preview Peta Saat Ini</label>
                <div class="bg-[#F6F3EF] rounded-2xl overflow-hidden border border-[#E5DDD4] min-h-[300px] flex items-center justify-center relative">
                    @if($map && $map->link_maps)
                        <div class="absolute inset-0">
                            {!! $map->link_maps !!}
                        </div>
                    @else
                        <div class="text-center p-10">
                            <svg class="w-12 h-12 text-[#E5DDD4] mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <p class="text-xs font-bold text-[#6B6B6B] uppercase tracking-wider">No Map Data Found</p>
                        </div>
                    @endif
                </div>
                <style>
                    .bg-\[\#F6F3EF\] iframe { width: 100%; height: 100%; border: 0; }
                </style>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-[#F6F3EF]">
            <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                Update Lokasi
            </button>
        </div>
    </form>
</div>
@endsection
