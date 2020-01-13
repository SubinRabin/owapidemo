angular.module("AdivahaAHBHotelsSearchResults", ['AdivahaAHBHotelsSearchResults.directives']);
angular.element(document).ready(function() {
    var element = angular.element(document.querySelector('#search_hotels_results_ahb'));
    var isInitialized = element.injector();
    if (!isInitialized) {
        angular.bootstrap(element, ['AdivahaAHBHotelsSearchResults']);
    }
});
angular.element(document).ready(function() {
    jQuery(document).ready(function() {
        jQuery(".grid-click").click(function() {
            jQuery('.search-result').addClass('searchGrid');
            jQuery('.searchGrid .add-cl-js').addClass('adi-col-4').addClass('adi-left');
            jQuery('.searchGrid .add-cl-js').removeClass('adi-full');
            jQuery('.adi-col-3-full').addClass('adi-full');
            jQuery('.adi-col-3-full').removeClass('text-right');
            jQuery('.Grid-show').css('display', 'block');
            jQuery('.Grid-hide').css('display', 'none');
            jQuery('.Grid-padding').addClass('padding-20');
            jQuery('.Grid-paddingrem').removeClass('padding-20');
        });
        jQuery(".list-click").click(function() {
            jQuery('.search-result').removeClass('searchGrid');
            jQuery('.search-result .add-cl-js').removeClass('adi-col-4').removeClass('adi-left');
            jQuery('.search-result .add-cl-js').addClass('adi-full');
            jQuery('.adi-col-3-full').removeClass('adi-full');
            jQuery('.adi-col-3-full').addClass('text-right');
            jQuery('.Grid-show').css('display', 'none');
            jQuery('.Grid-hide').css('display', 'block');
            jQuery('.Grid-padding').removeClass('padding-20');
            jQuery('.Grid-paddingrem').addClass('padding-20');
        });
        jQuery(".map-click").click(function() {
            jQuery('.map-display-none').css('display', 'none');
            jQuery('.map-full-width').addClass('adi-full');
            jQuery('.map-show').addClass('map-show-add');
            jQuery('.search-result').addClass('map-search-result');
            jQuery('.filter-click').css('display', 'inline-block');
        });
        jQuery(".filter-click").click(function() {
            jQuery('.map-display-none').css('display', 'block');
            jQuery('.map-full-width').removeClass('adi-full');
            jQuery('.map-show').removeClass('map-show-add');
            jQuery('.search-result').removeClass('map-search-result');
            jQuery('.filter-click').css('display', 'none');
        });
        if (jQuery(window).width() < 1024) {
            jQuery('.search-result').addClass('searchGrid'); /*jQuery('.add-cl-js').addClass('adi-col-4').addClass('adi-left');*/
            jQuery('.list-click').hide();
            jQuery('.grid-click').hide();
        }
    }); /* end this code use only search page */
    if (jQuery(window).width() < 1024) {
        var filterToggleUse = 0;
        jQuery(".modifybtn").show();
        jQuery(".searchBoxMobile").hide();
        jQuery(".spinFause").hide();
        jQuery('.modifyToggle').click(function() {
            jQuery('.searchBoxMobile').slideToggle('slow');
            jQuery('.filterMobile').removeClass('filterMobileOpen');
			jQuery("body").css("overflow", "inherit");
			jQuery('.header-on-off').hide();
			
            filterToggleUse = 0;
        });
		
		
        jQuery('.filterToggle').click(function() {
            if (filterToggleUse == 0) {
                jQuery('.filterMobile').addClass('filterMobileOpen');
                jQuery('.header-on-off').show();
				jQuery("body").css("overflow", "hidden");
				/*jQuery('body').css("");*/
                filterToggleUse = 1;
            } else if (filterToggleUse == 1) {
                jQuery('.filterMobile').removeClass('filterMobileOpen');
                jQuery('.header-on-off').hide();
				jQuery("body").css("overflow", "inherit");
                filterToggleUse = 0;
            }
        });
        jQuery('.header-on-off').click(function() {
            if (filterToggleUse == 1) {
                jQuery('.filterMobile').removeClass('filterMobileOpen');
                jQuery('.header-on-off').hide();
				jQuery("body").css("overflow", "inherit");
                filterToggleUse = 0;
            }
        });
        jQuery('.filterMobile').click(function() {
            if (filterToggleUse == 1) {
               /* jQuery('.filterMobile').removeClass('filterMobileOpen');*/
                filterToggleUse = 0;
            }
        })
    }
});
angular.module("AdivahaAHBHotelsSearchResults").filter('range', function() {
    return function(input, total) {
        total = parseInt(total);
        for (var i = 0; i < total; i++) input.push(i);
        return input;
    };
});
'use strict';
angular.module('AdivahaAHBHotelsSearchResults.directives', ['rzModule', 'ngSanitize', 'elif', 'ui.bootstrap']).directive('adivahaAhbHotelsSearchResults', function() {
            return {
                controller: function($scope, $http) {
                    var prefix = jQuery('#prefix_adivaha_hotels').val();
                    $scope.prefix = prefix;
                    var xhr = null;
                    $scope.hotelType = '';
					
                    $scope.regionid = document.getElementById(prefix + 'regionid').value;
                    $scope.regionname = document.getElementById(prefix + 'regionname').value;
                    $scope.checkIn = document.getElementById(prefix + 'checkIn').value;
                    $scope.checkOut = document.getElementById(prefix + 'checkOut').value;
                    $scope.rooms = document.getElementById(prefix + 'rooms').value;
                    $scope.adults = document.getElementById(prefix + 'adults').value;
                    $scope.children = document.getElementById(prefix + 'children').value;
                  	$scope.description_in_sametab = document.getElementById(prefix + 'description_in_sametab').value;
					
					$scope.property_type = document.getElementById(prefix + 'property_type').value;
					$scope.ip_address = document.getElementById(prefix + 'ip_address').value;
					//alert($scope.ip_address);
					
                    $scope.language = document.getElementById('adh_language').value;
                    $scope.currency = document.getElementById('adh_currency').value;
                    $scope.currency_symbol = document.getElementById('adh_currency_symbol').value;
					$scope.datatype = document.getElementById('searchType').value;
                    $scope.maxSize = 9;
                    $scope.itemsPerPage = 15;

                    var actionUrl = document.getElementById('adivaha_plugin_url').value + 
                    '/apps/modules/adivaha-hotel-booking/ean_update_rates.php';
                    FindKey();
					
					
                    function FindKey() {
                        var param = 'action=findSearchKey&regionid=' + $scope.regionid + '&destname='+$scope.regionname+'&checkIn=' + $scope.checkIn + '&checkOut=' + $scope.checkOut + '&rooms=' + $scope.rooms + '&adults=' + $scope.adults + '&children=' + $scope.children + '&hotelType=' + $scope.hotelType + '&language=' + $scope.language + '&currency=' + $scope.currency + '&datatype=' + $scope.datatype;
                        var url = actionUrl + '?' + param;
                        return xhr = $http.get(url).then(function(response) {
                            var response = response.data;
                            $scope.search_Session_Id = response.search_session;
                            if ($scope.search_Session_Id == null) {
                                return false;
                            }
                            if (response.exist == 'Yes') {
                                Upldate_Searched_Hotels();
                                getControls();
                                getAmenities();
                                jQuery('#preloader').css('display', 'none');
                            } else {
                                Upldate_Rates();
                            }
                        });
                    }
					/*
					function customer_analytics(){
						var param = 'action=customer_analytics&searched_destinations=' + $scope.regionname + '&property_type=' + $scope.property_type + '&customer_ip_address=' + $scope.ip_address + '&action_type=Hotels Search';
						var url = actionUrl + '?' + param;
						$http.get(url).success(function(response) {
							response = response.trim();
							if(response == '1'){
								alert('Updated.');
							}
							else{
								alert('Inserted.');
							}
						});					
					}
					*/

                    function Upldate_Rates() {
                        var param = 'action=Upldate_Rates&search_Session_Id=' + $scope.search_Session_Id + '&regionid=' + $scope.regionid + '&checkIn=' + $scope.checkIn + '&checkOut=' + $scope.checkOut + '&rooms=' + $scope.rooms + '&adults=' + $scope.adults + '&children=' + $scope.children + '&hotelType=' + $scope.hotelType + '&language=' + $scope.language + '&currency=' + $scope.currency;
                        var url = actionUrl + '?' + param;
                        $http.get(url).success(function(response) {
                            if (response.ErrorCode == '100') {
                                jQuery(".hotel-list-container").html("ErrorCode-100: Authentication failed, Please contact support team...");
                                jQuery(".hotel-list-container").removeClass("hidethis");
                                jQuery(".loader_hotel_content").addClass("hidethis");
                                return false;
                            }
                            $scope.Loading_msg = "Please wait while we are finding you the softest pillows ...";
                            $scope.currentPage = 1;
                            jQuery(".search-result").addClass("opacity_0_5");
                            jQuery(".wrapper-animated-loader").hide();
                            $scope.hotelList = response.responseData.HotelLists.HotelList;
                            Upldate_Rates_All();
                        });
                    };

                    function Upldate_Rates_All() {
                        var param = 'action=Upldate_Rates_All&search_Session_Id=' + $scope.search_Session_Id + '&regionid=' + $scope.regionid + '&checkIn=' + $scope.checkIn + '&checkOut=' + $scope.checkOut + '&rooms=' + $scope.rooms + '&adults=' + $scope.adults + '&children=' + $scope.children + '&hotelType=' + $scope.hotelType + '&language=' + $scope.language + '&currency=' + $scope.currency;
                        var url = actionUrl + '?' + param;
                        $http.get(url).success(function(response) {
                            Upldate_Searched_Hotels();
                            getControls();
                            getAmenities();
                        });
                    };

                    function Upldate_Searched_Hotels() {
                        var Cri_Rating = jQuery('input[name=starrating]:checked').val();
                        if (typeof Cri_Rating == 'undefined') {
                            Cri_Rating = '';
                        }
                        var Cri_Distance = jQuery('input[name=distance]:checked').val();
                        if (typeof Cri_Distance == 'undefined') {
                            Cri_Distance = '';
                        }
                        var Cri_Price = '';
                        var minPrice = $scope.minRangeSlider.minValue;
                        var maxPrice = $scope.minRangeSlider.maxValue;
                        if (typeof minPrice != 'undefined' && typeof minPrice != 'NaN' && typeof maxPrice != 'undefined' && typeof maxPrice != 'NaN') {
                            Cri_Price = minPrice + '-' + maxPrice;
                        }
                        var Cri_guestrating = '';
                        var minGuestRate = $scope.guestminRangeSlider.minValue;
                        var mxnGuestRate = $scope.guestminRangeSlider.maxValue;
                        if (typeof minGuestRate != 'undefined' && typeof minGuestRate != 'NaN' && typeof mxnGuestRate != 'undefined' && typeof mxnGuestRate != 'NaN') {
                            Cri_guestrating = minGuestRate + '-' + mxnGuestRate;
                        }
                        var amenityArr = [];
                        jQuery('.amenityCls:checked').each(function(i) {
                            amenityArr[i] = jQuery(this).val();
                        });
                        if (typeof $scope.orderFiled == 'undefined') {
                            $scope.orderFiled = 'distance';
                            $scope.orderBy = 'ASC';
                        }
                        if (typeof $scope.paggination == 'undefined') {
                            $scope.paggination = 1;
                        }
						
						var hotelName = document.getElementById(prefix+"regionname").value.split(',');
						var hotel_name = hotelName[0];
						
                        var param = "action=Searched_Hotels&search_Session_Id=" + $scope.search_Session_Id + "&regionid=" + $scope.regionid + "&checkIn=" + $scope.checkIn + "&checkOut=" + $scope.checkOut + "&adults=" + $scope.adults + "&children=" + $scope.children + "&hotelType=" + $scope.hotelType + "&language=" + $scope.language + "&currency=" + $scope.currency + "&Cri_Rating=" + Cri_Rating + "&Cri_Distance=" + Cri_Distance + "&Cri_amenity=" + amenityArr + "&Cri_Price=" + Cri_Price + "&Cri_guestrating=" + Cri_guestrating + "&orderby_fild=" + $scope.orderFiled + "&hotel_name=" +hotel_name+ '&datatype=' + $scope.datatype + "&orderby_val=" + $scope.orderBy + "&page=" + $scope.paggination;
                        var url = actionUrl + '?' + param;
                        jQuery('.search-result').addClass('opacity_0_5');
                        $http.get(url).success(function(response) {
                            jQuery(".search-result").removeClass("opacity_0_5");
                            jQuery(".wrapper-animated-loader").hide();
                            $scope.hotelList = response.result;
                            $scope.totalItems = parseInt(response.result[0].total);
							
							$scope.search_type = response.result[0].datatype;
					
							if($scope.search_type=='location'){ $scope.htcontent =document.getElementById("txt_hotels_in").value;}
							if($scope.search_type=='hotel'){ $scope.htcontent ='';}
							
							
                        });
                    };

                    function getControls() {
                        var param = 'action=getControls&search_Session_Id=' + $scope.search_Session_Id + '&hotelType=' + $scope.hotelType + '&language=' + $scope.language + '&currency=' + $scope.currency;
                        var url = actionUrl + '?' + param;
                        $http.get(url).success(function(response) {
                            $scope.stars5 = response.stars5;
                            $scope.stars4 = response.stars4;
                            $scope.stars3 = response.stars3;
                            $scope.stars2 = response.stars2;
                            $scope.stars1 = response.stars1;
                            $scope.stars0 = response.stars0;
                            $scope.distance50 = response.distance50;
                            $scope.distance20 = response.distance20;
                            $scope.distance10 = response.distance10;
                            $scope.distance5 = response.distance5;
                            $scope.distance2 = response.distance2;
                            $scope.minRangeSlider = {
                                minValue: parseInt(response.minrate),
                                maxValue: parseInt(response.maxrate),
                                options: {
                                    floor: parseInt(response.minrate),
                                    ceil: parseInt(response.maxrate),
                                    translate: function(value) {
                                        return $scope.currency_symbol + value;
                                    },
                                    step: 1,
                                    onEnd: $scope.myChangeListener
                                }
                            };
                            $scope.guestminRangeSlider = {
                                minValue: parseInt(response.minguest),
                                maxValue: parseInt(response.maxguest),
                                options: {
                                    floor: parseInt(response.minguest),
                                    ceil: parseInt(response.maxguest),
                                    step: 1,
                                    onEnd: $scope.myChangeListener
                                }
                            };
                        });
                    };

                    function getAmenities() {
                        var param = 'action=getAmenities&search_Session_Id=' + $scope.search_Session_Id + '&hotelType=' + $scope.hotelType + '&language=' + $scope.language + '&currency=' + $scope.currency;
                        var url = actionUrl + '?' + param;
                        $http.get(url).success(function(response) {
                            $scope.Ameneties_List = response;
                        });
                    };
                    jQuery('.reset-all').click(function() {
                        location.reload();
                    });
                    $scope.Hotel_Filter_Name = '';
                    $scope.HotelFilter = function() {
                        var txt = jQuery('#findbynamefilter').val();
                        if (txt == '') {
                            jQuery(".locationpopup_flightsto").hide();
                            $scope.Hotel_Filter_Name = '';
                            Upldate_Searched_Hotels();
                        } else {
                            var param = 'action=hotelFilter&q=' + txt + '&search_Session_Id=' + $scope.search_Session_Id + '&language=' + $scope.language + '&currency=' + $scope.currency;
                            var url = actionUrl + '?' + param;
                            $http.get(url).success(function(response) {
                                jQuery(".locationpopup_flightsto").show();
                                $scope.Filter_ByNames = response;
                            });
                        }
                    };
                    $scope.Update_Hotel_Filter = function(hotelId, Name, is_custom) {
                        jQuery('#findbynamefilter').val(Name);
                        jQuery(".locationpopup_flightsto").hide();
                        var detailpageUrl = jQuery('#adivaha_site_url').val() + '/' + jQuery('#' + prefix + 'nextpage').val() + '/?hotelid=' + hotelId + '&dest=' + $scope.regionname + '&checkIn=' + $scope.checkIn + '&checkOut=' + $scope.checkOut + '&rooms=' + $scope.rooms + '&adults=' + $scope.adults + '&children=' + $scope.children + '&language=' + $scope.language + '&currency=' + $scope.currency;
                        window.open(detailpageUrl, '_blank');
                    };
                    $scope.myChangeListener = function() {
                        Upldate_Searched_Hotels();
                    };
                    $scope.filtration = function() {
                        $scope.paggination = 1;
                        Upldate_Searched_Hotels();
                    };
                    $scope.sortArrow = 'true';
                    jQuery('.sortingCls').click(function() {
                        $scope.orderFiled = jQuery(this).attr('relorderfield');
                        var relorderby = jQuery(this).attr('relorderby');
                        jQuery('.sortingCls').removeClass('down_arrow up_arrow');
                        if (relorderby == 0) {
                            $scope.orderBy = 'DESC';
                            jQuery(this).attr('relorderby', '1');
                            jQuery(this).addClass('down_arrow');
                            $scope.sortArrow = 'false';
                        } else {
                            $scope.orderBy = 'ASC';
                            jQuery(this).attr('relorderby', '0');
                            jQuery(this).addClass('up_arrow');
                            $scope.sortArrow = 'true';
                        }
                        Upldate_Searched_Hotels();
                    });
                    $scope.pageChanged = function() {
                        setTimeout(function() {
                            $scope.currentPage = jQuery('.pagination').find('.active').text();
                            $scope.paggination = $scope.currentPage;
                            jQuery('html, body').animate({
                                scrollTop: 0
                            }, 0);
                            Upldate_Searched_Hotels();
                        }, 100);
                    };
                    $scope.nextPageUrl = document.getElementById('adivaha_site_url').value + '/' + jQuery('#' + prefix + 'nextpage').val();
                },
				
					
template:'<div class=" modifybtn"><a href="javascript:void(0)" class="spinFause"><i class="fa fa-cog fa-spin"></i></a><a href="javascript:void(0)" class="modifyToggle"><i class="fa fa-search" aria-hidden="true"></i></a><a href="javascript:void(0)" class="filterToggle"><i class="fa fa-filter" aria-hidden="true"></i></a></div><div class="adiFullp tabpanebackpadding " style=""  id="search_hotels_results_css"><div class="'+document.getElementById('adimaxwidth').value+'"><div class="filterMobile adi-col-3edit adi-left padding-right-20 map-display-none sidebar-wrapper">'+


'<div class="theiaStickySidebar">'+

'<form class="">'+

'<div class="adi-full padding-bottom-10 "><div class="adi-left"><h2 class="Filteryourtext">'+document.getElementById('txt_filter_your_search').value+'</h2></div><div class="adi-right"> <a href="javascript:void(0);" class="reset-all">'+document.getElementById('txt_reset_all').value+'</a></div></div>'+


'<div class="adi-full padding-bottom-10 amenities-box-padding add_click_fu_martian_theme">'+

'<h5 class="padding-bottom-10">'+document.getElementById('txt_distance_from_destination').value+'</h5>'+

'<div class="adi-full on-off-close">'+
'<div class="radio padding-bottom-10 adi-full"> <input name="distance" type="radio" value="2" ng-click="filtration()"> <label for="radio-1" class="radio-label adi-full"><span class="Milestext">2 '+document.getElementById('txt_miles').value+' </span><span class="adiLeftimage"><img src="'+document.getElementById('adivaha_plugin_url').value+'/apps/modules/adivaha-hotel-booking/images/prog2.jpg"></span> <span class="adi-right">({{distance2}})</span> </label></div><div class="radio padding-bottom-10 adi-full"> <input name="distance" type="radio" value="5" ng-click="filtration()"> <label for="radio-1" class="radio-label adi-full"><span class="Milestext">5 '+document.getElementById('txt_miles').value+' </span> <span class="adiLeftimage"><img src="'+document.getElementById('adivaha_plugin_url').value+'/apps/modules/adivaha-hotel-booking/images/prog5.jpg"></span> <span class="adi-right">({{distance5}})</span> </label></div><div class="radio padding-bottom-10 adi-full"> <input name="distance" type="radio" value="10" ng-click="filtration()"> <label for="radio-1" class="radio-label adi-full"><span class="Milestext">10 '+document.getElementById('txt_miles').value+' </span><span class="adiLeftimage"><img src="'+document.getElementById('adivaha_plugin_url').value+'/apps/modules/adivaha-hotel-booking/images/prog10.jpg"></span> <span class="adi-right">({{distance10}})</span> </label></div><div class="radio padding-bottom-10 adi-full"> <input name="distance" type="radio" value="20" ng-click="filtration()"> <label for="radio-1" class="radio-label adi-full"><span class="Milestext">20 '+document.getElementById('txt_miles').value+' </span> <span class="adiLeftimage"><img src="'+document.getElementById('adivaha_plugin_url').value+'/apps/modules/adivaha-hotel-booking/images/prog20.jpg"></span> <span class="adi-right">({{distance20}})</span> </label></div><div class="radio padding-bottom-10 adi-full"> <input name="distance" type="radio" value="50" ng-click="filtration()"> <label for="radio-1" class="radio-label adi-full"><span class="Milestext">50 '+document.getElementById('txt_miles').value+' </span><span class="adiLeftimage"><img src="'+document.getElementById('adivaha_plugin_url').value+'/apps/modules/adivaha-hotel-booking/images/prog50.jpg"></span> <span class="adi-right">({{distance50}})</span> </label></div>'+
'</div>'+

'</div>'+



'<div class="adi-full padding-bottom-10 amenities-box-padding add_click_fu_martian_theme" style="position: relative;"><h5 class="padding-bottom-10 adi-full">'+document.getElementById('txt_search_with_hotel_name').value+'</h5>'+


'<div class="adi-full on-off-close">'+
'<div class="adi-full padding-search-input"><input type="text" class="hotel-search-input" name="hotel_name" id="findbynamefilter" ng-keyup="HotelFilter()" placeholder="'+document.getElementById('txt_search_by_name').value+'"></div>'+


'<div class="popup showhidepopup_flightsto hidethisinitially locationpopup_flightsto show-autocomplete-popup background-color-white adi-box-shadow position-absolute" style="top: 61px"><div><a class="autocompletehotelname-dropdown autocomplete-dropdown adi-full padding-10 border-bottom-1" ng-repeat="Filter_ByNames in Filter_ByNames track by $index"><span ng-click="Update_Hotel_Filter(Filter_ByNames.EANHotelID,Filter_ByNames.Name,Filter_ByNames.is_custom )">{{ Filter_ByNames.Name}}</span></a> </div></div>'+

'</div>'+

'</div>'+


'<!--Price SLider--><div class="filter_criteria wleft add_click_fu_martian_theme"><h5>'+document.getElementById('txt_price').value+'</h5>'+

'<div class="adi-full on-off-close">'+

'<div class="flt-price"><rzslider rz-slider-model="minRangeSlider.minValue" rz-slider-high="minRangeSlider.maxValue" rz-slider-options="minRangeSlider.options"></rzslider></div>'+
'</div>'+

'</div><!--End Price Slider-->'+

'<!-- Guest slider --><div class="filter_criteria wleft add_click_fu_martian_theme"><h5>'+document.getElementById('txt_guest_rating').value+'</h5>'+
'<div class="adi-full on-off-close">'+
'<div class="flt-price"><rzslider rz-slider-model="guestminRangeSlider.minValue" rz-slider-high="guestminRangeSlider.maxValue" rz-slider-options="guestminRangeSlider.options"></rzslider></div>'+
'</div>'+
'</div><!-- End Guest Slider-->'+


'<div class="adi-full padding-bottom-10 amenities-box-padding add_click_fu_martian_theme"> <h5 class="padding-bottom-10 adi-left adi-full">'+document.getElementById('txt_star_rating').value+' <a href="javascript:void(0);" class="reset-all adi-right">Reset All</a></h5>'+
'<div class="adi-full on-off-close">'+
'<div class="radio padding-bottom-10 adi-full"> <input name="starrating" type="radio" value="1" ng-click="filtration()"> <label for="radio-6" class="radio-label adi-full"><i class="fa fa-star" aria-hidden="true"></i> <span class="adi-right">({{stars1}})</span></label> </div><div class="radio padding-bottom-10 adi-full"> <input name="starrating" type="radio" value="2" ng-click="filtration()"> <label for="radio-7" class="radio-label adi-full"><i class="fa fa-star"></i> <i class="fa fa-star"></i><span class="adi-right">({{stars2}})</span></label> </div><div class="radio padding-bottom-10 adi-full"> <input name="starrating" type="radio" value="3" ng-click="filtration()"> <label for="radio-8" class="radio-label adi-full"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="adi-right">({{stars3}})</span></label> </div><div class="radio padding-bottom-10 adi-full"> <input name="starrating" type="radio" value="4" ng-click="filtration()"> <label for="radio-9" class="radio-label adi-full"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="adi-right">({{stars4}})</span></label> </div><div class="radio padding-bottom-10 adi-full"> <input name="starrating" type="radio" value="5" ng-click="filtration()"> <label for="radio-10" class="radio-label adi-full"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="adi-right">({{stars5}})</span></label> </div>'+
'</div>'+

'</div>'+


'<div class="adi-full padding-bottom-10 amenities-box-padding amenities_boode add_click_fu_martian_theme"> <h5 class="padding-bottom-10 adi-left adi-full">'+document.getElementById('txt_property_ameneties').value+'<a href="javascript:void(0);" class="reset-all adi-right">'+document.getElementById('txt_reset_all').value+'</a></h5>'+
'<div class="adi-full on-off-close">'+
'<div class="radio padding-bottom-10 adi-full" ng-repeat="role in Ameneties_List"> <input name="Cri_amenity[]" type="checkbox" value="{{role}}" class="amenityCls" ng-click="filtration()"> <label for="radio-12" class="radio-label adi-full">{{role}}</label> </div>'+

'</div>'+
'</div>'+


'</form></div></div>'+'<div class="adi-col-7edit adi-right padding-left-10 map-full-width">'+'<div class="adi-full padding-bottom-10 fixed-top-map">'+'<div class="adi-col-6 adi-left ">'+'<h1 class="Selecttext">{{htcontent}} {{regionname}}</h1> <p style="font-size: 13px;color:#777;padding-bottom:5px;">{{totalItems}} '+document.getElementById('txt_hotels_available').value+' '+document.getElementById('txt_checkin').value+' : {{checkIn}}, '+document.getElementById('txt_checkout').value+' : {{checkOut}}</p></div><div class="adi-right adi-col-4 icons-search text-right"> <!--<a class="map-click" href="javascript:void(0);"><i class="fa fa-map-marker"></i> '+document.getElementById('txt_map').value+'</a>--> <a class="list-click" href="javascript:void(0);"><i class="fa fa-list"></i> '+document.getElementById('txt_list').value+'</a> <a class="grid-click" href="javascript:void(0);"><i class="fa fa-th-large"></i> '+document.getElementById('txt_grid').value+'</a> <a class="filter-click" href="javascript:void(0);"> <i class="fa fa-filter"></i>Filter</a></div></div><div class="adi-full sortbar text-center"> <div class="adi-left adi-col-3 background-color-white"> <a href="javascript:void(0);" class="sorting sortingCls up_arrow down_arrow" relorderfield="distance" relorderby="0">'+document.getElementById('txt_distance').value+' <i class="fa fa-road iconsOnPhone"></i> <span class="recom">'+'</span></a></div><div class="adi-left adi-col-3 background-color-white"> <a href="javascript:void(0);" class="sorting sortingCls" relorderfield="price" relorderby="0">'+document.getElementById('txt_price').value+' <i class="fa fa-usd iconsOnPhone"></i><span class="recom"></span></a></div><div class="adi-left adi-col-3 background-color-white"> <a href="javascript:void(0);" class="sorting sortingCls" relorderfield="hotelRating" relorderby="0">'+document.getElementById('txt_star_rating').value+' <i class="fa fa-star iconsOnPhone"></i><span class="recom"></span></a></div><div class="adi-left adi-col-3 background-color-white"> <a href="javascript:void(0);" class="sorting sortingCls" relorderfield="tripAdvisorRating" relorderby="0">'+document.getElementById('txt_tripadvisor').value+' <i class="fa fa-tripadvisor iconsOnPhone"></i><span class="recom"></span></a></div></div>'+'<div class="map-show">map-show</div>'+'<!-- new lodaer code add mk -->'+'<div class="wrapper-animated-loader adi-full">'+'<div class="timeline-wrapper margin-top-10">'+' <div class="timeline-item">'+'<div class="animated-background facebook">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'</div>'+' </div>'+'<div class="adi-col-7 adi-left">'+'<div class="adianimated_7">'+'<div class="h2animated"></div>'+'<p class="ratingratingdanimated"></p>'+'<p class="markeranimated"></p>'+'<p class="tripAdvisorRatinganimated"></p>'+'<p class="ratanimatedp"></p>'+'</div>'+' <div class="adianimated_3">'+'<p class="priceanimated_1"></p>'+'<p class="priceanimated_2"></p>'+'<p class="priceanimated_3Btn"></p>'+'</div>'+'</div>'+'</div>'+' </div>'+'</div>'+'<div class="timeline-wrapper margin-top-10">'+' <div class="timeline-item">'+'<div class="animated-background facebook">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'</div>'+' </div>'+'<div class="adi-col-7 adi-left">'+'<div class="adianimated_7">'+'<div class="h2animated"></div>'+'<p class="ratingratingdanimated"></p>'+'<p class="markeranimated"></p>'+'<p class="tripAdvisorRatinganimated"></p>'+'<p class="ratanimatedp"></p>'+'</div>'+' <div class="adianimated_3">'+'<p class="priceanimated_1"></p>'+'<p class="priceanimated_2"></p>'+'<p class="priceanimated_3Btn"></p>'+'</div>'+'</div>'+'</div>'+' </div>'+'</div>'+'<div class="timeline-wrapper margin-top-10">'+' <div class="timeline-item">'+'<div class="animated-background facebook">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'</div>'+' </div>'+'<div class="adi-col-7 adi-left">'+'<div class="adianimated_7">'+'<div class="h2animated"></div>'+'<p class="ratingratingdanimated"></p>'+'<p class="markeranimated"></p>'+'<p class="tripAdvisorRatinganimated"></p>'+'<p class="ratanimatedp"></p>'+'</div>'+' <div class="adianimated_3">'+'<p class="priceanimated_1"></p>'+'<p class="priceanimated_2"></p>'+'<p class="priceanimated_3Btn"></p>'+'</div>'+'</div>'+'</div>'+' </div>'+'</div>'+'<div class="timeline-wrapper margin-top-10">'+' <div class="timeline-item">'+'<div class="animated-background facebook">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'</div>'+' </div>'+'<div class="adi-col-7 adi-left">'+'<div class="adianimated_7">'+'<div class="h2animated"></div>'+'<p class="ratingratingdanimated"></p>'+'<p class="markeranimated"></p>'+'<p class="tripAdvisorRatinganimated"></p>'+'<p class="ratanimatedp"></p>'+'</div>'+' <div class="adianimated_3">'+'<p class="priceanimated_1"></p>'+'<p class="priceanimated_2"></p>'+'<p class="priceanimated_3Btn"></p>'+'</div>'+'</div>'+'</div>'+' </div>'+'</div>'+'<div class="timeline-wrapper margin-top-10">'+' <div class="timeline-item">'+'<div class="animated-background facebook">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'</div>'+' </div>'+'<div class="adi-col-7 adi-left">'+'<div class="adianimated_7">'+'<div class="h2animated"></div>'+'<p class="ratingratingdanimated"></p>'+'<p class="markeranimated"></p>'+'<p class="tripAdvisorRatinganimated"></p>'+'<p class="ratanimatedp"></p>'+'</div>'+' <div class="adianimated_3">'+'<p class="priceanimated_1"></p>'+'<p class="priceanimated_2"></p>'+'<p class="priceanimated_3Btn"></p>'+'</div>'+'</div>'+'</div>'+' </div>'+'</div>'+'<div class="timeline-wrapper margin-top-10">'+' <div class="timeline-item">'+'<div class="animated-background facebook">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'</div>'+' </div>'+'<div class="adi-col-7 adi-left">'+'<div class="adianimated_7">'+'<div class="h2animated"></div>'+'<p class="ratingratingdanimated"></p>'+'<p class="markeranimated"></p>'+'<p class="tripAdvisorRatinganimated"></p>'+'<p class="ratanimatedp"></p>'+'</div>'+' <div class="adianimated_3">'+'<p class="priceanimated_1"></p>'+'<p class="priceanimated_2"></p>'+'<p class="priceanimated_3Btn"></p>'+'</div>'+'</div>'+'</div>'+' </div>'+'</div>'+'</div>'+'<!-- end new lodaer code add mk -->'+'<div class="adi-full padding-bottom-10 search-result">'+




'<div class="adi-full background-color-white margin-top-10 border-1pag add-cl-js" ng-repeat="hotelList in hotelList track by $index">'+'<div class="adi-full" ng-if="hotelList.LowRate>0">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'<a class="adi-imgbtn" id="image_target_description" href="{{nextPageUrl}}/?hotelid={{hotelList.EANHotelID}}&dest={{regionname}}&checkIn={{checkIn}}&checkOut={{checkOut}}&rooms={{rooms}}&adults={{adults}}&children={{children}}&language={{language}}&currency={{currency}}&cityId={{regionid}}&search_Session_Id={{search_Session_Id}}" target="{{description_in_sametab!=\'Yes\' ? \'_blank\' : \'_self\'}}"><img src="{{hotelList.thumbnail}}" ></a>'+'<div class="price text-right padding-left-10 padding-top-10 padding-right-5 Grid-show"> '+'<div ng-if="hotelList.isFavourate==\'Yes\'" class="padding-bottom-10 tooltip fade favourites_icon_container" data-title="Remove from Favourites"> <i class="fa fa-heart adv_heart" data-rel="adh_hotel" id="{{hotelList.EANHotelID}}"> </i></div>'+'<div ng-if="hotelList.isFavourate!=\'Yes\'" class="padding-bottom-10 tooltip fade favourites_icon_container" data-title="Add to Favourites"> <i class="fa fa-heart-o adv_heart" data-rel="adh_hotel" id="{{hotelList.EANHotelID}}"> </i></div>'+'<p class="padding-bottom-10 price-text"><span ng-bind-html="currency_symbol"></span> {{hotelList.LowRate | number:2}}</p><p class="padding-bottom-10 ppr">'+document.getElementById('txt_per_room_per_night').value+'</p></div></div></div>'+'<div class="adi-col-7 adi-left">'+'<div class="adi-col-6 adi-left padding-addbox border-right-dotted show-map-7">'+'<div class="messageRoomLeft" ng-if="hotelList.currentAllotment<8"> {{hotelList.currentAllotment}} '+document.getElementById('txt_room_left').value+'</div>'+'<h2 class="padding-bottom-10" style=""> <a id="image_target_description" href="{{nextPageUrl}}/?hotelid={{hotelList.EANHotelID}}&dest={{regionname}}&checkIn={{checkIn}}&checkOut={{checkOut}}&rooms={{rooms}}&adults={{adults}}&children={{children}}&language={{language}}&currency={{currency}}&cityId={{regionid}}&search_Session_Id={{search_Session_Id}}" target="{{description_in_sametab!=\'Yes\' ? \'_blank\' : \'_self\'}}">{{hotelList.Name}} </a></h2>'+'<p class="rating rating-{{hotelList.StarRating}}"></p>'+'<div class="list-text-style"><i class="fa fa-map-marker padding-right-5" style="font-size:17px;"></i>{{hotelList.Address1}},{{hotelList.City}}</div><div class="Locationadde" >{{hotelList.Location}}</div><div class="" style="padding-top: 6px;padding-bottom: 0px;" ng-if="!hotelList.tripAdvisorRating"><img src="//www.tripadvisor.com/img/cdsi/img2/ratings/traveler/0.0-39958-4.png" alt=""></div><div class="" style="padding-top: 6px;padding-bottom: 0px;" ng-if="hotelList.tripAdvisorRating"><img src="//www.tripadvisor.com/img/cdsi/img2/ratings/traveler/{{hotelList.tripAdvisorRating | number:1}}-39958-4.png" alt=""></div><div class="ta-total-reviews padding-bottom-5" ng-if="hotelList.tripAdvisorReviewCount>0">{{hotelList.tripAdvisorReviewCount}} '+document.getElementById('txt_reviews').value+'</div></div><div class="adi-col-4 adi-right show-map-3"> <div class="price text-right padding-left-10 padding-top-10 padding-right-10"> <div class="Onioncsfavour">'+


'<div ng-if="hotelList.isFavourate==\'Yes\'" class="padding-bottom-10 tooltip fade favourites_icon_container" data-title="Remove from Favourites"> <i class="fa fa-heart adv_heart" data-rel="adh_hotel" id="{{hotelList.EANHotelID}}"> </i></div>'+'<div ng-if="hotelList.isFavourate!=\'Yes\'" class="padding-bottom-10 tooltip fade favourites_icon_container" data-title="Add to Favourites"> <i class="fa fa-heart-o adv_heart" data-rel="adh_hotel" id="{{hotelList.EANHotelID}}"> </i></div>'+'</div><p class="padding-bottom-10 price-text Grid-hide"><span ng-bind-html="currency_symbol"></span> {{hotelList.LowRate | number:2}}</p><p class="padding-bottom-10 ppr Grid-hide">'+document.getElementById('txt_per_room_per_night').value+'</p><a target="{{description_in_sametab!=\'Yes\' ? \'_blank\' : \'_self\'}}" id="image_target_description" href="{{nextPageUrl}}/?hotelid={{hotelList.EANHotelID}}&dest={{regionname}}&checkIn={{checkIn}}&checkOut={{checkOut}}&rooms={{rooms}}&adults={{adults}}&children={{children}}&language={{language}}&currency={{currency}}&cityId={{regionid}}&search_Session_Id={{search_Session_Id}} " class="adi-btn adi-btnrund text-color-white margin-top-10">'+document.getElementById('txt_select_room').value+' </a></div></div></div>'+'</div>'+'<div class="adi-full soldOut" ng-if="hotelList.LowRate==0">'+'<div class="adi-col-3 adi-left">'+'<div class="list-image">'+'<a class="adi-imgbtn" id="image_target_description"><img src="{{hotelList.thumbnail}}"></a>'+'<div class="price text-right padding-left-10 padding-top-10 padding-right-5 Grid-show"> '+'<div ng-if="hotelList.isFavourate==\'Yes\'" class="padding-bottom-10 tooltip fade favourites_icon_container" data-title="Remove from Favourites"> <i class="fa fa-heart adv_heart" data-rel="adh_hotel" id="{{hotelList.EANHotelID}}"> </i></div>'+'<div ng-if="hotelList.isFavourate!=\'Yes\'" class="padding-bottom-10 tooltip fade favourites_icon_container" data-title="Add to Favourites"> <i class="fa fa-heart-o adv_heart" data-rel="adh_hotel" id="{{hotelList.EANHotelID}}"> </i></div>'+'<p class="padding-bottom-10 price-text"><span ng-bind-html="currency_symbol"></span>{{hotelList.LowRate | number:2}}</p><p class="padding-bottom-10 ppr">per room/per night</p></div></div></div>'+'<div class="adi-col-7 adi-left">'+'<div class="adi-col-6 adi-left padding-addbox border-right-dotted show-map-7">'+'<h2 class="padding-bottom-10" style=""> <a>{{hotelList.Name}} </a></h2>'+'<p class="rating rating-{{hotelList.StarRating}}"></p>'+'<div class="list-text-style"><i class="fa fa-map-marker padding-right-5" style="font-size:17px;"></i>{{hotelList.Address1}}</div><div class="Locationadde" >{{hotelList.Location}}</div><div class="" style="padding-top: 6px;padding-bottom: 0px;" ng-if="!hotelList.tripAdvisorRating"><img src="//www.tripadvisor.com/img/cdsi/img2/ratings/traveler/0.0-39958-4.png" alt=""></div><div class="" style="padding-top: 6px;padding-bottom: 0px;" ng-if="hotelList.tripAdvisorRating"><img src="//www.tripadvisor.com/img/cdsi/img2/ratings/traveler/{{hotelList.tripAdvisorRating | number:1}}-39958-4.png" alt=""></div></div><div class="adi-col-4 adi-right show-map-3"> <div class="price text-right padding-left-10 padding-top-10 padding-right-10"> <div class="Onioncsfavour">'+


'<div class="padding-bottom-10 tooltip fade favourites_ioncs {{Myfavourite}}" data-rel="adh_hotel" data-id="{{hotelList.EANHotelID}}" data-title="Add to Favourites "> <i class="fa fa-heart-o fa-heart-ioncs "> </i></div></div><a class="adi-btn adi-btnrund text-color-white margin-top-10">Sold Out </a></div></div></div>'+
'</div>'+
'</div></div>'+

'<!--paging Start--><div class="srchList-pagingCntnr ng-scope" ng-if="totalItems > itemsPerPage "><div class="srchList-pagingOuter"><pagination total-items="totalItems" ng-model="currentPage" max-size="maxSize" class="pagination-sm" boundary-links="true" rotate="false" num-pages="numPages" items-per-page="itemsPerPage" first-text="|<<" previous-text="|<" next-text=">|" last-text=">>|" ng-change="pageChanged()"></pagination></div></div> <!--End paging --></div></div> </div>'+
'<style>.adi-col-3edit {width: 23%;}.adi-col-7edit {width: 77%;padding: 0px 2px 0px 21px;}.Filteryourtext{font-size:14px;font-weight:700;color:#333;margin-bottom:10px;text-align:left}.adi-right{float:right}.reset-all{color:#ff5a5f !important;font-size:12px;font-weight:400}.amenities-box-padding .radio input{position:absolute;top:8px;left:2px}.radio-label{text-align:left;font-size:13px;color:#666;font-weight:400}.adi-full{width:100%;float:left}.Milestext{width:24%;float:left}.adiLeftimage{}.adi-col-3edit h5{font-family:sans-serif;font-size:13px;font-weight:700;color:#666;text-align:left}.hotel-search-input{padding:6px;font-size:14px;line-height:1.428571429;vertical-align:middle;border:1px solid #ccc;width:100%;height:38px;margin-bottom:18px}.flt-price .rzslider .rz-bubble{color:red;margin-bottom:0px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif}.rzslider .rz-bubble{bottom:16px;padding:1px 3px;color:#55637d;cursor:default}.rzslider span{position:absolute;display:inline-block;white-space:nowrap}.rzslider .rz-pointer{top:-7px;z-index:1;width:20px;height:20px;cursor:pointer;background-color:#fff;border-radius:16px;border:4px solid #186900;background-image:none}.tabpanebackpadding{padding-top: 20px;padding-bottom: 20px;}.amenities-box-padding .radio{padding:5px 0px 5px 23px;clear:both;position:relative}.padding-bottom-10{padding-bottom:10px}.Selecttext{text-overflow:ellipsis;white-space:nowrap;overflow:hidden;margin-bottom:5px;font-weight:300;font-size:22px;color:#222}.text-right{text-align:right}.adi-col-4{width:33.3333%}.icons-search a{padding:10px;display:inline-block;color:#6b6a6a;-webkit-transition:all .3s;-moz-transition:all .3s;transition:all .3s}.icons-search a .fa{padding-right:4px;font-size:18px}.sortbar{}.adi-col-3{width:25%}.sortbar a{position:relative}.sortbar a{width:100%;color:#666;text-transform:uppercase;float:left;background:#fff;line-height:48px;text-align:Center;font-weight:600;cursor:pointer;border:1px solid #dfdfdf;border-right:0px solid #dfdfdf}.sortbar a .fa{}.up_arrow .recom, .down_arrow .recom{background-image:url('+document.getElementById('adivaha_plugin_url').value+'apps/modules/adivaha-hotel-booking/images/{{sortArrow}}.png);position:absolute !important;height:25px;width:25px;background-repeat:no-repeat;top:17px;right:0px}.icons-search a:last-child {display: none;}.map-show {display: none;}.down_arrow {border-bottom: 4px solid #777 !important;}.rzslider {position: relative;display: inline-block;width: 99%;height: 4px;vertical-align: middle;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;margin: 13px 0 7px;}</style>'+

'<style>.animated-background .adi-col-3{float:left;width:25%;height:176px}.animated-background .h2animated{border:solid #fff;height:40px;border-width:24px 97px 0px 11px}.animated-background .ratingratingdanimated{border:solid #fff;height:28px;border-width:7px 207px 9px 11px}.animated-background .ratanimatedp{border:solid #fff;height:58px;border-width:2px 200px 39px 11px}.animated-background .tripAdvisorRatinganimated{border:solid #fff;height:29px;border-width:2px 165px 14px 11px}.animated-background .markeranimated{height:21px;border:solid #fff;border-width:3px 165px 7px 11px}.animated-background .priceanimated_1{border:solid #fff;height:63px;border-width:45px 14px 0px 25px}.animated-background .priceanimated_2{border:solid #fff;height:37px;border-width:14px 14px 11px 4px}.animated-background .priceanimated_3Btn{border:solid #fff;height:76px;border-width:32px 10px 11px 6px}.animated-background .adianimated_7{float:left;width:70%}.animated-background .adianimated_3{float:left;width:30%}.animated-background .list-image{}.animated-background .adi-col-7{float:left;width:75%;height:176px}@-webkit-keyframes placeHolderShimmer{0%{background-position:-468px 0}100%{background-position:468px 0}}@keyframes placeHolderShimmer{0%{background-position:-468px 0}100%{background-position:468px 0}}.timeline-wrapper{overflow: hidden}.timeline-item{background:#fff;border:1px solid;border-color:#e5e6e9 #dfe0e4 #d0d1d5;height:177px}.animated-background{-webkit-animation-duration:1s;animation-duration:1s;-webkit-animation-fill-mode:forwards;animation-fill-mode:forwards;-webkit-animation-iteration-count:infinite;animation-iteration-count:infinite;-webkit-animation-name:placeHolderShimmer;animation-name:placeHolderShimmer;-webkit-animation-timing-function:linear;animation-timing-function:linear;background:#f6f7f8;background:#eee;background:-webkit-gradient(linear, left top, right top, color-stop(8%, #eeeeee), color-stop(18%, #dddddd), color-stop(33%, #eeeeee));background:-webkit-linear-gradient(left, #eee 8%, #ddd 18%, #eee 33%);background:linear-gradient(to right, #eee 8%, #ddd 18%, #eee 33%);-webkit-background-size:800px 104px;background-size:800px 104px;height:177px;position:relative}@media (max-width: 767px){.wrapper-animated-loader{}.wrapper-animated-loader .timeline-item{height:354px}.wrapper-animated-loader .animated-background{height:100%}.wrapper-animated-loader .adi-col-3{width:100% !important}.wrapper-animated-loader .adi-col-7{width:100% !important}}.margin-top-10 {margin-top: 10px;}.border-1pag {border: #dfdfdf 1px solid;}.adi-col-3{width:25%}.map-show-add{display:block;float:left !important;width:50% !important}.map-search-result{float:right !important;width:50% !important}.map-search-result .show-map-7{width:60%}.map-search-result .show-map-3{width:40%}.map-search-result.searchGrid>.adi-col-4{width:49%}.map-search-result.searchGrid>.adi-col-4:nth-child(3n-1){margin-left:0%;margin-right:0%}.map-search-result.searchGrid>.adi-col-4:nth-child(2n-1){float:right}.icons-search{}.icons-search a{padding:10px;display:inline-block;color:#6b6a6a;-webkit-transition:all .3s;-moz-transition:all .3s;transition:all .3s}.icons-search a:hover{}.icons-search a .fa{padding-right:4px;font-size:18px}.sortbar{}.sortbar a{width:100%;color:#666;text-transform:uppercase;float:left;background:#fff;line-height:48px;text-align:Center;font-weight:600;cursor:pointer;border:1px solid #dfdfdf;border-right:0px solid #dfdfdf}.sortbar a .recom{position:relative}.sortbar a .recom .off_image{position:absolute;top:7px;left:10px}.sortbar a .recom .on_image{position:absolute;top:5px;left:10px}.sortbar .adi-col-3:last-child a{border-right:1px solid #ccc}.sortbar a .fa{}.search-result{}.icons-search a:last-child{display:none}.list-image{width:100%;float:left;position:inherit;height:177px;overflow:hidden}.list-image img{width:100%;height:100%;transition: .2s linear;-webkit-transition: .2s linear;-moz-transition: .2s linear;-ms-transition: .2s linear;-o-transition: .2s linear}.list-image:hover img{transition: .2s linear;-webkit-transition: .2s linear;-moz-transition: .2s linear;-ms-transition: .2s linear;-o-transition: .2s linear;transform:scale(1.2);-webkit-transform:scale(1.2);-moz-transform:scale(1.2);-ms-transform:scale(1.2);-o-transform:scale(1.2)}.rating{width:61px;height:11px;display:inline-block;background:url('+document.getElementById('adivaha_plugin_url').value+'apps/modules/adivaha-hotel-booking/images/star-rating.png) 0 0 no-repeat;position:relative;top:-7px;margin-bottom: 0px;}.rating-5{background-position:0 0}.rating-4{background-position:-13px 0}.rating-3{background-position:-23px 0}.rating-2{background-position:-35px 0}.rating-1{background-position:-47px 0}.rating-0{background-position:-60px 0}.list-text-style{font-size:13px;color: #000;text-overflow: ellipsis;white-space: nowrap;font-weight: 600;}.fa-heart-ioncs{font-size:25px !important;cursor:pointer}#myList{margin:0}#myList.pagination li>a{transition:all .2s ease;-webkit-transition:all .2s ease;-moz-transition:all .2s ease;-ms-transition:all .2s ease;-o-transition:all .2s ease}#myList.pagination>.active,#myList.pagination>.active:hover,#myList.pagination>.active:focus{z-index:1;color:#777}#myList.pagination>li:first-child{margin-left:0;border-bottom-left-radius:0;border-top-left-radius:0}#myList.pagination>li:last-child{border-top-right-radius:0;border-bottom-right-radius:0}#myList.pagination{margin-left:-3px}#myList.pagination>li{position:relative;float:left;padding:6px 12px;margin-left:-1px;text-decoration:none;background-color:#fff;border:1px solid #ddd;outline:none;cursor:pointer}#prev,#next{padding:6px 12px;background:#fff;text-decoration:none;background-color:#fff;border:1px solid #ddd;display:inline-block}#prev,#first{right:-4px;border-right:0}#first{right:-8px;border-right:0}#next{left:-12px;border-left:0}#last{left:-17px;border-left:0}#prev,#next,#first,#last,#nDots{padding:6px 12px;background:#fff;text-decoration:none;background-color:#fff;border:1px solid #ddd;display:inline-block;position:relative;cursor:pointer;top:-12px;left:0px}#nDots{}#myList.pagination>.active,#myList.pagination>.active:hover,#myList.pagination>.active:focus{background-color:#186900;color:#fff}.srchList-pagingCntnr{clear:both}.pagination{display:inline-block;padding-left:0;border-radius:4px;background:transparent;height:0px;margin:0em 0em 6em 0em}.padding-addbox h2{font-weight:300;font-size:17px;font-size:16px;color:#222;width:100%;text-overflow:ellipsis;white-space:nowrap;overflow:hidden    line-height: inherit;margin-bottom: 0px;}.price-text{font-family:Georgia,"Times New Roman",Times,serif;color:#009688;font-size:25px;    margin-bottom: 0px;}.ppr{    margin-bottom: 0px;font-size:13px;color:#000;display:inline-block;text-align:right;width:100%}.border-1pag{border:#dfdfdf 1px solid}.border-1pag:hover{border:#186900 1px solid}.tooltip{position:relative;opacity:1}.tooltip:before,.tooltip:after{display:block;opacity:0;pointer-events:none;position:absolute}.tooltip:after{border-right:6px solid transparent;border-bottom:6px solid #777;border-left:6px solid transparent;content:\'\';height:0;top:27px;right:6px;width:0}.tooltip:before{border-radius:4px;color:#fff;content:attr(data-title);font-size:14px;padding:6px 10px;top:33px;white-space:nowrap;right:0px;background:#777}.tooltip.fade:after,.tooltip.fade:before{transform:translate3d(0,-10px,0);transition:all .15s ease-in-out}.tooltip.fade:hover:after,.tooltip.fade:hover:before{opacity:1;transform:translate3d(0,0,0)}.fixed-top-map-add{top:0px;z-index:999;position:fixed;padding:10px 1% 10px 1%;box-shadow:0px 3px 5px 0px rgba(0,0,0,0.2);background-color:#f3f3f3;max-width:868px}.fixed-top-map{}.fixed-top-map-add h1{font-size:14px;margin:0px;padding:0px}.searchGrid{}.searchGrid .add-cl-js>.adi-col-3 .Grid-show{position:absolute;top:0px;width:100%}.searchGrid .list-image{position:relative}.searchGrid .fa-heart-ioncs{color:#fff}.searchGrid .add-cl-js>.adi-col-3 .Grid-show p{background:rgba(0,0,0,0.8);color:#fff;position:absolute;right:0px;top:124px;padding:4px 7px 10px 7px}.searchGrid .padding-addbox{width:100%}.searchGrid .add-cl-js>.adi-col-7>.adi-col-4{width:100%}.searchGrid .add-cl-js>.adi-col-7>.adi-col-4>.price>a{margin-bottom:10px;border-radius:4px;width:100%}.add-cl-js>.adi-col-7>.adi-col-4>.price>a:hover{color:#fff}.searchGrid .add-cl-js>.adi-col-7>.adi-col-4>.price{text-align:center;padding-top:0px}.searchGrid .Locationadde{display:none}.searchGrid .ta-total-reviews{display:none}.searchGrid .padding-addbox{height:100%}.searchGrid .add-cl-js>.adi-full>.adi-col-3{width:100%}.searchGrid .add-cl-js>.adi-full>.adi-col-7{width:100%}.searchGrid .add-cl-js>.adi-full>.adi-col-7>.adi-col-7{width:100%}.searchGrid .add-cl-js>.adi-full>.adi-col-7>.adi-col-4{width:100%}.searchGrid .add-cl-js>.adi-full>.adi-col-7>.adi-col-4>.price{text-align:center;padding-top:0px}.searchGrid .add-cl-js>.adi-full>.adi-col-7>.adi-col-4>.price>a{margin-bottom:10px;margin-top:10px;float:left;width:100%;border-radius:1px}.searchGrid .add-cl-js>.adi-full>.adi-col-7>.adi-col-4>.price>.Onioncsfavour{display:none}.searchGrid .add-cl-js>.adi-full>.adi-col-3>.list-image>.price{position:absolute;right:0px;bottom:9px}.searchGrid .add-cl-js>.adi-full>.adi-col-3>.list-image>.price>.favourites_ioncs{top:-86px;left:-4px}.searchGrid .add-cl-js>.adi-full>.adi-col-3>.list-image>.price>.price-text{background-color:#000;color:#fff;padding:4px;    font-size: 25px;}.searchGrid .tooltip:before{left:135px;top:25px}.searchGrid .tooltip:after{top:19px;left:243px}.searchGrid>.adi-col-4{width:32.6%}.searchGrid>.adi-col-4:nth-child(3n-1){margin-left:1%;margin-right:1%}.searchGrid .border-right-dotted{border-right:0px dotted #ddd}.searchGrid .list-image:before{content:"";position:absolute;left:0;right:0;top:0;bottom:0;display:block;height:100%;width:100%}.searchGrid .ppr{display:none}.amenities-box-padding{}.amenities-box-padding .radio{padding:5px 0px 5px 23px;clear:both;position:relative}.amenities-box-padding .radio input{position:absolute;top:8px;left:2px}.amenities-box-padding h5{font-size:15px;font-weight:400;color:#666;text-align:left}.padding-search-input{}.filter_criteria h5{margin-bottom:25px;font-size:15px;font-weight:100;color:#666}.adi-col-3edit h5{font-family:sans-serif;font-size:13px;font-weight:700;color:#666;text-align:left}.modifybtn{position:absolute;right:55px;z-index:999;top:17px;display:none}.modifybtn a .fa{font-size:20px}.filterToggle{padding-left:15px}.search-result .adi-btn:hover{color:#fff}.Onioncsfavour .favourites_icon_container .fa{font-size:25px;color:#186900}.searchGrid .favourites_icon_container .fa{font-size:25px;color:#fff}.searchGrid .favourites_icon_container{top:-96px;right:3px}.adi-col-7 {width: 75%;}.adi-col-3{width:25%}.adi-col-4{width:33.3333%}.adi-col-7{width:75%}.adi-col-6{width:66.55555%}.text-center{text-align:center}.text-right{text-align:right}.padding-addbox{padding:11px 15px 4px 17px;position:relative;overflow:hidden;height:177px}.border-right-dotted{border-right:1px dotted #ddd}.padding-right-10{padding-right:10px}.padding-left-10{padding-left:10px}.padding-top-10{padding-top:10px}.adi-btn{display:inline-block;font-size:15px;background-color:#186900;margin:0 auto;padding:10px 25px 10px 25px;border-radius:0px;text-align:center}.adi-btnrund {border-radius: 50px;}.text-color-white {color: #fff;}.messageRoomLeft{font-size:9px;color:#fff;text-transform:uppercase;text-align:center;line-height:20px;transform:rotate(45deg);-webkit-transform:rotate(45deg);width:100px;display:block;background:#7ab340;box-shadow:0 3px 10px -5px rgba(0,0,0,1);position:absolute;top:19px;right:-21px;background:#186900;font-weight:bold}.rzslider .rz-bar-wrapper{left:0;z-index:1;width:100%;height:45px;box-sizing:border-box}.flt-price .rzslider .rz-bubble{color:red;margin-bottom:0px;font-family:Arial,Helvetica Neue,Helvetica,sans-serif}.flt-price .rzslider .rz-bar{background:#186900;height:6px;float:left;width:100%}.filter_criteria {margin-bottom: 30px;}</style>'+'<style>@media (max-width: 767px){.adi-col-3 {width: 100%;} .adi-col-7 {width: 100%;}.adi-col-4 {width: 100%;}}  .otherTypBtn{} .otherTypBtn a{background-color: #186900;color: #fff;padding: 8px 23px;display: inline-block;float: left;} .otherTypBtn1{} .otherTypBtn2{margin-left: 10px;}.padding-right-20{padding-right: 20px;}</style>'

};});