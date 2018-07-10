@php $photos = get_photos('partners',$lang); @endphp
<section class="partners-section pt-60">
    <div class="slick-partners">
    @forelse($photos as $photo)
        <div>
            <a href="{{ $photo->link }}"><img src="{{ ( $photo->image && file_exists(public_path('/uploads/photos/'.$photo->image)) ? asset( 'public/uploads/photos/'.get_thumbnail($photo->image) ) : asset('noimage/200x100') ) }}" alt="{{ $photo->alt }}" /></a></div>
    @empty
    @endforelse
    </div>
</section>