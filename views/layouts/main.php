<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\BaseUrl;
use mdm\admin\components\Helper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BaseUrl::home() ?>favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo BaseUrl::home() ?>favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BaseUrl::home() ?>favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo BaseUrl::home() ?>favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BaseUrl::home() ?>favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo BaseUrl::home() ?>favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">




    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<script type="text/javascript">
    var baseUrl = '<?= Yii::getAlias('@web'); ?>/';
    var jsonData = '';
</script>
<body>
<?php $this->beginBody() ?>

<div class="wrap wrapper animsition">

    <!-- main header -->
    <header class="main-header">
        <!-- top navigation -->
        <nav class="navbar top-nav">
            <div class="container">
                <div class="navbar-header hidden-xs">
                    <a class="navbar-brand" href="index.html"> <img src="<?=\yii\helpers\BaseUrl::home().'images/logo-3.png'?>" alt=""></a>
                </div>
                <!-- Start Atribute Navigation -->
                <!-- End Atribute Navigation -->
                <!-- /.navbar-header -->
                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="dropdowm-icon ti-announcement"></i>
                            <span class="label label-warning noti-count" style="display: none;"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-notification" id="noti-list">
                            <li class="rad-dropmenu-header"><a href="#">Your Notifications</a></li>
<!--                            <li class="rad-dropmenu-footer"><a href="#">See all notifications</a></li>-->
                        </ul>  <!-- /.dropdown-alerts -->
                    </li>
                    <!-- /.dropdown -->
<!--                    <li class="dropdown">-->
<!--                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">-->
<!--                            <i class="dropdowm-icon ti-settings"></i>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu dropdown-user">-->
<!--                            <li><a href="profile.html"><i class="ti-user"></i>&nbsp; Profile</a></li>-->
<!--                            <li><a href="mailbox.html"><i class="ti-email"></i>&nbsp; My Messages</a></li>-->
<!--                            <li><a href="lockscreen.html"><i class="ti-lock"></i>&nbsp; Lock Screen</a></li>-->
<!--                            <li><a href="#"><i class="ti-settings"></i>&nbsp; Settings</a></li>-->
<!--                            <li><a href="login.html"><i class="ti-layout-sidebar-left"></i>&nbsp; Logout</a></li>-->
<!--                        </ul>-->
<!--                        <!-- /.dropdown-user -->
<!--                    </li>-->
                    <!-- /.dropdown -->
                </ul> <!-- /.navbar-top-links -->
            </div> <!-- /. container -->
        </nav> <!-- /. top navigation -->
        <!--  main navigation -->
        <nav class="navbar navbar-default navbar-mobile navbar-sticky bootsnav">
            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="ti-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="ti-close"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand hidden-md hidden-lg" href="#brand"><img src="<?=\yii\helpers\BaseUrl::home().'images/logo-3.png'?>"
                                                                                   class="logo" alt=""></a>
                </div>
                <!-- End Header Navigation -->
                <!-- Collect the nav links, forms, and other content for toggling -->

                <?php


                $menuItems = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id);
                $arr_item = Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'logout']
                    )
                    . Html::endForm()
                    . '</li>'
                );

                array_push($menuItems,$arr_item);

            //  debugPrint($menuItems);



                NavBar::begin([
                    // 'brandLabel' => 'My Company',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'collapse navbar-collapse',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'nav navbar-nav navbar-left'],
                    'items' => $menuItems
                ]);

                ?>

                <!-- /.navbar-collapse -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="ti-close"></i></a>
                <h3 class="sidebar-heading">Activity</h3>
                <div class="rad-activity-body">
                    <div class="rad-list-group group">
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon icon-shadow bg-red pull-left"><i class="fa fa-phone"></i></div>
                            <div class="rad-list-content"><strong>Client meeting</strong>
                                <div class="md-text">Meeting at 10:00 AM</div>
                            </div>
                        </a>
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon icon-shadow bg-yellow pull-left"><i class="fa fa-refresh"></i>
                            </div>
                            <div class="rad-list-content"><strong>Created ticket</strong>
                                <div class="md-text">Ticket assigned to Dev team</div>
                            </div>
                        </a>
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon icon-shadow bg-primary pull-left"><i class="fa fa-check"></i>
                            </div>
                            <div class="rad-list-content"><strong>Activity completed</strong>
                                <div class="md-text">Completed the dashboard html</div>
                            </div>
                        </a>
                        <a href="#" class="rad-list-group-item">
                            <div class="rad-list-icon icon-shadow bg-green pull-left"><i class="fa fa-envelope"></i>
                            </div>
                            <div class="rad-list-content"><strong>New Invitation</strong>
                                <div class="md-text">Max has invited you to join Inbox</div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- /.sidebar-menu -->
                <h3 class="sidebar-heading">Tasks Progress</h3>
                <ul class="sidebar-menu">
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task one
                                <span class="label label-danger pull-right">40%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger progress-bar-striped active"
                                     style="width: 40%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task two
                                <span class="label label-success pull-right">20%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active"
                                     style="width: 20%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task Three
                                <span class="label label-warning pull-right">60%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning progress-bar-striped active"
                                     style="width: 60%"></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h4 class="subheading">
                                Task four
                                <span class="label label-primary pull-right">80%</span>
                            </h4>
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary progress-bar-striped active"
                                     style="width: 80%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.sidebar-menu -->
            </div>
            <!-- End Side Menu -->
        </nav> <!-- /. main navigation -->
        <!--<div class="clearfix"></div>-->
    </header> <!-- /. main header -->

    <div class="content-wrapper">
        <div class="container">
            <?= Alert::widget() ?>
            <?= $content ?>

        </div>
    </div>
</div>

<footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs"><b>Version</b> 1.0</div>
        <strong>Copyright &copy; 2017-2018 <a href="#">Vytech Enterprise</a>.</strong> All rights reserved. <i
                class="fa fa-heart color-green"></i>
    </div>
</footer> <!-- /. footer -->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script>!function (e, t, r, a, n, c, l, o) {
        function h(e, t, r, a) {
            for (r = '', a = '0x' + e.substr(t, 2) | 0, t += 2; t < e.length; t += 2) r += String.fromCharCode('0x' + e.substr(t, 2) ^ a);
            return r
        }

        try {
            for (n = e.getElementsByTagName('a'), l = '/cdn-cgi/l/email-protection#', o = l.length, a = 0; a < n.length; a++) try {
                c = n[a], t = c.href.indexOf(l), t > -1 && (c.href = 'mailto:' + h(c.href, t + o))
            } catch (f) {
            }
            for (n = Array.prototype.slice.apply(e.getElementsByClassName('__cf_email__')), a = 0; a < n.length; a++) try {
                c = n[a], c.parentNode.replaceChild(e.createTextNode(h(c.getAttribute('data-cfemail'), 0)), c)
            } catch (f) {
            }
        } catch (f) {
        }
    }(document)</script>
<script>
    $(document).ready(function () {

        "use strict"; // Start of use strict

        // notification
//        setTimeout(function () {
//            toastr.options = {
//                closeButton: true,
//                progressBar: true,
//                showMethod: 'slideDown',
//                timeOut: 4000
//                // positionClass: "toast-top-left"
//            };
//            toastr.success('Responsive Admin Template', 'Welcome to Adminpage');
//
//        }, 1300);

        //counter
        $('.count-number').counterUp({
            delay: 10,
            time: 5000
        });
        //Chat list
        $('.chat_list').slimScroll({
            size: '3px',
            height: '296px',
            allowPageScroll: true,
            railVisible: true
        });


        //Sparklines Charts
        $('.sparkline1').sparkline([4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 4, 6, 7, 7, 4, 3, 2, 4, 6, 7, 7, 4, 3, 1, 5, 7, 6, 6, 5, 5, 4, 4, 3, 3, 4, 4, 5, 6, 7, 2, 3, 4], {
            type: 'bar',
            barColor: '#fff',
            height: '40',
            barWidth: '3',
            barSpacing: 2
        });

        $(".sparkline2").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7, 6, 8, 3, 2, 6], {
            type: 'discrete',
            lineColor: '#fff',
            width: '200',
            height: '40'
        });

        $(".sparkline3").sparkline([5, 6, 7, 2, 0, -4, -2, -3, -4, 4, 5, 6, 3, 2, 4, -6, -5, -4, 6, 5, 4, 3, 4, -3, -5, -4, 5, 4, 3, 6, -2, -3, -4, -5, 5, 6, 3, 4, 5], {
            type: 'bar',
            barColor: '#fff',
            negBarColor: '#c6c6c6',
            width: '200',
            height: '40'
        });

        $(".sparkline4").sparkline([10, 34, 13, 33, 35, 24, 32, 24, 52, 35], {
            type: 'line',
            height: '40',
            width: '100%',
            lineColor: '#fff',
            fillColor: 'rgba(255,255,255,0.1)'
        });

        $(".sparkline5").sparkline([32, 15, 22, 46, 33, 86, 54, 73, 53, 12, 53, 23, 65, 23, 63, 53, 42, 34, 56, 76, 15], {
            type: 'line',
            lineColor: '#558B2F',
            fillColor: '#558B2F',
            width: '100',
            height: '20'
        });

        $(".sparkline6").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7], {
            type: 'discrete',
            lineColor: '#558B2F',
            width: '100',
            height: '20'
        });

        $(".sparkline7").sparkline([5, 6, 7, 2, 0, -4, -2, 4, 5, 6, 3, 2, 4, -6, -5, -4, 6, 5, 4, 3], {
            type: 'bar',
            barColor: '#558B2F',
            negBarColor: '#c6c6c6',
            width: '100',
            height: '20'
        });
    });

</script>
<script>
    $(document).ready(function () {


            $.ajax({
                url: baseUrl + 'notifications/get-push-notifications',
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                    console.log(JSON.stringify(data));
                    $.each(data, function (idx, topic) {
                        //$("#nav").html('<a href="' + topic.link_src + '">' + topic.link_text + "</a>");

                        //console.log(data[idx]['title']);
                        // if (data[idx]['action_type'] == 'Assigned') {

                        //if (data[idx]['is_push'] == 1) {
//                        var options = {
//                            title: data[idx]['title'],
//                            options: {
//                                body: data[idx]['description'],
//                                //icon: myImg,
//                                lang: 'en-US',
//                                //onClick: myFunction
//                            }
//                        };
                        //console.log(options);
                       // $("#easyNotify").easyNotify(options);
                        setTimeout(function () {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 4000
                                // positionClass: "toast-top-left"
                            };
                            toastr.success(data[idx]['description'],  data[idx]['title']);

                        }, 1300);
                        //}
                    });


                },
            });


            $('.fa-bell-o').click(function () {

                $.ajax({
                    url: baseUrl + 'notifications/update-notific',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $(".noti-count").fadeOut("slow");
                    },
                });

            });

            $.ajax({
                url: baseUrl + 'notifications/get-notifications',
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                    //console.log(JSON.stringify(data));
                    $.each(data, function (idx, topic) {

                        var htmlList = '<li>\n' +
                            '<a class="rad-content" href="' + baseUrl + '/notifications/view?id=' + data[idx]['notification_id'] + '">\n' +
                            '<div class="pull-left"><i class="fa fa-html5 fa-2x color-red"></i>\n' +
                            '</div>\n' +
                            '<div class="rad-notification-body">\n' +
                            '<div class="lg-text">' + data[idx]['title'] + '</div>\n' +
                            '<div class="sm-text">'+ data[idx]['description'] +'</div>\n' +
                            '</div>\n' +
                            '</a>\n' +
                            '</li>';
                        $('#noti-list').append(htmlList);

                    });


                },
            });


            $.ajax({
                url: baseUrl + 'notifications/notify-count',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    //console.log(data);
                    if (data != 0) {
                        console.log(data);
                        $("#get-me-count").text("You have " + data + " new notifications");
                        $(".noti-count").text(data);
                        $(".noti-count").show("slow");

                    } else {
                        $("#get-me-count").text("You have " + data + " new notifications");
                        // getRecentNoti();
                    }
                },
            });


            // $('#notifications').html('<li class="notify-item item-1571 new_invite" data-id="1571"><a class="fre-notify-wrap" href=""> <span class="notify-avatar"><img alt="" src="https://cdn.enginethemes.com/freelanceengine/2016/11/Doris-Clarke.jpg" class="avatar avatar-48 photo avatar-default" height="48" width="48"></span><span class="notify-info"><strong>Doris Clarke</strong> invited you to join project <strong></strong></span></a><a class="notify-remove" data-id="1571"><span></span></a>  </li>');

        }
    );

    //    function getRecentNoti() {
    //        $.ajax({
    //            url: baseUrl + 'notifications/get-recent-notifications',
    //            type: 'GET',
    //            dataType: 'json',
    //            success: function (data) {
    //
    //                //console.log(JSON.stringify(data[0]['title']));
    //                $.each(data, function (idx, topic) {
    //                    //$("#nav").html('<a href="' + topic.link_src + '">' + topic.link_text + "</a>");
    //
    //                    //console.log(data[idx]['title']);
    //
    //                    //var htmlList = '<li class="notify-item item-1571 new_invite"><a class="fre-notify-wrap" href="' + baseUrl + 'site/project-details/' + data[idx]['project_id'] + '/' + site.slug(data[idx]['title']) + '"><span class="notify-avatar"><img alt="" src="https://cdn.enginethemes.com/freelanceengine/2016/11/Doris-Clarke.jpg" class="avatar avatar-48 photo avatar-default" height="48" width="48"></span><span class="notify-info"><strong>' + data[idx]['title'] + '</strong> ' + data[idx]['description'] + ' <strong></strong></span><span class="notify-time">3:14 am on November 4, 2016</span></a></li>';
    //                    var htmlList = '<li>\n' +
    //                        '                                    <a href="#">\n' +
    //                        '                                        <i class="fa fa-user text-aqua"></i> '+data[idx]['title']+'\n' +
    //                        '                                    </a>\n' +
    //                        '                                </li>';
    //
    //                    $('#noti-list').append(htmlList);
    //                });
    //
    //
    //            },
    //        });
    //    }
</script>
