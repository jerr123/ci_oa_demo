
<nav class="breadcrumb" style="margin-top: -26px;"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 提交待审核 <span class="c-gray en">&gt;</span> 已经通过 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
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
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"></span> <span class="r"> </div>
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
						<td class="td-status"><span style="font-weight: normal;" class="label label-success radius">已通过</span></td>
						<td class="f-14 td-manage">
							<button style="text-decoration:none" onClick="order_first(<?php echo $v['order_id'] ?>)" class="btn btn-secondary radius size-MINI" href="javascript:;" title="已首付">首</button>
							
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
/*订单-通过*/
function order_first(id){
	$.get(SITE_URL + '/Ajax/toFirstList?id=' + id, function(rs){
		if (rs.code==1){
			layer.msg('通过操作成功!', {icon: 1,time:2000},function(){
				location.reload();
			});
		}else{
			layer.msg(rs.errmsg, {icon: 2,time:2000});
		}
	})
}



/** 查看客户 */
function customer_query(title,url,w='86%',h='86%'){
	var index = layer.open({
		type: 2,
		title: title,
		content: url,
		area : [w,h]
	});
	//layer.open(index);
}

</script> 