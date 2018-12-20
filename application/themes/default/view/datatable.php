<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>datatable</title>
	<link rel="stylesheet" href="<?php echo $this->getThemesUrl(); ?>/assets/bootstrap/css/bootstrap.css">
	<!-- <link rel="stylesheet" href="<?php echo $this->getThemesUrl(); ?>/assets/datatable/media/css/jquery.dataTables.css"> -->
	<link rel="stylesheet" href="<?php echo $this->getThemesUrl(); ?>/assets/datatable/media/css/dataTables.bootstrap.css">

	<script src="<?php echo $this->getThemesUrl(); ?>/assets/jquery-3.2.1.min.js"></script>
	<script src="<?php echo $this->getThemesUrl(); ?>/assets/datatable/media/js/jquery.dataTables.js"></script>
	<script src="<?php echo $this->getThemesUrl(); ?>/assets/datatable/media/js/dataTables.bootstrap.js"></script>
	<!-- <script src="<?php echo $this->getThemesUrl(); ?>/assets/datatable/media/js/dataTables.default.config.js"></script> -->
</head>
<body>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
		<table class="table table-bordered table-striped table-condensed" id="user_index">
			<thead>
				<tr>
					<th dt-data-width="15%">序号</th>
					<th dt-data-width="15%">id</th>
					<th dt-data-width="15%">name</th>
					<th dt-data-width="15%">class_name</th>
					<th dt-data-width="15%">sex</th>
					<th dt-data-width="15%">操作</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
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
		autoWidth: false,
		searching:true,
		ajax: "/User/ajax_user",
		columns: [{
			data: null,
			targets: 0
		},{
			data: "id",
		},{
			data: "name",
		},{
			data: "class_name",
		},{
			data: "sex"
		},{
			data: "null",
		}],
		columnDefs: [{
			targets: -1,
			data: null,
			defaultContent: "<a>编辑</a>|<a>删除</a>",
		},{
			"orderable": false, "targets": [0,-1],  //设置第一列和最后一列不可排序
		}],
		createdRow: function(row, data, index) {
			$(row).data('id', data.id);
			// console.log($(row).data('id'));
			// console.log(index);
		},
		"fnDrawCallback": function(){
			　　        var api = this.api();
		　　var startIndex= api.context[0]._iDisplayStart;//获取到本页开始的条数
		　　api.column(0).nodes().each(function(cell, i) {
			cell.innerHTML = startIndex + i + 1;
		　　});
	},
	language: {
		url: '<?php echo $this->getThemesUrl(); ?>/assets/datatable/i18n/zh-cn.json'
	}
});


	$('#add').click(function(event) {
		var name = $('#name').val();
		$.post("/User/add_user",{"name":name},function(e){
			console.log(e);
			if(e){
				alert("success");
				table.draw();
			}else{
				alert("failed");
			}
		});
	});
</script>
</html>