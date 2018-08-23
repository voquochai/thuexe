<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="nav-item start padding-tb-20">
                <a href="<?php echo e(route('qlyxe.dashboard.index')); ?>" data-route="dashboard" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Thống kê</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('qlyxe.product.quickly',['type'=>'thue-xe'])); ?>" data-route="product.thue-xe" class="nav-link">
                    <i class="icon-exclamation"></i>
                    <span class="title">Nhập xe</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('qlyxe.product.index',['type'=>'thue-xe'])); ?>" data-route="product.thue-xe" class="nav-link">
                    <i class="icon-exclamation"></i>
                    <span class="title">Quản lý xe</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('qlyxe.order.index',['type'=>'thue-xe'])); ?>" data-route="order.thue-xe" class="nav-link">
                    <i class="icon-exclamation"></i>
                    <span class="title">Phiếu thuê xe</span>
                </a>
            </li>
            
        </ul>
    </div>
</div>