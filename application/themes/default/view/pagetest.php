<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="<?php echo $this->getThemesUrl(); ?>/assets/pagination/pagination.css">
	<script src="<?php echo $this->getThemesUrl(); ?>/assets/pagination/jquery.min.js"></script>
	<script src="<?php echo $this->getThemesUrl(); ?>/assets/pagination/jquery.pagination.js"></script>
</head>
<body>
	<div style ="width: 800px; margin: 0 auto;text-align: center">
		<input id="search_user_data" type="text" class="form-control" placeholder="搜索...">
		<input type="button" value="搜索" onclick="search_user_data()">
		<table id="datatable" class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>id</th>
					<th>name</th>
					<th>class</th>
					<th>sex</th>
					<th>操作</th>
				</tr>
			</thead>
			
			<tbody id="user">
				<tr><td><img id="loading" src="<?php echo $this->getThemesUrl(); ?>/images/loading.gif" width="25px" height="25px" alt=""></td></tr>
			</tbody>
		</table>
		<div id="Pagination" class="pagination"></div>
	</div>
</body>
<script type="text/javascript">
	function user_data(status,p)
	{
			if(typeof status== 'undefined') status=0;//获取值
			if(typeof p== 'undefined') p=1; //获取当前页数
			var name = $('#search_user_data').val();
			$.post('/User/ajax_pagination_data',{"status":status,"p":p,"name":name},function(e){
				$('#user').empty();//清空所有数据
				var e = JSON.parse(e);
				if(e.data){
					var str='';						
					$.each(e.data,function(i,d){
						str +='<tr id="type'+d.id+'">';
						str +='<td>'+d.id+'</td>';
						str +='<td>'+d.name+'</td>';
						str +='<td>'+d.class_name+'</td>';
						str +='<td>'+d.sex+'</td>';
						str +='<td class="actions"><div class="btn-group">';
						str +='<a href="/Test/hehe?&sid='+d.id+'" class="btn btn-default"><i class="fa fa-search"></i> 查看</a>';
						str +='<a href="/Test/haha?&sid='+d.id+'" class="btn btn-default"><i class="fa fa-cogs"></i> 编辑</a>';
						str +='<a href="javascript:void(0)" onclick="delete_item(\''+d.id+'\')" class="btn btn-default"><i class="fa fa-trash-o"></i> 删除</a>';
						str +='</div></td></tr>';
					});
					$("#user").html(str);   //把数据填到ID中
					if(status!=1){
						initPagination(e.entries);//总页数
					}
				}else{
					// $("#user").text('暂无数据!');
					if(status!=1){
						initPagination('0');
					}
				}
			});		
		}
		function search_user_data(){
			user_data();
		}		
		//固定Pagination 分页
		function pageselectCallback(page_index, jq){
		    var p = page_index+1;			//当前页码数
		    user_data(1,p);
		}
		function initPagination(page) {
			var num_entries = page;
			var _pag_text='';
			if(num_entries!='0'){
				_pag_text=true;
			}else{
				_pag_text=false;
			}
			// 创建分页
			$("#Pagination").pagination(num_entries, {
				num_edge_entries: 1, //边缘页数
				num_display_entries: 4, //主体页数
				callback: pageselectCallback,
				items_per_page:1, //每页显示1项
				prev_text: "上一页",
				next_text: "下一页",
				prev_show_always:_pag_text,
				next_show_always:_pag_text
			});
		};	
		$(function(){ //执行这个方法
			user_data();
			console.log($('#user'));
			console.log($('#user').get(0).offsetHeight);
		});	
	</script>
	</html>