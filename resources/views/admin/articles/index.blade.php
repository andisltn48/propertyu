@extends('layouts.admin')

@section('title', 'Articles List')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<style>
    :root {
        --cream: #F6F3EF;
        --ivory: #FDFBF9;
        --charcoal: #1C1C1C;
        --gold: #B8914A;
        --gold-light: #D4B87A;
        --muted: #6B6B6B;
        --border: #E5DDD4;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 100px;
        padding: 10px 18px;
        border: 1.5px solid var(--border);
        background: var(--cream);
        font-family: 'Akt', sans-serif;
        font-size: 0.85rem;
        outline: none;
        color: var(--charcoal);
        margin-bottom: 24px;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--gold);
    }
    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
        padding: 5px 10px;
        border: 1px solid var(--border);
        font-family: 'Akt', sans-serif;
        color: var(--charcoal);
        background: var(--ivory);
    }
    table.dataTable thead th {
        border-bottom: 1px solid var(--border) !important;
        background: var(--cream);
        color: var(--muted);
        font-weight: 700;
        font-size: 0.65rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding-top: 16px !important;
        padding-bottom: 16px !important;
    }
    table.dataTable.no-footer {
        border-bottom: 1px solid var(--border) !important;
    }
    table.dataTable tbody tr {
        border-bottom: 1px solid var(--cream);
    }
    table.dataTable tbody tr:hover {
        background: var(--cream) !important;
    }
    table.dataTable tbody td {
        padding-top: 20px !important;
        padding-bottom: 20px !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--charcoal) !important;
        color: white !important;
        border: none !important;
        border-radius: 100px !important;
        font-weight: 600 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 100px !important;
        font-family: 'Akt', sans-serif !important;
    }
    .dataTables_wrapper .dataTables_info {
        font-family: 'Akt', sans-serif;
        color: var(--muted);
        font-size: 0.8rem;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-[#FDFBF9] p-8 rounded-2xl border border-[#E5DDD4] shadow-sm">
        <div>
            <h3 class="text-xl font-bold text-[#1C1C1C]">Daftar Artikel</h3>
            <p class="text-sm text-[#6B6B6B] font-medium">Kelola publikasi dan berita terbaru</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" class="px-6 py-3 bg-[#B8914A] text-white rounded-xl font-bold hover:bg-[#8E6F36] transition-all flex items-center gap-2 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Create New Article
        </a>
    </div>

    <div class="bg-[#FDFBF9] p-8 rounded-2xl border border-[#E5DDD4] shadow-sm overflow-hidden">
        <table id="articleTable" class="w-full text-left">
            <thead>
                <tr>
                    <th class="px-4">Title</th>
                    <th class="px-4">Category</th>
                    <th class="px-4">Publish Date</th>
                    <th class="px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#F6F3EF]">
                @foreach($articles as $article)
                <tr class="hover:bg-[#F6F3EF]/50 transition-colors">
                    <td class="px-4">
                        <p class="font-bold text-[#1C1C1C]">{{ $article->title }}</p>
                    </td>
                    <td class="px-4">
                        <span class="px-3 py-1 bg-[#F6F3EF] text-[#B8914A] text-[10px] font-bold rounded-lg border border-[#E5DDD4] uppercase tracking-tighter">
                            {{ $article->category }}
                        </span>
                    </td>
                    <td class="px-4">
                        <p class="text-sm text-[#6B6B6B] font-medium">{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</p>
                    </td>
                    <td class="px-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="w-10 h-10 bg-[#F6F3EF] text-[#6B6B6B] rounded-xl flex items-center justify-center hover:bg-[#B8914A] hover:text-white transition-all border border-[#E5DDD4]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-10 h-10 bg-[#F6F3EF] text-[#6B6B6B] rounded-xl flex items-center justify-center hover:bg-[#1C1C1C] hover:text-white transition-all border border-[#E5DDD4]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#articleTable').DataTable({
            "pageLength": 10,
            "order": [[2, "desc"]],
            "language": {
                "search": "Cari Artikel:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ artikel",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": ">",
                    "previous": "<"
                }
            }
        });
    });
</script>
@endpush
@endsection
