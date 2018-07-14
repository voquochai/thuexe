@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="row display-flex">
                    @forelse($posts as $post)
                        {!! get_template_post($post,$type,3,'mb-30') !!}
                    @empty
                    @endforelse
                </div>
                <div class="page-pagination text-center">
                	{{ $posts->links('frontend.default.blocks.paginate') }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
@endsection