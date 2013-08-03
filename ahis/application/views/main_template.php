<!DOCTYPE HTML>
<html lang="en-US">
    <head>

        <meta charset="UTF-8">
        <title>AHIS - Animal Health Information System</title>
        <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>favicon.ico">
        
     <!-- common stylesheets-->
        <!-- bootstrap framework css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <!-- google web fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Abel">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300">

        <!-- aditional stylesheets -->
        <!-- main stylesheets -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/ahis-main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/ahis-custom.css">

        <!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css"><![endif]-->
        <!--[if IE 9]><link rel="stylesheet" href="css/ie9.css"><![endif]-->
            
        <!--[if lt IE 9]>
            <script src="js/ie/html5shiv.min.js"></script>
            <script src="js/ie/respond.min.js"></script>
            <script src="js/lib/flot-charts/excanvas.min.js"></script>
        <![endif]-->

    </head>
    <body class="bg_d">
    <!-- main wrapper (without footer) -->
        <div class="main-wrapper">
        
        <!-----Start my top bar-------->
        <div class="mybar">
        <!-- header -->
            <header>
                <div class="container">
                    <div class="row">
                        <div class="span3">
                            <div class="main-logo"><a href="dashboard"><img src="<?php echo base_url(); ?>img/logo.png" alt="AHIS Admin"></a></div>
                        </div>
                        
                        <div class="span9">
                            <div class="user-box">
                                <div class="user-box-inner">
                                    <img src="<?php echo base_url(); ?>assets/avatars/<?php echo $this->session->userdata('avatar'); ?>" alt="My Photo" class="user-avatar img-avatar">
                                    <div class="user-info">
                                        Welcome, <strong><?php echo $this->session->userdata('fullname'); ?></strong>
                                        <ul class="unstyled">
                                            <li><a href="<?php echo base_url(); ?>user/profile">My Profile</a></li>
                                            <li>&middot;</li>
                                            <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        <!-- top bar -->
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <div class="pull-right top-search">
                            <form action="" >
                                <input type="text" name="q" id="q-main">
                                <button class="btn"><i class="icon-search"></i></button>
                            </form>
                        </div>
                        <div id="fade-menu" class="pull-left">
                            <ul class="clearfix" id="mobile-nav">
                                
                                <li>
                                    <a href="<?php echo base_url() . 'dashboard'; ?>"><i class="icsw16-home icsw16-white"></i>&nbsp;&nbsp;Home</a>                                    
                                </li>
                                
                                <li><a href="javascript:void(0)"><i class="icsw16-documents icsw16-white"></i>&nbsp;&nbsp;Incidents</a>
                                  <ul>
                                        <li>
                                            <a href="<?php echo base_url(); ?>incident/create">Open New Incident</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>incident/listing">Open Existing Incident</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0)"><i class="icsw16-chart-5 icsw16-white"></i>&nbsp;&nbsp;Reports</a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo base_url(); ?>report/create">Create New Report</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>report/listing">Open Existing Report</a>
                                        </li>
                                    </ul>
                                </li>
                                </li>
                                <li><a href="javascript:void(0)"><i class="icsw16-user icsw16-white"></i>&nbsp;&nbsp;Persons</a>
                                 <ul>
                                        <li>
                                            <a href="<?php echo base_url(); ?>persons/manage">Manage</a>
                                        </li>
                                        
                                    </ul>                                   
                                </li>
                                <li><a href="javascript:void(0)"><i class="icsw16-user icsw16-white"></i>&nbsp;&nbsp;Users</a>
                                 <ul>
                                        <li>
                                            <a href="<?php echo base_url(); ?>user/accounts">User Accounts</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>user/roles">User Roles</a>
                                        </li>
                                    </ul>                                   
                                </li>
                                
                                <li><a href="javascript:void(0)"><i class="icsw16-megaphone icsw16-white"></i>&nbsp;&nbsp;System Setup</a>
                                 <ul>
                                        <li>
                                            <a href="<?php echo base_url(); ?>setup/diseases">Diseases</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url(); ?>setup/locations">Locations</a>
                                        </li>
                                    </ul>
                                <li><a href="javascript:void(0)"><i class="icsw16-alert-2 icsw16-white"></i>&nbsp;&nbsp;Help</a>                                   
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End my top bar -->
        
        <!-- breadcrumbs -->
        <div class="container">
            <ul id="breadcrumbs">
                <li><a href="<?php echo base_url(); ?>dashboard"><i class="icon-home"></i></a></li>
            </ul>
        </div>
            
        <!-- main content -->
        <div class="container">

        <!-- NOTIFICATIONS START -->
        <?php

        // First, initialize the message variable
        $message = "";

        // Initialize the $style and $prompt variables just in case
        $style = ' alert-success';
        $prompt = '';

        /*
        Check if there is any flash data
        Check if instead we have flash data message ... this always supersedes any other message
        */
        @ $flash_data_message = $this->session->flashdata('message');
        if (isset($flash_data_message) && trim($flash_data_message) != "") {
            // set the $message variable to the flash data message ... overriding any other message sent to the 
            $message .= "<div class='flash-data-message'>".$flash_data_message."</div>";
        }

        /* 
        Now that we are done with the flash data ... proceed to check for other notification messages sent over
        Check if the $msg variable is set
        The $msg variable is constructed as follows ...
        $msg = array(
                'type' => 'warning | error | success | notification',
                'message' => 'Your message goes here ...'
            );
        It is envisaged that each view load will have a single message OR none at all
        The various message types have the following colours
        a) warning - yellow
        b) error - red/pink
        c) success - green
        d) notification - blue
        The value of 'type' in the $msg array determines the kind of warning/notification loaded
        If no value is defined for 'type', 'success' is used by default
        */

        // Check for any $msg array variable sent over
        if ( (isset($msg) && is_array($msg)) || (isset($msg) && trim($msg) != "") ) {

            // ARRAY MESSAGE
            if (is_array($msg)) {
                $available_types = array('warning','error','success','notification');
                $message_type = (in_array($msg['type'], $available_types)) ? $msg['type'] : 'success';

                // Set the style based on the passed on message type value
                switch ($message_type) {

                    // warning
                    case 'warning':
                        $style = '';
                        $prompt = '';
                        break;

                    // error
                    case 'error':
                        $style = ' alert-error';
                        $prompt = '';
                        break;

                    // success
                    case 'success':
                        $style = ' alert-success';
                        $prompt = '';
                        break;

                    // notification
                    case 'notification':
                        $style = ' alert-info';
                        $prompt = '';
                        break;

                    // default
                    default:
                        $style = ' alert-success';
                        $prompt = '';
                        break;            
                }

                // Now grab the message
                $message .= "<div class='generic-notification-message'>".$msg['message']."</div>";

            }   // Message passed in as an array

            // NON-ARRAY MESSAGE
            if (!is_array($msg)) {
                $message = $msg;
            }

        }   // Checking if there is a $msg variable

        ?>

        <?php if (trim($message) != "") { ?>
        <div class="w-box-content cnt_a">
            <div class="alert<?php echo $style; ?>">
                <a data-dismiss="alert" class="close">×</a>
                <strong><?php echo $prompt; ?></strong><?php echo $message; ?>
            </div>
        </div>
        <?php } ?>

        <!-- NOTIFICATIONS END -->

        <!-- LOAD THE VIEW HERE : START -->
        <?php $this->load->view($view); ?>
        <!-- LOAD THE VIEW HERE : END -->
        
        </div>
        </div>
        <div class="footer_space"></div>

    	<!-- footer --> 
        <footer>
            <div class="container">
                <div class="row">
                    <div class="span5">
                        <div>&copy; FAO SOMALIA <?php echo date('Y'); ?></div>
                    </div>
                    <div class="span7">
                        <ul class="unstyled">
                            <li><a href="<?php echo base_url(); ?>help/index.html">Documentation</a></li>
                            <li>&middot;</li>
                            <li><a href="<?php echo base_url(); ?>system/settings">System Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        
    <!-- Common JS -->
        <!-- jQuery framework -->
            <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
            <script src="<?php echo base_url(); ?>js/jquery-migrate.js"></script>
        <!-- bootstrap Framework plugins -->
            <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <!-- top menu -->
            <script src="<?php echo base_url(); ?>js/jquery.fademenu.js"></script>
        <!-- top mobile menu -->
            <script src="<?php echo base_url(); ?>js/selectnav.min.js"></script>
        <!-- actual width/height of hidden DOM elements -->
            <script src="<?php echo base_url(); ?>js/jquery.actual.min.js"></script>
        <!-- jquery easing animations -->
            <script src="<?php echo base_url(); ?>js/jquery.easing.1.3.min.js"></script>
        <!-- power tooltips -->
            <script src="<?php echo base_url(); ?>js/lib/powertip/jquery.powertip-1.1.0.min.js"></script>
        <!-- date library -->
            <script src="<?php echo base_url(); ?>js/moment.min.js"></script>
        <!-- common functions -->
            <script src="<?php echo base_url(); ?>js/ahis_common.js"></script>


    <!-- Dashboard JS -->
        <!-- jQuery UI -->
            <script src="<?php echo base_url(); ?>js/lib/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
        <!-- touch event support for jQuery UI -->
            <script src="<?php echo base_url(); ?>js/lib/jquery-ui/jquery.ui.touch-punch.min.js"></script>
        <!-- colorbox -->
            <script src="<?php echo base_url(); ?>js/lib/colorbox/jquery.colorbox.min.js"></script>
        <!-- fullcalendar -->
            <script src="<?php echo base_url(); ?>js/lib/fullcalendar/fullcalendar.min.js"></script>
        <!-- flot charts -->
            <script src="<?php echo base_url(); ?>js/lib/flot-charts/jquery.flot.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/flot-charts/jquery.flot.resize.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/flot-charts/jquery.flot.pie.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/flot-charts/jquery.flot.orderBars.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/flot-charts/jquery.flot.tooltip.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/flot-charts/jquery.flot.time.js"></script>
        <!-- responsive carousel -->
            <script src="<?php echo base_url(); ?>js/lib/carousel/plugin.min.js"></script>
        <!-- responsive image grid -->
            <script src="<?php echo base_url(); ?>js/lib/wookmark/jquery.imagesloaded.min.js"></script>
            <script src="<?php echo base_url(); ?>js/lib/wookmark/jquery.wookmark.min.js"></script>

            <script src="<?php echo base_url(); ?>js/pages/ahis_dashboard.js"></script>

    </body>
</html>
