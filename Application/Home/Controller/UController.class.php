<?php
namespace Home\Controller;
use Think\Controller;
class  UController extends Controller {
	function _initialize(){  //■■■■■■■■■■■■■■■■■■■■■■构造函数
		$this->u = M("user");
		$this->s = M("site");
		$this->h = M("house");
		$this->t = M("tag");
		$this->d = M("deal");
		$this->a = M("article");
		$site_info = $this->s->where('area_id='.I('get.url_area_id'))->find();
		$this->assign('site_info',$site_info);
		$user_info = $this->checkUserCookie();
	    $this->assign('user_info',$user_info);
	}
	public function _empty($name){
        $this->_noContraller($name);
    }
	protected function _noContraller($name){
       $this->error('不存在的页面','/Index/Register',3);
    }
    public function index(){
		$this->error('不存在的页面','/Index/Register',3);
		$this->display();	
    }
    public function manage(){
		$where['area_id'] = array('in','0,'.I('get.url_area_id')); 
		$where['state'] = 1;
		$where['type'] = 2;
		$news = $this->a->where($where)->order('id desc')->limit(5)->select();
		foreach($news as $new){
			$new['time'] = countPastTime($new['time']); 
			$outNew[] = $new; 
		}
		//var_dump($outNew);die;
		$this->assign('outNew',$outNew);
	  //$user_info
	  //$this->u->where('id'=)->select();
	  //var_dump($user_info);die;
	  $this->display();
    }
	public function moneyTag(){
		$content = $this->a->where('id=5')->find();
		$this->assign('content',$content['content']);
		$this->display();
	}
	public function houseList(){
		$this->display();
	}
	public function addHouse(){
		$this->display();
	}
//■■■■■■■■■■■■■■■■■■■■■■修改密码
	public function changePass(){
		if(trim(I('post.r'))!=''){
			 $this->u->where('id='.cookie('lei666_id'))->setField('password',I('post.r'));
			 echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('success'=>false,'errorMsg'=>'请重新输入密码!'));
		}	
	}	
//■■■■■■■■■■■■■■■■■■■■■■获取用户余额
	public function getUserLeftMoney(){
		if(I('post.user_id')){
			 $user_money = $this->u->field('money')->where('id='.$I('post.user_id'))->find();	
			 echo json_encode(array('success'=>true,'money'=>$user_money['money']));die;
		}
		echo json_encode(array('success'=>false,'errorMsg'=>'余额数据有误!'));die;
	}
	
//■■■■■■■■■■■■■■■■■■■■■■置顶剩余时间
	public function getLeftTime($time){
		$time = ($time-time())/(60*60); //算出小时
		if($time>24){
			return ceil($time/24)."天";
		}else{
			if($time<0){
				return "已过期";
			}else{
				return ceil($time)."小时";
			}
		}
	}
//■■■■■■■■■■■■■■■■■■■■■■后台设置房源置顶 id是house的id	
	public function setHouseToTop(){
		if($_POST['id']&&$_POST['user_id']&&$_POST['day']){
			//判断用户余额
			$user_money = $this->u->field('money')->where('id='.I('post.user_id'))->find();
			if(I('post.day')>$user_money['money']){ 
				echo json_encode(array('success'=>false,'errorMsg'=>'用户余额不足,请及时充值'));
				die;
			}
			//判断是否置顶中 如果正在置顶那么追加时间
			$top_to_time = $this->h->field('top_to_time')->where('id='.I('post.id'))->find();
			if($top_to_time['top_to_time']>=time()){ //如果置顶中
				$tagInfo['add_time'] = $top_to_time['top_to_time'];
				$tagInfo['to_time'] = $top_to_time['top_to_time']+60*60*24*I('post.day');
			}else{
				$tagInfo['add_time'] = time();
				$tagInfo['to_time'] = time()+60*60*24*I('post.day');
			}
			//插入tag表
			$tagInfo['user_id'] = I('post.user_id');
			$tagInfo['house_id'] = I('post.id');
			$tagInfo['tag_type'] = 1;
			$this->t->create($tagInfo);
			$tag_id = $this->t->add();
			//插入deal表
			$deal['type'] = "1";
			$deal['user_id'] = I('post.user_id');
			$deal['money'] = I('post.day');
			$deal['house_id'] = I('post.id');
			$deal['tag_id'] = $tag_id;
			$deal['tag_days'] = I('post.day');
			$this->d->create($deal);
			$this->d->add();
			//更新house表is_top & top_to_time
			$this->h->where('id='.$tagInfo['house_id'])->setField('is_top',$tag_id);
			$this->h->where('id='.$tagInfo['house_id'])->setField('top_to_time',$tagInfo['to_time']);
			//更新user表money
			$this->u->where('id='.I('post.user_id'))->setDec('money',I('post.day'));
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('errorMsg'=>'参数错误'));
		}
	}
	
	//■■■■■■■■■■■■■■■■■■■■■■后台设置房源加急
	public function setHouseToHurry(){
		if($_POST['id']&&$_POST['user_id']&&$_POST['day']){
			//判断用户余额
			$user_money = $this->u->field('money')->where('id='.I('post.user_id'))->find();
			if(I('post.day')*0.5>$user_money['money']){ 
				echo json_encode(array('success'=>false,'errorMsg'=>'用户余额不足,请及时充值'));
				die;
			}
			//判断是否置顶中 如果正在置顶那么追加时间
			$hurry_to_time = $this->h->field('hurry_to_time')->where('id='.I('post.id'))->find();
			if($hurry_to_time['hurry_to_time']>=time()){ //如果置顶中
				$tagInfo['add_time'] = $hurry_to_time['hurry_to_time'];
				$tagInfo['to_time'] = $hurry_to_time['hurry_to_time']+60*60*24*I('post.day');
			}else{
				$tagInfo['add_time'] = time();
				$tagInfo['to_time'] = time()+60*60*24*I('post.day');
			}
			//插入tag表
			$tagInfo['user_id'] = I('post.user_id');
			$tagInfo['house_id'] = I('post.id');
			$tagInfo['tag_type'] = 2; //2加急
			$this->t->create($tagInfo);
			$tag_id = $this->t->add();
			//插入deal表
			$deal['type'] = "2"; //2加急
			$deal['user_id'] = I('post.user_id');
			$deal['money'] = I('post.day')*0.5;
			$deal['house_id'] = I('post.id');
			$deal['tag_id'] = $tag_id;
			$deal['tag_days'] = I('post.day');
			$this->d->create($deal);
			$this->d->add();
			//更新house表is_top & top_to_time
			$this->h->where('id='.$tagInfo['house_id'])->setField('is_hurry',$tag_id);
			$this->h->where('id='.$tagInfo['house_id'])->setField('hurry_to_time',$tagInfo['to_time']);
			//更新user表money
			$this->u->where('id='.I('post.user_id'))->setDec('money',I('post.day')*0.5);
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('errorMsg'=>'参数错误'));
		}
	}
	
//■■■■■■■■■■■■■■■■■■■■■■房源信息增删改
	public function getHousesInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 用户房源列表
		if(empty($_POST['searchValue']) and empty($_POST['house_sell_type']) and empty($_POST['house_type']) and empty($_POST['house_state']) ){ 
				$where['house_state'] = 1 ;
				$where['user_id'] = cookie('lei666_id');
				$data['total'] = $this->h->where($where)->count();	
				//$data['rows']  = $this->h->field('lei1_house.id,user_id,title,size,price,content,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,lei1_zone.name')->where('house_state = 1 AND user_id='.cookie('lei666_id'))->join('lei1_zone ON lei1_house.zone_id = lei1_zone.id ')->page(I('post.page'),I('post.rows'))->order('id desc')->select();
				$data['rows']  = $this->h->where($where)->page(I('post.page'),I('post.rows'))->order('id desc')->select();	
		}else{
				$fieldsArray = $fieldsArray = array("id","zone_name","title","content") ;
				foreach($fieldsArray as $fields){
					$where[$fields]  = array('like', '%'.I('post.searchValue').'%');
				}
				$where['_logic'] = 'or';
				$map['_complex'] = $where;
				$map['user_id'] = cookie('lei666_id');
				$map['house_state'] = 1 ;
				if(!empty($_POST['house_sell_type']))
					$map['sell_type'] = I('post.house_sell_type');
				if(!empty($_POST['house_type']))
					$map['house_type'] = I('post.house_type');
				if(!empty($_POST['house_state']))
					$map['house_state'] = I('post.house_state');
				$data['total'] = $this->h->where($map)->count();	
				$data['rows'] = $this->h->where($map)->page(I('post.page'),I('post.rows'))->select();
		}
		foreach($data['rows'] as $k=>$v){
			$data['rows'][$k]['content'] = htmlspecialchars_decode($data['rows'][$k]['content']); //修改内容格式
			if($data['rows'][$k]['top_to_time']){ //修改置顶时间格式
				//echo $data['rows'][$k]['top_to_time'];die;
				$data['rows'][$k]['top_to_time'] = $this->getLeftTime($data['rows'][$k]['top_to_time']);
			}
			if($data['rows'][$k]['hurry_to_time']){ //修改加急时间格式
				$data['rows'][$k]['hurry_to_time'] = $this->getLeftTime($data['rows'][$k]['hurry_to_time']);
			}
		}
		echo json_encode($data);	
	}
	public function updateHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 房源信息
		$this->h->create($_POST);
		$this->h->where('id='.I('get.id'))->save();
		echo json_encode(array('success'=>true,'house_id'=>I('get.id')));
		//empty($_GET['id'])?$this->h->add():
		//echo json_encode($this->h);
	}
	public function dealHouse(){//■■■■■■■■■■■■■■■■■■■■■■成交！！！
		$_POST['house_state'] = 5;
		$this->h->create($_POST);
		$this->h->where('id='.I('get.id'))->save();
		echo json_encode(array('success'=>true));
	}
	
	public function deleteHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 房源信息
		$this->h->where('id='.I('post.id'))->setField('house_state',3);
		echo json_encode(array('success'=>true));
	}
	public function rubbishHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■垃圾 房源信息
		$this->h->where('id='.I('post.id'))->setField('house_state',3);
		echo json_encode(array('success'=>true));
	}
	public function checkHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■审核 房源信息
		if(I('post.check')){
			$this->h->where('id='.I('post.id'))->setField('house_state',1);
		}else{
			$this->h->where('id='.I('post.id'))->setField('house_state',6);
		}
		
		echo json_encode(array('success'=>true));
	}
	public function dealInfo(){
		$this->display();
	}
	public function getDealInfoList(){//■■■■■■■■■■■■■■■■■■■■■■获取消费信息列表
		//$where['house_state'] = 1 ;
		$where['user_id'] = cookie('lei666_id');
		$data['total'] = $this->d->where($where)->count();	
		//$data['rows']  = $this->h->field('lei1_house.id,user_id,title,size,price,content,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,lei1_zone.name')->where('house_state = 1 AND user_id='.cookie('lei666_id'))->join('lei1_zone ON lei1_house.zone_id = lei1_zone.id ')->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		$data['rows']  = $this->d->where($where)->page(I('post.page'),I('post.rows'))->order('id desc')->select();	
		/*
		foreach($data['rows'] as $k=>$v){
			$data['rows'][$k]['content'] = htmlspecialchars_decode($data['rows'][$k]['content']); //修改内容格式
			if($data['rows'][$k]['top_to_time']){ //修改置顶时间格式
				//echo $data['rows'][$k]['top_to_time'];die;
				$data['rows'][$k]['top_to_time'] = $this->getLeftTime($data['rows'][$k]['top_to_time']);
			}
			if($data['rows'][$k]['hurry_to_time']){ //修改加急时间格式
				$data['rows'][$k]['hurry_to_time'] = $this->getLeftTime($data['rows'][$k]['hurry_to_time']);
			}
		}*/
		echo json_encode($data);	
		
	}
	public function owenUrl(){	//■■■■■■■■■■■■■■■■■■■■■■专属网址
		 $content = $this->a->where('id=6')->find();
		 $this->assign('content',$content['content']);
		 $this->display();
		 $this->display();
	}
	public function fixComputer(){	//■■■■■■■■■■■■■■■■■■■■■■电脑维修
		 $content = $this->a->where('id=7')->find();
		 $this->assign('content',$content['content']);
		 $this->display();
	}
	public function ownPage(){	//■■■■■■■■■■■■■■■■■■■■■■专属主页
		 $content = $this->a->where('id=8')->find();
		 $this->assign('content',$content['content']);
		 $this->display();
	}
	public function userInfo(){	//■■■■■■■■■■■■■■■■■■■■■■商家信息
		 //$content = $this->a->where('id=8')->find();
		 //$this->assign('content',$content['content']);
		 $this->display();
	}
	public function userInfoJson(){	//■■■■■■■■■■■■■■■■■■■■■■商家信息json
		//var_dump($this->user_info);
		echo json_encode($this->user_info);
	}
	public function userInfoChange(){	//■■■■■■■■■■■■■■■■■■■■■■商家信息修改
		$this->u->create($_POST);
		$this->u->where('id='.$this->user_info['id'])->save();
//上传图像	
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize   =     2097152;// 设置附件上传大小
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->rootPath  =      './public'; // 设置附件上传根目录
		$upload->savePath  =      '/img/user/'.$this->site_info['area_id'].'/'; // 设置附件上传（子）目录
		$upload->saveName  = 	 $this->user_info['id'].'up';
		$upload->subName   =     '';
		$upload->replace   =     true;
// 上传文件 
		$info   =   $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
			die;
		}else{// 上传成功 获取上传文件信息
			foreach($info as $file){
				$img_path = $file['savepath'];
				$img_name = $file['savename'];
				$file['savepath'].$file['savename'];
			}
		}
		//var_dump($info );
//裁剪
		echo 'public'.$img_path.$img_name;
		$image = new \Think\Image(); 
		$image->open('public'.$img_path.$img_name);
		//将图片裁剪为400x400并保存为corp.jpg
		$image->thumb(205, 240)->save('public'.$img_path.$this->user_info['id'].'.jpg');
		//var_dump($_POST);
		//var_dump($_FILE);
	}
    public function logOff(){	//■■■■■■■■■■■■■■■■■■■■■■安全退出
	   cookie('lei666_pass',' '); 
	   $this->success('成功安全退出','/index',2);
    }
	public function checkUserCookie(){ //■■■■■■■■■■■■■■■■■■■■■■检测用户登陆
	   $user_cookie = cookie();
	   if(NULL==$user_cookie['lei666_id']){ //检测cookie
		  $this->error('请先登陆','/index/register',3);die;
	   }
	   if($user_info = $this->u->where('id='.$user_cookie['lei666_id'])->find()){//用户id是否存在
			if(md5($user_info['password'].'lei666')==$user_cookie['lei666_pass'] and $user_info['tel']==$user_cookie['lei666_tel']){ //密码是否正确
				 return $user_info;
			}else{
				$this->error('请先登陆','/index/register',3);die;
			}
	   }
	   else{
		   $this->error('请先登陆','/index/register',3);die;
	   }
    }
  
}