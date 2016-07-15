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
                        栏目管理
                    </span>
                </a>
            </li>
            <li>
                <a href="<?php echo U('WithdrawLog/index');?>">
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
                            添加权限  用户名：<?php echo ($list['username']); ?>
                        </h5>
                    </div>
                    <div class="ibox-content">
                            <div class="hr-line-dashed">
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">
                                    栏目管理：
                                  </label>
                                <form action="<?php echo U('level');?>" method=post>
                                    <input name="select[]" type="checkbox" value="11"<?php if(in_array('11',$level)){?> checked <?php }?> />添加&nbsp;
                                    <input name="select[]" type="checkbox" value="12"<?php if(in_array('12',$level)){?> checked <?php }?> />删除&nbsp;
                                    <input name="select[]" type="checkbox" value="13" <?php if(in_array('13',$level)){?> checked <?php }?>/>编辑&nbsp;
                                    <input name="select[]" type="checkbox" value="14" <?php if(in_array('14',$level)){?> checked <?php }?>/>查看&nbsp;

                                      <div class="hr-line-dashed">
                                      </div>
                                     <label class="col-sm-2 control-label">
                                        提现记录：
                                      </label>
                                      <input name="select[]" type="checkbox" value="21"<?php if(in_array('21',$level)){?> checked <?php }?>/>查看
                                      <div class="hr-line-dashed">
                                      </div>
                                     <label class="col-sm-2 control-label">
                                        文章管理：
                                      </label>
                                      <input name="select[]" type="checkbox" value="31"<?php if(in_array('31',$level)){?> checked <?php }?> />添加 &nbsp;
                                      <input name="select[]" type="checkbox" value="32"<?php if(in_array('32',$level)){?> checked <?php }?>/>删除 &nbsp;
                                      <input name="select[]" type="checkbox" value="33"<?php if(in_array('33',$level)){?> checked <?php }?> />编辑&nbsp;
                                      <input name="select[]" type="checkbox" value="34"<?php if(in_array('34',$level)){?> checked <?php }?> />查看&nbsp;
                                      <div class="hr-line-dashed">
                                      </div>
                                     <label class="col-sm-2 control-label">
                                        问答管理：
                                      </label>
                                      <input name="select[]" type="checkbox" value="41"<?php if(in_array('41',$level)){?> checked <?php }?> />添加 &nbsp;
                                      <input name="select[]" type="checkbox" value="42"<?php if(in_array('42',$level)){?> checked <?php }?> />删除 &nbsp;
                                      <input name="select[]" type="checkbox" value="43"<?php if(in_array('43',$level)){?> checked <?php }?> />编辑&nbsp;
                                      <input name="select[]" type="checkbox" value="44"<?php if(in_array('44',$level)){?> checked <?php }?> />查看&nbsp;
                                      <div class="hr-line-dashed">
                                      </div>
                                     <label class="col-sm-2 control-label">
                                        广告管理：
                                      </label>
                                      <input name="select[]" type="checkbox" value="51"<?php if(in_array('51',$level)){?> checked <?php }?> />添加 &nbsp;
                                      <input name="select[]" type="checkbox" value="52"<?php if(in_array('52',$level)){?> checked <?php }?> />删除 &nbsp;
                                      <input name="select[]" type="checkbox" value="53"<?php if(in_array('53',$level)){?> checked <?php }?> />编辑&nbsp;
                                      <input name="select[]" type="checkbox" value="54"<?php if(in_array('54',$level)){?> checked <?php }?> />查看&nbsp;
                                      <input type="hidden" name="id" value="<?php echo $list['0']['id'] ?>" />
                                      <div class="hr-line-dashed">
                                      </div>
                                      <div class="col-sm-4 col-sm-offset-2">
                                           <input class="btn btn-primary"value="提交权限" type=submit>&nbsp;
                                           <a href="<?php echo U('/admin/admin');?>"><input class="btn btn-primary"value="取消" ></a>
                                      </div>
                                </form>
                            </div>
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
    
</body>
</html>