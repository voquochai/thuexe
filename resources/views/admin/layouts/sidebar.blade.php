<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="nav-item start padding-tb-20">
                <a href="{{ route('admin.dashboard.index') }}" data-route="dashboard" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Bảng điều khiển</span>
                    <span class="selected"></span>
                </a>
            </li>
            @php
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
                                <a href="'.route('admin.category.index',['type'=>$key]).'" data-route="category.'.$key.'" class="nav-link ">
                                    <span class="title">'.config('siteconfig.category.'.$key.'.page-title').'</span>
                                </a>
                            </li>';
                        }
                        $dataSidebar .= '
                        <li class="nav-item">
                            <a href="'.route('admin.product.index',['type'=>$key]).'" data-route="product.'.$key.'" class="nav-link ">
                                <span class="title">'.$val['page-title'].'</span>
                            </a>
                        </li>';
                        if( @config('siteconfig.attribute.'.$key) ){
                            foreach( config('siteconfig.attribute.'.$key) as $k => $v ){
                                if( !$v ) continue;
                                $dataSidebar .= '
                                <li class="nav-item">
                                    <a href="'.route('admin.attribute.index',['type'=>$k]).'" data-route="attribute.'.$k.'" class="nav-link ">
                                        <span class="title">'.config('siteconfig.attribute.'.$k.'.page-title').'</span>
                                    </a>
                                </li>';
                            }
                        }

                        $dataSidebar .= '</ul></li>';

                    }else{
                        $dataSidebar .= '
                        <li class="nav-item">
                            <a href="'.route('admin.product.index',['type'=>$key]).'" data-route="product.'.$key.'" class="nav-link ">
                                <i class="icon-exclamation"></i>
                                <span class="title">'.$val['page-title'].'</span>
                            </a>
                        </li>';
                    }
                }
                echo $dataSidebar;
            @endphp

            @php
                $dataSidebar = '
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-exclamation"></i>
                        <span class="title">Bán hàng</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">';
                foreach( @config('siteconfig.order') as $key => $val ){
                    if( $key == 'default' || $key == 'path') continue;
                    if( @config('siteconfig.order.'.$key) ){
                        $dataSidebar .= '
                        <li class="nav-item">
                            <a href="'.route('admin.order.index',['type'=>$key]).'" data-route="order.'.$key.'" class="nav-link ">
                                <span class="title">'.config('siteconfig.order.'.$key.'.page-title').'</span>
                            </a>
                        </li>';
                    }
                }
                $dataSidebar .= '
                <li class="nav-item">
                    <a href="'.route('admin.coupon.index').'" data-route="coupon.'.$key.'" class="nav-link ">
                        <span class="title">Coupon</span>
                    </a>
                </li>';
                $dataSidebar .= '</ul></li>';
                echo $dataSidebar;
            @endphp

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-exclamation"></i>
                    <span class="title">Kho hàng</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.supplier.index',['type'=>'default']) }}" data-route="supplier.default" class="nav-link ">
                            <span class="title"> Nhà cung cấp </span>
                        </a>
                    </li>
                    {{--
                    <li class="nav-item">
                        <a href="{{ route('admin.wms_store.index',['type'=>'default']) }}" data-route="wms_store.default" class="nav-link ">
                            <span class="title"> Kho hàng </span>
                        </a>
                    </li>
                    --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.wms_import.index',['type'=>'default']) }}" data-route="wms_import.default" class="nav-link ">
                            <span class="title"> Nhập hàng </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.wms_export.index',['type'=>'default']) }}" data-route="wms_export.default" class="nav-link ">
                            <span class="title"> Xuất hàng </span>
                        </a>
                    </li>
                </ul>
            </li>

            @php
                $dataSidebar = '
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-exclamation"></i>
                        <span class="title">Bài viết</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">';
                foreach( @config('siteconfig.post') as $key => $val ){
                    if( $key == 'default' || $key == 'path') continue;
                    if( @config('siteconfig.category.'.$key) ){
                        $dataSidebar .= '
                        <li class="nav-item">
                            <a href="'.route('admin.category.index',['type'=>$key]).'" data-route="category.'.$key.'" class="nav-link ">
                                <span class="title">'.config('siteconfig.category.'.$key.'.page-title').'</span>
                            </a>
                        </li>';
                    }
                    $dataSidebar .= '
                    <li class="nav-item">
                        <a href="'.route('admin.post.index',['type'=>$key]).'" data-route="post.'.$key.'" class="nav-link ">
                            <span class="title">'.$val['page-title'].'</span>
                        </a>
                    </li>';
                }
                $dataSidebar .= '</ul></li>';
                echo $dataSidebar;
            @endphp

            @php
                $dataSidebar = '
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-exclamation"></i>
                        <span class="title">Trang tĩnh</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">';
                foreach( @config('siteconfig.page') as $key => $val ){
                    if( $key == 'default' || $key == 'path') continue;
                    $dataSidebar .= '
                    <li class="nav-item">
                        <a href="'.route('admin.page.index',['type'=>$key]).'" data-route="page.'.$key.'" class="nav-link ">
                            <span class="title">'.$val['page-title'].'</span>
                        </a>
                    </li>';
                }
                $dataSidebar .= '</ul></li>';
                echo $dataSidebar;
            @endphp

            @php
                $dataSidebar = '
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-exclamation"></i>
                        <span class="title">Hình ảnh</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">';
                foreach( @config('siteconfig.photo') as $key => $val ){
                    if( $key == 'default' || $key == 'path') continue;
                    $dataSidebar .= '
                    <li class="nav-item">
                        <a href="'.route('admin.photo.index',['type'=>$key]).'" data-route="photo.'.$key.'" class="nav-link ">
                            <span class="title">'.$val['page-title'].'</span>
                        </a>
                    </li>';
                }
                $dataSidebar .= '</ul></li>';
                echo $dataSidebar;
            @endphp

            @php
                $dataSidebar = '
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-exclamation"></i>
                        <span class="title">Liên kết</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">';
                foreach( @config('siteconfig.link') as $key => $val ){
                    if( $key == 'default' || $key == 'path') continue;
                    $dataSidebar .= '
                    <li class="nav-item">
                        <a href="'.route('admin.link.index',['type'=>$key]).'" data-route="link.'.$key.'" class="nav-link ">
                            <span class="title">'.$val['page-title'].'</span>
                        </a>
                    </li>';
                }
                $dataSidebar .= '</ul></li>';
                echo $dataSidebar;
            @endphp

            @php
                $dataSidebar = '
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-exclamation"></i>
                        <span class="title">Đăng ký</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">';
                foreach( @config('siteconfig.register') as $key => $val ){
                    if( $key == 'default' || $key == 'path') continue;
                    $dataSidebar .= '
                    <li class="nav-item">
                        <a href="'.route('admin.register.index',['type'=>$key]).'" data-route="register.'.$key.'" class="nav-link ">
                            <span class="title">'.$val['page-title'].'</span>
                        </a>
                    </li>';
                }
                $dataSidebar .= '</ul></li>';
                echo $dataSidebar;
            @endphp

            <li class="nav-item">
                <a href="{{ route('admin.comment.index') }}" data-route="comment" class="nav-link">
                    <i class="icon-exclamation"></i>
                    <span class="title">Bình luận</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.seo.index') }}" data-route="seo" class="nav-link">
                    <i class="icon-exclamation"></i>
                    <span class="title">Seo page</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.member.index') }}" data-route="member" class="nav-link">
                    <i class="icon-people"></i>
                    <span class="title">Thành viên</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title"> Quản trị </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    {{--
                    <li class="nav-item">
                        <a href="{{ route('admin.role.index') }}" data-route="role" class="nav-link">
                            <span class="title"> Chức năng </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.permission.index') }}" data-route="permission" class="nav-link">
                            <span class="title"> Quyền hạn </span>
                        </a>
                    </li>
                    --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.group.index') }}" data-route="group" class="nav-link">
                            <span class="title"> Nhóm quản trị </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.user.index', ['type'=>'admin']) }}" data-route="user.admin" class="nav-link">
                            <span class="title"> Tài khoản </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.setting.index') }}" data-route="setting" class="nav-link">
                    <i class="icon-settings"></i>
                    <span class="title">Cấu hình</span>
                </a>
            </li>
        </ul>
    </div>
</div>