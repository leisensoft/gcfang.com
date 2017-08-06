<?php
return array(
	//'配置项'=>'配置值'
'DB_TYPE'               =>  'mysql',    // 数据库类型
'DB_HOST'               =>  'mysql.sql128.cdncenter.net',// 服务器地址
'DB_NAME'               =>  'sq_leisensoft', // 数据库名
'DB_USER'               =>  'sq_leisensoft',     // 用户名
'DB_PWD'                =>  'ljlGOOD888',         // 密码
'DB_PORT'               =>  '3306',     // 端口
'DB_PREFIX'             =>  'lei1_',     // 数据库表前缀
'DB_CHARSET'		    => 'utf8', 		// 字符集
'APP_DEBUG'    		    =>  true,		// 开启调试模式

'URL_PARAMS_BIND'       =>  true, // URL变量绑定到操作方法作为参数
'URL_DENY_SUFFIX' => 'pdf|ico|png|gif|jpg', // URL禁止访问的后缀设置


'APP_SUB_DOMAIN_DEPLOY'   =>    1, // 开启子域名配置
'APP_SUB_DOMAIN_RULES'    =>    array(   
    'lianzhou.c'        => array('Home','url_area_id=1'),  //藁城
	'luancheng.c'       => array('Home','url_area_id=2'),  //栾城
	'xinji.c'       => array('Home','url_area_id=3'),  //辛集
	'jinzhou.c'       => array('Home','url_area_id=4'),  //晋州
),

'URL_ROUTER_ON'   => true, //开启路由
'URL_ROUTE_RULES' => array( //定义路由规则 
    'a/:id\d'    => 'index/showUser',
),


);