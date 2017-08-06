<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
		body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
		#allmap{width:100%;height:100%;}
		p{margin-left:5px; font-size:14px;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=nlmv0V9pCDtmCuMIr6gDzWAn"></script>
</head>	
<body>
		
		<div id="allmap"></div>

		
</body>
</html>

<script type="text/javascript">
	// 百度地图API功能
	var mp = new BMap.Map("allmap", {enableMapClick:false}); //构造底图时，关闭底图可点功能
	mp.centerAndZoom(new BMap.Point(114.854, 38.028), 15);
	mp.enableScrollWheelZoom();
	//设置版权控件
	var cr = new BMap.CopyrightControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT});   
	mp.addControl(cr); //添加版权控件
	var bs = mp.getBounds();   //返回地图可视区域
	cr.addCopyright({id: 1, content: "<a href='#' style='font-size:20px;background:green;'>xx房产网</a>", bounds: bs});
//添加控件和比例尺
	var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
	var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件

	mp.addControl(top_left_control);        
	mp.addControl(top_left_navigation);     

	// 复杂的自定义覆盖物
    function ComplexCustomOverlay(point, text, mouseoverText){
      this._point = point;
      this._text = text;
      this._overText = mouseoverText;
    }
    ComplexCustomOverlay.prototype = new BMap.Overlay();
    ComplexCustomOverlay.prototype.initialize = function(map){
      this._map = map;
      var div = this._div = document.createElement("div");
      div.style.position = "absolute";
      div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);
      div.style.backgroundColor = "#EE5D5B";
      div.style.border = "1px solid #BC3B3A";
      div.style.color = "white";
      div.style.height = "18px";
      div.style.padding = "2px";
      div.style.lineHeight = "18px";
      div.style.whiteSpace = "nowrap";
      div.style.MozUserSelect = "none";
      div.style.fontSize = "18px"
      var span = this._span = document.createElement("span");
      div.appendChild(span);
      span.appendChild(document.createTextNode(this._text));      
      var that = this;

      var arrow = this._arrow = document.createElement("div");
	  arrow.style.background = "url(http://map.baidu.com/fwmap/upload/r/map/fwmap/static/house/images/label.png) no-repeat";
      arrow.style.position = "absolute";
      arrow.style.width = "11px";
      arrow.style.height = "10px";
      arrow.style.top = "22px";
      arrow.style.left = "10px";
      arrow.style.overflow = "hidden";
      div.appendChild(arrow);

      div.onmouseover = function(){
        this.style.backgroundColor = "#7BB44F";
        this.style.borderColor = "grey";
        this.getElementsByTagName("span")[0].innerHTML = that._overText;
        arrow.style.backgroundPosition = "0px -20px";
      }

      div.onmouseout = function(){
        this.style.backgroundColor = "#DA5E43";
        this.style.borderColor = "#BC3B3A";
        this.getElementsByTagName("span")[0].innerHTML = that._text;
        arrow.style.backgroundPosition = "0px 0px";
      }
      mp.getPanes().labelPane.appendChild(div);
      return div;
    }
    ComplexCustomOverlay.prototype.draw = function(){
      var map = this._map;
      var pixel = map.pointToOverlayPixel(this._point);
      this._div.style.left = pixel.x - parseInt(this._arrow.style.left) + "px";
      this._div.style.top  = pixel.y - 30 + "px";
    }
	//构造点击时间
	ComplexCustomOverlay.prototype.addEventListener = function(event,fun){ this._div['on'+event] = fun;}
	
	<?php if(is_array($houseMap)): foreach($houseMap as $key=>$zone): if(!empty($zone["baidu_coordinate"])): ?>var txt = <?php echo ($zone["housesum"]); ?>+"套", mouseoverTxt = txt + " " + "<?php echo ($zone["name"]); ?>(点击查看)" ;
				var myCompOverlay = new ComplexCustomOverlay(new BMap.Point(<?php echo ($zone["baidu_coordinate"]); ?>), <?php echo ($zone["housesum"]); ?>+"套",mouseoverTxt);
				mp.addOverlay(myCompOverlay);
				myCompOverlay.addEventListener('click',function(){ alert('<?php echo ($zone["id"]); ?>');});<?php endif; endforeach; endif; ?>
	
</script>