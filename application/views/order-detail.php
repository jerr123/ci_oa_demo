<style>
	.panel {
		width: 76%;
		margin: 0 auto;
		margin-top: 20px;
	}
	.order-track .track-list {
    margin: 20px;
    height: 216px;
    padding-left: 5px;
    overflow-y: auto;
    position: relative;
}
ol, ul {
    list-style: none;
}
.order-track .track-list li.first {
    color: #e4393c;
    padding-top: 0;
    border-left-color: #fff;
    font-size: 14px;
    font-weight: 600;
}
.order-track .track-list li {
    position: relative;
    padding: 9px 0 0 25px;
    line-height: 18px;
    border-left: 1px solid #d9d9d9;
    color: #333;
}
.order-track .track-list li.first .node-icon {
    background-position: 0 -72px;
}
.order-track .track-list li .node-icon {
    position: absolute;
    left: -6px;
    top: 50%;
    width: 11px;
    height: 11px;
    background: url(//misc.360buyimg.com/user/order/0.0.1/css/i/order-icons.png) -21px -72px no-repeat;
}
.order-track .track-list li .time {
    margin-right: 20px;
}
.order-track .track-list li .time, .order-track .track-list li .txt {
    position: relative;
    top: 4px;
    display: inline-block;
    *display: inline;
    *zoom: 1;
    vertical-align: middle;
}
 .order-track .track-list li span.txt {
    max-width: 640px;
}
.order-track .track-list li {
    position: relative;
    padding: 9px 0 0 25px;
    line-height: 18px;
    border-left: 1px solid #d9d9d9;
    color: #333;
}
</style>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 查看详细 <span class="c-gray en"><!-- &gt;</span> 基本设置 --> <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form class="form form-horizontal" id="form-article-add">
		<div id="tab-system" class="HuiTab">
			
			<div class="tabCon">
				<div class="panel panel-default mt-20">
					<div class="panel-header">客户基本信息</div>
					<div class="panel-body">
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>客户姓名：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['c_name'] ?>
								</div>
							</div>

							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>客户电话：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['c_mobile'] ?>
								</div>
							</div>
						</div>

						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>户籍：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['c_hj'] ?>
								</div>
							</div>
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>身份证号：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['c_sfz'] ?>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<div class="panel panel-default mt-20">
					<div class="panel-header">
						购车基本信息
					</div>
					<div class="panel-body">
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>车型：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[3] as $k => $v): ?>
									<?php if (isset($data['car_type']) && $data['car_type']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>

							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>排量：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[4] as $k => $v): ?>
									<?php if (isset($data['car_pl']) && $data['car_pl']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>

						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>发票价：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[5] as $k => $v): ?>
									<?php if (isset($data['fp_price']) && $data['fp_price']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>

							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>购车方式：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[6] as $k => $v): ?>
									<?php if (isset($data['buy_type']) && $data['buy_type']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>
						
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>销售顾问：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo isset($data['sales'])?$data['sales']:'' ?>
								</div>
							</div>

							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>销售顾问手机：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo isset($data['sales_mobile'])?$data['sales_mobile']:'' ?>
								</div>
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>意愿上牌地区：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo isset($data['willing_register_area'])?$data['willing_register_area']:'' ?>
								</div>
							</div>

							
						</div>
					</div>
				</div> <!-- Panel End -->
				<div class="panel panel-default mt-20">
					<div class="panel-header">
						金融板块信息
					</div>
					<div class="panel-body">
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>金融公司1：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[7] as $k => $v): ?>
									<?php if (isset($data['banking_id']) && $data['banking_id']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>金融公司2：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[9] as $k => $v): ?>
									<?php if (isset($data['banking_id2']) && $data['banking_id2']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
							
						</div>
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>金融渠道1：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[8] as $k => $v): ?>
									<?php if (isset($data['banking_road']) && $data['banking_road']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
							

							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>金融渠道2：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<?php foreach ($opts[10] as $k => $v): ?>
									<?php if (isset($data['banking_road2']) && $data['banking_road2']==$v['opt_id']): ?>
										<div class="select-view-box">
											<?php echo $v['opt_name'] ?>
										</div>
									<?php endif ?>
								<?php endforeach ?>
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>通过金额1：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['banking_pass'] ?>
								</div>
							</div>
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>通过金额2：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['banking_pass2'] ?>
								</div>
							</div>
						</div>

						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>合计金额：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['banking_pass'] + $data['banking_pass2'] ?>
								</div>
							</div>
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>进度标志：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
								<?php foreach ($status_map as $k => $v): ?>
									<?php if ($v['status']==$data['state']): ?>
										<span class="<?php echo $v['sm_class'] ?>"><?php echo $v['sm_name'] ?></span>
									<?php endif ?>
								<?php endforeach ?>
									
								</div>
								
							</div>
						</div>
					</div>
				</div><!-- End panel -->
				<div class="panel panel-default mt-20">
					<div class="panel-header">上牌板块信息</div>
					<div class="panel-body">
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>发票日期：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['fp_date'] ?>
								</div>
							</div>

							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>是否二次贷优先：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['is_second_yxd'] ?>
								</div>
							</div>
						</div>

						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>发票金额：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['fp_money'] ?>
								</div>
							</div>
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>相片处理日期：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['xpcl_date'] ?>
								</div>
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>对接地区：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['docking_area'] ?>
								</div>
							</div>
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>对接人：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['docking_person'] ?>
								</div>
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>出证与否：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['czyf'] ?>
								</div>
							</div>
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>抵押完成与否：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['is_dy_finished'] ?>
								</div>
							</div>
						</div>
						<div class="row cl">
							<label class="form-label col-xs-2 col-sm-2"><span class="c-red">*</span>上牌日期：</label>
							<div class="formControls col-xs-4 col-sm-3">
								<div class="select-view-box">
									<?php echo $data['sp_date']; ?>
								</div>
								
							</div>
							
						</div>
						
					</div>
				</div><!-- End panel -->
				
				<div class="panel panel-default">
					<div class="panel-header">
						操作流水
					</div>
					<div class="panel-body">
						<div class="order-track">
							<div class="track-list">
								<ul>
									<?php foreach ($logs as $lk => $lv): ?>
										<li <?php if ($lk==0) echo 'class="first"'?>>
											<i class="node-icon"></i>
											<span class="time"><?php echo $lv['addtime'] ?></span>
											<span class="txt"><?php echo $lv['user_name'].'['.$lv['user_nick'].']&nbsp;&nbsp;'.$lv['act'] ?></span>
										</li>
									<?php endforeach ?>
									
									
								
								</ul>
							</div>
						</div>
						
					</div>
				</div> <!-- End panel -->
			</div>

	</form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery/1.9.1/jquery.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/layer/2.1/layer.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/icheck/jquery.icheck.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.validation/1.14.0/jquery.validate.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.validation/1.14.0/validate-methods.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.validation/1.14.0/messages_zh.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/core/h-ui/js/H-ui.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/core/h-ui.admin/js/H-ui.admin.js')?>"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
$(function(){
	$('input').attr("disabled","true");
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});
</script>
<!--/请在上方写此页面业务相关的脚本-->