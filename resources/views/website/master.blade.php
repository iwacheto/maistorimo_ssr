<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8 lt-ie7 "> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>

    <!-- Basic Page Needs -->
    <meta charset="utf-8">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    <meta name="author" content="">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Tag Manager -->
    <script async>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W3NF2MB');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicons -->
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- FONTS -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,400italic,700&display=swap'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Patua+One:100,300,400,400italic,700&display=swap'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic,900&display=swap'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lora:100,300,400,400italic,500,700,700italic&display=swap'>

    <!-- CSS -->
    <link rel='stylesheet' href='/website/css/global.css'>
    <link rel='stylesheet' href='/website/css/structure.css'>
    <link rel='stylesheet' href='/website/css/betheme2.css'>
    <link rel='stylesheet' href='/website/css/custom.css'>
    <link rel='stylesheet' href='/website/css/skins/{{ $settings->color }}/stylec721.css'>
    <link rel='stylesheet' href='/website/plugins/nano-gallery/css/nanogallery2.css'>


    <!-- Revolution Slider -->
    <link rel="stylesheet" href="/website/plugins/css/settings.css">
    <style>
        div.tp-bgimg {
            display: none !important;
        }
    </style>

</head>


<body class="home page-template-default page color-custom style-default layout-full-width no-content-padding header-classic sticky-header sticky-tb-color ab-show subheader-both-center menu-link-color menuo-right mobile-tb-hide mobile-side-slide mobile-mini-mr-ll">
    {{-- @include('cookieConsent::index') --}}

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W3NF2MB" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="Wrapper">
        <div id="Header_wrapper" style="background-image: url({{ $settings->main_image }});">
            <!-- <header id="Header" style="{{ (request()->segment(3))==='home' ? 'min-height:800px' : 'min-height: 250px;' }}"> -->
            <header id="Header">

                <div class="header_placeholder"></div>
                @include('website.partials.navigation', ['settings' => $settings, 'vendor' => $vendor, 'colors' => $colors, 'services' => $services,])
                @yield('header')

                {{-- @include('website.widgets.homeslider') --}}
                <div id="Content">
                    @yield('content')
                </div>
                {{--
                        @include('website.content.homepage') --}}
                @include('website.partials.footer', ['settings' => $settings, 'vendor' => $vendor, 'colors' => $colors])

                {{-- @yield('header') --}}

                <!-- side menu -->

                <div id="Side_slide" class="right dark">
                    <div class="close-wrapper">
                        <a href="#" class="close"><i class="icon-cancel-fine"></i></a>
                    </div>
                    <!-- <div class="extras">
            <a href="http://bit.ly/1M6lijQ" class="button button_theme button_js action_button " target="_blank"><span class="button_label">Buy now</span></a>
            <div class="extras-wrapper">
                <a class="icon search" href="#"><i class="icon-search-fine"></i></a>
            </div>
        </div> -->
                    <div class="search-wrapper">
                        <form id="side-form" method="get" action="#">
                            <input type="text" class="field" name="s" id="s" placeholder="Enter your search">
                            <input type="submit" class="submit" value="" style="display:none">
                            <a class="submit" href="#"><i class="icon-search-fine"></i></a>
                        </form>
                    </div>

                    <div class="menu_wrapper"></div>

                </div>

                <div id="body_overlay"></div>

                <?php
                echo $localBusiness->toScript();
                ?>
                <!-- JS -->
                <div id="fb-root"></div>
                <script>
                    (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>

                <script src="/website/js/jquery-2.1.4.min.js"></script>

                <script src="/website/js/mfn.menu.js"></script>
                <script src="/website/js/jquery.plugins.js"></script>
                <script src="/website/js/jquery.jplayer.min.js"></script>
                <script src="/website/js/animations/animations.js"></script>
                <script src="/website/js/translate3d.js"></script>
                <script src="/website/js/scripts.js"></script>

                <script src="/website/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>
                <script src="/website/plugins/rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>
                <script src="/website/plugins/nano-gallery/jquery.nanogallery2.core.js"></script>

                <script>
                    var tpj = jQuery;
                    var revapi1;
                    tpj(document).ready(function() {
                        if (tpj("#rev_slider_1_1").revolution == undefined) {
                            revslider_showDoubleJqueryError("#rev_slider_1_1");
                        } else {
                            revapi1 = tpj("#rev_slider_1_1").show().revolution({
                                sliderType: "hero",
                                sliderLayout: "auto",
                                dottedOverlay: "none",
                                delay: 9000,
                                navigation: {},
                                visibilityLevels: [1240, 1024, 778, 480],
                                gridwidth: 1240,
                                gridheight: 760,
                                lazyType: "none",
                                parallax: {
                                    type: "scroll",
                                    origo: "enterpoint",
                                    speed: 400,
                                    levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                                },
                                shadow: 0,
                                spinner: "spinner2",
                                autoHeight: "off",
                                disableProgressBar: "on",
                                hideThumbsOnMobile: "off",
                                hideSliderAtLimit: 0,
                                hideCaptionAtLimit: 0,
                                hideAllCaptionAtLilmit: 0,
                                debugMode: false,
                                fallbacks: {
                                    simplifyAll: "off",
                                    disableFocusListener: false,
                                }
                            });
                        }
                    });
                    /*]]>*/
                </script>

                <script>
                    jQuery(window).load(function() {
                        var retina = window.devicePixelRatio > 1 ? true : false;
                        if (retina) {
                            var retinaEl = jQuery("#logo img.logo-main");
                            var retinaLogoW = retinaEl.width();
                            var retinaLogoH = retinaEl.height();
                            retinaEl.attr("src", "images/logo-retina.png").width(retinaLogoW).height(retinaLogoH);
                            var stickyEl = jQuery("#logo img.logo-sticky");
                            var stickyLogoW = stickyEl.width();
                            var stickyLogoH = stickyEl.height();
                            stickyEl.attr("src", "images/logo-retina.png").width(stickyLogoW).height(stickyLogoH);
                            var mobileEl = jQuery("#logo img.logo-mobile");
                            var mobileLogoW = mobileEl.width();
                            var mobileLogoH = mobileEl.height();
                            mobileEl.attr("src", "images/logo-retina.png").width(mobileLogoW).height(mobileLogoH);
                            var mobileStickyEl = jQuery("#logo img.logo-mobile-sticky");
                            var mobileStickyLogoW = mobileStickyEl.width();
                            var mobileStickyLogoH = mobileStickyEl.height();
                            mobileStickyEl.attr("src", "images/logo-retina.png").width(mobileStickyLogoW).height(mobileStickyLogoH);
                        }
                    });

                    // let getUrl = '{{ Request::path()}}'
                    // let remClass=document.querySelector('.current_page_item');
                    // remClass.classList.remove('current_page_item');
                    // getUrl.classList.add('current_page_item');
                </script>

                <script>
                    $(function() {
                        // var height = $('.textwidget').css('height')
                        var height = $('.textwidget').height();
                        if (height < 140) {
                            $('.show_more').css('display', 'none')
                        }
                        $('.show_more').on('click', function() {
                            $('.textwidget').toggleClass('active_widget');
                        });
                    });
                </script>

                @yield('scripts')

</body>

</html>