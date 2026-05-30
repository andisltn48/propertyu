@extends('layouts.admin')

@section('title', 'Create New Article')

@section('content')
<div class="bg-[#FDFBF9] p-10 rounded-2xl border border-[#E5DDD4] shadow-sm">
    <form action="{{ route('admin.articles.store') }}" method="POST" class="space-y-8">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Article Title</label>
                <input type="text" name="title" required
                    class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-bold"
                    placeholder="Contoh: Tren Desain Interior 2026">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Category</label>
                    <select name="category" required class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-semibold">
                        <option value="Arsitektur">Arsitektur</option>
                        <option value="Interior">Interior</option>
                        <option value="Investasi">Investasi</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Lifestyle">Lifestyle</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-[#1C1C1C] mb-3">Publish Date</label>
                    <input type="date" name="published_at" value="{{ date('Y-m-d') }}" required
                        class="w-full px-5 py-4 bg-[#F6F3EF] border-none rounded-xl focus:ring-2 focus:ring-[#B8914A]/20 focus:bg-white transition-all outline-none font-semibold">
                </div>
            </div>
        </div>

        <div>
            <label class="block text-sm font-bold text-[#1C1C1C] mb-4">Content</label>
            <div class="rounded-xl overflow-hidden border border-[#E5DDD4]">
                <textarea name="content" id="editor" class="w-full"></textarea>
            </div>
        </div>

        <div class="flex justify-end pt-6 border-t border-[#F6F3EF]">
            <button type="submit" class="px-10 py-4 bg-[#1C1C1C] text-white rounded-xl font-bold hover:bg-[#B8914A] transition-all">
                Publish Article
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
@endsection
