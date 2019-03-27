@include('admin.public.header')
<div class="x-body">
	<form class="layui-form">
	  <div class="layui-form-item">
		  <label for="username" class="layui-form-label">
			  <span class="x-red">*</span>名称
		  </label>
		  <div class="layui-input-inline">
			  <input type="text" id="username" name="username" required="" lay-verify="required"
			  autocomplete="off" class="layui-input">
		  </div>
	  </div>
	  <div class="layui-form-item">
		  <label for="username" class="layui-form-label">
			  <span class="x-red">*</span>节点链接
		  </label>
		  <div class="layui-input-inline">
			  <input type="text" id="username" name="username" required="" lay-verify="required"
			  autocomplete="off" class="layui-input">
		  </div>
	  </div>
	  <div class="layui-form-item">
		  <label for="username" class="layui-form-label">
			  <span class="x-red">*</span>规则
		  </label>
		  <div class="layui-input-inline">
			  <input type="text" id="username" name="username" required="" lay-verify="required"
			  autocomplete="off" class="layui-input">
		  </div>
	  </div>
	  <div class="layui-form-item">
		  <label for="L_email" class="layui-form-label">
			  <span class="x-red">*</span>邮箱
		  </label>
		  <div class="layui-input-inline">
			  <input type="text" id="L_email" name="email" required="" lay-verify="email"
			  autocomplete="off" class="layui-input">
		  </div>
		  <div class="layui-form-mid layui-word-aux">
			  <span class="x-red">*</span>
		  </div>
	  </div>
	  <div class="layui-form-item">
		  <label for="L_pass" class="layui-form-label">
			  <span class="x-red">*</span>密码
		  </label>
		  <div class="layui-input-inline">
			  <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
			  autocomplete="off" class="layui-input">
		  </div>
		  <div class="layui-form-mid layui-word-aux">
			  6到16个字符
		  </div>
	  </div>
	  <div class="layui-form-item">
		  <label for="L_repass" class="layui-form-label">
			  <span class="x-red">*</span>确认密码
		  </label>
		  <div class="layui-input-inline">
			  <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
			  autocomplete="off" class="layui-input">
		  </div>
	  </div>
	  <div class="layui-form-item">
		  <label for="L_repass" class="layui-form-label">
		  </label>
		  <button  class="layui-btn" lay-filter="add" lay-submit="">
			  增加
		  </button>
	  </div>
  </form>
</div>
<script>
	layui.use(['form','layer'], function(){
		$ = layui.jquery;
	  var form = layui.form
	  ,layer = layui.layer;
	
	  //自定义验证规则
	  form.verify({
		nikename: function(value){
		  if(value.length < 5){
			return '昵称至少得5个字符啊';
		  }
		}
		,pass: [/(.+){6,12}$/, '密码必须6到12位']
		,repass: function(value){
			if($('#L_pass').val()!=$('#L_repass').val()){
				return '两次密码不一致';
			}
		}
	  });

	  //监听提交
	  form.on('submit(add)', function(data){
		data=data.field;
		group = $("input:checkbox[name='group']:checked").map(function(index,elem) {
			return $(elem).val();
		}).get().join(',');
		console.log(group);
		//发异步，把数据提交给php
		$.post("/admin/admin/add",{data:data,group:group,"_token":'{{csrf_token()}}'},function(data){
			if(data==1){
				layer.alert("增加成功", {icon: 6},function () {
					// 获得frame索引
					var index = parent.layer.getFrameIndex(window.name);
					// 关闭当前frame
					parent.layer.close(index);
					parent.location.reload();
				});
			}
		});
		return false;
	  });
	  
	  
	});
</script>
