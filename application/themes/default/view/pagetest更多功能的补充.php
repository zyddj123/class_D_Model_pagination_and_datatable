<!-- ===========================项目列表==================================== -->
<!DOCTYPE html>
<html>
    <?php include VIEW_THEMES_PATH.'/'.$this->GetThemes()."/view/common/head.php";?>
    <body class="fixed-left">
	<!--==================== 开始==================== -->
	<div id="wrapper">
		<!--========== 顶栏开始 ==========-->
        <?php include VIEW_THEMES_PATH.'/'.$this->GetThemes()."/view/common/top.php";?>
		<!--========== 左侧边栏开始 ======== -->
        <?php include VIEW_THEMES_PATH.'/'.$this->GetThemes()."/view/common/leftsidebar.php";?>
		<!--========== 内容这里开始 ========== -->
		<div class="content-page">
			<!-- 内容开始 -->
			<div class="content">
				<div class="container">
					<!-- 页标 -->
					<div class="row">
						<div class="col-sm-12">
							<h4 class="pull-left page-title">项目列表</h4>
							<ol class="breadcrumb pull-right">
								<li><a href="#">首页</a></li>
								<li class="active">项目列表</li>
							</ol>
						</div>
					</div>
					<!-- 页标 -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">项目列表</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<table id="datatable"
												class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>项目名称</th>
														<th>类型</th>
														<th>项目时间</th>
														<th>项目状态</th>
														<th>操作</th>
													</tr>
												</thead>
												<tbody id="item_data">

												</tbody>
											</table>
											<div id="Pagination" class="pagination"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="height: 600px;"></div>
				</div>
				<!-- container -->
			</div>
			<!-- 内容结束 -->
			<!-- footer 底部 -->
            <?php include VIEW_THEMES_PATH.'/'.$this->GetThemes()."/view/common/footer.php";?>
        </div>
		<!--========== 右侧边栏 ============= -->            
        <?php include VIEW_THEMES_PATH.'/'.$this->GetThemes()."/view/common/rightsidebar.php";?>
	</div>
	<!--==================== 结束==================== -->
	<!-- jQuery  -->
    <?php include VIEW_THEMES_PATH.'/'.$this->GetThemes()."/view/common/js.php";?>
    <!-- 分页JS+CSS -->
    <?php include VIEW_THEMES_PATH.'/'.$this->GetThemes()."/view/common/page.php";?>   
	<script type="text/javascript">
	function item_data(status,p)
		{
			if(typeof status== 'undefined') status=0;//获取值
			if(typeof p== 'undefined') p=1; //获取当前页数
			$.post('<?php echo APP_URL_ROOT?>/Item/item_ajax_data',{"status":status,"p":p},function(e){
				$('#item_data').empty();//清空所有数据
				var e = JSON.parse(e);	
				if(e.data){
					var str='';						
					$.each(e.data,function(i,d){
                    str +='<tr id="type'+d.SID+'">';
					str +='<td>'+d.INAME+'</td>';
					str +='<td>'+d.ITNAME+'</td>';
					str +='<td>'+d.ISTART+'~'+d.IEND+'</td>';
					if(d.ISTATUS=='0'){
						str +='<td><span class="label label-success">新建</span></td>';
					}else if(d.ISTATUS=='1'){
						str +='<td><span class="label label-warning">进行中</span></td>';
					}else{
						str +='<td><span class="label label-inverse">结束</span></td>';
					}
					str +='<td class="actions"><div class="btn-group">';
					str +='<a href="<?php echo APP_URL_ROOT?>/Item/item_check?&sid='+d.SID+'" class="btn btn-default"><i class="fa fa-search"></i> 查看</a>';
				<?php if(in_array('item_purview',unserialize($_SESSION['cooa']['RPURVIEW']))):?>
					str +='<a href="<?php echo APP_URL_ROOT?>/Item/item_editor?&sid='+d.SID+'" class="btn btn-default"><i class="fa fa-cogs"></i> 编辑</a>';
					str +='<a href="javascript:void(0)" onclick="delete_item(\''+d.SID+'\')" class="btn btn-default"><i class="fa fa-trash-o"></i> 删除</a>';
				<?php endif;?>	
					str +='</div></td></tr>';
					});
					$("#item_data").html(str);   //把数据填到ID中
					if(status!=1){
						initPagination(e.entries);//总页数
					}
				}else{
					if(status!=1){ 
						initPagination('0');
					}
				}
			});		
		}		
		//删除
		function delete_item(sid)
		{
			if(sid=='')return false;
			if(confirm("是否删除此活动类型？")){
				$.post('<?php echo APP_URL_ROOT?>/Item/delete_item',{'sid':sid},function (e){
					if(e){
						$("#type"+sid).remove();//移除
					}else{
						alert('删除失败');
					}
					location.reload();
				});
			}else{
				return false;
			}
		}
		//固定Pagination 分页
		function pageselectCallback(page_index, jq){
		    var p = page_index+1;			//当前页码数
		    item_data(1,p);
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
			item_data();
		});	
	</script>

</body>
</html>