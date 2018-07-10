@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <!-- Single Blog Post -->
                <div class="single-blog-post">
                    <div class="blog-info">
                        <h3 class="title">{{ $page->title }}</h3>
                        {!! $page->contents !!}                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
@endsection