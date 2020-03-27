<div id="Top_bar">
    <div class="container">
        <div class="column one">
            <div class="top_bar_left clearfix">
                <div class="logo">
                    <a id="logo" href="/" title="BeTheme - Best WordPress Theme Ever">
                        <img class="logo-main scale-with-grid" src="{{ $settings->logo }}" alt="logo">
                        <img class="logo-sticky scale-with-grid" src="{{ $settings->logo }}" alt="logo">
                        <img class="logo-mobile scale-with-grid" src="{{ $settings->logo }}" alt="logo">
                        <img class="logo-mobile-sticky scale-with-grid" src="{{ $settings->logo }}" alt="logo">
                    </a>
                </div>
                <div class="menu_wrapper">
                    <nav id="menu" class="menu-main-menu-container">
                        <ul id="menu-main-menu" class="menu">
                            <!-- <li class="{{ Request::path()==='/home' ? 'current_page_item' : ''}}"> -->
                            <li class="{{ (request()->segment(1) == 'home') ? 'current_page_item' : '' }}">
                                <a href="/">
                                    <span>Начало</span></a>
                            </li>
                            <li class="{{ (request()->segment(1) == 'portfolio') ? 'current_page_item' : '' }}">
                                <a href="/portfolio"><span>Проекти</span></a>
                            </li>
                            <li class="{{ (request()->segment(1) == 'services') ? 'current_page_item' : '' }}">
                                @if(count($services)>0)
                                <a href="/services"><span>Услуги</span></a>
                                <ul class="menu">
                                    @foreach($services as $service)
                                    <li class="list_services">
                                        <a href="{{$vendor->name}}/services/{{ $service->name }}"><span>{{ $service->name }}</span></a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            <li class="{{ (request()->segment(1) == 'about') ? 'current_page_item' : '' }}">
                                <a href="/about"><span>За нас</span></a>
                            </li>
                            <li class="{{ (request()->segment(1) == 'contact') ? 'current_page_item' : '' }}">
                                <a href="/contact"><span>Контакти</span></a>
                            </li>
                            <li class="{{ (request()->segment(1) == 'terms') ? 'current_page_item' : '' }}">
                                <a href="/terms"><span>Общи условия</span></a>
                            </li>
                        </ul>
                    </nav>

                    <a class="responsive-menu-toggle" href="#" style="color: {{ $colors[$settings->color] }}"><i class="icon-menu-fine"></i></a>

                </div>
                <div class="secondary_menu_wrapper"></div>
                <div class="banner_wrapper"></div>
                <div class="search_wrapper">
                    <form method="get" id="searchform" action="#">
                        <i class="icon_search icon-search-fine"></i><a href="#" class="icon_close"><i class="icon-cancel-fine"></i></a>
                        <input type="text" class="field" name="s" id="s" placeholder="Enter your search">
                        <input type="submit" class="submit" value="" style="display:none">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
