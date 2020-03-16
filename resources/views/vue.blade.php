<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>
    <?php
    echo $title;
    ?>
    </title>
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php
    echo $localBusiness->toScript();
    ?>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Google Tag Manager -->
    <script async defer>
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
        })(window, document, 'script', 'dataLayer', 'GTM-K84D4G7');
    </script>
    <!-- End Google Tag Manager -->

    {{--<link rel="preload" href="/css/vuetify.css" as="vuetify" onload="this.onload=null;this.rel='stylesheet'"> --}}
    {{-- <link rel="preload" href="/css/main-color.css" as="main-color" onload="this.onload=null;this.rel='stylesheet'" id="colors"> --}}

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script defer src="{{ mix('js/vue/entry-client.js') }}"></script>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K84D4G7" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->



    {!! ssr('js/vue/entry-server.js')
    // Share the packages with the server script through context
    ->context('packages', $packages)
    // If ssr fails, we need a container to render the app client-side
    ->fallback('<div id="app"></div>')
    ->render() !!}

    <script>
        // Share the packages with the client script through a JS variable
        window.packages = @json($packages)
    </script>
    <!-- Back To Top Button -->
    <div id="backtotop"><a href="#"></a></div>
    <div class="cookies_content">
        <div>Cookies</div>
    </div>
    </div>
   
    <!-- Scripts
================================================== -->

    <link rel="stylesheet" href="/css/colors/celadon.css" id="colors" async defer>
    <link rel="stylesheet" href="/website/plugins/nano-gallery/css/nanogallery2.css" async defer>
    <script type="text/javascript" src="/js/scripts/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/js/scripts/mmenu.min.js"></script>
    <script type="text/javascript" src="/js/scripts/chosen.min.js"></script>
    <script type="text/javascript" src="/js/scripts/slick.min.js"></script>
    <script type="text/javascript" src="/js/scripts/rangeslider.min.js"></script>
    <script type="text/javascript" src="/js/scripts/magnific-popup.min.js"></script>
    <script type="text/javascript" src="/js/scripts/waypoints.min.js"></script>
    <script type="text/javascript" src="/js/scripts/counterup.min.js"></script>
    <script type="text/javascript" src="/js/scripts/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/scripts/tooltips.min.js"></script>
    <!-- <script type="text/javascript" src="js/scripts/tooltips.min.js" async defer></script> -->
    <!-- <script type="text/javascript" src="js/front/bootstrap.js"></script> -->
    <script src="/website/plugins/nano-gallery/jquery.nanogallery2.core.js"></script>
    <script type="text/javascript" src="/js/scripts/custom.js" async defer></script>
    <!-- Google Autocomplete -->

    <script>
        function initAutocomplete() {
            var input = document.getElementById('autocomplete-input');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
            });
            if ($('.main-search-input-item')[0]) {
                setTimeout(function() {
                    $(".pac-container").prependTo("#autocomplete-container");
                }, 300);
            }
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"></script>
    <!-- Typed Script -->
    <script type="text/javascript" src="/js/scripts/typed.js" async defer></script>
    <script>
        let localCookies = document.cookie;
        if (localCookies) {

        }
    </script>

    <!-- Style Switcher
================================================== -->
    <script src="/js/scripts/switcher.js" async defer></script>

    {{-- <div id="style-switcher">
	<h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>
	<div>
		<ul class="colors" id="color1">
			<li><a href="#" class="main" title="Main"></a></li>
			<li><a href="#" class="blue" title="Blue"></a></li>
			<li><a href="#" class="green" title="Green"></a></li>
			<li><a href="#" class="orange" title="Orange"></a></li>
			<li><a href="#" class="navy" title="Navy"></a></li>
			<li><a href="#" class="yellow" title="Yellow"></a></li>
			<li><a href="#" class="peach" title="Peach"></a></li>
			<li><a href="#" class="beige" title="Beige"></a></li>
			<li><a href="#" class="purple" title="Purple"></a></li>
			<li><a href="#" class="celadon" title="Celadon"></a></li>
			<li><a href="#" class="red" title="Red"></a></li>
			<li><a href="#" class="brown" title="Brown"></a></li>
			<li><a href="#" class="cherry" title="Cherry"></a></li>
			<li><a href="#" class="cyan" title="Cyan"></a></li>
			<li><a href="#" class="gray" title="Gray"></a></li>
			<li><a href="#" class="olive" title="Olive"></a></li>
		</ul>
	</div>
</div> --}}
    <!-- Style Switcher / End -->

    </body>

    </html>