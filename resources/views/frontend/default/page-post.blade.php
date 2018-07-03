@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<div class="page-section pt-60 pb-60 wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-xs-12">
                <div class="post-detail">
                    <h3 class="title">{{ $post->title }}</h3>
                    <div class="meta">
                        <span><a href="{{ url('/'.$type.'/'.$category->slug) }}"><i class="fa fa-tags"></i> {{ @$category->title }} </a></span>
                        <span><a><i class="fa fa-user"></i> {{ @$author->name }}</a></span>
                        <span><a><i class="fa fa-eye"></i> {{ __('site.view') }} ({{ $post->viewed }})</a></span>
                    </div>
                    <div class="desc">
                        {{ $post->description }}
                    </div>
                    <div class="image">
                        <img alt="" src="{{ asset('public/uploads/posts/'.$post->image) }}">
                    </div>
                    <div class="content mb40">{!! $post->contents !!}</div>
                </div>
                <!-- Comments Wrapper -->
                @include('frontend.default.blocks.comment')
            </div>
            <div class="col-lg-3 col-md-4 col-xs-12">
                @include('frontend.default.layouts.sidebar')
            </div>
        </div>
    </div>
</div>
<!-- PAGE SECTION END -->
@endsection