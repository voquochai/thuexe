@extends('frontend.default.master')
@section('content')
<!-- PAGE SECTION START -->
<section class="page-section ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="sub-title">Cảm ơn bạn đã đặt hàng tại Website</h3>
                <div class="alert alert-success">
                    Mã đơn hàng #{{ session('orderCode') }} đã được đặt hàng thành công.
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE SECTION END -->
@endsection