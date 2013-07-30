<?php

// Checking for any message sent over from the previous page
// $this->session->flashdata('msg') != ""
if (trim($this->session->flashdata('msg')) != "") {
    $msg = $this->session->flashdata('msg');
    $class = "error";
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>favicon.ico">
    <title>AHIS - Animal Health Information System</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/login.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/ahis-custom.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet'>
    <!-- jQuery framework -->
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <!-- validation -->
    <script src="<?php echo base_url(); ?>js/lib/jquery-validation/jquery.validate.js"></script>
    <script type="text/javascript">
        (function(a){a.fn.vAlign=function(){return this.each(function(){var b=a(this).height(),c=a(this).outerHeight(),b=(b+(c-b))/2;a(this).css("margin-top","-"+b+"px");a(this).css("top","50%");a(this).css("position","absolute")})}})(jQuery);(function(a){a.fn.hAlign=function(){return this.each(function(){var b=a(this).width(),c=a(this).outerWidth(),b=(b+(c-b))/2;a(this).css("margin-left","-"+b+"px");a(this).css("left","50%");a(this).css("position","absolute")})}})(jQuery);
        $(document).ready(function() {
            // put the cursor in the username textfield
            document.forms[0].username.focus();
            // Do validation
            if($('#login-wrapper').length) {
                $("#login-wrapper").vAlign().hAlign()
            };
            if($('#login-validate').length) {
                $('#login-validate').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    rules: {
                        username: { required: true },
                        password: { required: true }
                    }
                })
            }
            if($('#forgot-validate').length) {
                $('#forgot-validate').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    rules: {
                        email: { required: true, email: true }
                    }
                })
            }
            $('#pass_login').click(function() {
                $('.panel:visible').slideUp('200',function() {
                    $('.panel').not($(this)).slideDown('200');
                });
                $(this).children('span').toggle();
            });
        });
    </script>
</head>
<body>
<div id="login-logo">

    </div>
    <div id="login-wrapper" class="clearfix">
    
        <div class="main-col">

            <div class="panel">
                <p class="heading_main">Account Login</p>
                <?php if (isset($msg) && trim($msg) != "") { echo '<p class="'.$class.'">' . $msg . '</p>'; } ?>
                <form id="login-validate" action="<?php echo base_url()."login/validate"; ?>" method="post">
                    <label for="username">Login</label>
                    <input type="text" id="username" name="username" value="" />
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" value="" />
                    <label for="login_remember" class="checkbox"><input type="checkbox" id="login_remember" name="login_remember" /> Remember me</label>
                    <div class="submit_sect">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
            <div class="panel" style="display:none">
                <p class="heading_main">Can't sign in?</p>
                <form id="forgot-validate" method="post" action="<?php echo base_url()."login/password_reset"; ?>">
                    <label for="email">Your email adress</label>
                    <input type="text" id="email" name="email" />
                    <div class="submit_sect">
                        <button type="submit" class="btn btn-success">Request New Password</button>
                    </div>
                </form>
            </div>
            <div class="login_links">
            <a href="javascript:void(0)" id="pass_login"><span>Forgot password?</span><span style="display:none">Account login</span></a>
        </div>
        </div>
        
    </div>
</body>
</html>