<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Comment;

use DateTime;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $_data;

    public function __construct(Request $request)
    {
        $this->_data['type'] = (isset($request->type) && $request->type !='') ? $request->type : 'default';
        $this->_data['siteconfig'] = config('siteconfig.comment');
        $this->_data['default_language'] = config('siteconfig.general.language');
        $this->_data['languages'] = config('siteconfig.languages');
        $this->_data['pageTitle'] = $this->_data['siteconfig'][$this->_data['type']]['page-title'];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $this->_data['items'] = DB::table('product_languages')
            ->select('title', 'product_id')
            ->whereIn('product_id', DB::table('comments')->pluck('product_id') )
            ->where('language', $this->_data['default_language'])
            ->get();
        foreach( $this->_data['items'] as $key => $item ){
            $this->_data['items'][$key]->sum = DB::table('comments')->where('product_id',$item->product_id)->count();
        }
        return view('admin.comments.index',$this->_data);
    }

    public function ajax(Request $request){
        if($request->table == 'products'){
            $items = DB::table('comments as A')
                ->where('product_id',$request->id)
                ->where('type',$this->_data['type'])
                ->orderBy('priority','asc')
                ->orderBy('id','desc')
                ->get();
        }
        
        if( count($items) > 0 ){
            foreach($items as $value){
                $parent=$value->parent;
                $data[$parent][]=$value;
            }
        }else{
            $data = [];
        }
        $comments = get_comments($data);
        return response()->json(['data'=>$comments]);
    }
    
    public function create(){
        return view('admin.comments.create',$this->_data);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'description' => 'required',
            // 'score' => 'required|between:1,5'
        ], [
            'description.required' => __('validation.required', ['attribute'=>__('site.content')]),
            // 'score.required' => 'Yêu cầu nhập vào điểm số',
            // 'score.between' => 'Vui lòng chỉ nhập từ :min tới :max khi chấm điểm'
        ]);
        if ($valid->fails()) {
            return response()->json(['type'=>'danger', 'icon'=>'warning', 'message'=>$valid->errors()->first()]);
        } else {
            $comment  = new Comment;
            $comment->parent = (int)$request->parent;
            $comment->product_id = ($request->product_id) ? $request->product_id : null ;
            $comment->post_id = ($request->post_id) ? $request->post_id : null ;
            $comment->member_id = null;
            $comment->name = Auth::user()->name;
            $comment->email = Auth::user()->email;
            $comment->description = $request->description;
            $comment->type = $request->type;
            $comment->status = 'publish';
            $comment->created_at = new DateTime();
            $comment->updated_at = new DateTime();
            $comment->save();
            $data[0][] = $comment;
            $comments = get_comments($data);
            return response()->json(['type'=>'success', 'data'=>$comments]);
        }
        
    }

    public function edit($id){
        $this->_data['item'] = Comment::find($id);
        if ($this->_data['item'] !== null) {
            return view('admin.comments.edit',$this->_data);
        }
        return redirect()->route('admin.comment.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }

    public function update(Request $request, $id){
        // dd($request);
        $valid = Validator::make($request->all(), [
            'image' => 'image|max:2048',
        ], [
            'image.image' => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max' => 'Dung lượng vượt quá giới hạn cho phép là :max KB',
        ]);
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $comment = Comment::find($id);
            if ($comment !== null) {
                if($request->data){
                    foreach($request->data as $field => $value){
                        $comment->$field = $value;
                    }
                }

                $comment->priority       = (int)str_replace('.', '', $request->priority);
                $comment->status         = ($request->status) ? implode(',',$request->status) : '';
                $comment->type           = $this->_data['type'];
                $comment->updated_at     = new DateTime();
                $comment->save();

                return redirect( $request->redirects_to )->with('success','Cập nhật dữ liệu <b>'.$comment->name.'</b> thành công');
            }
            return redirect( $request->redirects_to )->with('danger', 'Dữ liệu không tồn tại');
        }
    }

    public function delete($id){
        $comment = Comment::find($id);
        $deleted = $comment->name;
        if ($comment !== null) {
            if( $comment->delete() ){
                Comment::whereIn('id',$comment->children()->pluck('id')->toArray())->delete();
                return redirect()->route('admin.comment.index',['type'=>$this->_data['type']])->with('success', 'Xóa dữ liệu <b>'.$deleted.'</b> thành công');
            }else{
                return redirect()->route('admin.comment.index',['type'=>$this->_data['type']])->with('danger', 'Xóa dữ liệu bị lỗi');
            }
        }
        return redirect()->route('admin.comment.index',['type'=>$this->_data['type']])->with('danger', 'Dữ liệu không tồn tại');
    }
}
