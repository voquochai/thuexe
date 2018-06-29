<?php
namespace App\Functions;
use Request;
class MenuFactory{

	protected	$_open="<ul class='menu'>";
	protected	$_close="</ul>";
	protected	$_openitem="<li>";
	protected	$_closeitem="</li>";
	protected	$_baseurl;
	protected	$_data; 
	protected	$_result="";
	protected	$_siteconfig;

	public function __construct($config=''){
		$this->_siteconfig = config('siteconfig.category');
		if($config != ""){
			$this->setOption($config);
		}
	}
	public function setOption($config){
		foreach($config as $k=>$v){
			$method="set".ucfirst($k);
			$this->$method($v);
		}
	}
	public function setOpen($tag){
		$this->_open=$tag;
	}
	public function setClose($tag){
		$this->_close=$tag;
	}
	public function setOpenitem($tag){
		$this->_openitem=$tag;
	}
	public function setCloseitem($tag){
		$this->_closeitem=$tag;
	}
	public function setBaseurl($url){
		$this->_baseurl=$url;
	}
	public function setMenu($menu){
		foreach($menu as $v){
			$p=$v->parent;
			$this->_data[$p][]=$v;
		}
	}
	public function resetMenu(){
		$this->_result = $this->_data = $this->_baseurl = '';
	}
	public function getMenu($self=0,$parent=0,$lvl=0){
		if( isset($this->_data[$parent]) ){
			if( is_array($this->_open) ){
				$this->_result.= (count($this->_open) > $lvl) ? $this->_open[$lvl] : $this->_open[--$lvl];
			}else{
				$this->_result.= $this->_open;
			}
			foreach($this->_data[$parent] as $k=>$v){
				$this->_result.= $this->_openitem;
				if($v->icon){
					$icon = '<i class="icon fa '.$v->icon.' fa-fw"></i>';
				}else{
					$icon = '';
				}
				$id=$v->id;
				$slug=$v->slug;
				if( $id == $self ) $isActive = 'class="active"'; else $isActive = '';
				$this->_result.= "<a href='$this->_baseurl/$slug' data-lvl='$lvl' $isActive >".$icon.$v->title."</a>";
				$this->getMenu($self,$id,++$lvl);
				$this->_result.= $this->_closeitem;
			}
			if( is_array($this->_close) ){
				$this->_result.= $this->_close[$lvl];
			}else{
				$this->_result.= $this->_close;
			}
		}
		return $this->_result;
	}

	public function getMenuSelect($self=0,$parent=0,$prefix='',$select=0){
		if( isset($this->_data[$parent]) ){
			foreach($this->_data[$parent] as $key => $val){
				$id = $val->id;
				$name = $val->title;
				if( $id != $self ){
					if( $id == $select ) $selected = "selected"; else $selected = "";
					$this->_result .= "<option value='$id' $selected > $prefix $name </option>";
					// unset($this->_data[$key]);
					$this->getMenuSelect($self,$id,$prefix.'--|',$select);
				}
			}
		}
		return $this->_result;
	}

	public function getMenuSelectLimit($self=0,$parent=0,$prefix='',$select=0,$level=1){
		
		if( isset($this->_data[$parent]) ){
			foreach($this->_data[$parent] as $key => $val){
				$id = $val->id;
				$name = $val->title;
				if( $id != $self ){
					if( $id == $select ) $selected = "selected"; else $selected = "";
					if( $this->_siteconfig[$_GET['type']]['level'] > 0 && $this->_siteconfig[$_GET['type']]['level'] < $level ) $disabled = "disabled"; else $disabled = "";
					$this->_result .= "<option value='$id' $selected $disabled data-lvl='$level' > $prefix $name </option>";
					// unset($this->_data[$key]);
					$this->getMenuSelectLimit($self,$id,$prefix.'--|',$select,$level+1);
				}
			}
		}
		return $this->_result;
	}

	public function getMenuTable($self=0,$parent=0,$prefix='',$select=0){
		if( isset($this->_data[$parent]) ){
			foreach($this->_data[$parent] as $key => $val){
				$id = $val->id;
				$name = $val->title;
				if( ($id != $self) && ($val->parent == $parent) ){
					if( $parent ) $isParent = ''; else $isParent = 'class="active"';
					if( $this->_siteconfig[$_GET['type']]['image'] ){
						$hasImage = '<td align="center">'.( ($val->image && file_exists(public_path(get_thumbnail($this->_siteconfig['path'].'/'.$val->image))) )?'<img src="'.asset(get_thumbnail('public/'.$this->_siteconfig['path'].'/'.$val->image)).'" height="50" />':'').'</td>';
					}else{
						$hasImage = '';
					}
					$button = '';
					foreach($this->_siteconfig[$_GET['type']]['status'] as $keyS => $valS){
	                    $button .= '<button class="btn btn-sm btn-status btn-status-'.$keyS.' btn-status-'.$keyS.'-'.$id.' '.((strpos($val->status,$keyS) !== false)?'blue':'default').'" data-loading-text="<i class=\'fa fa-spinner fa-pulse\'></i>" data-ajax="act=update_status|table=categories|id='.$id.'|col=status|val='.$keyS.'"> '.$valS.'</button>';
					}

					$this->_result .= '
						<tr id="record-'.$id.'" '.$isParent.'>
	                        <td align="center">
	                            <label class="mt-checkbox mt-checkbox-single">
	                                <input type="checkbox" name="id[]" class="checkable" value="'.$id.'">
	                                <span></span>
	                            </label>
	                        </td>
	                        <td align="center"> <input type="text" name="priority" class="form-control input-mini input-priority" value="'.$val->priority.'" data-ajax="act=update_priority|table=categories|id='.$id.'|col=priority"> </td>
	                        <td align="left"> <a href="'.route('admin.category.edit',[$id, 'type'=>$_GET['type']]).'"> '.$prefix.' '.$name.' </a> </td>
	                        '.$hasImage.'
	                        <td align="center"> '.$val->created_at.' </td>
	                        <td align="center"> '.$button.' </td>
	                        <td align="center">
	                            <a href="'.route('admin.category.edit',[$id, 'type'=>$_GET['type']]).'" class="btn btn-sm blue" title="Chỉnh sửa"> <i class="fa fa-edit"></i> </a>
	                            <form action="'.route('admin.category.delete',[$id, 'type'=>$_GET['type']]).'" method="post">
	                                '.csrf_field().'
	                                '.method_field('DELETE').'
	                                <button type="button" class="btn btn-sm btn-delete red" title="Xóa"> <i class="fa fa-times"></i> </button>
	                            </form>
	                        </td>
	                    </tr>
					';
					// unset($this->_data[$key]);
					$this->getMenuTable($self,$id,$prefix.'--|',$select);
				}
			}
		}
		return $this->_result;
	}
}