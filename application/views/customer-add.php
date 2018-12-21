<article class="page-container">
	<form class="form form-horizontal" action="<?php echo site_url('Ajax/exeCustomerAdd')?>" id="form-customer-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>客户名字：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="111" placeholder="" id="customerName" name="customerName">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>客户电话：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="13163062522" placeholder="" id="mobile" name="mobile">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>客户户籍：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="111" placeholder="" id="hj" name="hj">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>订购车型：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="111" placeholder="" id="carType" name="carType">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>购车方式：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="buyType" id="buyType" class="select">
					<option value="0">请选择</option>
					<option selected="true" value="1">裸车</option>
					<option value="11">全款</option>
					<option value="12">分期</option>
					<option value="13">零首付</option>
				</select>
				</span> </div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>客户意愿上牌地区：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="11" placeholder="" name="willingRegisterArea" id="willingRegisterArea" name="">
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
				<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
				<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</article>
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
<script type="text/javascript" src="<?php echo base_url('public/lib/My97DatePicker/WdatePicker.js')?>"></script>  
<script type="text/javascript" src="<?php echo base_url('public/lib/webuploader/0.1.5/webuploader.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/ueditor/1.4.3/ueditor.config.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/ueditor/1.4.3/ueditor.all.min.js')?>"> </script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.form/jquery.form.js')?>"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$("#form-customer-add").validate({
		rules:{
			customerName:{
				required:true,
				minlength:2,
				maxlength:10
			},
			mobile:{
				required:true,
				isPhone:true,
			},
			hj:{
				required:true,
				minlength:3,
			},
			carType:{
				required:true,
				minlength:1,
			},
			buyType:{
				required:true,
				minlength:1,
			},
			willingRegisterArea:{
				required:true,
				minlength:1
			},
		},
		onkeyup:false,
		focusCleanup:false,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type:'post',
				dataType:'json',
				success:function(rs){
					if (rs.code==1){
						//layer.alert('提交成功',{icon:1});
						layer.alert('提交成功',{icon:1,offset:['120px', '270px']},function(){
							removeIframe();
						});
					}else{
						layer.alert(rs.errmsg,{icon:2});
					}
				}
			});
		}
	});
})
</script>
<!--/请在上方写此页面业务相关的脚本-->
