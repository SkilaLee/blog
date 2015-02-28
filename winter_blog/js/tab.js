window.onload=function()
 	{
 		var oDiv=document.getElementById('div1');
 		var aBtn=oDiv.getElementsByTagName('input');
 		var iDiv=document.getElementsByClassName('journal');
 		for(var i=0;i<aBtn.length;i++)
 		{
 			aBtn[i].index=i;
 			aBtn[i].onclick= function ()
 			{
 				for (var i = 0; i <aBtn.length; i++)
 				{
 					aBtn[i].className='';
 					iDiv[i].style.display='none';
 				}
 				//aDiv[i].style.display='block';
 				this.className='active';
 				iDiv[this.index].style.display='block';
 			};
 		}
 		var oDiv1=document.getElementById('div2');
 		var aBtn1=oDiv1.getElementsByTagName('input');
 		var iDiv1=document.getElementsByClassName('journ');
 		for(var i=0;i<aBtn1.length;i++)
 		{
 			aBtn1[i].index=i;
 			aBtn1[i].onclick= function ()
 			{
 				for (var i = 0; i <aBtn1.length; i++)
 				{
 					aBtn1[i].className='';
 					iDiv1[i].style.display='none';
 				}
 				//aDiv[i].style.display='block';
 				this.className='active';
 				iDiv1[this.index].style.display='block';
 			};
 		}


 		var left=document.getElementById('body_left');
 		var li=left.getElementsByTagName('li');
 		var right=document.getElementsByClassName('body_right');
 		for(var i=0;i<7;i++)
 		{
 			li[i].index=i;
 			li[i].onclick= function ()
 			{
 				for (var i = 0; i <7; i++)
 				{
 					li[i].className='';
 					right[i].style.display='none';
 				}
 				//aDiv[i].style.display='block';
 				this.className='active';
 				right[this.index].style.display='block';
 			};
 		}

	
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

 	var Index,
 		pinglun = document.getElementsByClassName("ping"),
 		Input = document.getElementsByClassName("discu");
 	//为每个被点击的对象绑定单击事件
 	for( var i = 0; i < pinglun.length; i++ ){
 		(function( i ){
 			pinglun[i].onclick = function(){
	 			//为被点击的时间点li添加active类
	 			Input[i].style.display = "block";

	 			//根据索引号变量的值，去除上一个li的active类
	 			Input[Index].style.display = "none";

	 			//将索引号变量值更新为被点击的li的索引号
	 			Index = i;
	 		};
 		})( i );
 	}
 	var index,
 		reply = document.getElementsByClassName("hui"),
 		InputRe = document.getElementsByClassName("reply_sub");
 	//为每个被点击的对象绑定单击事件
 	for( var i = 0; i < reply.length; i++ ){
 		(function( i ){
 			reply[i].onclick = function(){
	 			//为被点击的时间点li添加active类
	 			InputRe[i].style.display = "block";

	 			//根据索引号变量的值，去除上一个li的active类
	 			InputRe[index].style.display = "none";

	 			//将索引号变量值更新为被点击的li的索引号
	 			index = i;
	 		};
 		})( i );
 	}







 	};

