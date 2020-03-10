<template>
  
<div id="footer" class="sticky-footer">
			<!-- Main -->
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-sm-6 footer_img">
						<img class="footer-logo" src="images/logo.png" alt="">
						<br><br>
						<p>Майсторимо.БГ е платформа предоставяща на своите потребители съдържание и възможност за пласиране на техните услуги</p>
					</div>

					<div class="col-md-4 col-sm-6 ">
						<h4>Полезни линкове</h4>
						<ul class="footer-links">
							<li>
								<router-link tag="a" to="general_terms">Общи условия</router-link>
							</li>
							<li>
								<router-link tag="a" to="private_protection">Политика за поверителност</router-link>
							</li>
							<li><a href="#">GDPR</a></li>
							<li>
								<router-link tag="a" to="/contacts">Контакти</router-link>
							</li>

						</ul>
						<div class="clearfix"></div>
					</div>

					<div class="col-md-3  col-sm-12">
						<h4>Свържете се с нас</h4>
						<div class="text-widget">
							<span>Плевен, Булевард Русе 19</span> <br>
							Телефон: <span>+359878735795</span><br>
							Поша:<span> <a href="#">g.prusiyski@webrika.bg</a> </span><br>
						</div>

						<ul class="social-icons margin-top-20">
							<li><a class="facebook" target="_blank" href="https://www.facebook.com/%D0%9C%D0%B0%D0%B9%D1%81%D1%82%D0%BE%D1%80%D0%B8%D0%BC%D0%BE-262442748017349"><i class="icon-facebook"></i></a></li>
							<!-- {{-- <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
						<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
						<li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li> --}} -->
						</ul>

					</div>

				</div>

				<!-- Copyright -->
				<div class="row">
					<div class="col-md-12">
						<div class="copyrights">© 2019 Maistorimo. All Rights Reserved.</div>
					</div>
				</div>

			</div>

		</div>
		<!-- Footer / End -->

</template>

<script>
export default {

}
</script>
