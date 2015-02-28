window.onload=function ()
	{
		var oDiv1=document.getElementById('zhuce');
		var main=document.getElementById('main');
		var regi=document.getElementById('regi');
		var logi=document.getElementById('login');
		var oDiv2=document.getElementById('denglu');
		oDiv1.onclick=function()
		{
			regi.style.display='block';
			main.style.display='none';
		}
		oDiv2.onclick=function()
		{
			logi.style.display='block';
			main.style.display='none';
		};


		var 
 		//记录当前已经添加active类的li的索引号
 		curIndex = 0,

 		//查找所有被点击的元素对象
 		timeLine = document.getElementById("timeline"),
 		clickArea = timeLine.getElementsByTagName("li"),

 		//查找所有li元素对象
 		timePoint = timeLine.getElementsByTagName("p");

 	//为每个被点击的对象绑定单击事件
 	for( var i = 0, len = clickArea.length; i < len; i++ ){
 		(function( i ){
 			clickArea[i].onclick = function(){
	 			//为被点击的时间点li添加active类
	 			timePoint[i].style.display = "block";

	 			//根据索引号变量的值，去除上一个li的active类
	 			timePoint[curIndex].style.display = "none";

	 			//将索引号变量值更新为被点击的li的索引号
	 			curIndex = i;
	 		};
 		})( i );
 	}
	}