<?php
namespace Home\Controller;
use Think\Controller;
class  BenbenController extends Controller {
	
	function _initialize(){  //■■■■■■■■■■■■■■■■■■■■■■构造函数
		$this->s = M("site");
		$this->u = M("user");
		$this->h = M("house");
		$this->a = M("article");
		$this->z = M("zone");
		$this->r = M("recharge");
		$this->d = M("deal");
		$this->m = M("manager");
		$manager_info = $this->checkManagerCookie();
	    $this->assign('manager_info',$manager_info);
	}
    public function index(){
		$all_sites = $this->s->getField('area_name,area_url');
		//var_dump($all_sites);die;
		$this->assign('all_sites',$all_sites);
		$this->display();	
   }
   public function detail(){
	   $this->display();
   }
	public function sitesInfo(){
		$this->display();
	}
	public function usersInfo(){
		$this->display();
	}
	public function zoneInfo(){
		$this->display();
	}
	
//sitesInfo 处理###################################################################################分站
	public function getSitesInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 分站列表
		if(empty($_POST['searchValue'])){ 
				$data['total'] = $this->s->count();	
				$data['rows']  = $this->s->page(I('post.page'),I('post.rows'))->order('area_id asc')->select();
		}else{
				$fieldsArray = $fieldsArray = array("area_name","name_spell","area_url","web_name") ;
				foreach($fieldsArray as $fields){
					$map[$fields]  = array('like', '%'.$_POST[searchValue].'%');
				}
				$map['_logic'] = 'or';
				$data['total'] = $this->s->where($map)->count();	
				$data['rows'] = $this->s->where($map)->page(I('post.page'),I('post.rows'))->select();
		}
		echo json_encode($data);	
	}
	public function updateSiteInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 分站信息
		$this->s->create($_POST);
		empty($_GET['area_id'])?$this->s->add():$this->s->where('area_id='.I('get.area_id'))->save();
		echo json_encode($this->s);
	}
	public function deleteSiteInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 分站信息
		$this->s->where('area_id='.I('post.area_id'))->delete(); 
		echo json_encode(array('success'=>true));
	}
	
//usersInfo 处理###################################################################################用户
	public function getUsersInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 用户列表
		if(empty($_POST['searchValue']) and empty($_POST['state'])){ 
				$data['total'] = $this->u->count();	
				$data['rows']  = $this->u->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}else{
			if(!empty($_POST['searchValue'])){
				$fieldsArray = $fieldsArray = array("id","tel","person_name","company_name") ;
				foreach($fieldsArray as $fields){
					$map[$fields]  = array('like', '%'.$_POST[searchValue].'%');
				}
				$map['_logic'] = 'or';
				$where['_complex'] = $map;
			}
			if(!empty($_POST['state'])){
				$where['state'] = I('post.state');
			}
				$data['total'] = $this->u->where($where)->count();	
				$data['rows'] = $this->u->where($where)->page(I('post.page'),I('post.rows'))->select();
		}
		echo json_encode($data);	
	}
	public function updateUserInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 用户信息
		$this->u->create($_POST);
		empty($_GET['id'])?$this->u->add():$this->u->where('id='.I('get.id'))->save();
		echo json_encode($this->u);
	}
	public function checkUserInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 用户信息
		//$this->u->where('id='.I('post.id'))->delete(); 
		$this->u->where('id='.I('post.id'))->setField('state',I('post.check'));
		echo json_encode(array('success'=>true));
	}
	
//housesInfo 处理###################################################################################房源	
	public function getHousesInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 房源列表
		if(empty($_POST['searchValue']) and empty($_POST['house_sell_type']) and empty($_POST['house_type']) ){ 
				$data['total'] = $this->h->count();	
				$data['rows']  = $this->h->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}else{
				if(!empty($_POST['searchValue'])){
					$fieldsArray = $fieldsArray = array("id","title","personal_name","personal_tel") ;//搜索字段
					foreach($fieldsArray as $fields){
						$map[$fields]  = array('like', '%'.$_POST['searchValue'].'%');
					}
					$map['_logic'] = 'or';
					$where['_complex'] = $map;
				}
				if(!empty($_POST['house_sell_type']))
					$where['sell_type'] = I('post.house_sell_type');
				if(!empty($_POST['house_type']))
					$where['house_type'] = I('post.house_type');
				$data['total'] = $this->h->where($where)->count();	
				$data['rows'] = $this->h->where($where)->page(I('post.page'),I('post.rows'))->select();
		}
		//修改置顶 加急时间格式
		foreach($data['rows'] as $k=>$v){
			if($data['rows'][$k]['top_to_time']){ //修改置顶时间格式
				$data['rows'][$k]['top_to_time'] = getLeftTime($data['rows'][$k]['top_to_time']);
			}
			if($data['rows'][$k]['hurry_to_time']){ //修改加急时间格式
				$data['rows'][$k]['hurry_to_time'] = getLeftTime($data['rows'][$k]['hurry_to_time']);
			}
		}
		echo json_encode($data);	
	}
	public function updateHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 房源信息
		$this->h->create($_POST);
		empty($_GET['id'])?$this->h->add():$this->h->where('id='.I('get.id'))->save();
		echo json_encode($this->h);
	}
	public function deleteHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 房源信息
		//$this->h->where('id='.I('post.id'))->delete(); 
		$this->h->where('id='.I('post.id'))->setField('house_state','3');
		echo json_encode(array('success'=>true));
	}
	public function dropHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■彻底删除 房源信息
		$this->h->where('id='.I('post.id'))->delete(); 
		//$this->h->where('id='.I('post.id'))->setField('house_state','3');
		echo json_encode(array('success'=>true));
	}
	public function checkHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■审核 房源信息
		$this->h->where('id='.I('post.id'))->setField('house_state',I('post.check'));
		echo json_encode(array('success'=>true));
	}
	public function rubbishHouseInfo(){//■■■■■■■■■■■■■■■■■■■■■■垃圾 房源信息
		//$this->h->where('id='.I('post.id'))->delete(); 
		$this->h->where('id='.I('post.id'))->setField('house_state','4');
		echo json_encode(array('success'=>true));
	}
	
//articleInfo 处理###################################################################################文章	
	public function getArticlesInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 文章列表
		if(empty($_POST['searchValue'])){ 
				$data['total'] = $this->a->count();	
				$data['rows']  = $this->a->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}else{
				$fieldsArray = $fieldsArray = array("id","title","content") ;
				foreach($fieldsArray as $fields){
					$map[$fields]  = array('like', '%'.$_POST[searchValue].'%');
				}
				$map['_logic'] = 'or';
				$data['total'] = $this->a->where($map)->count();	
				$data['rows'] = $this->a->where($map)->page(I('post.page'),I('post.rows'))->select();
		}
		foreach($data['rows'] as $k=>$v){
			$data['rows'][$k]['content'] = htmlspecialchars_decode($data['rows'][$k]['content']); //修改内容格式
		}
		echo json_encode($data);	
	}
	public function updateArticleInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 文章信息
		$this->a->create($_POST);
		empty($_GET['id'])?$this->a->add():$this->a->where('id='.I('get.id'))->save();
		echo json_encode($this->a);
	}
	public function deleteArticleInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 文章信息
		//$this->a->where('id='.I('post.id'))->delete(); 
		$this->a->where('id='.I('post.id'))->setField('state',I('post.state'));
		echo json_encode(array('success'=>true));
	}
//zoneInfo 处理###################################################################################小区	
	public function getZonesInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 小区列表
		if(empty($_POST['searchValue']) AND empty($_POST['state'])){ 
				$data['total'] = $this->z->count();	
				$data['rows']  = $this->z->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}else{
			if(!empty($_POST['searchValue'])){	
				$fieldsArray = $fieldsArray = array("name_spell","name","address") ;
				foreach($fieldsArray as $fields){
					$map[$fields]  = array('like', '%'.$_POST[searchValue].'%');
				}
				$map['_logic'] = 'or';
				$where['_complex'] = $map;
			}
			if(!empty($_POST['state'])){
				$where['state'] = I('post.state');
			}
				$data['total'] = $this->z->where($where)->count();	
				$data['rows'] = $this->z->where($where)->page(I('post.page'),I('post.rows'))->select();
		}
		echo json_encode($data);	
	}
	public function updateZoneInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 小区信息
		$this->z->create($_POST);
		empty($_GET['id'])?$this->z->add():$this->z->where('id='.I('get.id'))->save();
		echo json_encode($this->z);
	}
	public function deleteZoneInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 小区信息
		$this->z->where('id='.I('post.id'))->delete(); 
		echo json_encode(array('success'=>true));
	}
//rechargeInfo 处理###################################################################################充值	
	public function getRechargeInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 充值列表
		if(empty($_POST['searchRechargeValue']) AND empty($_POST['type']) AND empty($_POST['area_id']) AND empty($_POST['user_id']) ){ 
				$data['total'] = $this->r->count();	
				$data['rows']  = $this->r->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}else{
			if(!empty($_POST['searchRechargeValue'])){	
				$fieldsArray = $fieldsArray = array("user_id") ;
				foreach($fieldsArray as $fields){
					$map[$fields]  = array('like', '%'.$_POST[searchRechargeValue].'%');
				}
				$map['_logic'] = 'or';
				$where['_complex'] = $map;
			}
			if(!empty($_POST['type'])){$where['type'] = I('post.type');}
			if(!empty($_POST['area_id'])){$where['area_id'] = I('post.area_id');}
			if(!empty($_POST['user_id'])){$where['user_id'] = I('post.user_id');}
				$data['total'] = $this->r->where($where)->count();	
				$data['rows'] = $this->r->where($where)->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}
		echo json_encode($data);	
	}
	public function updateRechargeInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 充值信息
		
		//echo json_encode(array('errorMsg'=>'输入用户ID'));
		$_POST['user_id'] = trim($_POST['user_id']);
		if(empty($_POST['user_id'])){
			echo json_encode(array('errorMsg'=>'请输入用户ID'));
		}
		$user_info = $this->u->where('id='.I('post.user_id'))->find();
		if(!empty($user_info)){
			//var_dump($user_info);die; 
			$this->u->where('id = '.$_POST['user_id'])->setInc('money',I('post.money')); 
			$_POST['area_id'] = $user_info['area_id'];
			$this->r->create($_POST);
			$this->r->add();
			echo json_encode($this->r);
		}else{
			echo json_encode(array('errorMsg'=>'不存在的用户'));
		}
	}
	public function deleteRechargeInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 充值信息
		//$this->r->where('id='.I('post.id'))->delete(); 
		$this->r->where('id='.I('post.id'))->setField('type',I('post.type'));
		echo json_encode(array('success'=>true));
	}
//dealInfo 处理###################################################################################消费	
	public function getDealInfoList(){ //■■■■■■■■■■■■■■■■■■■■■■获取 充值列表
		if(empty($_POST['searchDealValue']) AND empty($_POST['type']) AND empty($_POST['area_id']) AND empty($_POST['user_id']) ){ 
				$data['total'] = $this->d->count();	
				$data['rows']  = $this->d->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}else{
			if(!empty($_POST['searchDealValue'])){	
				$fieldsArray = $fieldsArray = array("user_id") ;
				foreach($fieldsArray as $fields){
					$map[$fields]  = array('like', '%'.$_POST[searchDealValue].'%');
				}
				$map['_logic'] = 'or';
				$where['_complex'] = $map;
			}
			if(!empty($_POST['type'])){$where['type'] = I('post.type');}
			if(!empty($_POST['area_id'])){$where['area_id'] = I('post.area_id');}
			if(!empty($_POST['user_id'])){$where['user_id'] = I('post.user_id');}
				$data['total'] = $this->d->where($where)->count();	
				$data['rows'] = $this->d->where($where)->page(I('post.page'),I('post.rows'))->order('id desc')->select();
		}
		echo json_encode($data);	
	}
	public function updateDealInfo(){//■■■■■■■■■■■■■■■■■■■■■■增加&修改 充值信息
		$_POST['user_id'] = trim($_POST['user_id']);
		if(empty($_POST['user_id'])){
			echo json_encode(array('errorMsg'=>'请输入用户ID'));
		}
		$user_info = $this->u->where('id='.I('post.user_id'))->find();
		if(!empty($user_info)){
			$this->u->where('id = '.$_POST['user_id'])->setDec('money',I('post.money')); 
			$_POST['area_id'] = $user_info['area_id'];
			$this->d->create($_POST);
			$this->d->add();
			echo json_encode($this->d);
		}else{
			echo json_encode(array('errorMsg'=>'不存在的用户'));
		}
	}
	public function deleteDealInfo(){//■■■■■■■■■■■■■■■■■■■■■■删除 充值信息
		//$this->r->where('id='.I('post.id'))->delete(); 
		$this->r->where('id='.I('post.id'))->setField('type',I('post.type'));
		echo json_encode(array('success'=>true));
	}

	
	
	
//################################################################################### 其他功能	
	public function setHouseToHurry(){//■■■■■■■■■■■■■■■■■■■■■■管理员设置 加急
		if($_POST['id']&&$_POST['day']){
			//判断是否置顶中 如果正在置顶那么追加时间
			$hurry_to_time = $this->h->field('hurry_to_time')->where('id='.I('post.id'))->find();
			if($hurry_to_time['hurry_to_time']>=time()){ //如果置顶中
				//$tagInfo['add_time'] = $hurry_to_time['hurry_to_time'];
				$tagInfo['to_time'] = $hurry_to_time['hurry_to_time']+60*60*24*I('post.day');
			}else{
				//$tagInfo['add_time'] = time();
				$tagInfo['to_time'] = time()+60*60*24*I('post.day');
			}
			//更新house表is_hurry & hurry_to_time
			$this->h->where('id='.I('post.id'))->setField('hurry_to_time',$tagInfo['to_time']);
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('errorMsg'=>'参数错误'));
		}
	}
	public function setHouseToTop(){//■■■■■■■■■■■■■■■■■■■■■■管理员设置 置顶
		if($_POST['id']&&$_POST['day']){
			//判断是否置顶中 如果正在置顶那么追加时间
			$hurry_to_time = $this->h->field('top_to_time')->where('id='.I('post.id'))->find();
			if($hurry_to_time['top_to_time']>=time()){ //如果置顶中
				//$tagInfo['add_time'] = $hurry_to_time['hurry_to_time'];
				$tagInfo['to_time'] = $hurry_to_time['top_to_time']+60*60*24*I('post.day');
			}else{
				//$tagInfo['add_time'] = time();
				$tagInfo['to_time'] = time()+60*60*24*I('post.day');
			}
			//更新house表is_hurry & hurry_to_time
			$this->h->where('id='.I('post.id'))->setField('top_to_time',$tagInfo['to_time']);
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('errorMsg'=>'参数错误'));
		}
	}
	
	public function checkManagerCookie(){ //■■■■■■■■■■■■■■■■■■■■■■检测用户登陆
	   $user_cookie = cookie();
	   if(NULL==$user_cookie['lei666_manager_id']){ //检测cookie
		  $this->error('请先登陆','/index/adminLogin',3);die;
	   }
	   if($user_info = $this->m->where('id='.$user_cookie['lei666_manager_id'])->find()){//用户id是否存在
			if(md5($user_info['password'].'lei666')==$user_cookie['lei666_manager_pass']){ //密码是否正确
				 return $user_info;
			}else{
				$this->error('请先登陆','/index/adminLogin',3);die;
			}
	   }
	   else{
		   $this->error('请先登陆','/index/adminLogin',3);die;
	   }
    }

	
}