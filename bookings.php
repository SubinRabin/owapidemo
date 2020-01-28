<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>API Demo</title>
       <link rel="shortcut icon" type="image/x-icon" href="assets/images/fav.ico">
        <!-- Bootstrap -->
        <link href="skin/dist/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="skin/assets/css/custom.css" rel="stylesheet" media="screen">
        <link href="skin/examples/carousel/carousel.css" rel="stylesheet">
        <link href="skin/updates/update1/css/style01.css" rel="stylesheet" media="screen">   
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="assets/js/html5shiv.js"></script>
          <script src="assets/js/respond.min.js"></script>
        <![endif]-->
        <!-- Fonts -->  
        <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400,300,300italic' rel='stylesheet' type='text/css'>   
        <!-- Font-Awesome -->
        <link rel="stylesheet" type="text/css" href="skin/assets/css/font-awesome.min.css" media="screen" />
       
        <link rel="stylesheet" type="text/css" href="skin/css/fullscreen.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="skin/rs-plugin/css/settings.css" media="screen" />
        <!-- Picker --> 
        <link rel="stylesheet" href="skin/assets/css/jquery-ui.css" />
        <link rel="stylesheet" href="skin/assets/css/daterangepicker.min.css">
        <!-- bin/jquery.slider.min.css -->
        <link rel="stylesheet" href="skin/plugins/jslider/css/jslider.css" type="text/css">
        <link rel="stylesheet" href="skin/plugins/jslider/css/jslider.round.css" type="text/css">    
        <!-- jQuery --> 
        <script src="skin/js/custom.js"></script>
         <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="skin/js/moment.min.js"></script>
        <script src="skin/assets/js/jquery.v2.0.3.js"></script>
        <script type="text/javascript" src="skin/assets/js/jquery.daterangepicker.min.js"></script>
        <script src="skin/assets/js/sweet-alert.js"></script>
        <!-- Sweet-Alert Custom Style -->
        <style>
            .swal2-popup .swal2-styled {
                padding: 3px 15px !important;
            }
            .swal2-popup .swal2-title {
                color: #d03328 !important;
            }
            .swal2-popup .swal2-styled:focus {
                box-shadow: none !important;
            }

            </style>
        <style type="text/css">
  .msgbox.read {
      background: #f2f2f2;
}
 <style>
    .timeline {
      list-style: none;
      padding-left: 0;
      position: relative;
    }
    .timeline:after {
      content: "";
      height: auto;
      width: 1px;
      background: #e3e3e3;
      position: absolute;
      top: 5px;
      left: 30px;
      bottom: 25px;
    }
    .timeline.timeline-sm:after {
      left: 12px;
    }
    .timeline li {
      position: relative;
      padding-left: 70px;
      margin-bottom: 20px;
    }
    .timeline li:after {
      content: "";
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #e3e3e3;
      position: absolute;
      left: 24px;
      top: 5px;
    } 
    .timeline .timeline-icon img {
       border-radius: 50%;
       height: 30px;
    }
    .timeline li .timeline-date {
      display: inline-block;
      width: 100%;
      color: #a6a6a6;
      font-style: italic;
      font-size: 13px;
    }
    .timeline .timeline-icons li {
      padding-top: 7px;
    }
    .timeline.timeline-icons li:after {
      width: 32px;
      height: 32px;
      background: #fff;
      border: 1px solid #e3e3e3;
      left: 14px;
      top: 0;
      z-index: 11;
    }
    .timeline.timeline-icons li .timeline-icon {
      position: absolute;
      left: 23.5px;
      top: 1px;
      z-index: 12;
    }
    .timeline.timeline-icons li .timeline-icon [class*=glyphicon] {
      top: -1px !important;
    }
    .timeline.timeline-icons.timeline-sm li {
      padding-left: 40px;
      margin-bottom: 10px;
    }
    .timeline.timeline-icons.timeline-sm li:after {
      left: -5px;
    }
    .timeline.timeline-icons.timeline-sm li .timeline-icon {
      left: -4.5px;
    }
    .timeline.timeline-advanced li {
      padding-top: 0;
    }
    .timeline.timeline-advanced li:after {
      background: #fff;
      border: 1px solid #29b6d8;
    }
    .timeline.timeline-advanced li:before {
      content: "";
      width: 52px;
      height: 52px;
      border: 10px solid #fff;
      position: absolute;
      left: 4px;
      top: -10px;
      border-radius: 50%;
      z-index: 12;
    }
    .timeline.timeline-advanced li .timeline-icon {
      color: #29b6d8;
    }
    .timeline.timeline-advanced li .timeline-date {
      width: 75px;
      position: absolute;
      right: 5px;
      top: 3px;
      text-align: right;
    }
    .timeline.timeline-advanced li .timeline-title {
      font-size: 17px;
      margin-bottom: 0;
      padding-top: 5px;
      font-weight: bold;
    }
    .timeline.timeline-advanced li .timeline-subtitle {
      display: inline-block;
      width: 100%;
      color: #a6a6a6;
    }
    .timeline.timeline-advanced li .timeline-content {
      margin-top: 10px;
      margin-bottom: 10px;
      padding-right: 70px;
    }
    .timeline.timeline-advanced li .timeline-content p {
      margin-bottom: 3px;
    }
    .timeline.timeline-advanced li .timeline-content .divider-dashed {
      padding-top: 0px;
      margin-bottom: 7px;
      width: 200px;
    }
    .timeline.timeline-advanced li .timeline-user {
      display: inline-block;
      width: 100%;
      margin-bottom: 10px;
    }
    .timeline.timeline-advanced li .timeline-user:before,
    .timeline.timeline-advanced li .timeline-user:after {
      content: " ";
      display: table;
    }
    .timeline.timeline-advanced li .timeline-user:after {
      clear: both;
    }
    .timeline.timeline-advanced li .timeline-user .timeline-avatar {
      border-radius: 50%;
      width: 32px;
      height: 32px;
      float: left;
      margin-right: 10px;
    }
    .timeline.timeline-advanced li .timeline-user .timeline-user-name {
      font-weight: bold;
      margin-bottom: 0;
    }
    .timeline.timeline-advanced li .timeline-user .timeline-user-subtitle {
      color: #a6a6a6;
      margin-top: -4px;
      margin-bottom: 0;
    }
    .timeline.timeline-advanced li .timeline-link {
      margin-left: 5px;
      display: inline-block;
    }
    .timeline-load-more-btn {
      margin-left: 70px;
    }
    .timeline-load-more-btn i {
      margin-right: 5px;
    }
    /* -----------------------------------------
       Dropdown
    ----------------------------------------- */
    .dropdown-menu{
        padding:0 0 0 0;
    }
    a.dropdown-menu-header {
        background: #f7f9fe;
        font-weight: bold;
        border-bottom: 1px solid #e3e3e3;
    }
    .dropdown-menu > li a {
        padding: 10px 20px;
    }
</style>
</head>
<style type="text/css">
    .stay-pay-tag {
        background: red;
        color: white;
        height: 20px;
        display: block;
        line-height: 20px;
        padding: 0px 10px 10px;
        border-bottom-left-radius: 20px;
        border-top-left-radius: 20px;
        font-weight: bolder;
    }
    .b-rates--tax {
      background-color: #eee;
      padding: 10px 10px;
      font-weight: bold;
      margin-bottom: 0;
      color: #455A64;
    }        
    .b-rates--grand {
      margin-top: 0;
      background-color: #5cb85c;
      padding: 15px 10px;
      font-size: 18px;
      color: #fff;
      font-weight: bold;
      border-radius: 0 0 6px 6px;
    }
    .payment-radio-group {

    }
    .payment-radio__btn:checked + label::before {
      content: "\f192";
      color: #15C85B;
    }
    .payment-radio__btn:checked + label {
      border: 1px solid #C3F1D5;
      background-color: #F4FDF8;
    }
    .payment-radio__label {
      display: block;
      position: relative;
      border: 1px solid #ccc;
      min-height: 55px;
      padding: 10px 0 10px 45px;
      border-radius: 5px;
      margin-top: 15px;
      cursor: pointer;
    }
    .payment-radio__label::before {
      content: "\f10c";
      font: normal normal normal 14px/1 FontAwesome;
      text-rendering: auto;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 20px;
      color: #ccc;
    }
    .payment-radio__label > span {
      color: #4D4E4E;
      line-height: 2.3;
    }
    .payment-radio__label > small {
      display: block;
      width: calc(100% - 60px);
      color: #b3b3b3;
      font-weight: 100;
      letter-spacing: .5px;
    }
    .payment-radio__label > span + small {
      line-height: 1.3;
    }
    .payment-radio__label >img {
      position: absolute;
      right: 0;
      top: 50%;
      transform: translateY(-50%);
    }
    .header {
        overflow: hidden;
        background-color: ##ffffff;
        padding: 4px 10px;
    }
    .header a {
    float: left;
    color: black;
    text-align: center;
    padding: 12px;
    text-decoration: none;
    font-size: 17px;
    line-height: 25px;
    border-radius: 4px;
  }

  /* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
  .header a.logo {
    font-size: 25px;
    font-weight: bold;
  }

  /* Change the background color on mouse-over */
  .header a.menu:hover {
    background-color: #186900;
    color: white;
  }

  /* Float the link section to the right */
  .header-right {
    float: right;
  }

  /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
  @media screen and (max-width: 500px) {
    .header a {
      float: none;
      display: block;
      text-align: left;

    }
    .header-right {
      float: none;
    }
  }
  .input-group.md-form.form-sm.form-2 input {
      border: 1px solid #bdbdbd;
      border-top-left-radius: 0.25rem;
      border-bottom-left-radius: 0.25rem;
  }
  .input-group.md-form.form-sm.form-2 input.purple-border {
      border: 1px solid #9e9e9e;
  }
  .input-group.md-form.form-sm.form-2 input[type=text]:focus:not([readonly]).purple-border {
      border: 1px solid #ba68c8;
      box-shadow: none;
  }
  .form-2 .input-group-addon {
      border: 1px solid #ba68c8;
      background-color: green;
  }

</style>
<body id="top" class ="thebg">
    <div class="header" style="background: white">
      <a href="#default" class="logo">API DEMO</a>
      <div class="header-right">
        <a class="fa fa-user menu" href="bookings.php"> My Bookings</a>
      </div>
    </div>
    <!-- CONTENT -->
    <div class="container" >
        <div class="container mt25 offset-0" style="padding-left:15px ">
            <div class="col-md-12 pagecontainer2 offset-0" style="padding-bottom: 35px ! important; margin-left: 9px">      
                <div class="col-md-12 mt10" style="padding: 20px">
                     <div class="card mb-4">
                <div class="card-body">
                    <!-- Grid row -->
                    <div class="row">
                        <!-- Grid column -->
                        <form id="searchform">
                        <div class="col-md-8 col-md-offset-2">
                            <h2 class="pt-3 pb-4 text-center font-bold font-up deep-purple-text">Bookings</h2>
                            <div class="input-group md-form form-sm form-2 pl-0">
                                <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="confirmation number" id="search" name="confirmno" aria-label="Search">
                                <span class="input-group-addon waves-effect lighten-2" id="basic-addon1"><a style="color: white"><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                            </div>
                        </div>
                      </form>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                    <!--Table-->
                    <table class="table table-striped" align="center" style="width: 65%">
                        <!--Table head-->
                        <thead>
                            <tr>
                                <th style="width: 25%">#</th>
                                <th>Confirmation No</th>
                            </tr>
                        </thead>
                        <!--Table head-->
                        <!--Table body-->
                        <tbody>
                           <tr>
                                <td scope="row">1</th>
                                <td>HA0328</td>
                            </tr>
                            <tr>
                                <td scope="row">2</th>
                                <td>HA0297</td>
                            </tr>
                            <tr>
                                <td scope="row">3</th>
                                <td>HA0278</td>
                            </tr>
                            <tr>
                                <td scope="row">4</th>
                                <td>HA0275</td>
                            </tr>
                            <tr>
                                <td scope="row">5</th>
                                <td>HAB0270</td>
                            </tr>    
                        </tbody>
                        <!--Table body-->
                    </table>
                    <!--Table-->
                </div>
            </div>
                </div>
                <div class="clear-fix"></div>
            </div>
        </div>
    </div>
 <style>
    .footer a {
          color: white;
          padding: 82px;
          margin: 9px;
    }
    .text-color-white {
      color: white;
    }
    .social-links .fa {
        background-color: transparent;
        display: inline-block;
        height: 30px;
        padding: 9px 7px;
        margin: 8px;
        width: 30px;
        font-size: 12px;
        text-align: center;
        color: #ffffff;
        border: 1px solid #ffffff;
        border-radius:20px;
    }

  </style>
 <div class="footerbgblack hidden-xs" style="background: #186900;padding: 20px 0">
  <div class="container">   
    
    <div class="col-md-3">
      <span class="ftitleblack" style="color:white;font-weight: unset">API Demo</span>
       <section id="media_image-14" class="widget widget_media_image"><a href="#"><img width="170" height="50" src="https://www.adivaha.com/demo/online-travel-theme/wp-content/uploads/2018/11/goappleStor-e1542882253857.png" class="image wp-image-6232  attachment-full size-full" alt="" style="max-width: 100%; height: auto;"></a></section><br>
       <section id="media_image-15" class="widget widget_media_image"><a href="#"><img width="170" height="50" src="https://www.adivaha.com/demo/online-travel-theme/wp-content/uploads/2018/12/goplyaStor.png" class="image wp-image-8076  attachment-full size-full" alt="" style="max-width: 100%; height: auto;"></a></section> 
    </div>
       
    
    <div class=" col-md-offset-6 col-md-3 social-links">
      <h4 style="color: white;padding: 8px;">STAY CONNECTED</h4>
        <a href="#" class="text-color-white"><i class="fa fa-facebook border-radius"></i></a>
        <a href="#" class="text-color-white"><i class="fa fa fa-google-plus border-radius"></i></a>
        <a href="#" class="text-color-white"><i class="fa fa fa-linkedin border-radius"></i></a>
        <a href="#" class="text-color-white"><i class="fa fa fa-twitter border-radius"></i></a>
    </div>
      <br/><br/>
    </div>      
    <!-- End of column 4-->     
  
    
  </div> 
  <p style="padding:9px">Copyright All Rights Reserved © 2019</p> 
</div>


</body>
<script>
  $("#basic-addon1").click(function() {
    $("#searchform").attr("action","./bookingview.php");
    $("#searchform").submit();
  });  
</script>
<script src="skin/assets/js/initialize-google-map.js"></script>
<script type='text/javascript' src='skin/assets/js/jquery.customSelect.js'></script>

<script src="skin/assets/js/functions.js"></script>
<script type="text/javascript" src="skin/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="skin/assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>

<script src="skin/assets/js/helper-plugins/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="skin/assets/js/helper-plugins/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="skin/assets/js/helper-plugins/jquery.transit.min.js"></script>
<script type="text/javascript" src="skin/assets/js/helper-plugins/jquery.ba-throttle-debounce.min.js"></script>
<script src="skin/assets/js/counter.js"></script>    
<script src="skin/assets/js/initialize-carousel-detailspage.js"></script>
<script src="skin/js/carousel.js"></script>
<script src="skin/assets/js/jquery.easing.js"></script>
<script type='text/javascript' src='skin/js/lightbox.js'></script>   
<script src="skin/assets/js/js-list4.js"></script>   
<script src="skin/assets/js/jquery-ui.js"></script>
<script src="skin/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="skin/plugins/jslider/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="skin/plugins/jslider/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="skin/plugins/jslider/js/tmpl.js"></script>
<script type="text/javascript" src="skin/plugins/jslider/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="skin/plugins/jslider/js/draggable-0.1.js"></script>
</html>