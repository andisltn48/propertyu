@extends('layouts.admin')

@section('title', 'Create New Project')

@section('content')
<div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Property Name</label>
                    <input type="text" name="name" required
                        class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-bold"
                        placeholder="Contoh: The Nordic Tropics">
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Detail & Specifications</label>
                    <div class="rounded-xl overflow-hidden border border-[#E5DDD4]">
                        <textarea name="detail" id="editor" class="w-full"></textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Upload Images (Multiple)</label>
                    <div class="relative group">
                        <input type="file" name="images[]" multiple required
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full py-12 border-2 border-dashed border-[#E5DDD4] rounded-2xl flex flex-col items-center justify-center bg-[#F6F3EF] group-hover:bg-[#FDFBF9] group-hover:border-[#B8914A]/40 transition-all">
                            <svg class="w-8 h-8 text-[#6B6B6B] mb-2 group-hover:text-[#B8914A] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="text-xs font-bold text-[#6B6B6B] uppercase">Drop photos here</p>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-[#1C1C1C] rounded-2xl text-white">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-[#B8914A] rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">3D Virtual Tour Asset</h4>
                            <p class="text-[10px] text-white/50 uppercase tracking-widest">Digital Twin Integration</p>
                        </div>
                    </div>

                    <label class="block text-xs font-bold text-white/70 mb-3 uppercase tracking-wider">Upload .GLB File</label>
                    <input type="file" name="file_3d" accept=".glb"
                        class="w-full text-xs text-white/50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#B8914A] file:text-white hover:file:bg-[#8E6F36] cursor-pointer">
                    <p class="text-[10px] text-white/30 mt-3 italic">*Pastikan format file adalah .glb untuk interaktivitas web.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-[#F6F3EF]">
            <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                Publish Project
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endsection
