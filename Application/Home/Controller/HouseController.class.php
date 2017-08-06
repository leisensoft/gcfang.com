<?php
namespace Home\Controller;
use Think\Controller;
class HouseController extends Controller {
	function _initialize(){  //■■■■■■■■■■■■■■■■■■■■■■构造函数
		 //$UController = new UController;
		 $this->h = M("house");
		 $this->z = M("zone");
		 $this->t = M("tag");
		 $this->d = M("deal");
		 $this->u = M("user");
		 $this->s = M("site");
		 $site_info = $this->s->where('area_id='.I('get.url_area_id'))->find();//获取站点信息
	     $this->assign('site_info',$site_info);
	}
    public function index(){
		$this->display();	
    }
    public function detail(){//■■■■■■■■■■■■■■■■■■■■■■房源信息-详细页面
	   if(empty($_GET['id'])){$this->error('不存在的房源','/Index',3);die;}
	   $house_info = $this->h->where('id='.I('get.id'))->find(); //获取house信息
	   $house_info['content'] = htmlspecialchars_decode($house_info['content']);
	   if(empty($house_info)){$this->error('不存在的房源','/Index',3);die;}
	   if(empty($house_info['personal_tel'])){//中介 OR 个人
			$user_info = $this->u->where('id='.$house_info['user_id'])->find(); //获取user信息
			$this->assign('user_info',$user_info);
	   }
	   //var_dump($user_info);die;
	   $this->assign('house_info',$house_info);
	   //浏览次数+1
	   $this->h->where('id='.I('get.id'))->setInc('view_times',1);
	   //判断是中介还是个人
	   //dump($house_info);
	   $this->display();
    }
	public function personDelHouse(){//■■■■■■■■■■■■■■■■■■■■■■游客删除房源
		$where['id'] = I('post.id');
		$where['personal_pass'] = I('post.pass');
		$house_info = $this->h->where($where)->find();
		if(empty($house_info)){echo "err";die;}
		$this->h->where($where)->setField('house_state',3);
		echo "ok";
		//$this->display();
	}
    public function zoneDetail(){ //■■■■■■■■■■■■■■■■■■■■■■小区详页
		//$user_money = $this->u->field('money')->where('id=23')->find(); 
	    if(empty($_GET['id'])){$this->error('不存在的小区','/Index',3);die;}
	    $zone_info = $this->z->where('id='.I('get.id'))->find(); //获取house信息
		$this->assign('zone_info',$zone_info);
		//var_dump($zone_info);die;
		//count 6次
		$countWhere['zone_id'] =  $zone_info['id'];
		$countWhere['house_state'] = 1;
		$countWhere['sell_type'] = 1;
		$countWhere['house_type'] = 1;
		$countSellHouse = $this->h->where($countWhere)->count();
		//var_dump($countSellHouse);die;
		$countSellHouse = $countSellHouse=='0'?'暂无':$countSellHouse; 
		$countWhere['house_type'] = 2;
		$countSellShop = $this->h->where($countWhere)->count();
		$countSellShop = $countSellShop=='0'?'暂无':$countSellShop; 
		$countWhere['house_type'] = 3;
		$countSellGarage = $this->h->where($countWhere)->count();
		$countSellGarage = $countSellGarage=='0'?'暂无':$countSellGarage; 
		$countWhere['sell_type'] = 2;
		$countRentGarage = $this->h->where($countWhere)->count();
		$countRentGarage = $countRentGarage=='0'?'暂无':$countRentGarage; 
		$countWhere['house_type'] = 2;
		$countRentShop = $this->h->where($countWhere)->count();
		$countRentShop = $countRentShop=='0'?'暂无':$countRentShop; 
		$countWhere['house_type'] = 1;
		$countRentHouse = $this->h->where($countWhere)->count();
		$countRentHouse = $countRentHouse=='0'?'暂无':$countRentHouse; 
		$this->assign('countSellHouse', $countSellHouse );
		$this->assign('countSellGarage',$countSellGarage);
		$this->assign('countSellShop',  $countSellShop  );
		$this->assign('countRentGarage',$countRentGarage);
		$this->assign('countRentHouse', $countRentHouse );
		$this->assign('countRentShop',  $countRentShop  );
		//count结束
		$where['zone_id'] = $zone_info['id'];
		$where['lei1_house.house_state'] = 1;
		$where['top_to_time'] = array(array('gt',time()));
	    $allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name')->where($where)->order('lei1_house.id desc')->select();
		foreach($allHouse as $house){
				$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
				$house['price'] = $house['price']?$house['price'].'万':'面议'; //处理价格格式
				$house['hurry_to_time'] = time()<$house['hurry_to_time']?2:0;//判断加急
				if(1==$house['sell_type'] and 1==$house['house_type']){ //买房
					 $sellHouse[] = $house;
				}
				if(2==$house['sell_type'] and 1==$house['house_type']){ //租房
					$rentHouse[] = $house;
				}
				if(2==$house['house_type']){ //门市/厂房
					$shopHouse[] = $house;
				}
				if(3==$house['house_type']){ //车库/车位
					$garageHouse[] = $house;
				}
		}
		//dump($garageHouse);die;
		$this->assign('sellHouse',$sellHouse); 
		$this->assign('rentHouse',$rentHouse);
		$this->assign('shopHouse',$shopHouse);
		$this->assign('garageHouse',$garageHouse);
	    $this->display();
    }
    public function userAddHouse(){ //■■■■■■■■■■■■■■■■■■■■■■中介后台添加房源信息
		$user_id = cookie('lei666_id');
//1.先判断 zone输入框 获取到 $zone_id 
		if(!IS_POST){echo json_encode(array('success'=>false,'errorMsg'=>'没有POST信息'));die;}
		$zone_id = $this->getZoneId(I('post.zone_id'));
		if(!$zone_id){echo json_encode(array('success'=>false,'errorMsg'=>'小区或街道名称数据有误!'));die;}
//2.插入house 表
		$house_info['user_id'] = $user_id;
		$house_info['zone_id'] = $zone_id['id']; 
		$house_info['zone_name'] = $zone_id['name']; 
		$house_info['house_state'] = 1; 
		$house_info['area_id'] = I('get.url_area_id'); 
		$house_info['title'] = I('post.title');
		$house_info['size'] = I('post.size');
		$house_info['price'] = I('post.price');
		$house_info['content'] = I('post.content');
		$house_info['sell_type'] = I('post.sell_type');
		$house_info['house_type'] = I('post.house_type');
		$house_info['user_type'] = 1;
		$house_info['create_time'] = date('Y-m-d H:i:s');
		$this->h->create($house_info);
		$house_id = $this->h->add();	
//3.判断 付费标签 插入tag表时间 同时更新house表tag信息 再插入deal表记录交易信息  house排序时候select to_time from * left jion tag表where house.is_top = tag_id
		if(1==I('post.tag_is_top')){
			//先判断余额 
			$user_money = $this->u->field('money')->where('id='.$user_id)->find();
			if(I('post.days')>$user_money['money']){ echo json_encode(array('success'=>false,'errorMsg'=>'用户余额不足,请及时充值'));die;}
			//插入tag表
			$tag_top['add_time'] = time();
			$tag_top['to_time'] = time()+60*60*24*I('post.days');
			$tag_top['house_id'] = $house_id;
			$tag_top['user_id'] = $user_id;
			$tag_top['tag_type'] = 1;
			$this->t->create($tag_top);
			$tag_top_id = $this->t->add();
			//更新house表is_top & top_to_time
			$this->h->where('id='.$house_id)->setField('is_top',$tag_top_id);
			$this->h->where('id='.$house_id)->setField('top_to_time',$tag_top['to_time']);
			//插入deal表
			$deal['type'] = "1";
			$deal['user_id'] = $user_id;
			$deal['money'] = I('post.days');
			$deal['house_id'] = $house_id;
			$deal['tag_id'] = $tag_top_id;
			$deal['tag_days'] = I('post.days');
			$this->d->create($deal);
			$this->d->add();
			//更新user表money
			$this->u->where('id='.$user_id)->setDec('money',I('post.days'));
		}
		if(1==I('post.tag_is_hurry')){
			$user_money = $this->u->field('money')->where('id='.$user_id)->find();
			if(I('post.days')*0.5>$user_money['money']){ echo json_encode(array('success'=>false,'errorMsg'=>'余额不足,请充值'));die;}
			$tag_hurry['add_time'] = time();
			$tag_hurry['to_time'] = time()+60*60*24*I('post.days');
			$tag_hurry['house_id'] = $house_id;
			$tag_hurry['user_id'] = $user_id;
			$tag_top['tag_type'] = 2;
			$this->t->create($tag_hurry);
			$tag_hurry_id = $this->t->add();
			$this->h->where('id='.$house_id)->setField('is_hurry',$tag_hurry_id);
			$this->h->where('id='.$house_id)->setField('hurry_to_time',$tag_hurry['to_time']);
			$deal['type'] = "2";
			$deal['user_id'] = $user_id;
			$deal['money'] = I('post.days')*0.5;
			$deal['house_id'] = $house_id;
			$deal['tag_id'] = $tag_hurry_id;
			$deal['tag_days'] = I('post.days');
			$this->d->create($deal);
			$this->d->add();
			$this->u->where('id='.$user_id)->setDec('money',I('post.days')*0.5);
		}
			echo json_encode(array('success'=>true,'house_id'=>$house_id));
    }
	public function personAddHouse(){
		//1.先判断 zone输入框 获取到 $zone_id 
		if(!IS_POST){echo json_encode(array('errorMsg'=>'没有POST信息'));die;}
		$zone_id = $this->getZoneId(I('post.zone_id'));
		if(!$zone_id){echo json_encode(array('errorMsg'=>'小区或街道名称数据有误!'));die;}
		//2.插入house 表
		//$house_info['user_id'] = $user_id;
		$house_info['zone_id'] = $zone_id['id']; 
		$house_info['zone_name'] = $zone_id['name']; 
		$house_info['house_state'] = 5; //个人未审核状态
		$house_info['area_id'] = I('get.url_area_id'); 
		$house_info['title'] = I('post.title');
		$house_info['size'] = I('post.size');
		$house_info['price'] = I('post.price');
		$house_info['content'] = I('post.content');
		$house_info['sell_type'] = I('post.sell_type');
		$house_info['house_type'] = I('post.house_type');
		$house_info['user_type'] = 2;
		$house_info['personal_name'] = I('post.personal_name');
		$house_info['personal_tel'] = I('post.personal_tel');
		$house_info['personal_pass'] = I('post.personal_pass');
		$house_info['create_time'] = date('Y-m-d H:i:s');
		$this->h->create($house_info);
		$house_id = $this->h->add();	
		echo json_encode(array('success'=>true,'house_id'=>$house_id));
	}
   public function getZoneId($id){ //■■■■■■■■■■■■■■■■■■■■■■通过用户输入数据 返回zone的id和name
	   $id = trim($id);//去掉前后空格
	   if(""==$id){return false;} 
	   if(is_numeric($id)){ 	// 一. 是否传入数字
			$zone_info = $this->z->where('id='.$id)->find();
			if($zone_info['id']==$id){ //1.如果用户选择自动完成 判断是否传入存在的 zone_id
					return $zone_info;
			}else{			   //2.不存在
				    return false;
			}
		}else{						  //二.传入中文
			$zone_info = $this->z->where('name="'.$id.'"')->find(); //返回 数组 $arr[id] = name //!!!!汉字搜索要加双引号 "搜索内容"
			if(is_array($zone_info)){ //1.用户输入的name 存在
					return $zone_info;
			}else{ 					  //2.用户输入的name 不存在 插入zone表 
				$zone_info['area_id'] = I('get.url_area_id');
				$zone_info['name'] = $id;
				$zone_info['id'] = $this->z->data($zone_info)->add();
				return $zone_info;
			}
		}
   }
   
   public function autoCompleteZone(){ //■■■■■■■■■■■■■■■■■■■■■■自动填表
		$fieldsArray = array("name_spell","name") ;    //自定义搜索的字段 //全字段$this->m->getDbFields();
		$search_words = trim(I('get.name_startsWith'));
		foreach($fieldsArray as $fields){
			$where[$fields]  = array('like', '%'.$search_words.'%');
		}
		$where['_logic'] = 'or';
		$map['_complex'] = $where;
		$map['pid'] = array('eq',I('get.url_area_id')); //这里需要定义 城市ID
		$data = $this->z->field('id,name,address')->where($map)->limit(5)->select();
		foreach($data as $val){					                   //修改返回数组 $arr['0'] = array('id'=>'ID值','name'=>'显示','desc'=>'小字');
			$fixData['id'] = $val['id'];
			$fixData['text'] = $val['name'];
			$fixData['address'] = $val['address'];
			$returnData[] = $fixData;
		}
		$callBack = I('get.callback');
		echo $callBack.'('.json_encode($returnData).')'; 
   }
   
   public function searchHouse(){ //■■■■■■■■■■■■■■■■■■■■■■首页搜索框
	  $_POST['searchValue'] = trim($_POST['searchValue']);
	  if(empty($_POST['searchValue'])){echo json_encode(array('success'=>false,'err'=>'没输入搜索内容'));die;}//无内容---结束
	  if(is_numeric($_POST['searchValue'])){ //一.传入数字 按 房源编号 手机号
			//先查编号
			$houseInfo = $this->h->field('id,title')->where('id='.I('post.searchValue').' AND area_id='.I('get.url_area_id'))->find();
			if($houseInfo){echo json_encode(array('success'=>true,'houseid'=>true,'houseInfo'=>$houseInfo));die;} //1.房源编号存在--跳转房源信息页-结束
			
			if( 11  == strlen($_POST['searchValue'])){
				$houseInfo = $this->h->field('id,title')->where('area_id='.I('get.url_area_id').' AND personal_tel='.I('post.searchValue'))->select();
				//dump($houseInfo);die;
				if(1==count($houseInfo)){echo json_encode(array('success'=>true,'telhouseone'=>true,'houseInfo'=>$houseInfo));die;}//2.个人电话存在--一条--跳转房源信息页
				if(1 <count($houseInfo)){echo json_encode(array('success'=>true,'telhouseduo'=>true,'houseInfo'=>$houseInfo));die;} //3.个人电话存在--多条--加载列表--结束
				
				$houseInfo = $this->u->field('tel,company_name,shop_url')->where('area_id='.I('get.url_area_id').' AND tel='.I('post.searchValue'))->find();
				if($houseInfo){echo json_encode(array('success'=>true,'houseInfo'=>$houseInfo,'user'=>true));die;} //4.中介电话存在--跳转中介页面--结束
				echo json_encode(array('success'=>false,'err'=>'没找到相关信息'));
			}
			//5.无数字结果 返回
			echo json_encode(array('success'=>false,'err'=>'没有找到相关的结果.'));
	  }else{ //二.传入文字搜小区
			$houseInfo = $this->z->field('id,baidu_coordinate')->where('area_id='.I('get.url_area_id').' AND name="'.I('post.searchValue').'"')->find();
			if($houseInfo){echo json_encode(array('success'=>true,'houseInfo'=>$houseInfo,'zonename'=>true));die;} //4.小区存在--跳转小区页面--结束
			echo json_encode(array('success'=>false,'err'=>'没找到相关信息'));
		    
	  }
	   //var_dump($_POST);var_dump($_GET);die;
   }
   public function getMoreHouseLise(){//小区详细信息 页面加载更多
		//var_dump($_GET);var_dump($_POST);die;
		//$sell_type=0,$house_type=0,$zone_id=0,$user_id=0
		if(empty($_POST['zone_id'])){die;}
		//if(I('post.tabNo')){$where['lei1_house.house_type']=I('post.tabNo');}//TAB编号决定房源类型 0-买房 1-租房 2-门市/厂房 3-车库/车位 4-搜索结果(直接die不返回)
		switch(I('post.tabNo')){
			case 0:
				$where['house_type']=1;
				$where['sell_type']=1;
			break;
			case 1:
				$where['house_type']=1;
				$where['sell_type']=2;
			break;
			case 2:
				$where['house_type']=2;
			break;
			case 3:
				$where['house_type']=3;
			break;
			default:die;
		}	
		$page_size = 20; //每页显示条数
		$where['zone_id'] = I('post.zone_id');
		$where['lei1_house.house_state'] = 1;
		//$where['lei1_house.area_id'] = I('get.url_area_id');
		$page = I('post.liNo')/$page_size+1;//第一页开始
	    $allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name')->where($where)->limit(I('post.liNo'),$page_size)->order('lei1_house.id desc')->select();
		if(empty($allHouse)){die;}//无结果 返回
		$houseHtml .= "<div class='house_page'>第".$page."页</div>";
		foreach($allHouse as $house){
				$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
				$house['price'] = $house['price']?$house['price'].'万':'面议'; //处理价格格式
				//html 
				$houseHtml .="<li class='info_li'>";
				$houseHtml .="<a target=_blank href='".$tihs->site_info['area_url']."/house/detail/id/$house[id].html'>";
				$houseHtml .= time()<$house['hurry_to_time']?"<span style='color:red;' class='info_tabs_title'>$house[title]<span class='lab lab_hurry'>急</span></span>":"<span class='info_tabs_title'>$house[title]</span>";//判断加急
				$houseHtml .= "<span class='info_tabs_size'>$house[size]平</span> <span class='info_tabs_price'>$house[price]</span> <span class='info_tabs_date'>$house[create_time]</span>";
				$houseHtml .="</a>";
				$houseHtml .= "</li>";
		}
		echo $houseHtml;
		//dump($houseHtml);die;	
	}
}