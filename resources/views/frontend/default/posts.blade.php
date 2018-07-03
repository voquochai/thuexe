@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section pt-60 pb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row">
                    @forelse($posts as $post)
                        {!! get_template_post($post,$type,3) !!}
                    @empty
                    @endforelse
                </div>
                <div class="page-pagination text-center col-xs-12 fix mb-40">
                	{{ $posts->links('frontend.default.blocks.paginate') }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
@endsection