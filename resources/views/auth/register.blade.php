<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', '人才数据库') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            overflow: hidden;
        }
        .top_bar{
            text-align: center;
            font-size: 2rem;
            font-weight: 600;
            padding: 0;
            line-height: 48px;
        }
        .group-reg  input{
            width: 52%;
            display: inline-block;
            box-sizing: border-box;
        }
        .group-reg button{
            width: 45%;
            height: 36px;
            border: none;
        }
    </style>
</head>
<body>
<div class="container" style="padding: 0">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading top_bar">注册</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 col-xs-3 control-label">姓名<span style="color: red">*</span></label>

                            <div class="col-md-6 col-xs-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 col-xs-3 control-label">手机号<span style="color: red">*</span></label>

                            <div class="col-md-6 col-xs-9">
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 col-xs-3 control-label">验证码<span style="color: red">*</span></label>

                            <div class="col-md-6 col-xs-9 group-reg">
                                <input id="code" type="code" class="form-control" name="email" value="{{ old('code') }}" required>
                                <button id="sendMsg" class="btn btn-success">发送验证码</button>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 col-xs-3 control-label">密码<span style="color: red">*</span></label>

                            <div class="col-md-6 col-xs-9">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-xs-3 control-label">确认密码<span style="color: red">*</span></label>

                            <div class="col-md-6 col-xs-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 col-xs-3 control-label">邮箱</label>

                            <div class="col-md-6 col-xs-9">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 col-xs-8 col-xs-offset-2">
                                <button type="submit" class="btn btn-primary" style="width: 100% ">
                                    注册
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script>
    $('#sendMsg').click(function () {
      if(regPhone($('#phone').val())){
          $.ajax({
              url:'http://localhost:8088/yzm/send',
              dataType:'json',
              type:'POST',
              headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
              data:{
                  phone:$('#phone').val()
              },
              success:function(res){
                  console.log('success');
                  counts($('#sendMsg'))
              },
              error:function (error) {
                  alert('获取验证码失败，请重新获取！');
                  $('#sendMsg').html('重新发送');
              }
          });
      }else {
          alert('请输入正确的手机号码！')
      }
    })
    function regPhone(num) {
        if(!(/^1[34578]\d{9}$/.test(num))){
            return false;
        } else{
            return true;}
    }
    var wait = 60;
    function counts(o){
        if (wait == 0) {
            o.removeAttr('disabled');
            o.removeClass('btn-warning').addClass('btn-success');
            o.html("重新获取");
            wait = 60;
        } else {
           o.removeClass('btn-success').addClass('btn-warning').attr('disabled',true);
           o.html('重新发送('+wait+')');
            wait--;
            setTimeout(function() {
                    counts(o)
                },
                1000)
        }
    }
//    $('#submit').click(register());
//    function register(){
//        $.ajax({
//            url:'http://localhost:8088/register',
//            dataType:'json',
//            type:'POST',
//            headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
//            beforeSend:function(){
//                if($('#password').val()!=$('#password-confirm').val()){
//                    alert('两次密码输入不一致！');
//                    return false;
//                }
//            },
//            data:{
//                name:$('#name').val(),
//                phone:$('#phone').val(),
//                code:$('#code').val(),
//                password:$('#password').val(),
//                email:$('#email').val(),
//            },
//            success:function(res){
//                alert(123);
//                console.log(res);
//            },
//            error:function (error) {
//                alert('获取验证码失败，请重新获取！');
//            }
//        })
//    }
</script>
</body>
</html>
