<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Kullanıcı Girişi</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        {{css('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}
        {{css('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}
        {{css('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}
        {{css('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {{css('assets/global/plugins/select2/css/select2.min.css')}}
        {{css('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        {{css('assets/global/css/components.min.css')}}t/css" />
        {{css('assets/global/css/plugins.min.css')}}
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        {{css('assets/pages/css/login.min.css')}}
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="{{asset('favicon.ico')}}" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="{{route('homePage')}}">
                <img src="{{asset('assets/pages/img/logo-big.png')}}" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            {{Form::open(['route' => 'login', 'class' => 'login-form'])}}
                <h3 class="form-title font-green">Giriş Yap</h3>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Bilgileri eksiksiz olarak doldurunuz. </span>
                </div>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Kullanıcı Adı</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Şifre</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn green uppercase">Giriş Yap</button>
                </div>
            </form>
            <!-- END LOGIN FORM -->
            <!-- END REGISTRATION FORM -->
        </div>
        <div class="copyright"> KobiLab </div>
        <!--[if lt IE 9]>
        {{script('assets/global/plugins/respond.min.js')}}
        {{script('assets/global/plugins/excanvas.min.js')}}
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        {{script('assets/global/plugins/jquery.min.js')}}
        {{script('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}
        {{script('assets/global/plugins/js.cookie.min.js')}}
        {{script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}
        {{script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}
        {{script('assets/global/plugins/jquery.blockui.min.js')}}
        {{script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        {{script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}
        {{script('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}
        {{script('assets/global/plugins/select2/js/select2.full.min.js')}}
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        {{script('assets/global/scripts/app.min.js')}}
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        {{script('assets/pages/scripts/login.min.js')}}
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>