var sel_apps = new Array();
var multi = 0;
var type = 1;
$(function(){
	$(".softgrid li").live('mouseover',function(){
		$(this).addClass('hover');
	});
	$(".softgrid li").live('mouseout',function(){
		$(this).removeClass('hover');
	});
	
	$("#view_listsp a").live('click',function(){
		
		$.get($(this).attr('href'),function(data){
			art.dialog.list['showgames'].content(data);
		});
		return false;
	});
});

var gameWin={
    open: function(cur_multi,cur_type,callbackFun){
		type = cur_type;
		if(!sel_apps[type])
			sel_apps[type] = new Array();
		
		multi=cur_multi;
        var arg_multi = multi || '0';
        if(typeof(callbackFun) == "function"){
            gameWin.callback = callbackFun;
        }else{
            gameWin.callback = null;
        }
		var title = type==2?'请选择标签':'选择关键字';
		var act = type==2?'get_tags':'get_keyword';
		art.dialog({
			id: 'showgames',
			title: title,
			content: '读取中...',
			width: 780,
			ok: function () {
				gameWin.confirmChooseApp();
				return false;
			},
			cancelVal: '关闭',
			cancel: true
		});
		
		$.get("/index.php?m=content&c=content&a="+act+"&pc_hash="+$_GET['pc_hash'], 
			function(data){
				art.dialog.list['showgames'].content(data);
				var curli_id = '';
				$(".softgrid li").each(function(){
					curli_id = $(this).attr('rel');
					if(sel_apps[type]['_'+curli_id]){
						$(this).addClass("on");
					}
				});
			}
		); 
    },
	allApp: function(o){
		if(document.getElementById("quanxuan").checked){
			
			$('.quanxuanla').each(function(){
				var o = $(this);
				var id = o.attr('valid');
				var name = o.attr('valname');
				var icon = '';
				sel_apps[type]['_'+id] = {id:id,icon:icon,name:name};
				//sel_apps[type]['_'+id] = id;
				if(o){
					$(o).parent().addClass('on');
				}
			})
			
		}else{
			$('.quanxuanla').each(function(){
				var o = $(this);
				var id = o.attr('valid');
				var name = o.attr('valname');
				var icon = '';
				delete sel_apps[type]['_'+id];
				if(o){
					$(o).parent().removeClass('on');
				}
			})
		}
	},
	search: function(form){
		$.get($(form).attr('action'),$(form).serializeArray(),function(data){
			art.dialog.list['showgames'].content(data);
		});
	},
	chooseApp: function(o,id,icon,name){
		var timestamp = Date.parse(new Date());  
		//$.get("/admin/keyword/set",{id:id,timestamp:timestamp},function(data){})
		if(sel_apps[type]['_'+id]){
			delete sel_apps[type]['_'+id];
			if(o){
				$(o).parent().removeClass('on');
			}
			
		}else{
			
			sel_apps[type]['_'+id] = {id:id,icon:icon,name:name};
			//sel_apps[type]['_'+id] = id;
			if(o){
				$(o).parent().addClass('on');
			}
		}
	},
	confirmChooseApp: function(){
		var result = new Array();
		var length = 0;
		for(var k in sel_apps[type]){
			if(!result[k]){
				result[k] = sel_apps[type][k];
				length++;
			}
		}
		
        if(!multi && length>1){
            alert('你只能选择一个游戏！');
            return false;
        }
		if(multi){
			if(gameWin.callback){
				gameWin.callback(result);
			}
			art.dialog.list['showgames'].close();
		}else{
			for(var k in result){
				if(gameWin.callback){
					gameWin.callback(result[k]);
				}
				art.dialog.list['showgames'].close();
				return;
			}
		}
	},
	callback: function(ret){}
} 

var lanmuWin={
    open: function(cur_multi,cur_type,callbackFun){
		type = cur_type;
		if(!sel_apps[type])
			sel_apps[type] = new Array();
		multi=cur_multi;
        var arg_multi = multi || '0';
        if(typeof(callbackFun) == "function"){
            lanmuWin.callback = callbackFun;
        }else{
            lanmuWin.callback = null;
        }
		
		art.dialog({
			id: 'showgames',
			title: '选择厂商',
			content: '读取中...',
			width: 780,
			ok: function () {
				lanmuWin.confirmChooseApp();
				return false;
			},
			cancelVal: '关闭',
			cancel: true
		});
		
		$.get("/index.php?m=content&c=appcsinfos&a=getlanmu&pc_hash="+$_GET['pc_hash'], 
			function(data){
				art.dialog.list['showgames'].content(data);
				var curli_id = '';
				$(".softgrid li").each(function(){
					curli_id = $(this).attr('rel');
					if(sel_apps[type]['_'+curli_id]){
						$(this).addClass("on");
					}
				});
			}
		); 
    },
	search: function(form){
		$.get($(form).attr('action'),$(form).serializeArray(),function(data){
			art.dialog.list['showgames'].content(data);
		});
	},
	chooseApp: function(o,id,icon,name){
		var timestamp = Date.parse(new Date());  
		//$.get("/admin/keyword/set",{id:id,timestamp:timestamp},function(data){})
		if(sel_apps[type]['_'+id]){
			delete sel_apps[type]['_'+id];
			if(o){
				$(o).parent().removeClass('on');
			}
			
		}else{
			sel_apps[type]['_'+id] = {id:id,icon:icon,name:name};
			//sel_apps[type]['_'+id] = id;
			if(o){
				$(o).parent().addClass('on');
			}
		}
	},
	confirmChooseApp: function(){
		var result = new Array();
		var length = 0;
		for(var k in sel_apps[type]){
			if(!result[k]){
				result[k] = sel_apps[type][k];
				length++;
			}
		}

        if(!multi && length>1){
            alert('你只能选择一个栏目！');
            return false;
        }
		if(multi){
			if(lanmuWin.callback){
				lanmuWin.callback(result);
			}
			art.dialog.list['showgames'].close();
		}else{
			for(var k in result){
				if(lanmuWin.callback){
					lanmuWin.callback(result[k]);
				}
				art.dialog.list['showgames'].close();
				return;
			}
		}
	},
	callback: function(ret){}
}; 

var downname={
    open: function(cur_multi,cur_type,callbackFun){
		type = cur_type;
		if(!sel_apps[type])
			sel_apps[type] = new Array();
		multi=cur_multi;
        var arg_multi = multi || '0';
        if(typeof(callbackFun) == "function"){
            lanmuWin.callback = callbackFun;
        }else{
            lanmuWin.callback = null;
        }
		
		art.dialog({
			id: 'showgames',
			title: '选择游戏名',
			content: '读取中...',
			width: 780,
			ok: function () {
				lanmuWin.confirmChooseApp();
				return false;
			},
			cancelVal: '关闭',
			cancel: true
		});
		
		$.get("/index.php?m=content&c=pinglun&a=get_downname&pc_hash="+$_GET['pc_hash'], 
			function(data){
				art.dialog.list['showgames'].content(data);
				var curli_id = '';
				$(".softgrid li").each(function(){
					curli_id = $(this).attr('rel');
					if(sel_apps[type]['_'+curli_id]){
						$(this).addClass("on");
					}
				});
			}
		); 
    },
	search: function(form){
		$.get($(form).attr('action'),$(form).serializeArray(),function(data){
			art.dialog.list['showgames'].content(data);
		});
	},
	chooseApp: function(o,id,icon,name){
		var timestamp = Date.parse(new Date());  
		//$.get("/admin/keyword/set",{id:id,timestamp:timestamp},function(data){})
		if(sel_apps[type]['_'+id]){
			delete sel_apps[type]['_'+id];
			if(o){
				$(o).parent().removeClass('on');
			}
			
		}else{
			sel_apps[type]['_'+id] = {id:id,icon:icon,name:name};
			//sel_apps[type]['_'+id] = id;
			if(o){
				$(o).parent().addClass('on');
			}
		}
	},
	confirmChooseApp: function(){
		var result = new Array();
		var length = 0;
		for(var k in sel_apps[type]){
			if(!result[k]){
				result[k] = sel_apps[type][k];
				length++;
			}
		}

        if(!multi && length>1){
            alert('你只能选择一个栏目！');
            return false;
        }
		if(multi){
			if(lanmuWin.callback){
				lanmuWin.callback(result);
			}
			art.dialog.list['showgames'].close();
		}else{
			for(var k in result){
				if(lanmuWin.callback){
					lanmuWin.callback(result[k]);
				}
				art.dialog.list['showgames'].close();
				return;
			}
		}
	},
	callback: function(ret){}
};

var username={
    open: function(cur_multi,cur_type,callbackFun){
		type = cur_type;
		if(!sel_apps[type])
			sel_apps[type] = new Array();
		multi=cur_multi;
        var arg_multi = multi || '0';
        if(typeof(callbackFun) == "function"){
            lanmuWin.callback = callbackFun;
        }else{
            lanmuWin.callback = null;
        }
		
		art.dialog({
			id: 'showgames',
			title: '选择用户名',
			content: '读取中...',
			width: 780,
			ok: function () {
				lanmuWin.confirmChooseApp();
				return false;
			},
			cancelVal: '关闭',
			cancel: true
		});
		
		$.get("/index.php?m=content&c=pinglun&a=get_username&pc_hash="+$_GET['pc_hash'], 
			function(data){
				art.dialog.list['showgames'].content(data);
				var curli_id = '';
				$(".softgrid li").each(function(){
					curli_id = $(this).attr('rel');
					if(sel_apps[type]['_'+curli_id]){
						$(this).addClass("on");
					}
				});
			}
		); 
    },
	search: function(form){
		$.get($(form).attr('action'),$(form).serializeArray(),function(data){
			art.dialog.list['showgames'].content(data);
		});
	},
	chooseApp: function(o,id,icon,name){
		var timestamp = Date.parse(new Date());  
		//$.get("/admin/keyword/set",{id:id,timestamp:timestamp},function(data){})
		if(sel_apps[type]['_'+id]){
			delete sel_apps[type]['_'+id];
			if(o){
				$(o).parent().removeClass('on');
			}
			
		}else{
			sel_apps[type]['_'+id] = {id:id,icon:icon,name:name};
			//sel_apps[type]['_'+id] = id;
			if(o){
				$(o).parent().addClass('on');
			}
		}
	},
	confirmChooseApp: function(){
		var result = new Array();
		var length = 0;
		for(var k in sel_apps[type]){
			if(!result[k]){
				result[k] = sel_apps[type][k];
				length++;
			}
		}

        if(!multi && length>1){
            alert('你只能选择一个栏目！');
            return false;
        }
		if(multi){
			if(lanmuWin.callback){
				lanmuWin.callback(result);
			}
			art.dialog.list['showgames'].close();
		}else{
			for(var k in result){
				if(lanmuWin.callback){
					lanmuWin.callback(result[k]);
				}
				art.dialog.list['showgames'].close();
				return;
			}
		}
	},
	callback: function(ret){}
};

var $_GET = (function(){
    var url = window.document.location.href.toString();
    var u = url.split("?");
    if(typeof(u[1]) == "string"){
        u = u[1].split("&");
        var get = {};
        for(var i in u){
            var j = u[i].split("=");
            get[j[0]] = j[1];
        }
        return get;
    } else {
        return {};
    }
})();


