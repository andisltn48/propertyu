@foreach($projects as $index => $project)
<a href="{{ route('public.projects.detail', $project->id) }}" class="project-card" style="text-decoration: none; display: block; position: relative;">
    @if($project->images->first())
        <img src="{{ asset('storage/' . $project->images->first()->image_path) }}" alt="{{ $project->name }}" loading="lazy">
    @else
        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80" alt="Placeholder" loading="lazy">
    @endif
    @if($project->file_3d_path)
    <span class="badge-3d" onclick="event.stopPropagation(); window.location='{{ route('public.projects.3d', $project->id) }}';">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
        </svg>
        3D Tour
    </span>
    @endif
    <div class="project-overlay">
        <span class="tagline">
            @if($project->file_3d_path)
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="12" height="12">
                    <path d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"/>
                </svg>
                3D Tour Ready
            @else
                Featured Project
            @endif
        </span>
        <h3>{{ $project->name }}</h3>
    </div>
</a>
@endforeach
