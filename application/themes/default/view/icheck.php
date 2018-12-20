<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>icheck</title>
	<link rel="stylesheet" href="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/bootstrap/css/bootstrap.css">
	<!-- <link rel="stylesheet" href="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/datatable/media/css/jquery.dataTables.css"> -->
	<link rel="stylesheet" href="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/datatable/media/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/icheck/skins/minimal/minimal.css">
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/jquery-3.2.1.min.js"></script>
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/datatable/media/js/jquery.dataTables.js"></script>
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/datatable/media/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/datatable/highlight.js"></script>
	
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/icheck/icheck.js"></script>

</head>
<body>
	<div style="width: 800px">
		<br>
		<button id="btn" class="btn btn-default">test</button><br><br>
		<table class="table table-bordered table-striped table-condensed" id="user_index">
			<thead>
				<tr>
					<th width="20px"><input type="checkbox" class="icheckbox_minimal" id="all_checked"></th>
					<th dt-data-width="20%">id</th>
					<th dt-data-width="20%">name</th>
					<th dt-data-width="20%">操作</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</body>
<script>

	var table = $("#user_index").DataTable({
		order: [
		["1", 'asc']
		], //按照发布时间降序排序
		page: false,
		serverSide:true,
		info: true,
		autoWidth: true,
		searching:true,
		ajax: "<?php echo APP_URL_ROOT?>/Test/get_datatable",
		columns: [{
			data: null
		},{
			data: "id",
		},{
			data: "name",
		},/*{
			data: "create_category_time",
		},{
			data: "ROLENAME",
		},*/{
			data: "null",
		}],
		columnDefs: [{
			targets:0,
			data: null,
			defaultContent:"<input type ='checkbox' name='test' class='icheckbox_minimal' value=''>",
		},{
			targets: -1,
			data: null,
			defaultContent: "<a>编辑</a>|<a>删除</a>",
		},{ 
			"orderable": false, "targets": [0,-1],  //设置第一列和最后一列不可排序
		}],
		createdRow: function(row, data, index) {
			$(row).data('id',data.id);
			$(row).find('.icheckbox_minimal').first().val(data.id);
		},
		"fnDrawCallback": function(){
			$("#all_checked").prop("checked",false);
		},
		"language": {
			"processing": "处理中...",
			"lengthMenu": "显示 _MENU_ 项结果",
			"zeroRecords": "没有匹配结果",
			"info": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
			"infoEmpty": "显示第 0 至 0 项结果，共 0 项",
			"infoFiltered": "(由 _MAX_ 项结果过滤)",
			"infoPostFix": "",
			"search": "搜索:",
			"searchPlaceholder": "搜索...",
			"url": "",
			"emptyTable": "表中数据为空",
			"loadingRecords": "载入中...",
			"infoThousands": ",",
			"paginate": {
				"first": "首页",
				"previous": "上页",
				"next": "下页",
				"last": "末页"
			},
			"aria": {
				paginate: {
					first: '首页',
					previous: '上页',
					next: '下页',
					last: '末页'
				},
				"sortAscending": ": 以升序排列此列",
				"sortDescending": ": 以降序排列此列"
			},
			"decimal": "-",
			"thousands": "."
		}
	});

	//实现全选功能 
	$("#all_checked").click(function(){
		$('[name=test]:checkbox').prop('checked',this.checked);//checked为true时为默认显示的状态
	});

	//实现反选功能  
	$("#checkrev").click(function(){
		$('[name=test]:checkbox').each(function(){  
			this.checked=!this.checked;  
		});  
	});

	$("#btn").click(function(){
		var a = [];
		$('input[name="test"]:checked').each(function(){ 
			a.push($(this).val());
			// console.log($(this).val());
		});
		console.log(a);
	});

</script>
</html>