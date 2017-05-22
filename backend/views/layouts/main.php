<?php

/**
 * @var $content string
 */

use yii\helpers\Html;
use common\widgets\Alert;
use backend\models\Cart;
use backend\models\Inventory;

yiister\adminlte\assets\Asset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <script>
        $("#language").click(function(){
            alert("clicked");
        });

    </script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>G</b>ED</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>G-EDU</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>

                        <span style="margin-top: 50px;font-family: Tahoma;color: #ccc;">
                        <?php

                        if (!Yii::$app->user->isGuest) {
                            $user_id=Yii::$app->user->identity->id;
                            ?>

                            <?=  \backend\models\AuthItem::getRoleName(\backend\models\AuthAssignment::getRoleByUserId($user_id));?> @ <?php echo \backend\models\Branch::getBranchName(\backend\models\Employee::getBranchID(Yii::$app->user->identity->emp_id));?>
                        <?php }?>
                        </span>
            </a>
            <div id="user_id" hidden><?php
                if (!Yii::$app->user->isGuest) {
                    echo $userdept = \backend\models\Employee::getDepartmentID(Yii::$app->user->identity->emp_id);
                }
                ?></div>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

                    <!-- Status -->

                <ul class="nav navbar-nav">
                    <!-- Languages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">

                    </li><!-- /.Languages-menu -->


                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">
                                <?php
                                if (!Yii::$app->user->isGuest) {
                                   echo Yii::$app->user->identity->username;
                                }
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="http://placehold.it/160x160" class="img-circle" alt="User Image">
                                <p>
                                    <?php
                                   if (!Yii::$app->user->isGuest) {

                                       echo Yii::$app->user->identity->username;

                                   }

                                    ?>

                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?php
                                    if(!Yii::$app->user->isGuest) {
                                        echo Html::beginForm(['/user/profile','id' => $user_id], 'post');
                                        echo Html::submitButton(
                                            'My profile',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }?>
                                </div>
                                <div class="pull-right">
                                    <?php
                                    if(!Yii::$app->user->isGuest) {
                                        echo Html::beginForm(['/site/logout'], 'post');
                                        echo Html::submitButton(
                                            'Logout',
                                            ['class' => 'btn btn-link logout']
                                        );
                                        echo Html::endForm();
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">

            </div>

            <!-- Sidebar Menu -->
            <?php if (!Yii::$app->user->isGuest) {?>
            <?=

            \yiister\adminlte\widgets\Menu::widget(
                [
                    "items" => [
                        ["label" =>Yii::t('app','Home'), "url" =>  Yii::$app->homeUrl, "icon" => "home"],

                        [
                                "label" =>Yii::t('app','Expenditures'),
                                "url" =>  ["#"],
                                "icon" => "fa fa-money",
                            "items" => [

                                [
                                    'visible' => yii::$app->User->can('BranchManager')|| yii::$app->User->can('Accountant')|| yii::$app->User->can('admin'),
                                    "label" =>  Yii::t('app', 'New Expenditure'),
                                    "url" => ["/expenditure/create"],
                                    "icon" => "fa fa-plus",
                                ],

                                [
                                    'visible' => yii::$app->User->can('BranchManager')|| yii::$app->User->can('Accountant')|| yii::$app->User->can('admin'),
                                    "label" => "Expenditures list",
                                    "url" =>["/expenditure/index"],
                                    "icon" => "fa fa-eye",
                                ],
                                [
                                    'visible' => yii::$app->User->can('BranchManager')|| yii::$app->User->can('Accountant')|| yii::$app->User->can('admin'),
                                    "label" => "Pending expenditures",
                                    "url" =>["/expenditure/pending"],
                                    "icon" => "fa fa-eye",
                                ],

                                [
                                    'visible' => yii::$app->User->can('Accountant')|| yii::$app->User->can('admin'),
                                    "label" => "Add expenditure type",
                                    "url" =>["/expenditure-type/create"],
                                    "icon" => "fa fa-plus",
                                ],

                                [
                                    'visible' => yii::$app->User->can('Accountant')|| yii::$app->User->can('admin'),
                                    "label" => "Expenditure types",
                                    "url" =>["/expenditure-type/index"],
                                    "icon" => "fa fa-eye",
                                ],

                            ]
                        ],

                        [
                                'visible' => yii::$app->User->can('Accountant')||yii::$app->User->can('admin'),
                                "label" =>Yii::t('app','Employees'),
                                "url" =>  ["/employee/index"], "icon" => "fa fa-users",
                        ],

                        [
                                'visible' => yii::$app->User->can('Accountant')||yii::$app->User->can('admin'),
                                "label" =>Yii::t('app','Branches'),
                                "url" =>  ["/branch/index"], "icon" => "fa fa-sitemap",
                        ],

                        [
                            'visible' => yii::$app->User->can('Accountant')||yii::$app->User->can('admin'),
                            "label" =>Yii::t('app','Departments'),
                            "url" =>  ["/department/index"], "icon" => "fa fa-sitemap",
                        ],


                        [
                                'visible' => yii::$app->User->can('BranchManager')||yii::$app->User->can('Accountant')||yii::$app->User->can('admin'),
                                "label" =>Yii::t('app','Reports'),
                                "url" =>  ["/report/index"], "icon" => "fa fa-bar-chart",
                        ],

                        [
                            'visible' =>yii::$app->User->can('Accountant')||yii::$app->User->can('admin'),
                            "label" =>Yii::t('app','Settings'),
                            "url" => "#",
                            "icon" => "fa fa-gears",
                            "items" => [

                                [
                                    'visible' => yii::$app->User->can('Accountant')||yii::$app->User->can('admin'),
                                    "label" => "Payment Method",
                                    "url" =>["/payment-method/index"],
                                    "icon" => "fa fa-angle-double-right",
                                ],
                                [
                                    'visible' =>  yii::$app->User->can('Accountant')||yii::$app->User->can('admin'),
                                    "label" =>  Yii::t('app', 'Users'),
                                    "url" => ["/user/index"],
                                    "icon" => "fa fa-user",
                                ],

                                [
                                    'visible' => yii::$app->User->can('admin'),
                                    'label' => Yii::t('app', 'Manager Permissions'),
                                    'url' => ['/auth-item/index'],
                                    'icon' => 'fa fa-lock',
                                ],
                                [
                                    'visible' => yii::$app->User->can('admin'),
                                    'label' => Yii::t('app', 'Manage User Roles'),
                                    'url' => ['/role/index'],
                                    'icon' => 'fa fa-lock',
                                ],

                            ],
                        ],
                    ],
                ]
            )
            ?>
            <?php }?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?php // Html::encode(isset($this->params['h1']) ? $this->params['h1'] : $this->title) ?>
            </h1>
            <?php if (isset($this->params['breadcrumbs'])): ?>
                <?=
                \yii\widgets\Breadcrumbs::widget(
                    [
                        'encodeLabels' => false,
                        'homeLink' => [
                            'label' => new \rmrevin\yii\fontawesome\component\Icon('home') .Yii::t('app','Home'),
                            "url" =>  Yii::$app->homeUrl,
                        ],
                        'links' => $this->params['breadcrumbs'],
                    ]
                )
                ?>
            <?php endif; ?>
        </section>

        <!-- Main content -->
        <section class="content">
            <div style="padding-top: 10px"><?= Alert::widget() ?></div>
            <?= $content ?>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Powered by Adotech
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; G-Education <?= date("Y") ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript::;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="label label-danger pull-right">70%</span>
                            </h4>
                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul><!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<script>
    $("#expenditure-fund_source").change(function(){
        var id =document.getElementById("expenditure-fund_source").value;
        if(id=='O'){
            $( "#fund_source" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id=='I'){
            $( "#fund_source" ).show( "slow", function() {
            });
        }
        else if(id==""){
            $( "#fund_source" ).show( "slow", function() {
            });
        }


    });


  $(document).ready(function(){
        var id =document.getElementById("expenditure-fund_source").value;
        if(id=='O'){
            $( "#fund_source" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id=='I'){
            $( "#fund_source" ).show( "slow", function() {
            });
        }
        else if(id==""){
            $( "#fund_source" ).show( "slow", function() {
            });
        }


    });

</script>



<script>
    $("#expenditure-fund_source").change(function(){
        var id =document.getElementById("expenditure-fund_source").value;
        if(id=='O'){
            $( "#fund_source" ).hide( "slow", function() {
                //alert( "Animation complete." );
            });
        }
        else if(id=='I'){
            $( "#fund_source" ).show( "slow", function() {
            });
        }
        else if(id==""){
            $( "#fund_source" ).show( "slow", function() {
            });
        }


    });

</script>


<script>
    $(document).ready(function(){
        var id =document.getElementById("user_id").innerHTML;
        //alert(id);
        $.get("<?php echo Yii::$app->urlManager->createUrl(['expenditure-type/filter','id'=>'']);?>"+id,function(data) {

            //alert(data);
            $("#expenditure-type").html(data);

        });
    });

</script>
