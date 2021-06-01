<!DOCTYPE html>

<head>

	<!-- Basic Page Needs
================================================== -->
	{!! app('seotools')->generate() !!}
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
		})(window, document, 'script', 'dataLayer', 'GTM-5RVVFTC');
	</script>
	<!-- End Google Tag Manager -->

	<!-- CSS
================================================== -->
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/vuetify.css">
	<link rel="stylesheet" href="/css/colors/celadon.css" id="colors">
	<script defer src="{{ mix('js/react/entry-client.js') }}?ver=10"></script>

</head>

<body>


	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RVVFTC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	{!! ssr('js/react/entry-server.js')
	// Share the packages with the server script through context
	->context('packages', $packages)
	// If ssr fails, we need a container to render the app client-side
	->fallback('<div id="app"></div>')
	->render() !!}

	<script>
		// Share the packages with the client script through a JS variable
		window.packages = @json($packages)
	</script>




	<!-- Scripts
================================================== -->

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
	<script type="text/javascript" src="/js/scripts/custom.js"></script>

	<script>
		$.ajaxSetup({
			data: {
				_token: $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>


	@include ('layout.footer')
</body>

</html>
