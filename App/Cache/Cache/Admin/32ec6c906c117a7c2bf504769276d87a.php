<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo C('SITE_TITLE');?></title>

    <link rel="shortcut icon" href="favicon.ico"> <link href="/Public/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/Public/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <link href="/Public/Admin/css/animate.min.css" rel="stylesheet">
    <link href="/Public/Admin/css/style.min.css?v=4.0.0" rel="stylesheet"><base target="_blank">
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>
<body class="gray-bg">
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">L+</h1>
            </div>
            <h3>欢迎使用 L+</h3>

            <form class="m-t" role="form" action="" onsubmit="return login(this)">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>
                </p>
            </form>
        </div>
    </div>
    <script src="/Public/Admin/js/jquery.min.js?v=2.1.4"></script>
    <script src="/Public/Admin/js/bootstrap.min.js?v=3.3.5"></script>
    <script>
        function login(dom) {
            var username = $('[name=username]').val();
            var password = $('[name=password]').val();

            if (username == '') {
                alert('请输入用户名');
                return false;
            }
            if (password == '') {
                alert('请输入密码');
                return false;
            }

            $.ajax({
                url:"<?php echo U('Login/login');?>",
                data:{
                    username : username,
                    password : password,
                },
                type : 'post',
                dataType : 'json',
                success : function(i) {
                    if (i.status == 1) {
                        window.location.href = i.url;
                    } else {
                        alert(i.info);
                        return false;
                    }
                }
            })
            return false;
        }
    </script>
</body>
</html>