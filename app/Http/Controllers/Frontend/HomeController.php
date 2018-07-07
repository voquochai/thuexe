<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

use Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    private $_data;

    public function __construct(Request $request){
        $this->_data = set_type($request->type);
        $this->middleware(function($request,$next){
            $this->_data['lang'] = (session('lang')) ? session('lang') : config('settings.language');
            $this->_data['meta_seo'] = set_meta_tags($this->_data['lang']);
            App::setLocale($this->_data['lang']);
            View::share('siteconfig', config('siteconfig'));
            $this->_data['domain'] = is_array($domain = json_decode($request->cookie('domain'), true)) ? $domain : [];
            $cart = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
            if (count($cart) > 0) {
                $this->_data['countCart'] = count($cart);
            }else{
                $this->_data['countCart'] = 0;
            }
            return $next($request);
        });
    }

    public function index(Request $request){

        $this->_data['new_products'] = DB::table('products as A')
            ->leftjoin('product_languages as B', 'A.id', '=', 'B.product_id')
            ->select('A.id','A.code','A.regular_price','A.sale_price','A.link','A.image','A.alt','A.category_id','A.user_id','A.type','B.title', 'B.slug')
            ->where('B.language',$this->_data['lang'])
            ->whereRaw('FIND_IN_SET(\'publish\',A.status) and FIND_IN_SET(\'new\',A.status)')
            ->where('A.type','san-pham')
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->limit(10)
            ->get();

        $this->_data['single_post'] = get_pages('san-pham-moi');

        $this->_data['collections'] = DB::table('posts as A')
            ->leftjoin('post_languages as B', 'A.id', '=', 'B.post_id')
            ->select('A.id','A.link','A.image','A.alt','A.updated_at','B.title','B.slug','B.description')
            ->where('B.language',$this->_data['lang'])
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.type','bo-suu-tap')
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->limit(8)
            ->get();

        $this->_data['banners'] = get_photos('banner');

        $this->_data['new_posts'] = DB::table('posts as A')
            ->leftjoin('post_languages as B', 'A.id', '=', 'B.post_id')
            ->select('A.id','A.link','A.image','A.alt','A.updated_at','B.title','B.slug','B.description')
            ->where('B.language',$this->_data['lang'])
            ->whereRaw('FIND_IN_SET(\'publish\',A.status) and FIND_IN_SET(\'new\',A.status)')
            ->where('A.type','tin-tuc')
            ->orderBy('A.priority','asc')
            ->orderBy('A.id','desc')
            ->limit(6)
            ->get();
        
        return view('frontend.default.index', $this->_data);
    }

    public function contact(){
        $this->_data['page']['title'] = __('site.contact');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/lien-he').'"> '.$this->_data['page']['title'].' </a> </li>';
        $this->_data['contact'] = get_pages('lien-he',$this->_data['lang']);
        if( $this->_data['contact'] && $this->_data['contact']->meta_seo !='' ){
            $current_seo = json_decode($this->_data['contact']->meta_seo);
            $current_seo->title ? $this->_data['meta_seo']->title = $current_seo->title : '';
            $current_seo->keywords ? $this->_data['meta_seo']->keywords = $current_seo->keywords : '';
            $current_seo->description ? $this->_data['meta_seo']->description = $current_seo->description : '';
        }
        
        return view('frontend.default.contact',$this->_data);
    }

    public function category($type,$slug){

        $this->_data['category'] = DB::table('categories as A')
            ->leftjoin('category_languages as B', 'A.id','=','B.category_id')
            ->select('A.*', 'B.title', 'B.slug', 'B.meta_seo')
            ->where('B.language', $this->_data['lang'])
            ->where('B.slug',$slug)
            ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
            ->where('A.type',$type)
            ->first();

        if( $this->_data['category'] && $this->_data['category']->meta_seo !='' ){
            $current_seo = json_decode($this->_data['category']->meta_seo);
            $current_seo->title ? $this->_data['meta_seo']->title = $current_seo->title : '';
            $current_seo->keywords ? $this->_data['meta_seo']->keywords = $current_seo->keywords : '';
            $current_seo->description ? $this->_data['meta_seo']->description = $current_seo->description : '';
        }

        if( $this->_data['category'] ){
            $category_id = $this->_data['category']->id;

            $this->_data['breadcrumb'] .= '<li class="active"> '.$this->_data['category']->title.' </li>';
            if($this->_data['template'] == 'product'){
                $this->_data['products'] = DB::table('products as A')
                    ->leftjoin('product_languages as B', 'A.id', '=', 'B.product_id')
                    ->select('A.id','A.code','A.regular_price','A.sale_price','A.link','A.image','A.alt','A.category_id','A.user_id','A.type','B.title', 'B.slug')
                    ->where('B.language',$this->_data['lang'])
                    ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
                    ->where('A.category_id',$category_id)
                    ->where('A.type',$type)
                    ->orderBy('A.priority','asc')
                    ->orderBy('A.id','desc')
                    ->paginate(config('settings.product_per_page') ? config('settings.product_per_page') : 20);

                return view('frontend.default.products',$this->_data);
            }elseif($this->_data['template'] == 'post'){
                $this->_data['posts'] = DB::table('posts as A')
                    ->leftjoin('post_languages as B', 'A.id', '=', 'B.post_id')
                    ->select('A.id','A.link','A.image','A.alt','A.updated_at','B.title','B.slug','B.description')
                    ->where('B.language',$this->_data['lang'])
                    ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
                    ->where('A.category_id',$category_id)
                    ->where('A.type',$type)
                    ->orderBy('A.priority','asc')
                    ->orderBy('A.id','desc')
                    ->paginate(config('settings.post_per_page') ? config('settings.post_per_page') : 10);
                return view('frontend.default.posts',$this->_data);
            }
        }
        return abort(404);
    }

    public function archive(Request $request,$type){
        $params['type'] = $type;
        if($this->_data['template'] == 'product'){
            $whereRaw = 'FIND_IN_SET(\'publish\',A.status)';

            if($request->keyword !=''){
                $whereRaw .= ' AND B.title LIKE \'%'.$request->keyword.'%\'';
                $params['keyword'] = $request->keyword;
            }
            if($request->tag){
                $this->_data['tag'] = DB::table('attributes as A')
                    ->leftjoin('attribute_languages as B', 'A.id','=','B.attribute_id')
                    ->select('A.*','B.title','B.slug')
                    ->where('B.slug', $request->tag)
                    ->where('B.language', $this->_data['lang'])
                    ->where('A.type','product_tags')
                    ->first();
                $idProducts = DB::table('product_attribute')->where('attribute_id',$this->_data['tag']->id)->pluck('product_id')->toArray();
                if($idProducts) $whereRaw .= ' AND A.id IN ('.implode(',', $idProducts).')';
                else $whereRaw .= ' AND A.id IN (0)';
                $params['tag'] = $request->tag;
            }

            if($request->color){
                $this->_data['color'] = DB::table('attributes as A')
                    ->leftjoin('attribute_languages as B', 'A.id','=','B.attribute_id')
                    ->select('A.*','B.title','B.slug')
                    ->where('B.slug', $request->color)
                    ->where('B.language', $this->_data['lang'])
                    ->where('A.type','product_colors')
                    ->first();
                $idProducts = DB::table('product_attribute')->where('attribute_id',$this->_data['color']->id)->pluck('product_id')->toArray();
                if($idProducts) $whereRaw .= ' AND A.id IN ('.implode(',', $idProducts).')';
                else $whereRaw .= ' AND A.id IN (0)';
                $params['color'] = $request->color;
            }

            $this->_data['products'] = DB::table('products as A')
                ->leftjoin('product_languages as B', 'A.id', '=', 'B.product_id')
                ->select('A.id','A.code','A.regular_price','A.sale_price','A.link','A.image','A.alt','A.category_id','A.user_id','A.type','B.title', 'B.slug')
                ->where('B.language',$this->_data['lang'])
                ->whereRaw($whereRaw)
                ->where('A.type',$type)
                ->orderBy('A.priority','asc')
                ->orderBy('A.id','desc')
                ->paginate(config('settings.product_per_page') ? config('settings.product_per_page') : 20);
            $this->_data['products']->withPath( route('frontend.home.archive', $params ) );
            return view('frontend.default.products',$this->_data);
        }elseif($this->_data['template'] == 'post'){
            $this->_data['posts'] = DB::table('posts as A')
                ->leftjoin('post_languages as B', 'A.id', '=', 'B.post_id')
                ->select('A.id','A.link','A.image','A.alt','A.updated_at','B.title','B.slug','B.description')
                ->where('B.language',$this->_data['lang'])
                ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
                ->where('A.type',$type)
                ->orderBy('A.priority','asc')
                ->orderBy('A.id','desc')
                ->paginate(config('settings.post_per_page') ? config('settings.post_per_page') : 10);
            return view('frontend.default.posts',$this->_data);
        }elseif($this->_data['template'] == 'page'){
            
            return view('frontend.default.page',$this->_data);
        }
        return abort(404);
    }

    public function page(Request $request, $type,$slug){
        if($this->_data['template'] == 'product'){
            $this->_data['product'] = DB::table('products as A')
                ->leftjoin('product_languages as B', 'A.id', '=', 'B.product_id')
                ->select('A.*','B.title','B.description','B.contents','B.attributes','B.meta_seo')
                ->where('B.language',$this->_data['lang'])
                ->where('B.slug',$slug)
                ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
                ->where('A.type',$type)
                ->first();

            if( $this->_data['product'] && $this->_data['product']->meta_seo !='' ){
                $current_seo = json_decode($this->_data['product']->meta_seo);
                $current_seo->title ? $this->_data['meta_seo']->title = $current_seo->title : '';
                $current_seo->keywords ? $this->_data['meta_seo']->keywords = $current_seo->keywords : '';
                $current_seo->description ? $this->_data['meta_seo']->description = $current_seo->description : '';
                $this->_data['product']->image ? $this->_data['meta_seo']->image = asset('public/uploads/products/'.get_thumbnail($this->_data['product']->image, '_medium')) : '';
            }

            if( $this->_data['product'] ){
                $client_ip = $request->getClientIp();
                if(!Cache::has($client_ip.'_product_view_'.$this->_data['product']->id)){
                    $this->_data['product']->viewed += 1;
                    DB::table('products')->where('id',$this->_data['product']->id)->increment('viewed',1);
                    Cache::add($client_ip.'_product_view_'.$this->_data['product']->id,$this->_data['product']->viewed,5);
                }
                $viewed = is_array($viewed = json_decode($request->cookie('viewed'), true)) ? $viewed : [];
                if( !in_array($this->_data['product']->id,$viewed) ){
                    array_unshift($viewed,$this->_data['product']->id);
                }
                $cookieViewed = cookie('viewed', json_encode($viewed), 1440);

                $this->_data['images'] = get_media($this->_data['product']->attachments);
                $this->_data['attributes'] = $this->_data['product']->attributes ? json_decode($this->_data['product']->attributes,true) : [];
                $this->_data['hosting'] = get_attributes('product_hosting');
                $this->_data['tags'] = get_attributes('product_tags');

                $comments = DB::table('comments')
                    ->where('product_id',$this->_data['product']->id)
                    ->whereRaw('FIND_IN_SET(\'publish\',status)')
                    ->orderBy('parent','asc')
                    ->orderBy('id','desc')
                    ->get();
                if($comments !== null){
                    foreach($comments as $value){
                        $parent=$value->parent;
                        $this->_data['comments'][$parent][]=$value;
                    }
                }else{
                    $this->_data['comments'] = [];
                }
                $this->_data['countComment'] = count($comments);

                $this->_data['products'] = DB::table('products as A')
                    ->leftjoin('product_languages as B', 'A.id', '=', 'B.product_id')
                    ->select('A.id','A.code','A.regular_price','A.sale_price','A.link','A.image','A.alt','A.category_id','A.user_id','A.type','B.title', 'B.slug')
                    ->where('B.language',$this->_data['lang'])
                    ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
                    ->where('A.id','!=',$this->_data['product']->id)
                    ->where('A.category_id',$this->_data['product']->category_id)
                    ->where('A.type',$type)
                    ->orderBy('A.priority','asc')
                    ->orderBy('A.id','desc')
                    ->limit(15)
                    ->get();
                return response()->view('frontend.default.page-product',$this->_data)->cookie($cookieViewed);
            }
        }elseif($this->_data['template'] == 'post'){
            $this->_data['post'] = DB::table('posts as A')
                ->leftjoin('post_languages as B', 'A.id', '=', 'B.post_id')
                ->select('A.*','B.title','B.description','B.contents','B.meta_seo')
                ->where('B.language',$this->_data['lang'])
                ->where('B.slug',$slug)
                ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
                ->where('A.type',$type)
                ->first();
            $this->_data['meta_seo'] = set_meta_tags($this->_data['lang']);
            if( $this->_data['post'] ){
                $client_ip = $request->getClientIp();
                if(!Cache::has($client_ip.'_post_view_'.$this->_data['post']->id)){
                    $this->_data['post']->viewed += 1;
                    DB::table('posts')->where('id',$this->_data['post']->id)->increment('viewed',1);
                    Cache::add($client_ip.'_post_view_'.$this->_data['post']->id,$this->_data['post']->viewed,5);
                }
                
                $this->_data['author'] = DB::table('users')->select('name')->where( 'id',$this->_data['post']->user_id )->first();

                $this->_data['category'] = DB::table('category_languages')->select('title','slug')->where('language',$this->_data['lang'])
                    ->where('category_id',$this->_data['post']->category_id )->first();

                $comments = DB::table('comments')
                    ->where('post_id',$this->_data['post']->id)
                    ->whereRaw('FIND_IN_SET(\'publish\',status)')
                    ->orderBy('parent','asc')
                    ->orderBy('id','desc')
                    ->get();
                if($comments !== null){
                    foreach($comments as $value){
                        $parent=$value->parent;
                        $this->_data['comments'][$parent][]=$value;
                    }
                }else{
                    $this->_data['comments'] = [];
                }
                $this->_data['countComment'] = count($comments);

                $this->_data['posts'] = DB::table('posts as A')
                    ->leftjoin('post_languages as B', 'A.id', '=', 'B.post_id')
                    ->select('A.id','A.link','A.image','A.alt','A.updated_at','B.title','B.slug','B.description')
                    ->where('B.language',$this->_data['lang'])
                    ->whereRaw('FIND_IN_SET(\'publish\',A.status)')
                    ->where('A.id','!=',$this->_data['post']->id)
                    ->where('A.category_id',$this->_data['post']->category_id)
                    ->where('A.type',$type)
                    ->orderBy('A.priority','asc')
                    ->orderBy('A.id','desc')
                    ->limit(15)
                    ->get();
                return view('frontend.default.page-post',$this->_data);
            }
        }
        return abort(404);
    }

    public function viewed(Request $request){
        $this->_data['page']['title'] = __('site.viewed');
        $this->_data['breadcrumb'] = '<li> <a href="'.url('/').'">'.__('site.home').'</a> </li>';
        $this->_data['breadcrumb'] .= '<li> <a href="'.url('/lien-he').'"> '.$this->_data['page']['title'].' </a> </li>';
        $this->_data['meta_seo'] = set_meta_tags($this->_data['lang']);
        $viewed = is_array($viewed = json_decode($request->cookie('viewed'), true)) ? $viewed : [];
        if( count($viewed) > 0 ){
            $this->_data['products'] = DB::table('products as A')
                ->leftjoin('product_languages as B', 'A.id', '=', 'B.product_id')
                ->select('A.id','A.code','A.regular_price','A.sale_price','A.link','A.image','A.alt','A.category_id','A.user_id','A.type','B.title', 'B.slug')
                ->where('B.language',$this->_data['lang'])
                ->whereIn('A.id',$viewed)
                ->orderBy('A.priority','asc')
                ->orderBy('A.id','desc')
                ->paginate(config('settings.product_per_page') ? config('settings.product_per_page') : 20);
        }else{
            $this->_data['products'] = [];
        }
        return view('frontend.default.products', $this->_data);
    }
    
}
