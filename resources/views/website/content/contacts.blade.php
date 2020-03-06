@extends('website.master')
@section('header')
@endsection()

@section('content')



<div class="content_wrapper clearfix">
                <div class="sections_group">
                    <div class="entry-content">
                        <div class="section mcb-section full-width" style="padding-top:0px; padding-bottom:0px;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one column_map ">

                                            <div class="google-map-wrapper no_border">
                                                <div class="google-map-contact-wrapper style-box">
                                                    <div class="get_in_touch">
                                                        <h3>Нашият Офис</h3>
                                                        <div class="get_in_touch_wrapper">
                                                            <ul>
                                                                <li class="address">
                                                                    <span class="icon"><i class="icon-location"></i></span><span class="address_wrapper">
																			<p>
																				{{ $settings->formatted_address }}
																			</p> </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="google-map" id="google-map-area-58af1ee65f2cb" style="width:100%; height:400px;">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section mcb-section" style="padding-top:30px; padding-bottom:0px;">
                            <div class="section_wrapper mcb-section-inner">
                                <div class="wrap mcb-wrap one valign-top clearfix">
                                    <div class="mcb-wrap-inner">
                                        <div class="column mcb-column one-third column_list">
                                            <div class="list_item lists_2 clearfix">
                                                <div class="list_left list_icon">
                                                    <i class=" icon-mail-line"></i>
                                                </div>
                                                <div class="list_right">
                                                    <div class="desc">
                                                        <p class="big" style="padding-top: 12px; display: block; margin: 0;">
                                                            Имате въпроси?
                                                        </p>
                                                        <h4><a href="mailto:noreply@envato.com">{{ $vendor->email }}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-third column_list">
                                            <div class="list_item lists_2 clearfix">
                                                <div class="list_left list_icon">
                                                    <i class=" icon-comment-line"></i>
                                                </div>
                                                <div class="list_right">
                                                    <div class="desc">
                                                        <p class="big" style="padding-top: 12px; display: block; margin: 0;">
                                                            Обадете ни се
                                                        </p>
                                                        <h4><a href="#">{{ $vendor->vendorDetails->phone_number }}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column mcb-column one-third column_list">
                                            <div class="list_item lists_2 clearfix">
                                                <div class="list_left list_icon">
                                                    <i class=" icon-user"></i>
                                                </div>
                                                <div class="list_right">
                                                    <div class="desc">
                                                        <p class="big" style="padding-top: 12px; display: block; margin: 0;">
                                                            Лице за контакти
                                                        </p>
                                                        <h4><a href="#">{{ $vendor->vendorDetails->contact_person }}</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('scripts')
<script src="https://maps.google.com/maps/api/js?sensor=false&ver=5.9"></script>
<script>
        function google_maps_58af1ee65f2cb() {
            var latlng = new google.maps.LatLng({{ $settings->lat }}, {{ $settings->lng }});
            var draggable = true;
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                draggable: draggable,
                zoomControl: true,
                mapTypeControl: false,
                streetViewControl: false,
                scrollwheel: false
            };
            var map = new google.maps.Map(document.getElementById("google-map-area-58af1ee65f2cb"), myOptions);
            var marker = new google.maps.Marker({
                position: latlng,
                map: map
            });
        }
        $(document).ready(function($) {
            google_maps_58af1ee65f2cb();
        });
</script>
@endsection
