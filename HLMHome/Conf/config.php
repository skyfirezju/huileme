<?php
return array(
	//'配置项'=>'配置值'
	'URL_MODEL' => 2,                    //URL重写模式
	'URL_CASE_INSENSITIVE' => true,	     //大小写不敏感
	//'SHOW_PAGE_TRACE' =>true,            // 显示页面Trace信息
	'URL_ROUTER_ON' => true, 			 //开启路由

	//路由规则
	'URL_ROUTE_RULES' => array(
		'login' => 'Account/login',
		'logout' => 'Account/logout',
		'register' => 'Account/register',
		'account/active_password$' => 'Account/activePassword',
		'account/change_password/:id\d/:code$' => 'Account/changePassword',
		'account/save_password$' => 'Account/savePassword',
		'account/re_send$' => 'Account/reSendActiveEmail',
		'account/start_change$' => 'Account/startChangePassword',
		'account/change_session$' => 'Account/changePasswordSession',
		'account/start_active$' => 'Account/startActiveUser',
		'account/check_login$' => 'Account/checkLogin',
		'account/check_invite$' => 'Account/checkInvite',
		'account/check_verify$' => 'Account/checkVerify',
		'account/check_register$' => 'Account/checkRegister',
		'account/active_user/:id\d/:code$' => 'Account/activeUser',
		'account/verify_code$' => 'Account/verifyCode',
		'notice/check_message$' => 'Notice/noticeNew',
		'coach/course$' => 'Coach/SearchByCourse',
		'coach/topic$' => 'Coach/SearchByTopic',
	),

	'TMPL_EXCEPTION_FILE' => '404.html',

	//新的路径替换
	'TMPL_PARSE_STRING' =>array(
		'__EDITOR__' => '/huileme/Public/kindeditor',
		'__IMAGE__' => '/huileme/Public/images', // 增加新癿JS 类库路徂替换觃则
		'__JS__' => '/huileme/Public/javascripts', // 增加新癿JS 类库路徂替换觃则
		'__CSS__' => '/huileme/Public/stylesheets', // 增加新癿JS 类库路徂替换觃则
		'__UPLOAD__' => '/huileme/Uploads', // 增加新癿上传路徂替换觃则
		'__BOOTSTRAP__' => '/huileme/Public/dist',
	),

	// 添加数据库配置信息
	'DB_TYPE' => 'mysql',      			   //数据库类型
	'DB_HOST' => 'localhost',			   //服务器地址
	'DB_NAME' => 'hlm',                     //数据库名
	'DB_USER' => 'root',                    //用户名
	'DB_PWD'  => '',                 //密码
	'DB_PORT' => 3306,					   //端口
	'DB_PREFIX' => 'hlm_',                    //数据库表前缀

	//DBSN方式：数据库类型://用户名:密码@数据库地址:数据库端口/数据库名
	//'DB_DSN' => 'mysql://root@localhost:3306/thinkphp'

	//缓存
	'HTML_CACHE_ON' => true, //开启静态缓存

	//自动加载类库
	'APP_AUTOLOAD_PATH'=>'@.TagLib,@.ORG',

	'SESSION_AUTO_START' => true,				//会话自启动
	'USER_AUTH_ON' => true,				//自动验证
	'USER_AUTH_TYPE' => 1,				// 默认认证类型 1 登录认证 2 实时认证
	'USER_AUTH_KEY' => 'authId',			// 用户认证SESSION标记
	'USER_AUTH_MODEL' => 'User',			// 默认验证数据表模型

    //邮件发送配置
    'THINK_EMAIL' => array(
	    'SMTP_HOST'   => 'smtp.163.com', 				//SMTP服务器
	    'SMTP_PORT'   => '25', 						//SMTP服务器端口
	    'SMTP_USER'   => 'huileme@163.com', 		//SMTP服务器用户名
	    'SMTP_PASS'   => 'huileme2014', 					//SMTP服务器密码
	    'FROM_EMAIL'  => 'huileme@163.com', 		//发件人EMAIL
	    'FROM_NAME'   => '会了么', 					//发件人名称
	    'REPLY_EMAIL' => '', 							//回复EMAIL（留空则为发件人EMAIL）
	    'REPLY_NAME'  => '', 							//回复名称（留空则为发件人名称）
	),
);
?>