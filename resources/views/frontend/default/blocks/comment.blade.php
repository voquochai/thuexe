<div class="comment-wrapper mb-30">
	
    @if( $countComment > 0 )
    <h3 class="sub-title">{{ __('site.comment').' ('.$countComment.')' }}</h3>
    {!! get_template_comment($comments) !!}
    @endif
    <h3 class="sub-title">{{ __('site.send_comment') }}</h3>
    <div class="comment-form main-form">
        <form action="{{ URL::current() }}" method="post">
            <input type="hidden" name="parent" value="0">
            <input type="hidden" name="score" value="">
            @if( @$product->id )
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            @elseif( @$post->id )
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            @endif
            <div class="row">
	            <div class="col-xs-12">
	                <label>1. {{ __('site.comment_rating') }}:
	                	<span class="rating">
	                		<i class="fa fa-star" data-rate="1"></i>
	                		<i class="fa fa-star" data-rate="2"></i>
	                		<i class="fa fa-star" data-rate="3"></i>
	                		<i class="fa fa-star" data-rate="4"></i>
	                		<i class="fa fa-star" data-rate="5"></i>
	                	</span>
	                </label>
	            </div>
	            {{--
	            <div class="col-sm-4 col-xs-12">
	                <label for="name">{{ __('site.name') }}</label>
	                <input name="name" type="text" class="form-control">
	            </div>
	            <div class="col-sm-8 col-xs-12">
	                <label for="email">Email</label>
	                <input name="email" type="text" class="form-control">
	            </div>
	            --}}
	            <div class="col-sm-5 col-xs-12">
	                <label for="name">2. {{ __('site.comment_title') }}:</label>
	                <input name="title" type="text" class="form-control" placeholder="{{ __('site.comment_title_placeholder') }}">
	            </div>
	            <div class="col-xs-12">
					<label for="description">3. {{ __('site.comment_description') }}:</label>
					<textarea name="description" class="form-control" placeholder="{{ __('site.comment_description_placeholder') }}"></textarea>
				</div>
	            <div class="col-xs-12">
	                <button type="submit" class="btn btn-site btn-ajax" data-ajax="act=comment|type=default"> {{ __('site.send_comment') }} </button>
				</div>
			</div>
		</form>
    </div>
</div>