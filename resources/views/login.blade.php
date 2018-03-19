<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '人才数据库') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .login_pic{
            width: 100%;
            height: 200px;
            padding: 0;
            margin: 0;
            /*background-color: #dddddd;*/
        }
        #pwd_msg{
            display: none;
        }
        #phone_msg{
            display:none;
        }
        .help-block{
            color: red;
        }
    </style>
</head>
<body>
<div class="container" style="padding: 0">
    <div class="login_pic" >

    </div>
    <div class="row" style="margin: 0">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" style="border: none">
                <div class="panel-heading">登陆</div>
                <div class="panel-body">
                    <form class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">账号</label>

                            <div class="col-md-6">
                                <input id="phone" class="form-control" name="phone" placeholder="请输入手机号" value="{{ old('phone') }}" required autofocus onchange="regPhone()">
                                    <span id="phone_msg" class="help-block">
                                        <strong>请输入正确的手机号！</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="请输入密码" class="form-control" name="password" required onchange="regPwd()">
                                    <span id="pwd_msg" class="help-block">
                                        <strong>密码不少于6位</strong>
                                    </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 记住密码
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <input id="submit" class="btn btn-primary" value="登陆">


                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--忘记密码?--}}
                                {{--</a>--}}
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
    var host = 'http://localhost:8088';
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('#submit').click(function () {
        if(checkPhone()){
            $('#phone_msg').hide();
        }else {
            $('#phone_msg').show();
            return false;
        }
        if(checkPwd()){
            $('#pwd_msg').hide();
        }else {
            $('#pwd_msg').show();
            return false;
        }
        $.ajax({
            url:host+'/api/admin/login',
            dataType:'json',
            type:'POST',
            data:{
                password:$('#password').val(),
                phone:$('#phone').val()
            },
            success:function (res) {
                console.log(res);
                if(res.err_code==0){
                    window.location.href=host+"/admin";
                }else{
                    alert(res.msg)
                }

            },
            error:function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest.responseText);
            }
        })
    })
    function regPhone() {
        if(checkPhone()){
            $('#phone_msg').hide();
        }
    }

    function regPwd(){
        if(checkPwd()){
            $('#pwd_msg').hide();
        }
    }
    function checkPhone() {
        var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
        if (!myreg.test($('#phone').val())) {
            return false;
        } else {
            return true;
        }
    }
    function checkPwd(){
        if ($('#password').val().length>5) {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>
</html>
