<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/select2/css/select2.css">
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/select2/js/jquery-3.2.1.min.js"></script>
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/select2/js/select2.js"></script>
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/select2/js/i18n/zh-CN.js"></script>
</head>
<body>
	<form action="<?php echo APP_URL_ROOT?>/Test/from_sub" id="signupForm" method="post" enctype="multipart/form-data">
		<select name="select2" id="select2" class="select2" style="width: 100%">
		</select>
		<button type="submit">kk</button>
	</form>
</body>
<!-- <script>
	$("#select2").select2Remote({
	    width: '100%',
	    allowClear:false, //此选项仅适用于指定占位符
	    url:'<?php echo APP_URL_ROOT?>/Test/select2_type/?',
	    minLength:1,    //输入的最小字符数
	    complete:function(repo){
	    	return repo.text;
	    }
	})
</script> -->
<script>
	$("#select2").select2({
		ajax: {
			url: "<?php echo APP_URL_ROOT?>/Test/select2_type/?",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					q: params.term,
				};
			},
			processResults: function (data) {
				return {
					results: data,
				};
			},
			cache: true
		},
		minimumInputLength: 1,
		language:"zh-CN",
		placeholder:'请选择',
		maximumSelectionLength: 2,
		escapeMarkup: function (markup) { return markup; }, 
	});
</script>
</html>