<?php if (!defined('THINK_PATH')) exit();?>


<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>UMEDITOR 完整demo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link href="/Public/js/editor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
	 <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
						<script type="text/javascript" src="/Public/js/editor/third-party/jquery.min.js"></script>
						<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.config.js"></script>
						<script type="text/javascript" charset="utf-8" src="/Public/js/editor/umeditor.min.js"></script>
						<script type="text/javascript" src="/Public/js/editor/lang/zh-cn/zh-cn.js"></script>
    
</head>
<body>
<h1>UMEDITOR 完整demo</h1>

<!--style给定宽度可以影响编辑器的最终宽度-->
<script type="text/plain" id="myEditor" style="width:1000px;height:240px;">
    <p>这里我可以写一些输入提示</p>
</script>



<script type="text/javascript">
    //实例化编辑器
    var um = UM.getEditor('myEditor');
    
</script>

</body>
</html>