<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="nav-item start padding-tb-20">
                <a href="<?php echo e(route('qlyxe.dashboard.index')); ?>" data-route="dashboard" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Bảng điều khiển</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php 
                $dataSidebar = '';
                foreach( @config('siteconfig.product') as $key => $val ){
                    if( $key == 'default' || $key == 'path') continue;

                    if( @config('siteconfig.category.'.$key) || @config('siteconfig.attribute.'.$key) ){
                        $dataSidebar .= '
                        <li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-exclamation"></i>
                            <span class="title">'.$val['page-title'].'</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">';
                        if( @config('siteconfig.category.'.$key) ){
                            $dataSidebar .= '
                            <li class="nav-item">
                                <a href="'.route('qlyxe.category.index',['type'=>$key]).'" data-route="category.'.$key.'" class="nav-link ">
                                    <span class="title">'.config('siteconfig.category.'.$key.'.page-title').'</span>
                                </a>
                            </li>';
                        }
                        $dataSidebar .= '
                        <li class="nav-item">
                            <a href="'.route('qlyxe.product.index',['type'=>$key]).'" data-route="product.'.$key.'" class="nav-link ">
                                <span class="title">'.$val['page-title'].'</span>
                            </a>
                        </li>';
                        if( @config('siteconfig.attribute.'.$key) ){
                            foreach( config('siteconfig.attribute.'.$key) as $k => $v ){
                                if( !$v ) continue;
                                $dataSidebar .= '
                                <li class="nav-item">
                                    <a href="'.route('qlyxe.attribute.index',['type'=>$k]).'" data-route="attribute.'.$k.'" class="nav-link ">
                                        <span class="title">'.config('siteconfig.attribute.'.$k.'.page-title').'</span>
                                    </a>
                                </li>';
                            }
                        }

                        $dataSidebar .= '</ul></li>';

                    }else{
                        $dataSidebar .= '
                        <li class="nav-item">
                            <a href="'.route('qlyxe.product.index',['type'=>$key]).'" data-route="product.'.$key.'" class="nav-link ">
                                <i class="icon-exclamation"></i>
                                <span class="title">'.$val['page-title'].'</span>
                            </a>
                        </li>';
                    }
                }
                echo $dataSidebar;
             ?>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-exclamation"></i>
                    <span class="title">Bán hàng</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item">
                        <a href="<?php echo e(route('qlyxe.order.index',['type'=>'online'])); ?>" data-route="order.online" class="nav-link">
                            <span class="title">Đơn hàng</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo e(route('qlyxe.coupon.index')); ?>" data-route="coupon" class="nav-link">
                            <span class="title">Coupon</span>
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </div>
</div>