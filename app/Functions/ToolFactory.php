<?php
namespace App\Functions;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
class ToolFactory {

    public function setType($type=''){
        $data['page']['title'] = __('site.home');
        $data['page']['class'] = 'page-home';
        $data['type'] = $type;

        switch($type){
            case "san-pham":
                $data['page']['title'] = __('site.product');
                $data['template'] = "product";
                break;
            case "dich-vu":
                $data['page']['title'] = __('site.service');
                $data['template'] = "post";
                break;
            case "thu-thuat":
                $data['page']['title'] = __('site.tip');
                $data['template'] = "post";
                break;
            case "gioi-thieu":
                $data['page']['title'] = __('site.about');
                $data['template'] = "page";
                break;
            case "chinh-sach-quy-dinh":
                $data['page']['title'] = "Chính sách & Quy định";
                $data['template'] = "post";
                break;
            case "ho-tro-khach-hang":
                $data['page']['title'] = "Hỗ trợ khách hàng";
                $data['template'] = "post";
                break;
            default:
                $data['template'] = "index";
                break;
        }
        if($type !=''){
            $data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
            $data['breadcrumb'] .= '<li> <a href="'.url('/'.$type).'"> '.$data['page']['title'].' </a> </li>';
        }
        return $data;
    }

    public function setMetaTags($lang='vi'){
        $default_seo = self::getSeos(url()->current(),$lang);
        if(!$default_seo) $default_seo = self::getSeos(url('/'),$lang);
        $default_seo = json_decode(@$default_seo->meta_seo);
        $seodata['title'] = @$default_seo->title;
        $seodata['keywords'] = @$default_seo->keywords;
        $seodata['description'] = @$default_seo->description;
        $seodata['image'] = asset('public/uploads/photos/'.config('settings.logo'));
        return (object) $seodata;
    }

    

    public function getThumbnail($filename, $suffix = '_small') {
        if ($filename) {
            return preg_replace("/(.*)\.(.*)/i", "$1{$suffix}.$2", $filename);
        }
        return '';
    }

    public function getCurrencyVN($number, $symbol = 'đ', $isPrefix = false) {
        if ($isPrefix) {
            return $symbol . number_format($number, 0, ',', '.');
        } else {
            return number_format($number, 0, ',', '.') . $symbol;
        }
    }

    public function saveImage($path,$image,$thumbs = ['_small' => ['width' => 300, 'height' => 200 ]]) {
        if ( !empty($image) ) {
            $folderName = date('Y-m');
            $fileName = $image->getClientOriginalName();
            $fileExtension = $image->getClientOriginalExtension();
            $fileNameSlug = str_slug( str_replace('.'.$fileExtension, '', $fileName) );

            $fileName = $fileNameSlug.'.'.$fileExtension;

            if ( !file_exists(public_path($path.'/'. $folderName)) ) {
                mkdir(public_path($path.'/'.$folderName), 0755, true);
            }

            if( file_exists(public_path($path.'/'. $folderName.'/'.$fileName)) ){
                $fileNameSlug = $fileNameSlug.'_'.time();
                $fileName = $fileNameSlug.'.'.$fileExtension;
            }
            // Di chuyển file vào folder Uploads
            $imageName = "$folderName/$fileName";
            $image->move( public_path($path.'/'.$folderName), $fileName );

            // Tạo các hình ảnh theo tỉ lệ giao diện
            $createImage = function($suffix = '_small', $width = 300, $height = 200) use($path, $folderName, $imageName, $fileNameSlug, $fileExtension) {
                $thumbnailFileName = $fileNameSlug . $suffix . '.' . $fileExtension;
                if($width <= 0) $width = 300;
                if($height <= 0) $height = 200;
                Image::make(public_path($path.'/'.$imageName))
                    ->resize($width, $height, function ($c) {
                        $c->aspectRatio();
                        $c->upsize();
                    })
                    ->save( public_path($path.'/'.$folderName.'/'.$thumbnailFileName) )
                    ->destroy();
            };
            if($thumbs !== null){
                foreach($thumbs as $k => $v){
                    if( $v['width'] !== null && $v['height'] !== null ){
                        $createImage($k,$v['width'],$v['height']);
                    }
                }
            }
            return $imageName;
        }
    }

    public function deleteImage($path,$thumbs) {
        if (!is_dir(public_path($path)) && file_exists(public_path($path))) {
            unlink(public_path($path));
            $deleteAllImages = function($sizeArr) use($path) {
                foreach ($sizeArr as $size) {
                    if (!is_dir(public_path(get_thumbnail($path, $size))) && file_exists(public_path(get_thumbnail($path, $size)))) {
                        unlink(public_path(get_thumbnail($path, $size)));
                    }
                }
            };
            if($thumbs !== null)
                $deleteAllImages(array_keys($thumbs));
        }
    }

    public function getCategories($type,$lang='vi'){
        return DB::table('categories as A')
            ->leftjoin('category_languages as B', 'A.id','=','B.category_id')
            ->select('A.id', 'A.parent', 'A.icon', 'B.title', 'B.slug')
            ->where('B.language', $lang)
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.priority','>',0)
            ->where('A.type',$type)
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
    }

    public function getPosts($type,$lang='vi'){
        return DB::table('posts as A')
            ->leftjoin('post_languages as B', 'A.id','=','B.post_id' )
            ->select('A.*','B.slug','B.title','B.description')
            ->where('B.language',$lang)
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.type',$type)
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
    }

    public function getPhotos($type,$lang='vi'){
        return DB::table('photos as A')
            ->leftjoin('photo_languages as B', 'A.id','=','B.photo_id' )
            ->select('A.*','B.title','B.description')
            ->where('B.language',$lang)
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.type',$type)
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
    }

    public function getLinks($type,$lang='vi'){
        return DB::table('links as A')
            ->leftjoin('link_languages as B', 'A.id','=','B.link_id' )
            ->select('A.*','B.title','B.description')
            ->where('B.language',$lang)
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.type',$type)
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
    }

    public function getPages($type,$lang='vi'){
        return DB::table('pages as A')
            ->leftjoin('page_languages as B', 'A.id','=','B.page_id' )
            ->select('A.*','B.slug','B.title','B.description','B.contents','B.meta_seo')
            ->where('B.language',$lang)
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.type',$type)
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->first();
    }

    public function getSeos($url,$lang='vi'){
        return DB::table('seos as A')
            ->leftjoin('seo_languages as B', 'A.id','=','B.seo_id' )
            ->select('A.*','B.slug','B.title','B.meta_seo')
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.link', $url )
            ->where('B.language',$lang)
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->first();
    }

    public function getAttributes($type,$lang='vi'){
        return DB::table('attributes as A')
            ->leftjoin('attribute_languages as B', 'A.id','=','B.attribute_id')
            ->select('A.*','B.title','B.slug')
            ->where('B.language', $lang)
            ->where('A.type',$type)
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->get();
    }

    public function getMediaLibrary($attachments){
        $arrID = explode(',',$attachments);
        return DB::table('media_libraries')
            ->select('*')
            ->whereIn('id',$arrID)
            ->orderBy('priority','asc')
            ->orderBy('id','desc')
            ->get();
    }

    public function updateCode($id,$prefix){
        $strlen = strlen($id);
        if($strlen==1){ $code = $prefix."0000".$id;
        } else if($strlen==2){ $code = $prefix."000".$id;
        } else if($strlen==3){ $code = $prefix."00".$id;
        } else if($strlen==4){ $code = $prefix."0".$id;
        } else{ $code = $prefix.$id; }
        return $code;
    }

    public function niceTime($date){
        if(empty($date)) {
            return "No date provided";
        }
        
        $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths         = array("60","60","24","7","4.35","12","10");
        
        $now             = time();
        $unix_date         = strtotime($date);
        
           // check validity of date
        if(empty($unix_date)) {    
            return "Bad date";
        }

        // is it future date or past date
        if($now > $unix_date) {    
            $difference     = $now - $unix_date;
            $tense         = "ago";
            
        } else {
            $difference     = $unix_date - $now;
            $tense         = "from now";
        }
        
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }
        
        $difference = round($difference);
        
        if($difference != 1) {
            $periods[$j].= "s";
        }
        
        return "$difference $periods[$j] {$tense}";
    }

    public function getComments($data,$parent=0,$lvl=0){
        $result = '';
        if( isset($data[$parent]) ){
            if( $parent==0 ){
                $result .= '<div class="timeline">';
            }else{
                $result .= '<div class="timeline">';
                krsort($data[$parent]);
            }
            foreach($data[$parent] as $k=>$v){
                $id=$v->id;
                $result .= '<div id="record-'.$v->id.'" class="timeline-item '.($v->status == '' ? 'disabled' : '').'">';
                $result .= '
                    <div class="timeline-badge">
                        <div class="timeline-icon">
                            <i class="'.($v->status == '' ? 'icon-user-unfollow font-red-haze' : 'icon-user-following font-green-haze').'"></i>
                        </div>
                    </div>
                    <div class="timeline-wrap">
                        <div class="timeline-body">
                            <div class="timeline-body-arrow"> </div>
                            <div class="timeline-body-head">
                                <div class="timeline-body-head-caption">
                                    <a href="javascript:;" class="timeline-body-title font-blue-madison">'.$v->name.'</a>
                                    <span class="timeline-body-time font-grey-cascade">'.self::niceTime($v->created_at).'</span>
                                    <div class="font-grey-cascade">'.$v->email.'</div>
                                </div>
                                <div class="timeline-body-head-actions">
                                    <a href="#" class="btn btn-circle green btn-outline btn-sm btn-comment-expand"> <i class="fa fa-angle-down"></i> </a>
                                    <div class="btn-group">
                                        <button class="btn btn-circle green btn-outline btn-sm dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> Hành động
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li>
                                                <a href="#" class="btn-comment-reply" data-parent="'.$v->id.'" data-product="'.( @$v->product_id ? $v->product_id : '0' ).'" data-post="'.( @$v->post_id ? $v->post_id : '0' ).'">Trả lời</a>
                                            </li>
                                            <li>
                                                <a href="#" class="btn-comment-status" data-ajax="act=update_status|table=comments|id='.$v->id.'|col=status|val=publish"> Hiển thị </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="#" class="btn-comment-delete" data-id="'.$v->id.'"> Xóa </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="timeline-body-content">
                                <span class="font-grey-cascade">'.$v->description.'</span>
                            </div>
                        </div>';
                        $result .= self::getComments($data,$id,$lvl+1);
                $result .= '</div>';
                $result .= '</div>';
            }
            $result .= '</div>';
        }
        return $result;
    }

    public function getProductInWarehouses($type = 'default'){
        $products = [];
        $items = DB::table('wms_import_details')
            ->select('product_id','product_code','product_qty','size_id','color_id','size_title','color_title')
            ->whereRaw('FIND_IN_SET(\'publish\',status)')
            ->get();
        if( $items !== null ){
            foreach( $items as $item ){
                $id  = $item->product_id;
                $code  = $item->product_code;
                $color = (int)$item->color_id;
                $size  = (int)$item->size_id;
                @$products[$code] = $id;
                @$products[$id][$color][$size]['color_title'] = $item->color_title;
                @$products[$id][$color][$size]['size_title'] = $item->size_title;
                @$products[$id][$color][$size]['import'] += (int)$item->product_qty;
            }
        }

        $items = DB::table('wms_export_details')
            ->select('product_id','product_qty','size_id','color_id')
            ->whereRaw('FIND_IN_SET(\'publish\',status)')
            ->get();
        if( $items !== null ){
            foreach( $items as $item ){
                $id  = $item->product_id;
                $color = (int)$item->color_id;
                $size  = (int)$item->size_id;
                @$products[$id][$color][$size]['export'] += (int)$item->product_qty;
            }
        }
        return $products;
    }
}