<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 8]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <link href="/Public/Admin/favicon.ico" rel="shortcut icon"/>
<link href="/Public/Admin/css/bootstrap.min.css?v=3.3.5" rel="stylesheet"/>
<link href="/Public/Admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet"/>
<link href="/Public/Admin/css/animate.min.css" rel="stylesheet"/>
<link href="/Public/Admin/css/style.min.css?v=4.0.0" rel="stylesheet"/>

</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--左侧导航开始-->
        <nav class="navbar-default navbar-static-side" role="navigation">
    <div class="nav-close">
        <i class="fa fa-times-circle">
        </i>
    </div>
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="/Public/Admin/img/profile_small.jpg"/>
                    </span>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">
                                    Hello
                                </strong>
                            </span>
                            <span class="text-muted text-xs block">
                                <?php echo session('nickname');?>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    H+
                </div>
            </li>
            <li>
                <a href="<?php echo U('/Admin');?>">
                    <i class="fa fa-home">
                    </i>
                    <span class="nav-label">
                        后台首页
                    </span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-desktop">
                    </i>
                    <span class="nav-label">
                        会员管理
                    </span>
                    <span class="fa arrow">
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('User/index');?>">
                            会员列表
                        </a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo U('WithdrawLog/index');?>">
                            提现申请
                        </a>
                    </li> -->
                </ul>
            </li>
            <li>
                <a href="<?php echo U('Category/index');?>">
                    <i class="fa fa-columns">
                    </i>
                    <span class="nav-label">
                        提现记录
                    </span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-desktop">
                    </i>
                    <span class="nav-label">
                        文章管理
                    </span>
                    <span class="fa arrow">
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Article/index');?>">
                            文章列表
                        </a>
                    </li>
                     <li>
                        <a href="<?php echo U('Article/add');?>">
                            添加文章
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo U('Problem/index');?>">
                    <i class="fa fa-table">
                    </i>
                    <span class="nav-label">
                        问答管理
                    </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Problem/index');?>">
                            问答列表
                        </a>
                    </li>
                </ul>
            </li>
            <!-- <li>
                <a href="<?php echo U('Message/index');?>">
                    <i class="fa fa-desktop">
                    </i>
                    <span class="nav-label">
                        消息管理
                    </span>
                    <span class="fa arrow">
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Message/index');?>">
                            消息列表
                        </a>
                    </li>
                </ul>
            </li> -->
            <li>
                <a href="<?php echo U('Banner/index');?>">
                    <i class="fa fa-desktop">
                    </i>
                    <span class="nav-label">
                        广告管理
                    </span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Banner/index');?>">
                            广告列表
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Banner/add');?>">
                            广告添加
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo U('System/index');?>">
                    <i class="fa fa-desktop">
                    </i>
                    <span class="nav-label">
                        系统管理
                    </span>
                    <span class="fa arrow">
                    </span>
                </a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo U('Admin/index');?>">
                            管理员管理
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                <i class="fa fa-bars">
                </i>
            </a>
            <form action="search_results.html" class="navbar-form-custom" method="post" role="search">
                <div class="form-group">
                    <input class="form-control" id="top-search" name="top-search" placeholder="请输入您需要查找的内容 …" type="text">
                    </input>
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown hidden-xs">
                <a href="<?php echo U('Login/logout');?>" aria-expanded="false" class="right-sidebar-toggle">
                    <i class="fa fa-tasks">
                    </i>
                    退出
                </a>
            </li>
        </ul>
    </nav>
</div>
            <div class="row J_mainContent" id="content-main">
                
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>
                            添加广告
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <?php if($vo['id']): ?><form class="form-horizontal" method="post" action="<?php echo U('update');?>" onsubmit="return ajaxForm(this)">
                        <?php else: ?>
                            <form class="form-horizontal" method="post" action="<?php echo U('insert');?>" onsubmit="return ajaxForm(this)"><?php endif; ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    广告名称
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="<?php echo ($vo["name"]); ?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    广告链接
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="<?php echo ($vo["name"]); ?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    点击量
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="<?php echo ($vo["name"]); ?>"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    广告位置
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="<?php echo ($vo["name"]); ?>"></input>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    广告图片
                                </label>
                                <div class="input-group m-b">
                                    <div class="input-group-btn">
                                            <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">操作 <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="" class="upImg">上传</a></li>
                                                <input type="file" name="upfile" id="upfile" style="display:none">
                                                <li><a href="" class="reviewImg" onclick="return reviewImg(this);">预览</a>
                                            </ul>
                                    </div>
                                <input type="text" class="form-control" name="content">
                                </div>

                            </div>
                            <div class="hr-line-dashed">
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <?php if(I('id')): ?><input type="hidden" name="id" value="<?php echo I('get.id');?>"><?php endif; ?>
                                    <button class="btn btn-primary" type="submit">
                                        保存内容
                                    </button>
                                    <button class="btn btn-white" type="submit">
                                        取消
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

            </div>
            <div class="footer">
                <div class="pull-right">
    © 2014-2015
    <a href="http://www.zi-han.net/" target="_blank">
        zihan's blog
    </a>
</div>
            </div>
        </div>
    </div>
    <script src="/Public/Admin/js/jquery.min.js?v=2.1.4">
</script>
<script src="/Public/Admin/js/bootstrap.min.js?v=3.3.5">
</script>
<script src="/Public/Admin/js/plugins/metisMenu/jquery.metisMenu.js">
</script>
<script src="/Public/Admin/js/plugins/slimscroll/jquery.slimscroll.min.js">
</script>
<script src="/Public/Admin/js/plugins/layer/layer.js">
</script>
<script src="/Public/Admin/js/hplus.min.js?v=4.0.0">
</script>
<script src="/Public/Admin/js/contabs.min.js" type="text/javascript">
</script>
<script src="/Public/Admin/js/ajaxfileupload.js" type="text/javascript">
</script>
<script src="/Public/Admin/js/common.js" type="text/javascript">
</script>
<script src="/Public/Admin/js/plugins/pace/pace.min.js">
</script>
    
    <script>
        $('.upImg').click(function(){
            $('#upfile').trigger('click');
            return false;
        })

        $('#upfile').change(function(){
            $.ajaxFileUpload({
                url: "<?php echo U('Upload/uploadImg');?>",
                secureuri: false,
                fileElementId: 'upfile',
                dataType: 'json',
                success: function (data) {
                    if (data['status'] == 1) {
                        $('[name=content]').attr('value', data['info']);
                    } else {
                        layer.alert(data.info);
                    }
                },
                error: function (data) {
                    alert(data);
                }
            });
            return false;
        })

        function reviewImg(dom) {
            var path = $('[name=content]').attr('value');
            if (path == '' || path == undefined) {
                layer.alert('请先上传广告图');
                return false;
            }

            layer.open({
              type: 1,
              title: false,
              closeBtn: 0,
              area: '516px',
              skin: 'layui-layer-nobg', //没有背景色
              shadeClose: true,
              content: '<img src="'+path+'" />',
            });
            return false;
        }
    </script>

</body>
</html>