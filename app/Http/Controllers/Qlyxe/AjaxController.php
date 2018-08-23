<?php

namespace App\Http\Controllers\Qlyxe;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function index(Request $request){
        if(!$request->ajax()) return abort(403);
        switch($request->act){
            case 'update_status':
                self::updateStatus($request);
                break;

            case 'update_priority':
                self::updatePriority($request);
                break;

            case 'delete_record':
                self::deleteRecord($request);
                break;

            case 'delete_file':
                self::deleteFile($request);
                break;
        }
    }

    public function updateStatus($request){
    	$arrID = explode(',',$request->id);
    	$data = DB::table($request->table)->select('id','status')->whereIn('id',$arrID)->get();
    	foreach($data as $val){
    		$array = explode(',',$val->status);
    		if( in_array($request->val, $array) ){
    			unset( $array[array_search( $request->val, $array )] );
    		}else{
    			$array[] = $request->val;
    		}
            $string = implode(',',$array);
            DB::table($request->table)->where('id',$val->id)->update(['status'=>trim($string,',')]);
    	}
    }

    public function updatePriority($request){
        $id = $request->id;
        if($request->val <= 0) return;
        DB::table($request->table)->where('id',$id)->update(['priority'=>$request->val]);
    }

    public function deleteRecord($request){
        $arrID = explode(',',$request->id);
        if($request->config){
            $config = config('siteconfig.'.$request->config);
            $type = $request->type;
            if( ($request->config == 'product' || $request->config == 'post') && $request->table != 'media_libraries' ){
                $data = DB::table($request->table)->select('id','image','attachments')->whereIn('id',$arrID)->get();
            }else{
                $data = DB::table($request->table)->select('id','image')->whereIn('id',$arrID)->get();
            }
            foreach($data as $val){
                delete_image($config['path'].'/'.$val->image,$config[$type]['thumbs']);
                if( @$val->attachments ){
                    $arrMediaID = explode(',',$val->attachments);
                    $medias = DB::table('media_libraries')->whereIn('id',$arrMediaID)->get();
                    if( $medias !== null ){
                        foreach( $medias as $media ){
                            delete_image($config['path'].'/'.$media->image,$config[$type]['thumbs']);
                        }
                    }
                    DB::table('media_libraries')->whereIn('id',$arrMediaID)->delete();
                }
            }
        }
        DB::table($request->table)->whereIn('id',$arrID)->delete();
    }

    public function deleteFile($request){
        if($request->thumbs){
            $thumbs = json_decode($request->thumbs,true);
        }else{
            $thumbs = null;
        }
        delete_image($request->path,$thumbs);
    }
}