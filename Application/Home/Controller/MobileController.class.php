<?php
namespace Home\Controller;
use Think\Controller;
class MobileController extends Controller {
	public $page_size = 10; //每页加载信息条数
	function _initialize(){  //■■■■■■■■■■■■■■■■■■■■■■构造函数 初始化 user site表 获取分站信息&个人信息
		$this->u = M("user");
		$this->s = M("site");
		$this->h = M("house");
		$this->z = M("zone");
		$this->a = M("article");
		$this->m = M("manager");
		$site_info = $this->s->where('area_id='.I('get.url_area_id'))->find();
		$this->assign('site_info',$site_info);
		//$user_cookie_info = $this->checkUserCookie();
		//$this->assign('user_info',$user_cookie_info);
	}
	public function _empty($name){
		echo $name;die;
        $this->_noContraller($name);
    }
	protected function _noContraller($name){
       $this->error('不存在的页面','/Index',3);
    }
	
    public function index(){	
	    //var_dump($_GET);die;
		$where['lei1_house.house_state'] = 1;
		$where['top_to_time'] = array(array('gt',time()));
	    $allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name,personal_name')->where($where)->order('lei1_house.id desc')->select();
		foreach($allHouse as $house){
				$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
				$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
				$house['hurry_to_time'] = time()<$house['hurry_to_time']?2:0;//判断加急
				if(empty($house['personal_name'])){   				//处理联系人
					$house['personal_name'] = $this->u->where('id='.$house['user_id'])->getField('company_name');
				}	
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
	
	public function zone(){
		if(I('get.id')){
			//count 4次 0:出售 1:出租 2:门市/厂房 3:车库/车位
				$countWhere['zone_id'] =  I('get.id');
				$countWhere['house_state'] = 1;
				$countWhere['house_type'] = 3; //车库
				$countGarage = $this->h->where($countWhere)->count();
				$countWhere['house_type'] = 2;//门市
				$countShop = $this->h->where($countWhere)->count();
				$countWhere['house_type'] = 1; //售房
				$countWhere['sell_type'] = 1;
				$countSellHouse = $this->h->where($countWhere)->count();
				$countWhere['sell_type'] = 2;//租房
				$countRentHouse = $this->h->where($countWhere)->count();
				$this->assign('countGarage', $countGarage );
				$this->assign('countShop',$countShop);
				$this->assign('countSellHouse',  $countSellHouse  );
				$this->assign('countRentHouse', $countRentHouse );
			//count结束
			$zone_info = $this->z->where('id='.I('get.id'))->find();
			$this->assign('zone',$zone_info);
			$where['zone_id'] = $zone_info['id'];
			$where['lei1_house.house_state'] = 1;
			$where['top_to_time'] = array(array('gt',time()));
			$allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name,personal_name')->where($where)->order('lei1_house.id desc')->select();
			foreach($allHouse as $house){
					$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
					$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
					$house['hurry_to_time'] = time()<$house['hurry_to_time']?2:0;//判断加急
					if(empty($house['personal_name'])){   				//处理联系人
						$house['personal_name'] = $this->u->where('id='.$house['user_id'])->getField('company_name');
					}	
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
			$this->assign('sellHouse',$sellHouse); 
			$this->assign('rentHouse',$rentHouse);
			$this->assign('shopHouse',$shopHouse);
			$this->assign('garageHouse',$garageHouse);
			$this->display();
		}
    }
	public function detail(){	
	//var_dump($_GET);die;
		$house = $this->h->where('id='.I('get.id'))->find();
		$house['content'] = htmlspecialchars_decode($house['content']);
		$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
		$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
		if(empty($house['personal_name'])){   				//处理联系人
			$house_info = $this->u->where('id='.$house['user_id'])->getField('tel','person_name');
			$house['personal_name'] = $house_info['person_name'];
			$house['personal_tel'] = $house_info['tel'];
		}
		$this->assign('house',$house);	
		$this->display();
    }
	public function user(){	
		if(I('get.id')){
			$user_info = $this->u->where('id='.I('get.id'))->find();
			$this->assign('user',$user_info);
			$where['user_id'] = $user_info['id'];
			$where['lei1_house.house_state'] = 1;
			$where['top_to_time'] = array(array('gt',time()));
			$allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name,personal_name')->where($where)->order('lei1_house.id desc')->select();
			foreach($allHouse as $house){
					$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
					$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
					$house['hurry_to_time'] = time()<$house['hurry_to_time']?2:0;//判断加急
					if(empty($house['personal_name'])){   				//处理联系人
						$house['personal_name'] = $this->u->where('id='.$house['user_id'])->getField('company_name');
					}	
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
			$this->assign('sellHouse',$sellHouse); 
			$this->assign('rentHouse',$rentHouse);
			$this->assign('shopHouse',$shopHouse);
			$this->assign('garageHouse',$garageHouse);
			$this->display();
		}
    }
	public function getMoreHouseList(){
		$page_size = $this->page_size; //每页显示条数
		$tabNo = I('post.tabNo');//类型
		$page = I('post.liNo')/$page_size+1;//第一页开始
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
		//小区
		if(I('post.zone_id')){
			$where['zone_id'] = I('post.zone_id');
		}
		//用户
		if(I('post.user_id')){
			$where['user_id'] = I('post.user_id');
		}
		$where['lei1_house.house_state'] = 1;
		$where['lei1_house.area_id'] = I('get.url_area_id');
	    $allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name,personal_name')->where($where)->limit(I('post.liNo'),$page_size)->order('lei1_house.id desc')->select();
		if(empty($allHouse)){die;}//无结果 返回
		$houseHtml .= "<div class='house_page'>第".$page."页</div>";
		foreach($allHouse as $house){
				$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
				$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
				if(empty($house['personal_name'])){   				//处理联系人
					$house['personal_name'] = $this->u->where('id='.$house['user_id'])->getField('company_name');
				}	
				$houseHtml .="<li id='$house[id]'>";
				$houseHtml .="<a name=$house[id]   href='#' onclick='openDetail($house[id]);'>";
				$houseHtml .= time()<$house['hurry_to_time']?"<div class='list-header' style='color:red;'>[急]$house[title]</div>":"<div class='list-header'>$house[title]</div>";//判断加急
				$houseHtml .= "<div class='list-content'>房源编号:$house[id] $house[zone_name] $house[size]平 $house[price]</div><div class='list-content'>联系人:$house[personal_name] $house[create_time]</div>";
				$houseHtml .="</a>";
				$houseHtml .= "</li>";
		}
		echo $houseHtml;
		//dump($houseHtml);die;	
	}
	
	public function getHouseInfo(){
		if(I('post.id')){
			$house_info = $this->h->where('id='.I('post.id'))->find();
			//判断是个人还是中介 
			if(empty($house_info['personal_tel'])){   				//如果是中介
					$house_info['personal_tel'] = $this->u->where('id='.$house_info['user_id'])->getField('tel');
			}	
			$house_info['content'] = htmlspecialchars_decode($house_info['content']);
			if(empty($_POST['isTop'])){
				$houseHtml .= "<div class='house_info_detail' id='detail_".$house_info['id']."'>";
			}else{
				$houseHtml .= "<div class='house_info_detail' id='top_detail_".$house_info['id']."'>";
			}
			$houseHtml .= "<div class='list-header' style='text-align:center;'><a class='tel_button' href='tel:$house_info[personal_tel]'>电话：$house_info[personal_tel] （点击拨打）</a></div>";
			$houseHtml .= "<div class='list-header'>详细信息： $house_info[content]</div>";	
			if(empty($_POST['isTop'])){
				$houseHtml .= "<div class='house_info_close' onclick='closeDetail(".$house_info['id'].");'>收 起</div>";
			}else{
				$houseHtml .= "<div class='house_info_close' onclick='closeDetail(".$house_info['id'].",1);'>收 起</div>";
			}
			$houseHtml .= "</div>";		
			echo $houseHtml;
		}
	}
	
	public function doSearch(){
		if(is_numeric($_POST['searchValue'])){ //一.传入数字 按 房源编号 手机号
			//先查编号
			$houseInfo = $this->h->field('id,title')->where('id='.I('post.searchValue').' AND area_id='.I('get.url_area_id'))->find();
			if($houseInfo){echo json_encode(array('success'=>true,'house'=>true,'id'=>$houseInfo['id']));die;} //1.房源编号存在--跳转房源信息页-结束
			echo json_encode(array('success'=>false,'err'=>'房源编号不存在.'));//2.无数字结果 返回
	    }else{ //二.传入文字搜小区
			//var_dump(I('post.searchValue'));
			$houseInfo = $this->z->field('id')->where('area_id='.I('get.url_area_id').' AND name="'.I('post.searchValue').'"')->find();
			if($houseInfo){echo json_encode(array('success'=>true,'id'=>$houseInfo['id'],'zone'=>true));die;//3.小区存在--跳转小区页面--结束
			}else{
				$userInfo = $this->u->field('id')->where('area_id='.I('get.url_area_id').' AND company_name="'.I('post.searchValue').'"')->find();
				if($userInfo){echo json_encode(array('success'=>true,'id'=>$userInfo['id'],'user'=>true));die;}//4.用户存在--跳转用户页面--结束
			    echo json_encode(array('success'=>false,'err'=>'没找到相关信息')); 
			}
		//var_dump($_POST);
		}
	}
}