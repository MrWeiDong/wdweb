	@include('admin.public.header')
	@include('admin.public.nav')
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so layui-form-pane">
          <input class="layui-input" placeholder="权限名"  name="title">
		  <input class="layui-input" placeholder="url路由" name="mca">
		  <input type="hidden" name="pid" value="0">
          <button  class="layui-btn" lay-filter="add" lay-submit="">
               增加
          </button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll(4)"><i class="layui-icon"></i>批量删除</button>
		<a class="layui-btn" onclick="x_admin_show('添加','/admin/meun/add',600,400)" ><i class="layui-icon"></i>顶级菜单</a>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table layui-form">
        <thead>
          <tr>
            <th width="20">
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th width="70">ID</th>
            <th>栏目名</th>
            <th width="400">mca</th>
            <th width="320">操作</th>
        </thead>
        <tbody>
		@foreach($data as $val)
		  <tr>
            <td>
              <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='{{$val['id']}}'><i class="layui-icon">&#xe605;</i></div>
            </td>
            <td>{{$val['id']}}</td>
            <td>
			<?php echo str_repeat('|————',$val['_level']-1); ?>
			{{$val['title']}}
            </td>
            <td>
			{{$val['mca']}}
            </td>
            <td class="td-manage">
              <button class="layui-btn layui-btn layui-btn-xs"  onclick="x_admin_show('修改','/admin/admin/rule/edit/{{$val['id']}}',600,400)" ><i class="layui-icon">&#xe642;</i>修改</button>
              <button class="layui-btn layui-btn-warm layui-btn-xs"  onclick="x_admin_show('添加子权限','/admin/admin/rule/add/{{$val['id']}}',600,400)" ><i class="layui-icon">&#xe642;</i>添加子权限</button>
              <button class="layui-btn-danger layui-btn layui-btn-xs"  onclick="member_del(this,4,'{{$val['id']}}')" href="javascript:;" ><i class="layui-icon">&#xe640;</i>删除</button>
            </td>
          </tr>
		@endforeach
        </tbody>
      </table>
    </div>
    <script>
      layui.use(['form'], function(){
        $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
		  //监听提交
          form.on('submit(add)', function(data){
            data=data.field;
			console.log(data);
			$.post("/admin/admin/rule",{data:data,"_token":'{{csrf_token()}}'},function(data){
				if(data==1){
					location.reload();
				}
			});
			return false;
          });
      });
    </script>
