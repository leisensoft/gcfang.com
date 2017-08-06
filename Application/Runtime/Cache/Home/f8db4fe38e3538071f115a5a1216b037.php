<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>网站地图-simply的BLOG</title>
<meta http-equiv="Content-type" content="text/html;" charset="UTF-8" />
<style type="text/css">
<!-- 
 .STYLE1 {
 font-size: 12px;
 color: #333333;
 }
 -->
 </style>
</head>
 <body>
 <table align="center">
 <tr  align="center">
 <td align="center">
 <table width="766" border="0" >
 <tr align="left">
 <td class="STYLE1" ><span >网站地图</span></td>
 </tr>
<?php if(is_array($result)): foreach($result as $k=>$v): ?><tr align="left"> <td width="760" class="STYLE1"><?php echo ($k); ?>.&nbsp;<a href="<?php echo ($v["0"]); ?>"><?php echo ($v["1"]); ?></a></td></tr><?php endforeach; endif; ?>	
 </table> </td> </tr> </table>

 </body> </html>