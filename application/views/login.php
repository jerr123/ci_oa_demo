<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="<?php echo base_url('public/core/h-ui/css/H-ui.min.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/core/h-ui.admin/css/H-ui.login.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/core/h-ui.admin/css/style.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('public/lib/Hui-iconfont/1.0.7/iconfont.css')?>" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>ERP系统登录</title>

</head>
<style>
  .verify-code{
    margin-left: 16px;
  }
  .verify-code:hover{
    cursor: pointer;
  }
</style>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="<?php echo site_url('Login/login')?>" method="post" id="login-form">
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8 skin-minimal">
          <input id="" name="user_name" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8 skin-minimal">
          <input id="" name="user_pwd" type="password"  placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3 skin-minimal">
          <input class="input-text size-L" type="text" name="code" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">
          <img height="" class="verify-code" onclick="this.src=this.src+'?t='+Math.random()" title="点击更换图片" src="<?php echo site_url('Login/getCode')?>"> <!-- <a id="kanbuq" href="javascript:;" onclick="this.src=this.src+'?t='+Math.random()" >换一张</a> --> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3 skin-minimal">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="">
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3 skin-minimal">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 华杉科技 by ERP v1.0</div>
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery/1.9.1/jquery.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/layer/2.1/layer.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/core/h-ui/js/H-ui.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/lib/icheck/jquery.icheck.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.validation/1.14.0/jquery.validate.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.validation/1.14.0/validate-methods.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.validation/1.14.0/messages_zh.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url('public/lib/jquery.form/jquery.form.js')?>"></script>
<script>
$(function(){
    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });
    
    $("#login-form").validate({
        rules:{
            user_name:{
                required:true,
                minlength:4,
                maxlength:16
            },
            user_pwd:{
                required:true,
            },
            code:{
                required:true,
                minlength : 4,
                maxlength : 4,
            },
        },
        onkeyup:false,
        focusCleanup:true,
        success:"valid",
        submitHandler:function(form){
            var index_i = layer.load();
            $(form).ajaxSubmit({
                type:'post',
                dataType:'json',
                success:function(rs){
                    layer.close(index_i);
                    if (rs.code==1){

                        layer.msg('登录成功,正在跳转...',{icon:1},function(){
                            location.href =  "<?php echo site_url('Home/index')?>";
                        });
                        
                    }else{
                        layer.msg(rs.errmsg,{icon:2});
                    }
                }
            });
        }
    })
});
</script>
</body>
</html>