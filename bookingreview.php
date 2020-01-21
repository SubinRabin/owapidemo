<?php
//print_r($_REQUEST);
if (isset($_REQUEST['hotel_id']) && isset($_REQUEST['token']) ) {
   $dd=  authMethod();
   $dd = json_decode($dd);
   if (isset($dd->token)) {
       $res = bookingreviewmethod($dd->token);
       $res = json_decode($res);
       // print_r($res);exit;
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

function bookingreviewmethod($token) {
    $curl = curl_init();
    $url = 'https://sandbox-bookingreviewapi.otelseasy.com';
    $roomindex = array();
    for($i=0;$i<$_REQUEST['no_of_rooms'];$i++) {
    	$room = "Room".($i+1);
    	$roomindex[$i] = $_REQUEST[$room];
    }
    $auth = array(
        'token' => $_REQUEST['token'],
        'hotelcode' => $_REQUEST['hotel_id'],
        'RoomIndex' => $roomindex
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
</style>
</head>
<script type="text/javascript" src="skin/js/payment.js"></script>
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
</style>
<body id="top" class ="thebg">
    <div class="header" style="background: white">
  	  <a href="#default" class="logo">API DEMO</a>
	  <div class="header-right">
	    <a class="fa fa-user menu" href="bookings.php"> My Bookings</a>
	  </div>
    </div>
	<div class="container breadcrub">
		<ol class="track-progress" data-steps="5">
	      <li class="done">
	        <span>Search</span>
	      </li><li class="done">
	        <span>Search Hotel</span>
	        <i></i>
	      </li><li class="done">
	        <span>Pax Information</span>
	        <i></i>
	      </li><li class="active">
	        <span>Review Booking</span>
	        <i></i>
	      </li><li>
	        <span>Confirm</span>
	      </li>
	    </ol>
	</div>	
	<!-- CONTENT -->
	<div class="container" >
		<div class="container mt25 offset-0" style="padding-left:15px ">
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
		        $viwedate1 = date("d/m/Y", strtotime(isset($_REQUEST['check_in']) ? $_REQUEST['check_in'] : ''));
                $viwedate2 = date("d/m/Y", strtotime(isset($_REQUEST['check_out']) ? $_REQUEST['check_out'] : ''));
            ?>
			<div class="col-md-12 pagecontainer2 offset-0" style="padding-bottom: 35px ! important; margin-left: 9px">
			<!-- <?php if (isset($_REQUEST['msg']) && $_REQUEST['msg']=="failed") { ?> 
	           	<div class="alert failed-msg alert-danger alert-dismissible" role="alert" style="position:fixed;width:49.35%">
				  <strong>Payment failed!</strong> Please choose other payment option.
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<script>
					window.setTimeout(function() {
					    $(".failed-msg").fadeTo(500, 0).slideUp(500, function(){
					        $(this).remove(); 
					    });
					}, 4000);
				</script>
    	    <?php } ?> -->
			<form method="post" name="payment_form" id="payment_form">
				<input type="hidden" name="nationality" value="<?php echo $_REQUEST['nationality'] ?>">
				<?php foreach ($_REQUEST['RequestType'] as $key => $value) { ?>
					<input type="hidden" name="RequestType[]" value="<?php echo $value ?>">
				<?php }	?>
				<input type="hidden" name="adults" id="adults" value="<?php echo array_sum($_REQUEST['reqadults']) ?>">
				<input type="hidden" name="childs" id="childs" value="<?php echo array_sum($_REQUEST['reqChild']) ?>">
				<input type="hidden" name="mark_up" id="mark_up" value="">
				<input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $_REQUEST['hotel_id'] ?>">
				<input type="hidden" name="tax" id="tax" value="<?php echo $res->details->tax; ?>">
				<input type="hidden" name="Check_in" value="<?php echo isset($_REQUEST['check_in']) ? $_REQUEST['check_in'] : '' ?>">
				<input type="hidden"  name="Check_out"  value="<?php echo isset($_REQUEST['check_out']) ? $_REQUEST['check_out'] : '' ?>" />
				<input type="hidden" name="no_of_rooms"  value="<?php echo $_REQUEST['no_of_rooms'] ?>">
				<input type="hidden" name="no_of_days"  value="<?php echo $tot_days ?>">
				<!-- <input type="hidden" name="room_index"  value="<?php echo $_REQUEST['room_index'] ?>">
				<input type="hidden" name="contract_index"  value="<?php echo $_REQUEST['contract_index'] ?>">
				<input type="hidden" name="room_id"  value="<?php echo $_REQUEST['room_index'] ?>">
				<input type="hidden" name="contract_id"  value="<?php echo $_REQUEST['contract_index'] ?>"> -->
				<input type="hidden" name="token" value="<?php echo $_REQUEST['token'] ?>">
				<div class="padding30 grey">
					<div class="row margtop15">
						<div class="col-sm-3">
							<span class="opensans size13"><b>Check in date</b></span>
							<input type="text" class="form-control wh90percent" value="<?php echo $viwedate1  ?>" readonly>
						</div>
						<div class="col-sm-3">
							<span class="opensans size13"><b>Check out date</b></span>
							<input type="text" class="form-control wh90percent" value="<?php echo $viwedate2  ?>" readonly>
						</div>
						<div class="col-sm-3 text-center">
							<span class="opensans size13"><b>Number of Nights</b></span>
							<h4><?php echo $tot_days ?></h4>
						</div>
						<div class="col-sm-3 text-center">
							<span class="opensans size13"><b>Number of Rooms</b></span>
							<h4><?php echo $_REQUEST['no_of_rooms'] ?></h4>
						</div>
					</div>

					<div class="padding20 margtop25" style="background-color: ghostwhite;">
						<div class="row">
							<div class="col-sm-6"  style="border-right: 1px dashed #bbb;">
								<?php 
				                       $adultss= array_sum($_REQUEST['reqadults']); ?>
								<label>Adult(s) : <span class="badge"><?php echo $adultss ?></span></label>
									
							</div>
							<div class="col-sm-6">
								<?php if (isset($_REQUEST['reqChild'])) {
			            				$childss= array_sum($_REQUEST['reqChild']);
			            			} else {
			            				$childss= "0";
			            			} ?>
								<label><?php echo $childss > 1 ? 'Children' : 'Child' ?> : <span class="badge"><?php echo $childss ?></span></label>
							</div>
						</div>
					</div>
						<?php for ($x=0; $x < count($_REQUEST['reqadults']); $x++) { ?>
					<div class="col-md-6 textleft">
						<input type="text" class="hide" id="first_name" name="first_name[]" value="<?php echo $_REQUEST['Room'.($x+1).'AdultFirstName'][0] ?>">

						</div>
						<div class="col-md-6 textleft">
							<input type="text" class="hide" name="last_name[]" id="last_name" value="<?php echo $_REQUEST['Room'.($x+1).'AdultLastName'][0] ?>">
						</div>
						<?php } ?>
						<div class="col-md-6 textleft">
							</span><input type="text" class="hide" name="email" id="email" value="<?php echo $_REQUEST['email'] ?>">
						</div>
						<div class="col-md-6 textleft">
							<input type="text" class="hide" name="contact_num" id="contact_num" value="<?php echo $_REQUEST['contact_num'] ?>">
						</div>
                         <?php for ($x=0; $x < count($_REQUEST['reqadults']); $x++) { 
			                for ($i=0; $i < $_REQUEST['reqadults'][$x] ; $i++) {  ?>
		                  	<input class="form-control input-sm Room-1Adulttitle hide" name="Room<?php echo $x+1 ?>Adulttitle[]" value="<?php echo isset($_REQUEST['Room'.($x+1).'Adulttitle'][$i]) ? $_REQUEST['Room'.($x+1).'Adulttitle'][$i] : '' ?>">   
	                        <input type="text" class="hide form-control validated name-validate input-sm" name="Room<?php echo $x+1 ?>AdultFirstName[]" value="<?php echo isset($_REQUEST['Room'.($x+1).'AdultFirstName'][$i]) ? $_REQUEST['Room'.($x+1).'AdultFirstName'][$i] : '' ?>">
		                    <input type="text" class="form-control hide validated name-validate  input-sm" name="Room<?php echo $x+1 ?>AdultLastName[]" value="<?php echo isset($_REQUEST['Room'.($x+1).'AdultLastName'][$i]) ? $_REQUEST['Room'.($x+1).'AdultLastName'][$i] : '' ?>">
		                    <input type="number" class="form-control hide validate validated input-sm" name="Room<?php echo $x+1 ?>AdultAge[]" value="<?php echo isset($_REQUEST['Room'.($x+1).'AdultLastName'][$i]) ? $_REQUEST['Room'.($x+1).'AdultAge'][$i] : '' ?>">
		                <?php } ?>
		                <?php for ($j=0; $j <$_REQUEST['reqChild'][$x] ; $j++) { ?>
		                	<input class="form-control input-sm Room-1Adulttitle hide" name="Room<?php echo ($x+1)  ?>ChildTitle[]" value="<?php echo isset($_REQUEST['Room'.($x+1).'ChildTitle'][$j]) ? $_REQUEST['Room'.($x+1).'ChildTitle'][$j] : '' ?>">
							<input type="text" class="form-control hide validated name-validate  input-sm" name="Room<?php echo ($x+1)  ?>ChildFirstName[]" value="<?php echo isset($_REQUEST['Room'.($x+1).'ChildFirstName'][$j]) ? $_REQUEST['Room'.($x+1).'ChildFirstName'][$j] : '' ?>">
							<input type="text" class="form-control validated name-validate hide  input-sm" name="Room<?php echo ($x+1)  ?>ChildLastName[]" value="<?php echo isset($_REQUEST['Room'.($x+1).'ChildLastName'][$j]) ? $_REQUEST['Room'.($x+1).'ChildLastName'][$j] : '' ?>">
		                <?php } ?>
		                <?php } ?>
                     <input type="hidden" name="boardChildTotal" value="<?php echo $ctBchildamount ?>">

                    <div class="clearfix"></div>
                   <?php /* <div class="col-md-12">
						<div class="row">
						<?php 
						$additionalfoodrequest = array();
						if(count($additionalfoodrequest)!=0) { ?>
						<span class="size16px bold dark">Add meals</span><br/><br/>
						<?php } ?>
							<div class="row">
								<?php if(count($additionalfoodrequest)!=0) {
									foreach ($additionalfoodrequest['board'] as $frkey => $frvalue) {
									?>
									<div class="col-sm-4 text-center">
											<?php 
												if ($this->session->userdata($frvalue)['supplementType']==$frvalue && $this->session->userdata($frvalue)['contract_id']==$_REQUEST['contract_id'] && $this->session->userdata($frvalue)['room_id']==$_REQUEST['room_id']  && $this->session->userdata($frvalue)['token']==$_REQUEST['token']) { ?>
												<a href="#" class="additional-food disabled">
													<img src="<?php echo base_url();?>assets/images/<?php echo strtolower($frvalue); ?>.png" width="55px" alt="breakfast"/>
													<p>Add <?php echo $frvalue; ?></p>
												</a>
											<?php } else { ?>
												<a href="#" onclick="aditionalfoodRequest1('board%5B%5D','<?php echo $frvalue; ?>');" class="additional-food">
													<img src="<?php echo base_url();?>assets/images/<?php echo strtolower($frvalue); ?>.png" width="55px" alt="breakfast"/>
													<p>Add <?php echo $frvalue; ?></p>
												</a>
											<?php	} ?>
									</div>
								<?php
								 } 
							} ?>
							</div>
							<div class="row" style="margin-top: 10px;">
								<div class="col-sm-12">
								<?php 
								$BreakfastAmount = 0;
								$LunchAmount = 0;
								$DinnerAmount = 0;
								for ($i=0; $i < count($_REQUEST['reqadults']); $i++) { ?>
								<?php $IndexSplit = explode("-", $_REQUEST['Room'.($i+1)]);
								if ($this->session->userdata('Breakfast')!="" && isset($this->session->userdata('Breakfast')['contract_id'][$i]) && $this->session->userdata('Breakfast')['contract_id'][$i]==$IndexSplit[0] && $this->session->userdata('Breakfast')['room_id'][$i]==$IndexSplit[1] && $this->session->userdata('Breakfast')['token']==$_REQUEST['token'] && isset($this->session->userdata('Breakfast')['splAdultsCheck'][$i])) { ?>
									<div class="additional-food-amount">
										<p>
											<a href="#" onclick="aditionalfoodRequest1('board%5B%5D','Breakfast');" class=""><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
											<span>Breakfast Amount </span>: <b><?php echo currency_type(agent_currency(),isset($Breakfast['totAmounts'][$i]) ? $Breakfast['totAmounts'][$i] : 0); ?> <?php echo agent_currency(); ?></b>
											<span style="
											    margin-left: 20%;
											    font-size: 15px;
											    font-weight: bold;
											    color: #0074b9;
											">Room <?php echo $i+1 ?> <img src="<?php echo base_url();?>assets/images/breakfast.png" width="25px" alt="breakfast"></span>
											<a href="#" onclick="aditionalfoodRemoveRequest1('board%5B%5D','Breakfast',<?php echo $i ?>);" class="pull-right additional-close"><i class="fa fa-times-circle"></i></a>
											
										</p>
									</div>
									<?php 
										$BreakfastAmount =  $Breakfast['totAmounts'][$i];
									?>
								<?php } ?>
								<?php
								 if ($this->session->userdata('Lunch')!="" && isset($this->session->userdata('Lunch')['contract_id'][$i]) && $this->session->userdata('Lunch')['contract_id'][$i]==$IndexSplit[0] && $this->session->userdata('Lunch')['room_id'][$i]==$IndexSplit[1] && $this->session->userdata('Lunch')['token']==$_REQUEST['token'] && isset($this->session->userdata('Lunch')['splAdultsCheck'][$i])) { 
								 	?>
									<div class="additional-food-amount">
										<p>
											<a href="#" onclick="aditionalfoodRequest1('board%5B%5D','Lunch');" class=""><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
											<span>Lunch Amount </span>: <b><?php echo currency_type(agent_currency(),isset($Lunch['totAmounts'][$i]) ? $Lunch['totAmounts'][$i] : 0); ?> <?php echo agent_currency(); ?></b>
											<span style="
											    margin-left: 20%;
											    font-size: 15px;
											    font-weight: bold;
											    color: #0074b9;
											">Room <?php echo $i+1 ?> <img src="<?php echo base_url();?>assets/images/lunch.png" width="25px" alt="lunch"></span>
											<a href="#" onclick="aditionalfoodRemoveRequest1('board%5B%5D','Lunch',<?php echo $i ?>);" class="pull-right additional-close"><i class="fa fa-times-circle"></i></a>
											
										</p>
									</div>
									<?php 
										$LunchAmount = $Lunch['totAmounts'][$i];
									 ?>
								<?php } ?>
								<?php if ($this->session->userdata('Dinner')!="" && isset($this->session->userdata('Dinner')['contract_id'][$i]) && $this->session->userdata('Dinner')['contract_id'][$i]==$IndexSplit[0] && $this->session->userdata('Dinner')['room_id'][$i]==$IndexSplit[1] && $this->session->userdata('Dinner')['token']==$_REQUEST['token'] && isset($this->session->userdata('Dinner')['splAdultsCheck'][$i])) { ?>
									<div class="additional-food-amount">
										<p>
											<a href="#" onclick="aditionalfoodRequest1('board%5B%5D','Dinner');" class=""><i class="fa fa-pencil-square-o"></i>&nbsp;</a>
											<span>Dinner Amount </span>: <b><?php echo currency_type(agent_currency(),isset($Dinner['totAmounts'][$i]) ? $Dinner['totAmounts'][$i] : 0); ?> <?php echo agent_currency(); ?></b>
											<span style="
											    margin-left: 20%;
											    font-size: 15px;
											    font-weight: bold;
											    color: #0074b9;
											">Room <?php echo $i+1 ?> <img src="<?php echo base_url();?>assets/images/dinner.png" width="25px" alt="dinner"></span>
											<a href="#" onclick="aditionalfoodRemoveRequest1('board%5B%5D','Dinner',<?php echo $i ?>);" class="pull-right additional-close"><i class="fa fa-times-circle"></i></a>
											
										</p>
									</div>
									<?php
										$DinnerAmount = $Dinner['totAmounts'][$i];
									?>

								<?php } 
									$totalFoodAmount = $BreakfastAmount+$LunchAmount+$DinnerAmount;
									}
								?>
								</div>
							</div>
						</div>
					</div> */?>
					<h4 class="opensans dark bold">Booking Amount Breakup</h4>				

					<?php 
					if (isset($res->status) && $res->status==true && isset($res->details)) {
            $finalAmount = 0;
						foreach ($_REQUEST['reqadults'] as $RAkey => $RAvalue) { 
							$room = 'room'.($RAkey+1);
							$roomdetails = $res->details->$room; ?>
    					<input type="hidden" name="RoomIndex[]" value="<?php echo $_REQUEST['Room'.($RAkey+1)] ?>" >
	            <div class="row payment-table-wrap">
            		<div class="col-md-12">
            			<h4 class="room-name">Room <?php echo $RAkey+1 ?></h4>
            			<table class="table-bordered" >
            				<thead>
            					<tr>
            						<th style="width: 85px;">Date</th>
	            					<th style="width: calc(100% - 265px);">Room Type</th>
	            					<th style="width: 60px; text-align: center">Board</th>
	            					<th style="width: 120px; text-align: right">Rate</th>
            					</tr>
            				</thead>
            				<tbody>
            					<?php foreach($roomdetails->amount_breakup as $value) { ?>
              					<!-- Room amount breakup start -->
              					<tr>
              						<input type="hidden" name="per_day_amount[]" value="<?php echo $value->Price ?>">
              						<input type="hidden" name="Room<?php echo $RAkey+1 ?>per_day_amount[]" value="<?php echo $value->Price; ?>">
                					<td><?php echo $value->Date ?></td>
                					<td><?php echo $value->RoomName ?></td>
                					<td style="text-align: center"><?php echo $value->Board ?></td>
                					<td style="text-align: right"><?php echo $value->Price ?></td>
              					</tr>
              					<!-- Room amount breakup end -->
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3" style="text-align: right"><strong class="text-blue">Total</strong></td>
                        <td style="text-align: right; font-weight: 700; color: #0074b9">AED <?php echo $roomdetails->totalroomamount->price?></td>
                      </tr>
          				  </tfoot>
	            		</table>
	            	</div>
	            </div>
                <?php $finalAmount += $roomdetails->totalroomamount->price;
            }  ?>               
      			<div class="col-md-12"> 
      			  <div class="row b-rates margtop10">
  	            <div class="col-sm-12">
  		            <div class="col-sm-12">
  		              <h5 class="b-rates--tax">Tax : <span class="right">AED <?php echo $res->details->tax; ?></span></h5>
		                <?php 
        							$grandTotal = $res->details->tax+$finalAmount;
        					  ?>
		              	<h5 class="b-rates--grand">GRAND TOTAL : 
  		              	<span class="right">AED 
  			               <span class="b-rates--grand-total"><?php echo $grandTotal ?> </span>
  						        </span>
  						      </h5>
  		            </div>
  	            </div>
  	          </div>
  	        </div>
			     <div class="col-md-12 padding30" style="padding-bottom: 0px;padding-top: 0px;">
        		<h4 class="opensans dark bold">Special Request</h4>     
         		<textarea name="SpecialRequest" class="form-control" placeholder="eg: I want early check-in or specify the time you will check-in"></textarea>
        	</div>
    			<div class="col-md-12 padding30">
    				<span class="opensans size18 blue bold">Important Remarks & Policies</span><br><br>
    				<div><?php echo isset($res->details->remarks_and_policies) ? $res->details->remarks_and_policies : 'Not Applicable'; ?></div>
    			</div><br>
    			<div class="alert alert-info padding30">
    				<span class="opensans size18 blue bold">Cancellation Policy *</span><br><br>
    				<?php 
    				for ($i=0; $i < count($_REQUEST['reqadults']); $i++) { 
              $room = 'room'.($i+1);
              $roomdetails = $res->details->$room;?>	
      				<div class="payment-table-wrap">
      					<h4 class="room-name">Room <?php echo $i+1 ?> </h4>
      					<table class="table table-bordered table-hover">
      						<thead>
      					      <tr>
      					        <th>Cancelled on or After</th>
      					        <th>Cancelled on or Before</th>
      					        <th>Cancellation Charge</th>
      					      </tr>
      					    </thead>
      					    <tbody> 
      					    	<?php 
                      if (isset($roomdetails->Cancellation_policy)) {
                        foreach($roomdetails->Cancellation_policy as $value) { 
                          if ($value[0]->application=="Nonrefundable") {  ?>
                              <tr>
                                <td colspan="3">
                                    This booking is Nonrefundable
                                </td>
                              </tr>
                          <?php }  else {
                            foreach ($value as $key => $Cancvalue) { ?>
                              <tr>
                                <td><?php echo date("d/m/Y", strtotime($Cancvalue->FromDate )) ?></td>
                                <td><?php  echo date("d/m/Y", strtotime($Cancvalue->ToDate )) ?></td>
                                <td><?php if ($Cancvalue->application=="FIRST NIGHT") {
                                      $finalAmount = $roomdetails->totalroomamount->price;
                                    }
                                    if ($Cancvalue->application=="FREE OF CHARGE") {
                                      $finalAmount = 0;
                                    }
                                    $charge = $roomdetails->totalroomamount->price*($Cancvalue->CancellationCharge/100);
                                    echo $charge." AED (".$Cancvalue->application.")"?></td>
                              </tr>
                            <?php } 
      					    		  }
                        } 
                      } else { ?> 
                        <tr>
                          <td colspan="3">
                           		This booking is Nonrefundable
                          </td>
                        </tr>
                      <?php } ?>
      				    	</tbody>
      					</table>
      				</div> 
    				<?php	}
          }	?>	<br>
    			<input type="checkbox" name="cancel_agree" id="cancel_agree">
					<span id="check_box_cancellation_err blink_me"></span>
				 	<label class="opensans size12 blue bold" for="cancel_agree">If you agree to the cancellation policy, kindly select the checkbox and proceed.</label> 
    		</div>
			  <div class="row">
  				<div class="col-md-12">
  					<div class="col-md-12 pay_options">
  						<h4 class="hpadding20 dark bold">Choose a Payment Option <small class="pay_error"></small></h4>
  						<div class="hpadding20">
  							<div class="payment-radio-group clearfix">
                  <input type="radio" id="credit" name="paymenttype" value="credit" class="hidden payment-radio__btn">
                  <label for="credit" class="payment-radio__label">
                    <span>Credit Amount</span>
                    <small>The amount paid will be deducted from the agent credit.</small>
                  </label>
              	</div>
  						</div>
  					</div>
  				</div>
			</div>
		</form>
		<div class="col-md-12 mt10">
				<div class="form-group col-md-12">
					<button class="bluebtn pull-right" id="Confirm_book" type="button" name="Continue_book">Confirm</button>
				</div>
		</div>
		<div class="clear-fix"></div>
		</div>
</div>
</div>
<div class="modal fade " id="boardAllocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

		<!-- END OF RIGHT CONTENT -->
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
  $('#Continue_book_api').click(function () {  
  alert("hi");    
    $("#payment_form").attr("action","./bookingreview.php");
    $("#payment_form").submit();       
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