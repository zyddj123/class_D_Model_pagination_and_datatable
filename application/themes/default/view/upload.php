<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>upload</title>
	<link rel="stylesheet" href="">
	<script src="<?php echo APP_HTTP_ROOT.$this->GetThemes();?>/assets/select2/js/jquery-3.2.1.min.js"></script>
</head>
<body>
	<form enctype="multipart/form-data">
		<div id="picInput">
			<input type="file" multiple="multiple" onchange="readAsDataURL(this)">
		</div><br>		
	</form>
	<div id="result" name="result"></div><br>
	<input type="button" id="btn_upload" onclick="sub_upload()" value="upload">
</body>
<script>
	var files = new Array();
	var k=0;
	//图片预览
	function readAsDataURL(e){  
		var file=e.files;
		for(var i = 0; i< file.length; i ++) { 
			//检验是否为图像文件
			if(!/image\/\w+/.test(file[i].type)){  
				alert("看清楚，这个需要图片！");  
				return false;  
			}
			var filename = file[i].name;
			a(file[i],k,filename);
			files[k]=file[i];
			k++ ;	
		}
	}
	//中转函数为了强行让异步函数顺序加载
	function a(file,k,filename){
		var reader = new FileReader();    
		reader.readAsDataURL(file);	
		reader.onload=function(e){  
			var result=document.getElementById("result"); 
			// console.log(result);
			result.innerHTML = result.innerHTML + "<div id='img"+k+"' data-id='"+k+"'><img style='width:100px;height:100px' src='" + this.result +"'><label>"+filename+"</label><button class='cancel_btn'>cancel</button></div>"; 
		}
	}
	//提交上传数据
	function sub_upload(){
		var count=0;
		var all_files = new FormData();
		// console.log(files);
		for(var i=0;i<files.length;i++){
			if(files[i]&&files[i].name){
				all_files.append("file[]",files[i]);
				count++;
			}
		}
		if(count<=0){
			alert("未选中有效图片");
			return false;
		}
		console.log(all_files);
		$.ajax({
			url:"<?php echo APP_URL_ROOT?>/Test/upload",
			data: all_files,
			type:"post",
			dataType:"json",
			processData: false,
			contentType: false,
			success:function(){
				
			}
		})
	}
	//取消上传
	$('body').on('click','.cancel_btn',function(){
		var box=$(this).closest('div');
		var id=box.data('id');
		files[id]=null;
		box.remove();
	});
</script>
</html>