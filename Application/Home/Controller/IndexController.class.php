<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	function _initialize(){  //■■■■■■■■■■■■■■■■■■■■■■构造函数 初始化 user site表 获取分站信息&个人信息
		$this->u = M("user");
		$this->s = M("site");
		$this->h = M("house");
		$this->z = M("zone");
		$this->a = M("article");
		$this->m = M("manager");
		$site_info = $this->s->where('area_id='.I('get.url_area_id'))->find();
		$this->assign('site_info',$site_info);
		$user_cookie_info = $this->checkUserCookie();
		$this->assign('user_info',$user_cookie_info);
	}
	public function _empty($name){
		echo $name;die;
        $this->_noContraller($name);
    }
	protected function _noContraller($name){
       $this->error('不存在的页面','/Index',3);
    }

	public function editor(){
		$this->display();
	}
	public function houseList(){
		$this->display();
	}
    public function index(){	
//是否是手机  首页只放一个判断
	if (ismobile()&&empty($_GET['mobile'])) {
		$this->success('跳转手机站', 'Mobile',0);
		die;
	}
//处理置顶数据
		$where['lei1_house.house_state'] = 1;
		$where['top_to_time'] = array(array('gt',time()));
	    $allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name')->where($where)->order('lei1_house.id desc')->select();
		foreach($allHouse as $house){
				$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
				$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
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
//如果小于12条 加入最新的
/*
		if(count($sellHouseShow)<18){
			foreach($sellHouse as $house){
				if(time()>$house['top_to_time']){
					$house['top_to_time'] = 0;//去掉置顶
					$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
					$house['price'] = $house['price']?$house['price'].'万':'面议'; //处理价格格式
					$house['hurry_to_time'] = time()<$house['hurry_to_time']?2:0;//判断加急
					//$house['title'] = sub_str($house['title'], 25); //修改标题长度
					$sellHouseShow[] = $house;
					if(18==count($sellHouseShow)){break;}
				}
			}
		}
*/
		$this->display();	
   }
//■■■■■■■■■■■■■■■■■■■■■■游客发布房源
  public function personAddHouse(){
	  $this->display();
  }
   
//■■■■■■■■■■■■■■■■■■■■■■用户个人首页  
   public function showUser(){
	   $_GET['id'] = trim($_GET['id']);//去掉前后空格
	   $user_info = $this->u->where('id='.I('get.id'))->find();
	    if(empty($user_info)){ $this->error('不存在的中介商','/Index',3);die;}	  
	   $area_name = $this->s->field('web_name')->where('area_id='.$user_info['area_id'])->find();

	   $this->assign('web_name',$area_name['web_name']);
	   $this->assign('user_info',$user_info);
//获取房源信息列表-置顶信息
		$where['house_state'] = 1;
		$where['user_id'] = I('get.id'); //用户ID
		$count = $this->h->where($where)->count();// 查询满足要求的总记录数
		$Page  = new \Think\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(20)
		$show  = $Page->show();// 分页显示输出
	    $allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name')->where($where)->order('lei1_house.id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($allHouse as $house){
				$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
				$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
				$house['hurry_to_time'] = time()<$house['hurry_to_time']?2:0;//判断加急	
				if(time()<$house['top_to_time']){
					$top_houses[] = $house;
				}else{
					$houses[] = $house;
				}
		}
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('houses',$houses); 
		$this->assign('top_houses',$top_houses); 
	    $this->display();
   }
   
   public function about(){
	   if($_GET['id']){
		   $article_info = $this->a->where('id='.I('get.id'))->find();
		   $this->assign('article',$article_info);
	   }
	   $this->display();
   }
    public function news(){
	   $_GET['id'] = trim($_GET['id']);//去掉前后空格
	   $article_info = $this->a->where('id='.I('get.id'))->find();
	   if(empty($article_info)){ $this->error('不存在的文章','/Index',3);die;}	  
	   //$area_name = $this->s->field('area_name')->where('area_id='.$user_info['area_id'])->find();
	   //var_dump($article_info);
	   $this->assign('article',$article_info);
	   $this->a->where('id='.I('get.id'))->setInc('view_times',1);
	   $this->display();
   }
    public function publish(){
	   $this->display();
   }
   
   
//地图看房 
    public function mapHouse(){
	   //需要 area_id    扩展 user_id
	   $where['lei1_zone.area_id'] = I('get.url_area_id');
		if($_GET['uid']){
			$where['user_id'] = I('get.uid');
		}
	   //$where['user_id'] = 
	   //$where['house_type'] =  		   
	   $where['lei1_house.house_state'] = 1;  	//正常发布
	   $where['lei1_house.sell_type'] = $_POST['sell_type']?I('post.sell_type'):1; 	  //1.出售 2.出租
	   $where['lei1_house.house_type'] = $_POST['house_type']?I('post.house_type'):1; //1.二手房 2.门市厂房 3.车库车位	   
//需要执行6次sql 统计房源...
	   $sellHouse = $this->z->field('lei1_zone.id,lei1_zone.name,lei1_zone.baidu_coordinate,count(lei1_house.id) AS housesum')->where($where)->group('lei1_zone.name')->join('lei1_house ON lei1_zone.id=lei1_house.zone_id')->select();
	   $where['lei1_house.house_type'] = 2;
	   $sellShop = $this->z->field('lei1_zone.id,lei1_zone.name,lei1_zone.baidu_coordinate,count(lei1_house.id) AS housesum')->where($where)->group('lei1_zone.name')->join('lei1_house ON lei1_zone.id=lei1_house.zone_id')->select();
	   $where['lei1_house.house_type'] = 3;
	   $sellGarage = $this->z->field('lei1_zone.id,lei1_zone.name,lei1_zone.baidu_coordinate,count(lei1_house.id) AS housesum')->where($where)->group('lei1_zone.name')->join('lei1_house ON lei1_zone.id=lei1_house.zone_id')->select();
	   $where['lei1_house.sell_type'] = 2; 
	   $rentGarage = $this->z->field('lei1_zone.id,lei1_zone.name,lei1_zone.baidu_coordinate,count(lei1_house.id) AS housesum')->where($where)->group('lei1_zone.name')->join('lei1_house ON lei1_zone.id=lei1_house.zone_id')->select();
	   $where['lei1_house.house_type'] = 2;
	   $rentShop = $this->z->field('lei1_zone.id,lei1_zone.name,lei1_zone.baidu_coordinate,count(lei1_house.id) AS housesum')->where($where)->group('lei1_zone.name')->join('lei1_house ON lei1_zone.id=lei1_house.zone_id')->select();
	   $where['lei1_house.house_type'] = 1;
	   $rentHouse = $this->z->field('lei1_zone.id,lei1_zone.name,lei1_zone.baidu_coordinate,count(lei1_house.id) AS housesum')->where($where)->group('lei1_zone.name')->join('lei1_house ON lei1_zone.id=lei1_house.zone_id')->select();
	   //var_dump($houseMap);die; //,lei1_house.sell_type,lei1_house.house_type
	   
	    $this->assign('rentHouse',$rentHouse);
	    $this->assign('rentShop',$rentShop);
		$this->assign('rentGarage',$rentGarage);
		$this->assign('sellHouse',$sellHouse);
		$this->assign('sellShop',$sellShop);
		$this->assign('sellGarage',$sellGarage);
	   $this->display();
   }
   
   public function register(){//■■■■■■■■■■■■■■■■■■■■■■登陆界面
	   $user_cookie_info = cookie();
	   if($user_cookie_info['lei666_tel']){
		   $this->assign('user_cookie_tel',$user_cookie_info['lei666_tel']);
	   }
	   $this->display();
   }
   public function submitRegister(){ //■■■■■■■■■■■■■■■■■■■■■■注册提交 ajax处理
	   $verify = check_verify_code(I('post.valid_code'),I('post.valid_id'));//检验验证码
	   $_POST['tel'] = trim($_POST['tel']);
	   if($verify){//验证码判断
		   //手机号判断
		   if(is_numeric($_POST['tel'])){
				if(11!=strlen($_POST['tel'])){echo json_encode(array('success'=>false,'errorMsg'=>'请输入11位数字的手机号'));die;}
				$user_info = $this->u->where('tel='.I('post.tel'))->find();
			    if($user_info){//检测用户是否存在
				  echo json_encode(array('success'=>false,'errorMsg'=>'用户 ['.I('post.tel').'] 已经注册为 ['.$user_info['company_name'].'],有问题请联系客服人员.'));
				  die;
				}
		   }else{
			   echo json_encode(array('success'=>false,'errorMsg'=>'请输入11位数字的手机号'));die;
		   }
		   //密码长度

		   //$_POST['password'] = md5(I('post.password').'lei666'); //密码md5 
		   $_POST['area_id'] = I('get.url_area_id');			  //获取area_id
		   $_POST['ip'] = get_client_ip();						  //获取IP信息
		   $this->u->create($_POST);
		   $user_id = $this->u->add();
		   if($user_id){//插入数据判断
			   cookie('lei666_id',$user_id,3600000);  			  //插入成功后存cookie
			   cookie('lei666_tel',I('post.tel'),3600000); 
			   $pass =  md5(I('post.password').'lei666');  //md5加密 密码 
			   cookie('lei666_pass',$pass); 
			   echo json_encode(array('success'=>true,'sb'=>$user_id.'恭喜您注册成功!'));
		   }else{//插入数据失败
			   echo json_encode(array('success'=>false,'errorMsg'=>'数据库错误,请联系管理员'));
		   }  
	   }else{//验证码错误
		   echo json_encode(array('success'=>false,'errorMsg'=>'验证码错误'));
	   }
   }
    public function submitLogin(){ //■■■■■■■■■■■■■■■■■■■■■■登陆提交 ajax处理
		if($this->u->where('tel='.I('post.u_tel'))->find()){//检测用户是否存在
			$condition['tel'] = I('post.u_tel');
			$condition['password'] = I('post.u_pass');
			$condition['_logic'] = 'AND';
			if($user_info = $this->u->where($condition)->find()){
				cookie('lei666_id',$user_info['id'],3600000);  			  //插入成功后存cookie
			    cookie('lei666_tel',I('post.u_tel'),3600000); 
				$pass = md5(I('post.u_pass').'lei666');
			    cookie('lei666_pass',$pass); 
				echo json_encode(array('success'=>true)); 
			}else{
				echo json_encode(array('success'=>false,'errorMsg'=>'账户或密码错误,请重新登陆.','err_no'=>'2'));
			}	  
		}else{
		    echo json_encode(array('success'=>false,'errorMsg'=>'用户('.I('post.u_tel').')不存在','err_no'=>'1'));
		}
	}
   
    public function checkUserCookie(){ //■■■■■■■■■■■■■■■■■■■■■■检测用户登陆COOKIE
	   $user_cookie = cookie();
	   //var_dump($user_cookie);die;
	   if(NULL==$user_cookie['lei666_id']){
		  return false;
	   }
	   if($user_info = $this->u->where('area_id='.I('get.url_area_id').' AND id='.$user_cookie['lei666_id'])->find()){//检测用户id是否存在
			if(md5($user_info['password'].'lei666')==$user_cookie['lei666_pass'] and $user_info['tel']==$user_cookie['lei666_tel']){
				 return $user_info;
			}else{
				return false;
			}
	   }
	   else{
		   return false;
	   }
    }
	public function adminLogin(){ //■■■■■■■■■■■■■■■■■■■■■■管理员登陆
		$this->display();
	}
	 public function submitManagerLogin (){ //■■■■■■■■■■■■■■■■■■■■■■管理员登陆提交 ajax处理
		if($this->m->where('m_name="'.$_POST['m_name'].'"')->find()){//检测用户是否存在
			$condition['m_name'] = I('post.m_name');
			$condition['password'] = I('post.password');
			$condition['_logic'] = 'AND';
			if($user_info = $this->m->where($condition)->find()){
				cookie('lei666_manager_id',$user_info['id'],3600000);  			  //插入成功后存cookie
			    cookie('lei666_manager_name',I('post.m_name'),3600000); 
				$pass = md5(I('post.password').'lei666');
			    cookie('lei666_manager_pass',$pass); 
				echo json_encode(array('success'=>true)); 
			}else{
				echo json_encode(array('success'=>false,'errorMsg'=>'请勿恶意尝试登陆,后台会有记录日志','err_no'=>'2'));
			}	  
		}else{
		    echo json_encode(array('success'=>false,'errorMsg'=>'请勿恶意尝试登陆,后台会有记录日志','err_no'=>'1'));
		}
	}
   public function verify_code(){   //■■■■■■■■■■■■■■■■■■■■■■验证码函数
		$verify_code_config =    array(
		'fontSize'    =>    25,    // 验证码字体大小
		'length'      =>    4,     // 验证码位数
		'useNoise'    =>   true, // 验证码杂点
		'useCurve'	  =>   false, //横线
		'imageW'	  =>   200,
		'imageH'	  =>   60,
		); 
		$Verify =     new \Think\Verify($verify_code_config);
		$Verify->codeSet = '0123456789'; 
		isset($_GET['id'])?$Verify->entry(I('get.id')):$Verify->entry();
   }
	
	public function shortcut(){	//■■■■■■■■■■■■■■■■■■■■■■存到桌面
		$site_info = $this->s->where('area_id='.I('get.url_area_id'))->find();
	    $Shortcut = "[InternetShortcut]
		URL=".$site_info['area_url']."
		IDList=
		IconIndex=43
		IconFile=C:\Windows\system32\SHELL32.dll
		HotKey=1626
		[{000214A0-0000-0000-C000-000000000046}]
		Prop3=19,2";
		//var_dump($site_info);die;
		Header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$site_info['web_name'].".url;");
		echo $Shortcut;
    }
	//■■■■■■■■■■■■■■■■■■■■■■获取更多房源列表 bug 1.首页搜索框 只能搜索个人号码20条
	public function getMoreHouseList(){
		//var_dump($_GET);var_dump($_POST);die;
		//$sell_type=0,$house_type=0,$zone_id=0,$user_id=0
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
	
		if($_GET['indexSearchValue']){$where['lei1_house.personal_tel'] = I('get.indexSearchValue');} //首页搜索框-个人电话-多条结果-ajax 
		
		$page_size = 20; //每页显示条数
		$where['lei1_house.house_state'] = 1;
		$where['lei1_house.area_id'] = I('get.url_area_id');
		$page = I('post.liNo')/$page_size+1;//第一页开始
	    $allHouse = $this->h->field('id,user_id,title,size,price,house_type,sell_type,top_to_time,hurry_to_time,lei1_house.create_time,zone_name')->where($where)->limit(I('post.liNo'),$page_size)->order('lei1_house.id desc')->select();
		if(empty($allHouse)){die;}//无结果 返回
		$houseHtml .= "<div class='house_page'>第".$page."页</div>";
		
		if($_GET['indexSearchValue']){$houseHtml="<div id='content'><ul>";}//首页搜索框-个人电话-多条结果-ajax
		
		foreach($allHouse as $house){
				$house['create_time'] = countPastTime($house['create_time'],1); //处理时间格式
				$house['price'] = $house['price']?$house['price'].'':'面议'; //处理价格格式
				//html 
				$houseHtml .="<li class='info_li'>";
				$houseHtml .="<a target=_blank href='".$tihs->site_info['area_url']."/house/detail/id/$house[id].html'>";
				$houseHtml .= time()<$house['hurry_to_time']?"<span style='color:red;' class='info_tabs_title'>$house[title]<span class='lab lab_hurry'>急</span></span>":"<span class='info_tabs_title'>$house[title]</span>";//判断加急
				$houseHtml .= "<span class='info_tabs_zone'>$house[zone_name]</span> <span class='info_tabs_size'>$house[size]平</span> <span class='info_tabs_price'>$house[price]</span> <span class='info_tabs_date'>$house[create_time]</span>";
				$houseHtml .="</a>";
				$houseHtml .= "</li>";
		}
		if($_GET['indexSearchValue']){$houseHtml.="</ul></div>";}//首页搜索框-个人电话-多条结果-ajax
		echo $houseHtml;
		//dump($houseHtml);die;	
	}
	
	public function makeXML(){
			$content='<?xml version="1.0" encoding="UTF-8"?>
			<urlset
				xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
				xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
				xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
				http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
			';
			//1.房源信息
			$where_house['house_state'] = 1;
			$houses_info = $this->h->where($where_house)->order('id desc')->getField('id,create_time');
			foreach($houses_info as $k=>$v){
				$v = date("Y-m-d",strtotime($v)); 
				$data_array[] = array(
										'loc'=>'http://www.gcfang.cn/house/detail/id/'.$k.'.html',
										'lastmod'=>$v,
										'changefreq'=>'always',
										'priority'=>'0.7',
									 );
			}
			//2.新闻信息
			$where_article['state'] = 1;
			$articles_info = $this->a->where($where_article)->order('id desc')->getField('id,time');
			foreach($articles_info as $k=>$v){
				$v = date("Y-m-d",strtotime($v)); 
				$data_array[] = array(
										'loc'=>'http://www.gcfang.cn/index/news/id/'.$k.'.html',
										'lastmod'=>$v,
										'changefreq'=>'always',
										'priority'=>'0.7',
									 );
			}
			//3.小区
			//$where_zone['state'] = 1;
			$zones_info = $this->z->order('id desc')->getField('id,creat_time');
			foreach($zones_info as $k=>$v){
				$v = date("Y-m-d",strtotime($v)); 
				$data_array[] = array(
										'loc'=>'http://www.gcfang.cn/house/zoneDetail/id/'.$k.'.html',
										'lastmod'=>$v,
										'changefreq'=>'always',
										'priority'=>'0.7',
									 );
			}
			//4.固定页面
			/*$data_array[]=
				array(
					'loc'=>'http://www.phpernote.com/',
					'lastmod'=>'2012-06-03T04:20:32-08:00',
					'changefreq'=>'always',
					'priority'=>'1.0',
				);*/
			foreach($data_array as $data){
				$content.=$this->create_item($data);
			}
			$content.='</urlset>';
			$fp=fopen('sitemap.xml','w+');
			fwrite($fp,$content);
			fclose($fp);
	}
	public function create_item($data){
				$item="<url>\n";
				$item.="<loc>".$data['loc']."</loc>\n";
				$item.="<lastmod>".$data['lastmod']."</lastmod>\n";
				$item.="<changefreq>".$data['changefreq']."</changefreq>\n";
				$item.="<priority>".$data['priority']."</priority>\n";
				$item.="</url>\n";
				return $item;
	}
	public function sitemap(){
			$this->makeXML();
			//1.房源信息
			$where_house['house_state'] = 1;
			$houses_info = $this->h->where($where_house)->order('id desc')->getField('id,title');
			foreach($houses_info as $k=>$v){
				$result[] = array('http://www.gcfang.cn/house/detail/id/'.$k.'.html',$v);
			}
			//2.新闻信息
			$where_article['state'] = 1;
			$articles_info = $this->a->where($where_article)->order('id desc')->getField('id,title');
			foreach($articles_info as $k=>$v){
				$result[] = array('http://www.gcfang.cn/index/news/id/'.$k.'.html',$v);
			}
			//3.小区
			//$where_zone['state'] = 1;
			$zones_info = $this->z->order('id desc')->getField('id,name');
			foreach($zones_info as $k=>$v){
				$result[] = array('http://www.gcfang.cn/house/zoneDetail/id/'.$k.'.html',$v);
			}
			$this->assign('result',$result);
			$this->display();
	}

}