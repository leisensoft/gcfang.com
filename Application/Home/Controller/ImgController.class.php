<?php
namespace Home\Controller;
use Think\Controller;
class ImgController extends Controller {
	
	function _initialize(){  //■■■■■■■■■■■■■■■■■■■■■■构造函数
		
	}
	 public function _empty($name){
        $this->_noContraller($name);
    }
	protected function _noContraller($name){
        $this->error('不存在的页面');
    }
	public function upload() {     
    //$this->checkLogin();//检测用户是否登录，需要另外写~       
   
   
    $upload = new \Think\Upload();// 实例化上传类    
    $upload->maxSize   =     5*1024*1024 ;// 设置附件上传允许的大小            $upload->autoSub  = true;        
    $upload->saveName =   array('uniqid','');      
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型       
    $upload->rootPath  =   'Public/upload/'; // 设置附件上传根目录        
	$upload->savePath = '';  // 设置附件上传（子）目录     
    $upload->subName  = array('date','Ymd'); //按年月日生成目录
	
	 $image = new \Think\Image(); 
    // 上传文件      
    $info   =   $upload->upload();
    if($info){   // 上传成功 获取上传文件信息  
		foreach ($info as &$file) {  
              //拼接出文件相对路径
			  $file['filepath'] =  $file['savepath'] . $file['savename'];      
			 // var_dump( $file['filepath']);
			  //echo $upload->rootPath.$file['filepath'];
//裁剪 2015年9月11日 添加裁剪图片
			$image->open($upload->rootPath.$file['filepath']);
			$image->thumb(500, 500)->save($upload->rootPath.$file['filepath']);
		}           
		//返回json数据被百度Umeditor编辑器   
		echo json_encode( array( 
			'url'=>$file['filepath'],       
			'title'=>htmlspecialchars( $_POST['pictitle'], ENT_QUOTES ),                'original'=>$file['savename'],       
			'state'=>'SUCCESS'        
			) );        
	}else{      
  // 上传失败   
		echo json_encode( array('state'=>$upload->getError() ) );     
    }    
}
	
	
	
}