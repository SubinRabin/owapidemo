<?php
if (isset($_REQUEST['hotelCode']) && isset($_REQUEST['token']) ) {
   $dd=  authMethod();
   $dd = json_decode($dd);
   if (isset($dd->token)) {
       $res = availablehotelroomsmethod($dd->token);
       $res = json_decode($res);
   }
}
function authMethod() {
    $curl = curl_init();
    $url = 'https://sandbox-authapi.otelseasy.com';
    $auth = array(
        'Agent_Code' => 'ABCDEF',
        'Username' => 'sanbox-user',
        'password' => 'pa$$word',
    );
    $data = json_encode($auth);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function availablehotelroomsmethod($token) {
    $curl = curl_init();
    $url = 'https://sandbox-availablehotelroomsapi.otelseasy.com';
    $auth = array(
        'token' => $_REQUEST['token'],
        'hotelcode' => $_REQUEST['hotelCode'] ,
    );

    $data = json_encode($auth);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'authorization: Bearer  '.$token.'',
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

?>
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
        <!-- end --> 
</head>
<script type="text/javascript" src="skin/js/payment.js"></script>
<style>
	.m-0 {
	  margin: 0;
	}

	.p-t-0 {
	  padding-top: 0;
	}

	.room-name-img {
    color: red;
    visibility:hidden;
  }
  .room-name:hover .room-name-img {
    visibility:visible;
  }
  .m-0 {
    margin: 0;
  }

  .p-t-0 {
    padding-top: 0;
  }

  .booking-timer {
    transform: translateY(-15px)
  }
  .booking-summary {
    margin-left: 10px;
    padding-right: 10px;
  }

  .booking-details-info > div  {
    min-height: 40px;
  }

  .bg-blue {
    background-color: #0074b9
  }

  /* GUEST TABLE STYLES */
  .guest-table {
      table-layout: fixed;
      width: 100%;
      margin: 0;
  }
  .guest-table tbody tr > td, .guest-table thead tr > th {
      padding: 5px 8px;
  }
  .guest-table thead > tr > th {
      background-color: #f5f5f5;
      color: #737373;
  }

  .guest-table .room-no > td {
      background-color: #fafafa;
      color: #0074b9;
      font-weight: 600;
      font-size: 12px;
  }

  /* r-type : Room Type */
  .r-type {
    padding: 0 15px;
  }

  .r-type--room {
    border: 1px solid #e6e6e6;
  }

  .r-type--room > h5 {
    margin: 0 -15px 10px;
    padding: 8px 15px;
    background-color: #f0f9ff;
    color: #007acc;
  }

  .r-type--room ul > li {
    margin: 0 -5px;
  }
  .r-type--room ul > li > label {
    display: block;
  }
  .r-type--room ul > li > label > input[type="radio"] {
    display: none;
  }

  .r-type--room ul > li > label > input[type="radio"] + div {
    background-color: #fafdff;
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ebebeb;
    margin-bottom: 8px;
    cursor: pointer;
    opacity: .8;
    filter: grayscale(100%);
    transition: all .3s;
  }

  .r-type--room ul > li > label > input[type="radio"] + div > h5 > i {
   /* display: none;*/
  }  

  .r-type--room ul > li > label > input[type="radio"] + div.availability  > h5 > i:first-child {
    display: none;
  }
  .r-type--room ul > li > label > input[type="radio"] + div.availability  > h5 > i:last-child {
    display: inline;
    margin-right: 2px;
  }
           

  .availability {
    border: 1px solid #5cb880 ! important;
    filter: grayscale(0) ! important;
  }
  .on-req.availability {
    border: 1px solid #fb6330 ! important;
    filter: grayscale(0) ! important; 
  }
  .on-req .text-green {
    color: #fb6330 ! important;
  }
    .r-type--room ul > li > label > input[type="radio"]:disabled + div  > h5 > i:first-child {          display: none;
    }

    .r-type--room ul > li > label > input[type="radio"]:checked + div {
      border: 1px solid #5cb880;
      opacity: 1;
      filter: none;
    }

    .r-type--room ul > li > label > input[type="radio"]:checked + div > h5 > i {
      display: none;
      margin-right: 2px;
    }

    .r-type--room ul > li > label > input[type="radio"]:checked + div.availability  > h5 > i:first-child {
      display: inline;
    }
    .r-type--room ul > li > label > input[type="radio"]:checked + div.availability  > h5 > i:last-child {
      display: none;
    }


  .r-type--name {
    font-size: 12px;
    font-weight: bold;
    color: #607D8B;
  }

  .validate + .required-msg,.name-validate + .required-msg {
    color: #e16359;
      display: block;
      text-align: right;
      margin-right: 6px;
      position: relative;
      top: -17px;
      opacity: 1;
      height: 0px;
      font-size: 11px;
      font-weight: 100;
  }

  .room-type-validate ,.traveller-validate{
    color: #e16359;
    display: block;
  }
  .validated + .required-msg, .room-type-validate.validated {
    display: none ! important;
  }

  .av-div > small {
    font-size: 11px;
    color: hsl(240, 8%, 69%);
    margin-left: 1px;
  }

  .av-div > .r-type--includes {
    color: #91919e;
  }



  /* b-rates : booking-rates */
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
   /* Extra small devices (phones, 600px and down) */
        @media(max-width: 600px) {
        .bor-sm {
            border-right: none ! important;
          }
          .guest-table {
              width: 100%;
              margin-bottom: 15px;
              overflow-x: scroll;
              overflow-y: hidden;
              border: 1px solid #dddddd
          }
          .container {
            margin-right: -10px;
            margin-left: -24px;
            padding-right: 0px;
            padding-left: 0px;
          }
          .booking-summary {
            margin-top: 39px;
          }
          .container > .navbar-header, .container > .navbar-collapse {
            margin-right: 31px; 
            margin-left: 47px; 
            }
            #book-progress{
              width:100%;
            }
        } 

        /* Small devices (portrait tablets and large phones, 600px and up) */
        @media(min-width: 600px) {
          .guest-table {
            width: 100%;
          }
           .booking-summary {
            margin-top: 39px;
          }
        } 

        /* Medium devices (landscape tablets, 768px and up) */
        @media (min-width: 768px) {
          .guest-table {
            width:100%;
          }
        } 

        /* Large devices (laptops/desktops, 992px and up) */
        @media(min-width: 992px) {
          .guest-table {
            width: 100%;
          }
        } 
         /* Extra large devices (large laptops and desktops, 1200px and up) */
        @media(min-width: 1200px) {
          .guest-table {
            width: 100%;
          }
        }
         .full-loading {
            position: fixed;
            top: 0;
            width: 100%;
            bottom: 0;
            left: 0;
            background-color: #006699;
            text-align: center;
            /*font-family: 'Titillium Web';*/
            z-index: 9999999;
        }
        
        .full-loading img {
            width: 30vw;
            position: relative;
            top: -3em;
        }
        
        .fl-data {
            position: relative;
            top: -9vw;
        }
        
        .fl-title {
            text-transform: uppercase;
            margin: 0;
            letter-spacing: 2px;
            color: white;
        }
        
        .fl-subtext {
            margin: 0;
            color: white;
        }
        
        .fl-info-card {
            height: 170px;
            width: 450px;
            margin: 1.5em auto 0;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 1px 0 #ccc;
            overflow: hidden;
        }
        
        .fl-info-card .top {
            height: 70px;
            background-color: #0784ff;
            padding: 0 15px;
        }
        
        .fl-info-card .top>p {
            margin: 0;
            text-transform: uppercase;
            font-size: 20px;
            line-height: 1.5;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
        }
        
        .fl-info-card .top>span {
            display: block;
            text-transform: uppercase;
            font-size: 12px;
            padding-top: 10px;
            color: rgba(255, 255, 255, 0.5);
        }
        
        .fl-info-card .mid {
            display: flex;
            border-bottom: 2px solid #F5F5F5;
        }
        
        .fl-info-card .mid>div {
            flex: 1;
            padding: 10px;
            position: relative;
        }
        
        .fl-info-card .mid>div:first-child::after {
            content: "";
            height: 60%;
            background-color: #F5F5F5;
            width: 2px;
            position: absolute;
            right: 0;
            top: 20%;
        }
        
        .fl-info-card .mid>div>p {
            margin: 0;
            color: #0784ff;
        }
        
        .fl-info-card .mid>div>span {
            color: #9E9E9E;
            font-size: 14px;
        }
        .htlbutton {
          background: white;
          line-height: 3;
          border: 1px #d0e9fd solid;
          margin: 0px 1px 1px 1px;          
        }
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
          max-width: 1000px;
          position: relative;
          margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next {
          cursor: pointer;
          position: absolute;
          top: 50%;
          width: auto;
          padding: 16px;
          margin-top: -22px;
          color: white;
          font-weight: bold;
          font-size: 18px;
          transition: 0.6s ease;
          border-radius: 0 3px 3px 0;
          user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
          right: 0;
          border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
          background-color: rgba(0,0,0,0.8);
        }
        .fade {
          -webkit-animation-name: fade;
          -webkit-animation-duration: 1.5s;
          animation-name: fade;
          animation-duration: 1.5s;
        }
        #button {
        display: inline-block;
        background-color: #39aeba;
        width: 50px;
        height: 50px;
        text-align: center;
        border-radius: 4px;
        position: fixed;
        bottom: 71px;
        right: 30px;
        transition: background-color .3s, 
          opacity .5s, visibility .5s;
        opacity: 0;
        visibility: hidden;
        z-index: 1000;
      }
      #button::after {
        content: "\f077";
        font-family: FontAwesome;
        font-weight: normal;
        font-style: normal;
        font-size: 2em;
        line-height: 50px;
        color: #fff;
      }
      #button:hover {
        cursor: pointer;
        background-color: #333;
      }
      #button:active {
        background-color: #555;
      }
      #button.show {
        opacity: 1;
        visibility: visible;
      }
  .header {
    overflow: hidden;
    background-color: ##ffffff;
    padding: 4px 10px;
  }
  /* Style the header links */
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
  .header a:hover {
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

</style>
<script>
let RoomCombination = new Array();
RoomCombination = <?php echo json_encode($res->RoomCombination) ?>;
$(".xml-default").remove();
$(document).ready(function() {
  var btn = $('#button');
  $(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
      btn.addClass('show');
    } else {
      btn.removeClass('show');
    }
  });
  btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
  }); 
  if(RoomCombination=="All") {
    $('input[name="Room1"]').on('change',function() {
        RoomCombinationCheckall();
    });
    $('input[type="radio"]').on('change',function() {
        var comAmnt = $('input[type="radio"]:checked').closest('li').find('.com-amnt');
        $("#room_index").val($('input[type="radio"]:checked').closest('li').find('.room_id').val());
        $("#contract_index").val($('input[type="radio"]:checked').closest('li').find('.contract_id').val());
        $.each($('input[type="radio"]:checked'),function(i,v) {
          $('input[name="RequestType['+i+']"]').val($(this).closest('li').find('.RequestType').val());
        }) 
        var sum = 0
        $.each(comAmnt,function(i,v) {
          sum += Number($(this).val().replace(/,/g , '')); 
        });
        $(".b-rates--grand-total").text(sum.toFixed(2));
    });
    RoomCombinationinitCheckall();
  } else {
    $(document).on('change','input[name="Room1"]',function(){
      RoomCombinationCheck();
    });
    $(document).on('change','input[type="radio"]',function(){
      var comAmnt = $('input[type="radio"]:checked').closest('li').find('.com-amnt');
      var sum = 0
      $.each(comAmnt,function(i,v) {
        sum += Number($(this).val().replace(/,/g , '')); 
      });
      $(".b-rates--grand-total").text(sum);
    });
    RoomCombinationinitCheck();
  }
  var startStamp = new Date($("#startTime").val()).getTime();
  var start = new Date($("#startTime").val());
  var maxTime = (30*60)*1000;
  var timeoutVal = Math.floor(maxTime/100);
  function updateProgress(percentage) {
    $("#book-progress").val((100-percentage));
  }
  function animateUpdate() {
      var now = new Date();
      var timeDiff = now.getTime() - start.getTime();
      var perc = Math.round((timeDiff/maxTime)*100);
        if (perc <= 100) {
         updateProgress(perc);
         setTimeout(animateUpdate, timeoutVal);
        } else {
            // window.location = base_url+"hotels";
        }
  }
  function updateClock() {
    var now = new Date();
     var timeDiff = now.getTime() - start.getTime();
    var nowTime = new Date().getTime();

    var diff = Math.round((nowTime-startStamp)/1000);

    var d = Math.floor(diff/(24*60*60)); /* though I hope she won't be working for consecutive days :) */
    diff = diff-(d*24*60*60);
    var h = Math.floor(diff/(60*60));
    diff = diff-(h*60*60);
    var m = Math.floor(diff/(60));
    diff = diff-(m*60);
    var s = diff;
        if(m<=30) {
          if (s<10) {
            s = '0'+s;
          }
          if (m<10) {
            m = '0'+m;
          }
          $("#timeLeft").text((30-m)+":"+(60-s));
        }
  }
  setInterval(updateClock, 1000);
});
$(document).ready(function() {
   $(".details").on("click", function( e ) {
    e.preventDefault();
    $("body, html").animate({ 
        scrollTop: $( $(this).attr('href') ).offset().top 
    }, 600);  
  });
})
function bubbleSort(ul) {
  var done = false;
  while (!done) {
    done = true;
    for (var i = 1; i < ul.find(".roomlist").length; i += 1) {
      if (parseInt($(ul).find(".roomlist:eq("+[i-1]+")").find(".com-amnt").val()) > parseInt($(ul).find(".roomlist:eq("+[i]+")").find(".com-amnt").val())) {
         done = false;
        $(ul).prepend($(ul).find(".roomlist:eq("+[i]+")"));
      }
    }
  }
  return ul;
}
function RoomCombinationinitCheckall() {
  $(".r-type--room .r-type--list").each(function(j,u) {
    var arr = $(u);
    bubbleSort(arr);
  })
  $('input[name="Room1"]:first').prop('checked',true);
  RoomCombinationCheckall();
}
function RoomCombinationCheckall() {
  var room1 =  $('input[name="Room1"]:checked').val();
  var availableRooms = $('.r-type--room').not(':first-child').find('.availability').closest('li');
  defaultcheckall();
  var comAmnt = $('input[type="radio"]:checked').closest('li').find('.com-amnt');
  $("#room_index").val($('input[type="radio"]:checked').closest('li').find('.room_id').val());
  $("#contract_index").val($('input[type="radio"]:checked').closest('li').find('.contract_id').val());
  $.each($('input[type="radio"]:checked'),function(i,v) {
      $('input[name="RequestType['+i+']"]').val($(this).closest('li').find('.RequestType').val());
    }) 
  var sum = 0
  $.each(comAmnt,function(i,v) {
    sum += Number($(this).val().replace(/,/g , '')); 
  });
  $(".b-rates--grand-total").text(sum.toFixed(2));
}
function defaultcheckall() {
  for (var i = 2; i <= <?php echo count($_REQUEST['adults']) ?>; i++) {
    $('input[name="Room'+i+'"]:first').prop('checked',true);
  }
}
function defaultRateCheckall() {
  if ($("#def_rid").val()!="" && $("#def_cid").val()!="") {
    var def_rid= $("#def_rid").val();
    var def_cid= $("#def_cid").val();
    $("#Room"+def_rid+"-"+def_cid).trigger('click');
  }
  var comAmnt = $('input[type="radio"]:checked').closest('li').find('.com-amnt');
  $("#room_index").val($('input[type="radio"]:checked').closest('li').find('.room_id').val());
  $("#contract_index").val($('input[type="radio"]:checked').closest('li').find('.contract_id').val());
  $.each($('input[type="radio"]:checked'),function(i,v) {
    $('input[name="RequestType['+i+']"]').val($(this).closest('li').find('.RequestType').val());
  }) 
  var sum = 0
  $.each(comAmnt,function(i,v) {
    sum += Number($(this).val().replace(/,/g , '')); 
  });
  $(".b-rates--grand-total").text(sum.toFixed(2));
}
function RoomCombinationinitCheck() {
  for (var i = 2; i <= <?php echo count($_REQUEST['adults']) ?>; i++) {
    $(".ulRoom"+i).html($(".ulRoom1").html());
    $(".ulRoom"+i+" .roomval").each(function(){
      $(this).attr("id","Room"+i+$(this).val());
      $(this).attr("name","Room"+i);
      $(this).closest('li').removeAttr('id').attr('id','listRoom'+i+$(this).val());
      $(this).closest('label').removeAttr('for').attr('for','Room'+i+$(this).val());
    });
  }
  $(".r-type").find('input').prop('disabled',true);
  $.each(RoomCombination,function(j,v) {
    if (isNaN(RoomCombination.RoomIndex)) {
      $('#Room'+1+v.RoomIndex).prop('disabled',false);
      $('#listRoom'+1+v.RoomIndex).removeClass("hide");
      $('#Room'+1+v.RoomIndex).closest('li').find('.av-div').addClass('availability');
      if(j==0) {
        $('#Room'+1+v.RoomIndex).prop('checked',true);
      }
    } else {
      $('#Room'+1+RoomCombination.RoomIndex).prop('disabled',false);
      $('#listRoom'+1+RoomCombination.RoomIndex).removeClass("hide");
      $('#Room'+1+RoomCombination.RoomIndex).closest('li').find('.av-div').addClass('availability');
      if(j==0) {
        $('#Room'+1+RoomCombination.RoomIndex).prop('checked',true);
      }
    }  
  });
  RoomCombinationCheck();
} 
function RoomCombinationCheck() {
  var room1 =  $('input[name="Room1"]:checked').val();
  var room1amnt =  $("input[name='Room1']:checked").closest("li").find(".com-amnt").val();
  var room1name =  $("input[name='Room1']:checked").closest("li").find(".com-name").val();
  for (var i = 2; i <= <?php echo count($_REQUEST['adults']) ?>; i++) {
    $(".r-type").find('input[name="Room'+i+'"]').prop('disabled',true);
    $(".r-type").find('input[name="Room'+i+'"]').closest('li').find('.av-div').removeClass('availability');
    $(".r-type").find('input[name="Room'+i+'"]').prop('checked',false);
  }
  $.each(RoomCombination,function(j,v) {
    for (var i = 2; i <= <?php echo count($_REQUEST['adults']) ?>; i++) {
      if (isNaN(RoomCombination.RoomIndex)) {       
        $('#listRoom'+i+v.RoomIndex[i-1]).removeClass("hide");   
      } else {
        $('#listRoom'+i+RoomCombination.RoomIndex[i-1]).removeClass("hide");
      }
    }
  });
  $.each(RoomCombination,function(j,v) {
    if (isNaN(RoomCombination.RoomIndex)) {
      if (v.RoomIndex[0]==room1) {
        for (var i = 2; i <= <?php echo count($_REQUEST['adults']) ?>; i++) {
          $('#Room'+i+v.RoomIndex[i-1]).prop('disabled',false);
          $('#Room'+i+v.RoomIndex[i-1]).closest('li').find('.av-div').addClass('availability'); 
        }
      }
    }
  });
  var availableRooms = $('.r-type--room').not(':first-child').find('.availability').closest('li');
  $.each(availableRooms, function(){
      $(this).closest('ul').prepend($(this).closest('li'));
  })
  var comAmnt = $('input[type="radio"]:checked').closest('li').find('.com-amnt');
  var sum = 0
  $.each(comAmnt,function(i,v) {
    sum += Number($(this).val().replace(/,/g , '')); 
  });
  $(".b-rates--grand-total").text(sum);
  defaultcheck();
}
function defaultcheck() {
  var room1 =  $('input[name="Room1"]:checked').val();
  var room1amnt =  $("input[name='Room1']:checked").closest("li").find(".com-amnt").val();
  var room1name =  $("input[name='Room1']:checked").closest("li").find(".com-name").val();
  $.each(RoomCombination,function(j,v) {
    if (isNaN(RoomCombination.RoomIndex)) {
      if (v.RoomIndex[0]==room1) {
        for (var i = 2; i <= <?php echo count($_REQUEST['adults']) ?>; i++) {
           if (j==0) {
            var temp  = 0;
            $( "input[name='Room"+i+"']" ).each(function( index ) {
              if($(this).closest('li').find('.com-amnt').val()==room1amnt && $(this).closest('li').find('.com-name').val()==room1name  && $(this).prop("disabled")==false) {
                $( this ).trigger("click");
                temp = 1;
              }  
            });
            if (temp==0) {
              $('#Room'+i+v.RoomIndex[i-1]).prop('checked',true);
            }
          }
        }
      }
    }
  });
}
</script>
<body id="top" class ="thebg">
  <div class="header" style="background: white">
  <a href="#default" class="logo">API DEMO</a>
  <div class="header-right">
    <a class="fa fa-user" href="bookings.php"> My Bookings</a>
  </div>
</div>
  <?php
    $start = $_REQUEST['check_in'];
    $end = $_REQUEST['check_out'];
    $first_date = strtotime($start);
    $second_date = strtotime($end);
    $offset = $second_date-$first_date; 
    $result = array();
    $checkin_date=date_create($_REQUEST['check_in']);
    $checkout_date=date_create($_REQUEST['check_out']);
    $no_of_days=date_diff($checkin_date,$checkout_date);
    $tot_days = $no_of_days->format("%a");
    for($i = 0; $i <= floor($offset/24/60/60); $i++) {
          $result[1+$i]['date'] = date('m/d/Y', strtotime($start. ' + '.$i.'  days'));
    }
    $viwedate1 = date("d/m/Y", strtotime(isset($_REQUEST['Check_in']) ? $_REQUEST['Check_in'] : ''));
    $viwedate2 = date("d/m/Y", strtotime(isset($_REQUEST['Check_out']) ? $_REQUEST['Check_out'] : ''));
  ?>
 
	<div class="container breadcrub hidden-xs">
		<ol class="track-progress" data-steps="5">
	      <li class="done">
	        <span>Search</span>
	      </li><li class="done">
	        <span>Search Hotel</span>
	        <i></i>
	      </li><li class="active">
	        <span>Pax Information</span>
	        <i></i>
	      </li><li>
	        <span>Review Booking</span>
	        <i></i>
	      </li><li>
	        <span>Confirm</span>
	      </li>
	    </ol>
	</div>	
	<div class="container">
    <a id="button"></a>
		<form method="get" name="payment_form" id="payment_form">
			<div class="col-sm-12 mt25 booking-summary">
		        <div class="pagecontainer2 padding30 p-t-0" style="padding-bottom: 10px">
		          <h3 class="text-green">Booking Summary <span class="right text-right booking-timer">
		              <small>Time Left : <b id="timeLeft">30:18</b></small>
		              <progress id="book-progress" value="98" max="100"></progress>
		            </span>
		          </h3>

		          <div class="row">
		            <div class="col-sm-12">

		              <div class="padding20 margtop15" style="background-color: #f0f9ff">
		                <div class="row booking-details-info">
		                  <div class="col-sm-3 col-xs-6 text-center" style="border-right: 1px dashed #bbb">
		                    <span class="text-muted m-0">Check in date</span><br>
		                    <span class="text-blue"><?php echo date('d/m/Y' ,strtotime($_REQUEST['check_in'])); ?></span>
		                  </div>
		                  <div class="col-sm-3 col-xs-6 text-center bor-sm" style="border-right: 1px dashed #bbb">
		                    <span class="text-muted m-0">Check out date</span><br>
		                    <span class="text-blue"><?php echo date('d/m/Y' ,strtotime($_REQUEST['check_out'])); ?></span>
		                  </div>
		                    <?php 
		                        $adult= array_sum($_REQUEST['adults']);
      		            			if (isset($_REQUEST['child'][0])) {
      		            				$childs= array_sum($_REQUEST['child']);
      		            			} else {
      		            				$childs= "0";
      		            			}
		                    	  $adultss= array_sum($_REQUEST['adults']); 
		                    ?>
		                  <div class="col-sm-3 col-xs-6 text-center" style="border-right: 1px dashed #bbb">
		                    <label class="margtop10 text-muted">Adult(s) <span class="badge bg-blue"><?php echo $adultss ?></span></label>
		                  </div>
		                  <div class="col-sm-3 col-xs-6 text-center">
		                    <label class="margtop10 text-muted"><?php echo $childs > 1 ? 'Children' : 'Child' ?> <span class="badge bg-blue"><?php echo $childs ?></span></label>
		                  </div>
		                </div>

		              </div>

		      	  
						<?php foreach ($_REQUEST['adults'] as $key => $value) { ?>
							<input type="hidden" name="reqadults[]" value="<?php echo $value ?>">
              <input type="hidden" name="RequestType[<?php echo $key ?>]" value="">
						<?php } ?>
						<?php foreach ($_REQUEST['child'] as $key => $value) { ?>
							<input type="hidden" name="reqChild[]" value="<?php echo $value ?>">
						<?php } ?>
						<input type="hidden" name="room_index"  id="room_index" value="">
						<input type="hidden" name="contract_index"  id="contract_index" value="">
						<input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $_REQUEST['hotelCode'] ?>">
						<input type="hidden" name="no_of_rooms" id="no_of_rooms" value="<?php echo count($_REQUEST['adults']); ?>">				
						<input type="hidden" name="check_in" value="<?php echo isset($_REQUEST['check_in']) ? $_REQUEST['check_in'] : '' ?>">
						<input type="hidden"  name="check_out"  value="<?php echo isset($_REQUEST['check_out']) ? $_REQUEST['check_out'] : '' ?>" />
						      <div class="margtop15">
                  <div class="row booking-details-info">
                      <div class="col-sm-12 hidden-lg hidden-md">
                        <a class="details htlbutton btn col-sm-3 col-xs-12" href="#hrooms"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Room Types</span></a>
                        <a class="details htlbutton btn col-sm-3 col-xs-12" href="#details"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Hotel Details</span></a>
                        <a class="details htlbutton btn col-sm-3 col-xs-12" href="#gallery"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Image Gallery</span></a>
                        <a class="details htlbutton btn col-sm-4 col-xs-12" href="#map"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Hotel Map</span></a>
                        <a class="details htlbutton btn col-sm-4 col-xs-12" href="#other"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Other Aminities</span></a>
                      </div>
                      <div class="hidden-xs">
                        <a class="details htlbutton btn" href="#hrooms" style="width:19%"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Room Types</span></a>
                        <a class="details htlbutton btn" href="#details" style="width:19%"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Hotel Details</span></a>
                        <a class="details htlbutton btn" href="#gallery" style="width:19%"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Image Gallery</span></a>
                        <a class="details htlbutton btn" href="#map" style="width:19%"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Hotel Map</span></a>
                        <a class="details htlbutton btn" href="#other" style="width:19%"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Other Aminities</span></a>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                      <p class="pull-right margtop15">Please fill all traveller's details</p>
                    </div> 
                    <div class="col-md-2"> 
                      <button type="button" data-toggle="modal" id="travellerModalButton" data-target="#travellerModal" class="btn btn-sm btn-primary pull-right margtop15">Add Traveller's</button>
                    </div>
                </div>
            <div class="col-sm-12 ">
            <div class="row b-rates margtop10" style="background: #f0f9ff;">
              <!-- <h5 class="b-rates--tax">Tax Amount : <span class="right">AED 1250</span></h5> -->
              <h5 class="text-green pull-right" style="font-weight: bold">GRAND TOTAL : AED <span class="b-rates--grand-total">0</span><button id="Continue_book" type="button" name="Continue_book"class="bluebtn" style="margin-left: 5px">Continue</button><span>
            </h5>
            </div>
          </div>
              <div class="modal fade " id="travellerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 60%;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Travellers Details <small class="right traveller-validate validated"></small></h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                       <div class="col-sm-12 col-xs-12" style="max-height: 350px;overflow-y: scroll;">
                          <table class="table table-bordered guest-table">
                            <thead>
                              <tr>
                                <th style="width: 5%" class="text-center">#</th>
                                  <th style="width: 30%">Adult/Children</th>
                                  <th style="width: 15%">Title</th>
                                  <th style="width: 25%">First Name</th>
                                  <th style="width: 25%">Last Name</th>
                                  <th style="width: 15%"class="text-center">Age</th>
                              </tr>
                            </thead>
                            <tbody class="guesttbody">
                              <?php for ($x=0; $x < count($_REQUEST['adults']); $x++) { 
                               ?> 
                              <tr class="room-no">
                                <td class="text-center"><i class="fa fa-home"></i></td>
                                <td colspan="5">Room <?php echo $x+1 ?></td>
                              </tr>
                              <?php for ($i=0; $i < $_REQUEST['adults'][$x] ; $i++) {  ?>
                              <tr>
                                <td class="text-center"><?php echo $i+1 ?></td>
                                <td>Adult</td>
                                <td><select class="form-control input-sm Room-1Adulttitle" name="Room<?php echo $x+1 ?>Adulttitle[]">
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Miss">Miss</option>
                                  </select></td>
                                <td><input type="text" class="form-control validated name-validate input-sm" name="Room<?php echo $x+1 ?>AdultFirstName[]">
                                  <small class="required-msg">*required</small></td>
                                <td><input type="text" class="form-control validated name-validate  input-sm" name="Room<?php echo $x+1 ?>AdultLastName[]">
                                  <small class="required-msg">*required</small></td>
                                <td class="text-center"><input type="number" class="form-control validatecc validated input-sm" name="Room<?php echo $x+1 ?>AdultAge[]">
                                  <small class="required-msg">*required</small></td>
                              </tr>
                            <?php } ?>
                            <?php for ($j=0; $j <$_REQUEST['child'][$x] ; $j++) { ?>
                              <tr>
                                <td class="text-center"><?php echo $j+1 ?></td>
                                <td>Child</td>
                                <td><select class="form-control input-sm Room-1Adulttitle" name="Room<?php echo ($x+1)  ?>ChildTitle[]">
                                  <option value="Mr">Mr</option>
                                    <option value="Ms">Ms</option>
                                  </select></td>
                                <td><input type="text" class="form-control validated name-validate  input-sm" name="Room<?php echo ($x+1)  ?>ChildFirstName[]"><small class="required-msg">*required</small></td>
                                <td><input type="text" class="form-control validated name-validate input-sm" name="Room<?php echo ($x+1)  ?>ChildLastName[]"><small class="required-msg">*required</small></td>
                                <td class="text-center"><input type="number" class="form-control validate validated input-sm" name="reqroom<?php echo ($x+1)  ?>-childAge[]" value="<?php echo $_REQUEST['Room'.($x+1).'ChildAge'][$j] ?>" readonly><small class="required-msg">*required</small></td>
                              </tr>
                            <?php } ?>
                            <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="row"> 
                         <div class="col-sm-12 col-xs-12">
                           <button type="button" class="btn btn-sm btn-primary margtop10 pull-right" id="travellerSubmit">Submit</button>
                         </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
		          <h4 class="text-green margtop25">Room Types <small class="right room-type-validate validated">*Please select all room combination</small></h4>
		          <div class="row r-type margtop10" id="hrooms">
		          	<?php $div = 12/count($_REQUEST['adults']);
             		if (isset($res->status) && $res->status==true && isset($res->AvailableHotelRooms)) {
                  if($res->RoomCombination=="All") {
                    foreach ($_REQUEST['adults'] as $key => $value) {
                      $room = 'room'.($key+1);      ?>
                      <div class="col-sm-<?php echo $div ?> r-type--room">
                        <h5>Room <?php echo $key+1 ?> (Adult <?php echo $_REQUEST['adults'][$key] ?><?php echo $_REQUEST['child'][$key]!="" && $_REQUEST['child'][$key]!=0 ? ' Child '.$_REQUEST['child'][$key] : '' ?>)</h5>
                        <ul class="list-unstyled r-type--list margtop10">
                        <?php foreach($res->AvailableHotelRooms->$room as $k => $value1) { 
                          $checked = '';
                          if ($k==0) {
                              $checked ='checked';
                          } 
                          $room = explode("-",$value1->RoomIndex);
                          ?>
                          <li class="roomlist">
                            <label for="<?php echo $key ?><?php echo $value1->RoomIndex ?>">
                            <input type="radio" <?php echo $checked; ?> name="<?php echo $key ?>" id="<?php echo $key ?><?php echo $value1->RoomIndex ?>" value="<?php echo $value1->RoomIndex ?>">
                            <div class="av-div availability <?php echo $value1->RequestType!="Book" ? 'on-req' : '' ?>">
                              <h5 class="r-type--name m-0"><i class="fa fa-check-circle text-green"></i><i class="fa fa-circle-thin text-green"></i> <span class="room-name"><?php echo $value1->RoomName ?> - <?php echo $value1->board ?> </span> <?php 
                              if (isset($value1->CancelPolicies) && $value1->CancelPolicies[0]->application=="FREE OF CHARGE") { ?>
                                <span class="pull-right" data-toggle="modal" data-target="#myModalroom<?php echo $key+1 ?><?php echo $value1->RoomIndex ?>">Free of Cancellation till <?php echo $value1->CancelPolicies[0]->ToDate ?> <span>
                              <?php } else { ?>
                                <span class="pull-right" data-toggle="modal" data-target="#myModalroom<?php echo $key+1 ?><?php echo $value1->RoomIndex ?>">cancellation<span>
                              <?php } ?></h5> 
                                
                              <p class="text-green m-0 bold">
                                <input type="hidden" class="RequestType" value="<?php echo $value1->RequestType ?>">
                                <input type="hidden" class="room_id" value="<?php echo $room[1] ?>">
                                <input type="hidden" class="contract_id" value="<?php echo $room[0] ?>">
                                <input type="hidden" class="com-amnt" value="<?php echo $value1->Price; ?>">
                                <small>AED <?php echo $value1->Price; ?> <?php echo $value1->RequestType!="Book" ? ' - On Request' : '' ?></small>
                              </p>
                            </div>
                            </label>
                          </li>
                          <div id="myModalroom<?php echo $key+1 ?><?php echo $value1->RoomIndex?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">

                            <!-- Modal content-->
                                <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Cancellation Policies</h4>
                              </div>
                              <div class="modal-body">
                                <table class="table table-bordered table-hover cancellation-table">
                                    <thead style="background: #0074b9;color: white;">
                                      <tr>
                                        <td>Cancelled on or After</td>
                                        <td>Cancelled on or Before</td>
                                        <td>Cancellation Charge</td>
                                      </tr>
                                    </thead>
                                   <tbody> 

                                    <?php 
                                    if (isset($value1->CancelPolicies)) {
                                    foreach ($value1->CancelPolicies as $Cancvalue) { 
                                      if($Cancvalue->application == "Nonrefundable") { ?>
                                        <tr>
                                          <td colspan="4">This booking is Nonrefundable.</td>
                                        </tr>
                                      <?php } else { 
                                        $finalAmount = $value1->Price;
                                        if ($Cancvalue->application=="FIRST NIGHT") {
                                          $finalAmount = ($value1->Price/$tot_days);
                                        }

                                        if ($Cancvalue->application=="FREE OF CHARGE") {
                                          $finalAmount = 0;
                                        }
                                        $charge = $finalAmount*($Cancvalue->CancellationCharge/100);  
                                        ?>
                                        <tr>
                                          <td><?php echo $Cancvalue->FromDate ?></td>
                                          <td><?php echo $Cancvalue->ToDate ?></td>
                                          <td><?php echo "AED ".$charge ?> (<?php echo $Cancvalue->application ?>) </td>
                                        </tr>
                                      <?php } 
                                  } } ?>
                                  </tbody>
                                  </table>
                              </div>
                          </div>
                          
                            </div>
                          </div>
                        <?php  
                        }  ?>
                        </ul>
                      </div>
                    <?php 
                    } 
                  } else {
                    for ($i=0; $i < count($_REQUEST['adults']) ; $i++) {
                      $room = 'room'.($i+1); ?> 
                      <div class="col-sm-<?php echo $div ?> r-type--room">
                      <h5>Room <?php echo $i+1 ?> (Adult <?php echo $_REQUEST['adults'][$i] ?><?php echo $_REQUEST['child'][$i]!="" && $_REQUEST['child'][$i]!=0 ? ' Child '.$_REQUEST['child'][$i] : '' ?>)</h5>
                      <ul class="list-unstyled r-type--list ulRoom<?php echo $i+1 ?>">
                        <?php foreach($res->AvailableHotelRooms->$room as $k => $value1) { 
                          
                          $checked = '';
                          if ($k==0) {
                              $checked ='checked';
                          } 
                          $room = explode("-",$value1->RoomIndex);
                          ?>                 
                          <li id="listRoom<?php echo $i+1 ?><?php echo $value1->RoomIndex ?>" class="hide">
                            <label for="Room<?php echo $i+1 ?><?php echo $value1->RoomIndex ?>">
                            <input type="radio" <?php echo $checked; ?> name="Room<?php echo $i+1 ?>" id="Room<?php echo $i+1 ?><?php echo $value1->RoomIndex ?>" class="roomval" value="<?php echo $value1->RoomIndex ?>">
                            <div class="av-div">
                              <h5 class="r-type--name m-0"><i class="fa fa-check-circle text-green"></i><i class="fa fa-circle-thin text-green" style="    margin-right: 2px;"></i><?php echo $value1->RoomName ?> - <?php echo $value1->board ?> 
                              <?php if (isset($value1->CancelPolicies) && $value1->CancelPolicies[0]->application=="FREE OF CHARGE") { ?>
                                <span class="pull-right" data-toggle="modal" data-target="#myTboModalroom<?php echo $i+1 ?><?php echo $value1->RoomIndex ?>">Free of Cancellation till <?php echo $value1->CancelPolicies[0]->ToDate ?> <span>
                              <?php } else { ?>
                                <span class="pull-right" data-toggle="modal" data-target="#myTboModalroom<?php echo $i+1 ?><?php echo $value1->RoomIndex ?>">cancellation<span>
                              <?php } ?></h5> 
                               <p class="text-green m-0 bold">
                                <input type="hidden" class="RequestType" value="<?php echo $value1->RequestType ?>">
                                <input type="hidden" class="room_id" value="<?php echo $room[1] ?>">
                                <input type="hidden" class="contract_id" value="<?php echo $room[0] ?>">
                                <input type="hidden" class="com-amnt" value="<?php echo $value1->Price; ?>">
                                <small>AED <?php echo $value1->Price; ?> <?php echo $value1->RequestType!="Book" ? ' - On Request' : '' ?></small>
                              </p>                                    
                            </div>
                            </label>
                          </li>
                          <div id="myTboModalroom<?php echo $i+1 ?><?php echo $value1->RoomIndex?>" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-sm">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">Cancellation Policies</h4>
                                </div>
                                <div class="modal-body">
                                  <table class="table table-bordered table-hover cancellation-table">
                                      <thead style="background: #0074b9;color: white;">
                                        <tr>
                                          <td>Cancelled on or After</td>
                                          <td>Cancelled on or Before</td>
                                          <td>Cancellation Charge</td>
                                        </tr>
                                      </thead>
                                     <tbody> 

                                      <?php 
                                      if (isset($value1->CancelPolicies)) {
                                      foreach ($value1->CancelPolicies as $Cancvalue) { 
                                        if($Cancvalue->application == "Nonrefundable") { ?>
                                          <tr>
                                            <td colspan="4">This booking is Nonrefundable.</td>
                                          </tr>
                                        <?php } else { 
                                          $finalAmount = $value1->Price;
                                          if ($Cancvalue->application=="FIRST NIGHT") {
                                            $finalAmount = ($value1->Price/$tot_days);
                                          }

                                          if ($Cancvalue->application=="FREE OF CHARGE") {
                                            $finalAmount = 0;
                                          }
                                          $charge = $finalAmount*($Cancvalue->CancellationCharge/100);  
                                          ?>
                                          <tr>
                                            <td><?php echo $Cancvalue->FromDate ?></td>
                                            <td><?php echo $Cancvalue->ToDate ?></td>
                                            <td><?php echo "AED ".$charge ?> (<?php echo $Cancvalue->application ?>) </td>
                                          </tr>
                                        <?php } 
                                    } } ?>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php  
                        }  ?>
                        </ul>
                      </div>
                    <?php }
                  }       
                } ?>
            <div class="clearfix"></div>
            <div class="row margtop10">
          <div class="col-md-12" id="details">
            <h4 class="text-green margtop25 text-justify">Hotel Details<small class="right traveller-validate validated"></small></h4>
            <p style="text-align: justify"><?php echo isset($view[0]->hotel_description)?($view[0]->hotel_description):"No details found" ?></p>
          </div>
         
          <div class="clearfix"></div>
          <div class="col-md-12" id="gallery">
            <h4 class="text-green margtop25 text-justify">Image Gallery<small class="right traveller-validate validated"></small></h4>
            <?php if(isset($view[0]->image)) { ?>
            <div class="slideshow-container">
              <div class="col-md-12 details-slider">
                <div id="c-carousel">
                  <div id="wrapper">
                  <div id="inner">
                    <div id="caroufredsel_wrapper2">
                      <div id="carousel">
                        <?php 
                          for ($q=1; $q <= 5; $q++) { 
                            $image = 'Image'.$q;
                           ?>
                          
                          <img src="<?php echo images_url(); ?>uploads/gallery/<?php echo $view[0]->id; ?>/<?php echo $view[0]->$image; ?>" alt=""/>
                        <?php } ?>          
                      </div>
                    </div>
                    <div id="pager-wrapper">
                      <div id="pager">
                        <?php for ($q=1; $q <= 5; $q++) { 
                            $image = 'Image'.$q;
                         ?>
                          <img src="<?php echo images_url(); ?>uploads/gallery/<?php echo $view[0]->id; ?>/<?php echo $view[0]->$image; ?>" width="120" height="68" alt=""/>
                       <?php } ?>              
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <button id="prev_btn2" class="prev2"><img src="<?php echo static_url(); ?>skin/images/spacer.png" alt=""/></button>
                  <button id="next_btn2" class="next2"><img src="<?php echo static_url(); ?>skin/images/spacer.png" alt=""/></button>   
                    
                  </div>
                </div> <!-- /c-carousel -->
              </div>
            </div>
          <?php } else { ?>
            <p>No details found.</p>
          <?php } ?>
          </div>
          <div class="clearfix"></div>
          <div class="col-md-12" id="map">
            <h4 class="text-green margtop25 text-justify">Map<small class="right traveller-validate validated"></small></h4>
            <?php if(isset($view[0]->lattitude)) { ?>
            <input type="hidden" id="lat_val" value="<?php echo isset($view[0]->lattitude)?$view[0]->lattitude:''?>">
            <input type="hidden" id="long_val" value="<?php echo isset($view[0]->longitude)?$view[0]->longitude:''?>">
            <div id="map-canvas"></div>
            <?php } else { ?>
               <p>No details found.</p>
            <?php } ?>
          </div>
          <div class="clearfix"></div>
           <div class="col-md-12" id="other">
            <h4 class="text-green margtop25 text-justify">Basic Aminities<small class="right traveller-validate validated"></small></h4>
            <?php if(isset($hotel_facilities[0])) { ?>
            <ul class="checklist" style="margin:15px">                 
              <?php if (count($hotel_facilities[0])!=0) {
                      foreach ($hotel_facilities as $key1 => $value3) {
                      ?>
                      <li><?php echo $value3[0]->Hotel_Facility; ?></li>
                    <?php } } ?>
            </ul>
             <?php } else { ?>
               <p>No details found.</p>
            <?php } ?>
          </div>
          <div class="clearfix"></div>
        </div>
		          </div>
		        </div>

        </div>
		  </div>
		  <input type="hidden" name="token" value="<?php echo $_REQUEST['token'] ?>">
		</form>
	</div>
		<!-- END OF RIGHT CONTENT -->
	</div>
</div>
<!-- END OF CONTENT -->
  
  <!-- Central Modal Medium Warning -->
  <div class="modal fade " id="boardAllocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
  </div>
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