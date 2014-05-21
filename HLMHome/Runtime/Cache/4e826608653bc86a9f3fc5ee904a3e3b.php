<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title> 编辑</title>
</head>
<body>
	  <FORM method="post" action="__URL__/update">
	    标题：<INPUT type="text" name="title" value="<?php echo ($vo["title"]); ?>"><br/>
	    内容：<TEXTAREA name="content" rows="5" cols="45"><?php echo ($vo["content"]); ?></TEXTAREA><br/>
	    <INPUT type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
	    <INPUT type="submit" value="提交">
	  </FORM>
	  
</body>
</html>