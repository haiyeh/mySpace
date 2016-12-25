/*
* 组件加载
*/

layui.use(['jquery', 'form', 'upload', 'layer', 'laypage', 'laydate', 'layedit', 'element'], function(){
	var $ = layui.jquery
	,form = layui.form() //获取form组件
	,upload = layui.upload //获取upload组件
	,layer = layui.layer //获得layer组件
  	,laypage = layui.laypage //获得laypage组件
 	,laydate = layui.laydate //获得laydate组件
 	,layedit = layui.layedit
 	,element = layui.element();

 	//实例化layui编辑器

	var diary = layedit.build('diary', {
		height: 350,
		uploadImage: {
			url: '',
			type: 'post'
		}
	});

	var say = layedit.build('say', {
		height: 150,
		tool: ['face', 'strong', 'italic', 'underline', 'left', 'center', 'right']
	});

	//监听提交按钮  ajax
	form.on('submit(addSay)', function(data){
		var content = layedit.getContent(say);
		var token = data.field._token;
		var url = data.field.hidden;
			$.ajax({
				url:url,
				type:'post',
				data:{'_token':token,'content':content},
				success: function(res){
					if (res == 1) {
						layui.use('layer', function(){
							var layer = layui.layer;
							layer.confirm('说说发表成功', {
							    btn: ['继续发表','返回首页'] //按钮
							}, function(){
								location.reload();
							}, function(){
								history.back(-1);
							});
						})
					}else if(res == 2){
						layui.use('layer', function(){
							var layer = layui.layer;
							layer.msg('内容不能为空',{time:2000});
						})
					}else{
						layui.use('layer', function(){
							var layer = layui.layer;
							layer.msg('发表失败',{time:2000});
						})
					}
				},
			}, JSON);
			return false;
		});

	form.on('submit(addDiary)', function(data){
		var content = layedit.getContent(diary);
		var title = data.field.title;
		var publi = data.field.published_at;
		var token = data.field._token;
		var url = data.field.hidden;
			$.ajax({
				url:url,
				type:'post',
				data:{'_token':token,'title':title,'content':content,'published_at':publi},
				success: function(res){
					if (res == 1) {
						layui.use('layer', function(){
							var layer = layui.layer;
							layer.confirm('日志发表成功', {
							    btn: ['继续发表','返回首页'] //按钮
							}, function(){
								location.reload();
							}, function(){
								history.back(-1);
							});
						})
					}else{
						layui.use('layer', function(){
							var layer = layui.layer;
							layer.msg('发表失败');
						})
					}
				},
			}, JSON);
			return false;
		});

	
	//表单验证信息定义
	form.verify({
  		username: function(value){
    	if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
      		return '用户名不能有特殊字符';
    	}
    	if(/(^\_)|(\__)|(\_+$)/.test(value)){
      		return '用户名首尾不能出现下划线\'_\'';
    	}
    	if(/^\d+\d+\d$/.test(value)){
      		return '用户名不能全为数字';
    	}
  	}
	  	//我们既支持上述函数式的方式，也支持下述数组的形式
	  	//数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
	  	,password: [
	    	/^[\S]{6,12}$/
	    	,'密码必须6到12位，且不能出现空格'
	  	] 
	});      


	//实例化一个上传控件
	layui.upload({
  	url: '上传接口url'
  	,success: function(res){
    	console.log(res); //上传成功返回值，必须为json格式
  		}
	});

});



