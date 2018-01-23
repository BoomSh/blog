
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link href="{{asset('admins/static/h-ui/css/H-ui.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admins/static/h-ui.admin/css/H-ui.login.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admins/static/h-ui.admin/css/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admins/lib/Hui-iconfont/1.0.8/iconfont.css')}}" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>后台登录 - H-ui.admin 3.0</title>
<meta name="keywords" content="H-ui.admin 3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin 3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<div class="header"></div>
<div class="loginWraper">
<input type="text" id="msg" name="msg" value="{{session('msg')}}" />
@if (count($errors) > 0)
    @foreach ($errors->all() as $key => $error)
        <input type="text"  name="info" value="{{$error}}"></input>
    @endforeach
@endif
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="{{url('auth/login')}}" method="post">
     {{csrf_field()}}
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
        <div class="formControls col-xs-8">
          <input id="email" name="email" value="{{old('email')}}" type="text" placeholder="邮箱" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
        <div class="formControls col-xs-8">
          <input id="password" name="password" value="{{old('password')}}" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input class="input-text size-L" type="text" placeholder="验证码" name="verify" value="" style="width:150px;">
          <img src="{{url('auth/verify')}}" id="img"> <a id="kanbuq" href="javascript:verify();">看不清，换一张</a> </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <label for="online">
            <input type="checkbox" name="remember" id="remember" value="1">
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-xs-8 col-xs-offset-3">
          <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright 你的公司名称 by <a href="http://www.mycodes.net/" target="_blank">源码之家</a></div>
<script type="text/javascript" src="{{asset('admins/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('admins/static/h-ui/js/H-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('\admins\lib\layer\2.4/layer.js')}}"></script>
<script type="text/javascript">
    //信息提示框
    $(document).ready(function(){
        var info = $('#info').val();
        var msg = $('#msg').val();
        if($("input[name='info']")[0].value!=""){
            layer.msg($("input[name='info']")[0].value);
        }
        else if(msg!=""){
            layer.msg(msg);
        }
    })
    //更新验证码
    function verify(){
        var time = new Date().getTime();
        $("#img").attr('src',"{{url('auth/verify')}}?"+time);
    }
</script>

</body>
</html>