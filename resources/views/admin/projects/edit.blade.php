@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Property Name</label>
                    <input type="text" name="name" value="{{ $project->name }}" required
                        class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-bold"
                        placeholder="Contoh: The Nordic Tropics">
                </div>

                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Detail & Specifications</label>
                    <div class="rounded-xl overflow-hidden border border-[#E5DDD4]">
                        <textarea name="detail" id="editor" class="w-full">{{ $project->detail }}</textarea>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Current Images</label>
                    <div class="grid grid-cols-3 gap-4 mb-6">
                        @foreach($project->images as $img)
                        <div class="relative group aspect-square rounded-xl overflow-hidden shadow-sm">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <button type="button" onclick="if(confirm('Hapus foto ini?')) { document.getElementById('delete-img-{{ $img->id }}').submit(); }"
                                    class="w-8 h-8 bg-white/20 backdrop-blur-md text-white rounded-xl hover:bg-red-500 transition-all flex items-center justify-center border border-white/30">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <label class="block text-xs font-bold text-[#6B6B6B] mb-3 uppercase tracking-wider">Add More Photos</label>
                    <div class="relative group">
                        <input type="file" name="images[]" multiple
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="w-full py-8 border-2 border-dashed border-[#E5DDD4] rounded-2xl flex flex-col items-center justify-center bg-[#F6F3EF] group-hover:bg-[#FDFBF9] group-hover:border-[#B8914A]/40 transition-all">
                            <svg class="w-6 h-6 text-[#6B6B6B] mb-2 group-hover:text-[#B8914A] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <p class="text-[10px] font-bold text-[#6B6B6B] uppercase">Upload More</p>
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
                            @if($project->file_3d_path)
                                <p class="text-[10px] text-[#D4B87A] font-bold uppercase tracking-widest flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    File Active: {{ basename($project->file_3d_path) }}
                                </p>
                            @else
                                <p class="text-[10px] text-white/50 uppercase tracking-widest">No Active 3D File</p>
                            @endif
                        </div>
                    </div>

                    <label class="block text-xs font-bold text-white/70 mb-3 uppercase tracking-wider">Replace .GLB File</label>
                    <input type="file" name="file_3d" accept=".glb"
                        class="w-full text-xs text-white/50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#B8914A] file:text-white hover:file:bg-[#8E6F36] cursor-pointer">
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-[#F6F3EF]">
            <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                Update Project
            </button>
        </div>
    </form>

    @foreach($project->images as $img)
    <form id="delete-img-{{ $img->id }}" action="{{ route('admin.projects.image.delete', $img->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endforeach
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endsection
