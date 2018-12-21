
<nav class="breadcrumb" style="margin-top: ;"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 提交待审核 <span class="c-gray en">&gt;</span> 提交待审核列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c"> 
		<form action="<?php echo site_url('Home/subForReview')?>" method="get">
		<span class="select-box inline">
		  	<select name="state" class="select">
		  		<option value="">全部分类</option>
		  		<option value="1">待申请</option>
		  		<option value="2">未通过</option>
		  	</select>
		  </span> 日期范围：
		<input type="text" name="startDate" value="<?php echo isset($rule['startDate'])?$rule['startDate']:'' ?>" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
		<input type="text" name="endDate" value="<?php echo isset($rule['endDate'])?$rule['endDate']:'' ?>" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d'})" id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="c_name" value="<?php echo isset($rule['c_name'])?$rule['c_name']:'' ?>" id="" placeholder=" 客户名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜客户</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><!-- <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>  --><a class="btn btn-primary radius" data-title="录入客户" _href="<?php echo site_url('Home/CustomerAdd')?>" onclick="Hui_admin_tab(this)" href="javascript:void(0);"><i class="Hui-iconfont">&#xe600;</i> 添加(录入)客户</a></span> <span class="r"> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort">
			<thead>
				<tr class="text-c">
					<th width="50"><input type="checkbox" name="" value=""></th>
					<th width="150">ID</th>
					<th width="250">订单日期</th>
					<th width="150">客户</th>
					<th width="250">客户电话</th>
					<!-- <th width="200">客户户籍</th> -->
					<!-- <th width="100">订购车型</th> -->
					<!-- <th width="100">购车方式</th> -->
					<!-- <th width="">客户意愿上牌地区</th> -->
					<th width="">销售顾问</th>
					<th width="200">合同价</th>
					<!-- <th width="75">手续费</th> -->
					<th width="100">状态</th>
					<th width="200">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $k => $v): ?>
					<tr class="text-c">
						<td><input type="checkbox" class="checkbox-select" value="<?php echo isset($v['order_id'])?$v['order_id']:''?>" name=""></td>
						<td><u style="cursor:pointer" class="text-primary" onClick="customer_query('查看详细','<?php echo site_url('Home/detailView').'?id='.$v['order_id'] ?>')" title="查看"><?php echo $v['order_id']?></u></td>
						<td ><?php echo $v['addtime'] ?><!-- <u style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10001')" title="查看">资讯标题</u> --></td>
						<td><?php echo $v['c_name'] ?></td>
						<td><?php echo $v['c_mobile'] ?></td>
						<!-- <td><?php echo $v['c_hj'] ?></td>
						<td><?php echo $v['car_type'] ?></td>
						<td><?php echo $v['buy_type'] ?></td> -->
						<!-- <td><?php echo $v['willing_register_area'] ?></td> -->
						<td><?php echo $v['sales'] ?></td>
						<td><?php echo $v['contract_price'] ?></td>
						<!-- <td>6000.00</td> -->
						<td class="td-status"><span style="font-weight: normal;" class="label label-success radius">待申请</span></td>
						<td class="f-14 td-manage">
							<a style="text-decoration:none" onClick="order_apply(<?php echo $v['order_id'] ?>)" href="javascript:;" title="申请审核"><i class="Hui-iconfont">&#xe6a7;</i></a> 
							<a style="text-decoration:none" class="ml-5" onClick="order_edit('编辑申请', <?php echo $v['order_id'] ?>)" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
							<a style="text-decoration:none" class="ml-5" onClick="order_del(<?php echo $v['order_id'] ?>)" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<div class="row">
			<div class="page-info">
				<div aria-relevant="all" aria-live="polite" role="alert" id="dataTables-example_info" class="dataTables_info">一共<?php echo $info['total'] ?>条数据，每页显示<?php echo $info['per_page'] ?>条，共 <?php echo $info['total_page'] ?>页</div>
			</div>
			<div class="page-content">
				<div class="">
					<ul id="pagination" class="pagination">
						<?php echo $page ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery/1.9.1/jquery.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/layer/2.1/layer.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/lib/My97DatePicker/WdatePicker.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/lib/datatables/1.10.0/jquery.dataTables.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/core/h-ui/js/H-ui.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/core/h-ui.admin/js/H-ui.admin.js')?>"></script>
<script type="text/javascript">
$('.table-sort').dataTable({
	"paging": false,
	"searching" : false,
	"info" : false,
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
	]
});
/*$('#pagination li a').attr("href", "javascript:void(0)");
$('#pagination li a').on('click', function(){
	console.log(this);
})*/
/** 录入客户 */
function customer_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/** 查看客户 */
function customer_query(title,url,w='90%',h='90%'){
	var index = layer.open({
		type: 2,
		title: title,
		content: url,
		area : [w,h]
	});
	//layer.open(index);
}

/** 编辑申请 */
function order_edit(title,id,w='86%',h='86%'){
	var url = SITE_URL + '/Home/CustomerAdd?id=' + id;
	var index = layer.open({
		type: 2,
		title: title,
		content: url,
		area : [w,h]
	});
	//layer.open(index);
}

/*订单-申请审核*/
function order_apply(id){
	$.get(SITE_URL + '/Ajax/applyToReview?id=' + id, function(rs){
		if (rs.code==1){
			layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000},function(){
				location.reload();
			});
		}else{
			layer.msg(rs.errmsg, {icon: 2,time:2000});
		}
	})
}
/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$(obj).parents("tr").remove();
		layer.msg('已删除!',1);
	});
}
/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布', {icon:6,time:1000});
	},
	function(){
		$(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
		$(obj).remove();
    	layer.msg('未通过', {icon:5,time:1000});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
		$(obj).remove();
		layer.msg('已下架!',{icon: 5,time:1000});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
		$(obj).remove();
		layer.msg('已发布!',{icon: 6,time:1000});
	});
}
/*资讯-申请上线*/
function article_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}

</script> 