@include('admin.public.header')
<style>
	
	.icon_tier{
		background: #fff;
		position: absolute;
		width: 600px;
		padding: 0px;
		top: 0px;
		border: 1px solid #e2e2e2;
		margin-bottom: 30px;
		display: none;
	}
	.icon_tier ul li:hover{
		background: #f2f2f2;
		cursor:pointer;
	}

	.icon_tier ul li:hover{
		background: #f2f2f2;
		cursor:pointer;
	}
</style>
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
			<label for="username" class="layui-form-label">
			  <span class="x-red">*</span>图标
			  </label>
			<div class="layui-input-inline">
				<input type="text" id="username" name="username" readonly="readonly" class="layui-input">
				
			</div>
			<input type="button" class="button layui-btn" id="get_icon" value="图标选择">
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


<div class="x-body icon_tier">
	<div calss="guanbi" style="border-bottom: 1px solid #e2e2e2;height: 30px;line-height: 30px;">
		<span style="margin-left: 10px;">图标选择</span><i class="layui-icon" style="float: right;margin-right: 10px;font-size: 20px;">&#x1006;</i>
	</div>
	<ul style="overflow-y: auto;height: 400px;margin-left: 5px;">
		@foreach($icon as $val)
		<li style="border:1px solid #e2e2e2;width:90px;height:82px;vertical-align:middle;text-align:center;padding: 8px 0;display:inline-block;">
			<i class="layui-icon" style="font-size:30px;color:#c2c2c2;">{{$val['icon']}}</i> 
			<div class="doc-icon-name" style="color:#c2c2c2;">{{$val['title']}}</div>
			<div class="doc-icon-code" style="color:#c2c2c2;">&amp;{{substr($val['icon'],1)}}</div>
		</li>
		@endforeach
	</ul>
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

	$('#get_icon').click(function(){
		$('.icon_tier').show();
	})
</script>

