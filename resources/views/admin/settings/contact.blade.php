@extends('layouts.admin')

@section('title', 'Kontak WhatsApp')

@section('content')
<div class="max-w-2xl">
    <div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-[#F6F3EF] rounded-xl flex items-center justify-center" style="color: #B8914A;">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.353-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.123.57-.081 1.758-.47 2.006-1.259.248-.79.248-1.463.173-1.611-.075-.15-.272-.24-.57-.39l-.015-.007zM12.193 20.222c-2.106 0-4.156-.546-5.961-1.584l-.427-.246-4.43 1.162 1.182-4.321-.269-.427A9.22 9.22 0 012.983 9.94c0-5.107 4.154-9.26 9.263-9.26 2.476 0 4.803.965 6.551 2.713 1.748 1.748 2.71 4.075 2.71 6.551 0 5.108-4.154 9.262-9.262 9.262h-.052z"/></svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-[#1C1C1C]">WhatsApp Integration</h3>
                <p class="text-sm text-[#6B6B6B] font-medium">Nomor yang terhubung dengan tombol "Private Chat"</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.contact.update') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Nomor WhatsApp Aktif</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-[#6B6B6B] font-bold">+</span>
                    <input type="text" name="no_whatsapp" value="{{ $contact->no_whatsapp ?? '' }}"
                        class="w-full pl-10 pr-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-bold text-lg"
                        placeholder="Contoh: 6281234567890">
                </div>
                <div class="mt-4 p-4 bg-[#F6F3EF] rounded-xl border border-[#E5DDD4] flex items-start gap-3">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: #B8914A;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-[11px] text-[#1C1C1C] font-medium leading-relaxed">
                        Pastikan nomor diawali dengan kode negara (Indonesia: 62). Jangan gunakan simbol (+), spasi, atau tanda hubung (-).
                    </p>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                    Update WhatsApp
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
