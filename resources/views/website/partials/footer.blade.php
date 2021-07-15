</div>
<!-- <footer id="Footer" class="clearfix" style="background-color:{{ $colors[$settings->color] }}"> -->
<footer id="Footer" class="clearfix">
    <div class="widgets_wrapper" style="padding:70px 0;">
        <div class="container">
            <div class="column one-third">
                <aside class="widget widget_text">
                    <h4>За нас</h4>
                    <div class="textwidget">
                        <p class="big">
                            {!! $settings->about_us !!}
                        </p>
                    </div>
                    <button class="show_more">Покажи повече</button>

                </aside>
            </div>
            <div class="column one-third">
                <aside class="widget widget_mfn_recent_posts">
                    <h4>Услуги</h4>
                    <div class="Recent_posts">
                        <ul>
                            @if(isset($services[0]))
                            <li class="post">
                                <a href="/services/{{ $services[0]->name }}">
                                    <div class="photo footer_image"><img src="{{ $services[0]->image_url }}" class="scale-with-grid wp-post-image" alt="">
                                    </div>
                                    <div class="desc">
                                        <h6>{{ $services[0]->name }}</h6><span class="date"><i class="icon-clock"></i>{{ $services[0]->created_at }}</span>
                                    </div>
                                </a>
                            </li>
                            @endif

                            @if(isset($services[1]))
                            <li class="post">
                                <a href="/services/{{ $services[1]->name }}">
                                    <div class="photo"><img width="80" height="80" src="{{ $services[1]->image_url }}" class="scale-with-grid wp-post-image" alt="">
                                    </div>
                                    <div class="desc">
                                        <h6>{{ $services[1]->name }}</h6><span class="date"><i class="icon-clock"></i>{{ $services[1]->created_at }}</span>
                                    </div>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </aside>
            </div>
            <div class="column one-third">
                <aside class="widget widget_mfn_recent_posts">
                    <h4>Проекти</h4>
                    <div class="Recent_posts">
                        <ul>
                            @if(isset($projects[0]))
                            <li class="post">
                                <a href="/portfolio/{{ $projects[0]->title }}">
                                    <div class="photo"><img width="80" height="80" src="{{ $projects[0]->ProjectMainImage['url'] }}" class="scale-with-grid wp-post-image" alt="">
                                    </div>
                                    <div class="desc">
                                        <h6>{{ $projects[0]->title }}</h6><span class="date"><i class="icon-clock"></i>{{ $projects[0]->created_at }}</span>
                                    </div>
                                </a>
                            </li>
                            @endif

                            @if(isset($projects[1]))
                            <li class="post">
                                <a href="/portfolio/{{ $projects[1]->title }}">
                                    <div class="photo"><img width="80" height="80" src="{{ $projects[1]->ProjectMainImage['url'] }}" class="scale-with-grid wp-post-image" alt="">
                                    </div>
                                    <div class="desc">
                                        <h6>{{ $projects[1]->title }}</h6><span class="date"><i class="icon-clock"></i>{{ $projects[1]->created_at }}</span>
                                    </div>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="yello-line"></div>
    <div class="social">
            <div class="column-one">
                <p class="copy-right">Copyright &#169; 2009 - 2021 Maistorimo.com</p>
            </div>
            
            <div class="column-two">
                <ul class="social">
                    
                    <li class="facebook">
                        <a href="#" title="Facebook"><i class="icon-facebook"></i></a>
                    </li>
                    <li class="instagram">
                        <a href="#" title="Instagram"><i class="icon-instagram"></i></a>
                    </li>
                    
                    <li class="twitter">
                        <a href="#" title="Twitter"><i class="icon-twitter"></i></a>
                    </li>
                    
                </ul>
            </div>
    </div>
    {{-- <div class="footer_copy">
                <div class="container">
                    <div class="column one">
                        <a id="back_to_top" class="button button_js" href="#"><i class="icon-up-open-big"></i></a>
                        <div class="copyright">
                            &copy; 2017 BeTheme - BeTheme. Muffin group - HTML by <a target="_blank" rel="nofollow" href="http://bit.ly/1M6lijQ">Test</a>
                        </div>
                        <ul class="social">
                            <li class="skype">
                                <a href="#" title="Skype"><i class="icon-skype"></i></a>
                            </li>
                            <li class="facebook">
                                <a href="#" title="Facebook"><i class="icon-facebook"></i></a>
                            </li>
                            <li class="googleplus">
                                <a href="#" title="Google+"><i class="icon-gplus"></i></a>
                            </li>
                            <li class="twitter">
                                <a href="#" title="Twitter"><i class="icon-twitter"></i></a>
                            </li>
                            <li class="vimeo">
                                <a href="#" title="Vimeo"><i class="icon-vimeo"></i></a>
                            </li>
                            <li class="youtube">
                                <a href="#" title="YouTube"><i class="icon-play"></i></a>
                            </li>
                            <li class="behance">
                                <a href="#" title="Behance"><i class="icon-behance"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
</footer>