angular.module("AdivahaAHBHotelsSearchbox", [
	'elif',
	'AdivahaAHBHotelsSearchbox.directives'
]);

angular.element(document).ready(function() {
var element = angular.element(document.querySelector('#adivaha_api_hotels_box'));
var isInitialized = element.injector();
if (!isInitialized) {
	angular.bootstrap(element, ['AdivahaAHBHotelsSearchbox']);
}
});

angular.module("AdivahaAHBHotelsSearchbox").filter('range', function() {
	return function(input, total) {
		total = parseInt(total);
		for (var i=0; i<total; i++)
			input.push(i);
			return input;
	};
});

'use strict';
/* Controllers */
angular.module('AdivahaAHBHotelsSearchbox.directives', [])

/* Starting of Adiaha Hotel Search Box*/
.directive('adivahaAhbHotelsSearchBox', function () {
    return {
		controller: function ($scope, $http) {
		 var prefix =jQuery('#prefix_adivaha_hotels').val(); 
        $scope.prefix = prefix;	
		
		$scope.ip_address = document.getElementById(prefix + 'ip_address').value;
		//alert($scope.ip_address);
			
		var xhr = null;
		$scope.getLocation_HotelsHint = function(val) {
			var locale= document.getElementById("adh_language").value;
			var term =$scope.adi_destination_name;
			return xhr = $http.get('//yasen.hotellook.com/autocomplete', {
				params: {
				lang: locale,
				limit: "5",
				term: term
				}
			}).then(function(response){
				if(JSON.stringify(response.data.hotels) != "[]" && JSON.stringify(response.data.hotels) != "[]"){
					$scope.hotel_destinations = response.data.hotels;
					$scope.city_destinations = response.data.cities;
					$scope.showpopup = true;	
				}else{
					$scope.showpopup = false;
				}
				
			});
		};
		
		
		/* $scope.Update_Search_Hotels_Param = function(city_destinations_id, latinFullName,lat,lng){
			$scope.adi_destination_name = latinFullName;
			$scope.adi_destination_id = lat+'|'+lng;
			document.getElementById(prefix+"regionid").value = $scope.adi_destination_id;
			document.getElementById(prefix+"regionname").value = latinFullName;
			$scope.showpopup = false;
		}; */								
		
		$scope.Update_Search_Hotels_Param = function(city_destinations_id, latinFullName, lat, lng, hotel_or_destination) {
			$scope.adi_destination_name = latinFullName;
			$scope.adi_destination_id = lat + '|' + lng;
			document.getElementById(prefix + "regionid").value = $scope.adi_destination_id;
			document.getElementById(prefix + "regionname").value = latinFullName;
			$scope.datatype = hotel_or_destination;
			document.getElementById("searchType").value = hotel_or_destination;
			$scope.showpopup = false;
		};
		
		$scope.Search_Hotels = function() {
			var rooms = document.getElementById(prefix + "rooms").value;
			var searchtype = document.getElementById("searchType").value;
			var adtStr = '';
			var chdStr = '';
			var childAgeStr = '';
			for (var i = 0; i < rooms; i++) {
				adtStr += jQuery('#' + prefix + 'adults_' + i).val() + ',';
				chdStr += jQuery('#' + prefix + 'childs_' + i).val() + ',';
				var chls = jQuery('#' + prefix + 'childs_' + i).val();
				if (chls > 0) {
					var agess = '';
					var agesss = '';
					for (var c = 0; c < chls; c++) {
						var age = document.getElementById(prefix + "childAge" + i + '_' + c).value;
						agess += age + ',';
					}
					agesss = agess.slice(0, -1);
					childAgeStr += i + '_' + agesss + '-';
				} else {
					childAgeStr += i + '_';
				}
			}
			var adults = adtStr.slice(0, -1);
			var childs = chdStr.slice(0, -1)
			var childAge = childAgeStr.slice(0, -1);
			var resultsPage = jQuery('#adivaha_site_url').val() + '/' + document.getElementById(prefix + 'result_page').value;
			if ($scope.datatype == "hotel") {
				var hotelName = document.getElementById(prefix + "regionname").value.split(',');
				var hotel_name = hotelName[0];
			} else {
				var hotel_name = '';
			}
			var url = resultsPage + "/?dest=" + document.getElementById(prefix + "regionname").value + "&checkIn=" + document.getElementById(prefix + "checkIn").value + "&checkOut=" + document.getElementById(prefix + "checkOut").value + "&rooms=" + document.getElementById(prefix + "rooms").value + "&adults=" + adults + "&children=" + childs + "&childAge=" + childAge + "&language=" + document.getElementById("adh_language").value + "&currency=" + document.getElementById("adh_currency").value + "&cityId=" + document.getElementById(prefix + "regionid").value + "&hotel_name=" + hotel_name + "&datatype=" + searchtype;
			location.href = url;
			jQuery(".inputadiPColor").addClass("clicked_btnloader");
		};
		
		/* Show Hide Hotel Criteria Filters */
		
		$scope.showpopupfilters = false;
		$scope.filtersonoff = function(val) {
			$scope.showpopupfilters = true;
		}
		
		$scope.hideRoomGroup = function(val) {
			$scope.showpopupfilters = false;
			showGuestRoom();
		}
		
		$scope.increasenoofrooms = function(){
			if($scope.noofrooms<7){
				$scope.noofrooms++;
			   document.getElementById(prefix+"rooms").value = $scope.noofrooms;
			}						
			setTimeout(function(){ changeChildNo(); }, 100);
		}
		
		$scope.decreasenoofrooms = function(){
			if($scope.noofrooms>1){
				$scope.noofrooms--;
			  document.getElementById(prefix+"rooms").value = $scope.noofrooms;
			}						
			setTimeout(function(){ changeChildNo(); }, 100);
		}
		
		function showGuestRoom(){
		  var totalGuest =0;
		  for(var i=0; i<$scope.noofrooms;i++){
			var adt =jQuery('#'+prefix+'adults_'+i).val();
            var chd =jQuery('#'+prefix+'childs_'+i).val();  
            totalGuest+= parseInt(adt)+ parseInt(chd);			
		  }	
          $scope.totalGuest = totalGuest;		  
		  $scope.filterswitcher = $scope.noofrooms + " " + document.getElementById('txt_Rooms').value + " " +  totalGuest + " " + document.getElementById('txt_guests').value;
		}
				
		function changeChildNo(){ 		  
			jQuery('.changeChildNo').change(function(){ 			  
			var r  =jQuery(this).attr('relRoom');			  
			var n  =jQuery(this).val();			  
			var html ='';			  
			if(n>0){ 				  
				html+='<span style="font-size:0px;"></span>'; 				  
				for(var i=0;i<n;i++){					
					html+='<div class="age_childdiv"><label class="age_label">Age<span>Below 12 years</span></label><select name="childAge['+r+'][]" id="'+prefix+'childAge'+r+'_'+i+'" class="form-control childagarss"><option selected="selected" value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select></div>'
				}			  
			}			
			jQuery('#'+prefix+'childAgeID_'+r).html(html);		  
			})		
		}				
		setTimeout(function(){ changeChildNo(); }, 100);		
		
		/* Set the Default Values */	
		
		$scope.adi_destination_id = document.getElementById(prefix+"regionid").value;
		$scope.adi_destination_name=document.getElementById(prefix+"regionname").value;
		$scope.noofrooms = document.getElementById(prefix+"rooms").value;
		
		var adultArr = document.getElementById(prefix+"adults").value.split(",");
		var childsArr = document.getElementById(prefix+"children").value.split(",");				
		var childAgeArr = document.getElementById(prefix+"childage").value.split("-");						
		/* Bind Child Age ==*/				
		function childAgeHtml(){		  
			for(var g =0; g<$scope.noofrooms;g++){			 
				var nchild =childsArr[g];			 
				if(nchild>0){				
					var childAgeHtml=''; 				
					var cAge =childAgeArr[g].split('_');				
					var childAg =cAge[1];				
					for(var h=0;h<nchild;h++){				  
						var childAgArr =childAg.split(',');				  
						childAgeHtml+='Age Below 12 years <select id="'+prefix+'childAge'+g+'_'+h+'" class="childagarss">';				   
							for(var k=0;k<13;k++){					 
								if(childAgArr[h]==k){					   
									childAgeHtml+='<option value="'+k+'" selected="selected">'+k+'</option>';  				     
								} else{						
									childAgeHtml+='<option value="'+k+'">'+k+'</option>';  					
								}					 				   
							}				  
						childAgeHtml+='</select>';				
					} 			 
				}			 
			jQuery('#adivaha_hotels_childAgeID_'+g).html(childAgeHtml);		  
			}		
		}		
		setTimeout(function() { childAgeHtml()}, 400);				
		setTimeout(function() { selectAdtChd()}, 100);
		function selectAdtChd(){ 
		   for(var s=0;s<$scope.noofrooms;s++){
			jQuery("#"+prefix+"adults_"+s+" option[value="+adultArr[s]+"]").attr('selected', 'selected');
			jQuery("#"+prefix+"childs_"+s+" option[value="+childsArr[s]+"]").attr('selected', 'selected');
		   }
		}
		
		/*==== On Page Load show this ===*/ 
		var totalGuest =0;
	    for(var i=0; i<$scope.noofrooms;i++){
			var adt =adultArr[i];
			var chd =childsArr[i];;  
			totalGuest+= parseInt(adt)+ parseInt(chd);			
	    }	
	    $scope.totalGuest = totalGuest;
		$scope.filterswitcher = $scope.noofrooms + " " + document.getElementById('txt_Rooms').value + " " +  totalGuest + " " + document.getElementById('txt_guests').value;
		
        },
	
		template: '<div class="adiFullp tabpaneback searchBoxMobile" style=""><div class="'+document.getElementById('adimaxwidth').value+'"><ul class="adiFullp width'+document.getElementById('responsive_width').value+' labelno'+document.getElementById('label_yes_and_no').value+' siteL'+document.getElementById('adh_language').value+'"><li class="adiFullWp-45 position-relative map_ioncs"> <label class="label-onP nolabel labelColor">I want to go to</label> <input type="text" class="inputadiP " name="destination" ng-model="adi_destination_name" ng-change="getLocation_HotelsHint(desti)"><div class="show-autocomplete-popup showhidepopup{{showpopup}} background-color-white adi-box-shadow position-absolute">'+ 
		'<!-- City lists autosation -->'+
		'<h6 style="font-size: 11px;letter-spacing: 1px;padding: 8px 8px 0px 8px;">'+document.getElementById('txt_cities').value+'</h6><a class="autocomplete-dropdown adi-full padding-10 border-bottom-1" ng-cloak ng-repeat="city_destinations in city_destinations track by $index"  ng-click="Update_Search_Hotels_Param(city_destinations.locationId, city_destinations.fullname,city_destinations.location.lat,city_destinations.location.lon,\'location\')">{{city_destinations.fullname}}</a><!--<h6 style="font-size: 11px;letter-spacing: 1px;padding: 8px 8px 0px 8px;" >'+document.getElementById('txt_hotels').value+'</h6 ><a class="autocomplete-dropdown adi-full padding-10 border-bottom-1" ng-cloak ng-repeat="hotel_destinations in hotel_destinations track by $index"  ng-click="Update_Search_Hotels_Param(hotel_destinations.location.locationId, hotel_destinations.hotelFullName,hotel_destinations.location.lat,hotel_destinations.location.lon,\'hotel\')">{{hotel_destinations.hotelFullName}}</a>-->'+
	
		'</div></li><li class="adiFullWp-21 calendar_ioncs"> <label class="label-onP nolabel labelColor">Travel Dates</label> <input type="text" class="inputadiP daterangeResorts adip-border" name="daterangeResorts" id="{{prefix}}dateRange" value=""></li><li class="adiFullWp-20 position-relative man_image_ioncs"> <label class="label-onP labelColor nolabel">Travelers</label> <input type="text" ng-model="filterswitcher" class="inputadiP adip-border" ng-click="filtersonoff()" readonly="readonly" id="dropboxadi">'+
		
		
		'<div id="drope_box" class="background-color-white P-adi-box-shadow adiFullp padding-20 position-absolute drope_box-css showhidefilters{{showpopupfilters}}">'+	'<div class="adiFullp margin-bottom-10">'+'<div class="P-adi-width-33">'+'<label class="label-onP">'+document.getElementById('txt_Room').value+'</label>'+'<div class="adiFullp" style="display: flex;"> <a href="" class="border-one" ng-click="decreasenoofrooms()">-</a>  <a href="" class="border-two ng-binding">{{noofrooms}}</a>  <a href="" class="border-three" ng-click="increasenoofrooms()">+</a>'+	'</div>'+'</div>'+'<div id="packListdiv">'+'<div class="margintopFull" ng-repeat="n in [] | range: noofrooms"><div class="packadultscls new-div-add1 nomar"><label class="label-onP" ng-if="n<1">'+document.getElementById('txt_adults').value+'</label><select name="adults[]" id="{{prefix}}adults_{{n}}" class="form-control backImgUse"><option selected="selected" value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></div> <div class="packchildsscls  nomar"><label class="label-onP" ng-if="n<1">'+document.getElementById('txt_childs').value+'</label><select name="childs[]" id="{{prefix}}childs_{{n}}" class="form-control changeChildNo backImgUse selectchild" relroom="{{n}}"><option selected="selected" value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div><div style="clear:both;"></div><div id="{{prefix}}childAgeID_{{n}}" class="packchildagecls age-childAge"></div></div><br>'+'</div><div style="clear:both;"></div>'+'</div>'+'<div class="adiFullp">'+'<div class="be-ddn-footer adiFullp" style="background-color:'+document.getElementById('color_filterbutton').value+';"> <a href="javascript:void(0)" class="" ng-click="hideRoomGroup();">'+document.getElementById('txt_done').value+'</a>'+'</div>'+'</div>'+'</div>'+
		
'</li>'+
'<li class="adiFullWp-14">'+
	'<label class="label-onP nolabel">&nbsp;</label>'+
	'<input class="inputadiP inputadiPColor" style="padding-left: 0px;" type="button" value='+document.getElementById('txt_search').value+' onclick="Search_Hotelss()">'+
'</li>'+
'</ul>'+
'</div>'+
'</div>'+

'<style>.tabpaneback {background-color: '+document.getElementById('color_wrapperbackground').value+';padding-top: '+document.getElementById('paddingtop').value+';padding-bottom: '+document.getElementById('paddingbottom').value+';padding-left: '+document.getElementById('paddingleft').value+';padding-right: '+document.getElementById('paddingright').value+';}.labelColor {color: '+document.getElementById('color_labelcolor').value+'}.inputadiPColor {background-color: '+document.getElementById('color_filterbutton').value+';}.show-autocomplete-popup a:hover {color: #fff;background-color: '+document.getElementById('color_autocompletehover').value+'}.age-childAge{right: 50%;}.age_childdiv .age_label{    font-size: 15px;color: #777;font-weight: 500;margin: 10px 0px;}#adivaha_hotels_childAge0_2,#adivaha_hotels_childAge0_1,#adivaha_hotels_childAge0_0{padding: 5px !important;width: 100% !important;}</style>'

};
})

jQuery(function() {
	var prefix =jQuery('#prefix_adivaha_hotels').val(); 
	var language =document.getElementById("adh_language").value;
	if(language=='ar'){
	  var daysOfWeek =['Ø­', 'Ù†', 'Ø«', 'Ø±', 'Ø®', 'Ø¬', 'Ø³'];
	  var monthNames =['ÙŠÙ†Ø§ÙŠØ±', 'ÙØ¨Ø±Ø§ÙŠØ±', 'Ù…Ø§Ø±Ø³', 'Ø¥Ø¨Ø±ÙŠÙ„', 'Ù…Ø§ÙŠÙˆ', 'ÙŠÙˆÙ†ÙŠØ©','ÙŠÙˆÙ„ÙŠÙˆ', 'Ø£ØºØ³Ø·Ø³', 'Ø³Ø¨ØªÙ…Ø¨Ø±', 'Ø£ÙƒØªÙˆØ¨Ø±', 'Ù†ÙˆÙÙ…Ø¨Ø±', 'Ø¯ÙŠØ³Ù…Ø¨Ø±'];
	  var opens ='left';
	  var direction ='rtl';
	}else{
	 var daysOfWeek =['Su','Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
	 var monthNames =['January', 'February', 'March', 'April', 'May', 'June','July', 'August', 'September', 'October', 'November', 'December'];
	 var opens ='right';
	 var direction ='ltr';	
	}

	if (document.getElementById(prefix+"checkIn") != null) {			
		var today_Date = new Date(document.getElementById(prefix+"checkIn").value);
		var nextDayDate = new Date(document.getElementById(prefix+"checkOut").value);
		jQuery("#"+prefix+"dateRange").daterangepicker({
		startDate: today_Date, 
		endDate: nextDayDate,
		opens: opens,
		autoApply: true,
		autoclose: true,
		locale: {
			  direction: direction,
			  format: 'DD-MMM-YYYY',
			  daysOfWeek: daysOfWeek,
			  monthNames: monthNames ,
			  firstDay: 1
			}
		}, function(start, end, label) {
		  jQuery("#"+prefix+"checkIn").val(start.format('YYYY-MM-DD'));
		  jQuery("#"+prefix+"checkOut").val(end.format('YYYY-MM-DD'))
		});
	}
	
	
});