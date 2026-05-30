@foreach($galleries as $index => $item)
    <div class="gallery-item reveal" 
         style="background-image: url('{{ asset('storage/' . $item->image_path) }}');" 
         data-reveal>
    </div>
@endforeach
