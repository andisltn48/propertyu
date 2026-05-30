@foreach($galleries as $index => $item)
    <div class="gallery-item reveal" 
         style="background-image: url('{{ asset('storage/' . $item->image_path) }}');" 
         role="img"
         aria-label="Gallery image {{ $index + 1 }}"
         data-reveal>
    </div>
@endforeach
