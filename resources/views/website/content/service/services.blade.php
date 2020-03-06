@extends('website.master')
@section('header')
@include('website.partials.portfolioHeader')
@endsection()

@section('content')

<!-- Test Nav -->



<!-- Section Filter -->
<div id="Subheader">
    <div class="container">
        <div class="column one">
            <h1 class="title">Услуги</h1>
        </div>
    </div>
</div>

@if(count($services)>=1)
<div class="section">
    <div class="section_wrapper clearfix">
        <div class="column one column_portfolio">
            <div class="portfolio_wrapper isotope_wrapper">
                <ul class="portfolio_group lm_wrapper isotope grid col-3 services_list">


                    @foreach($services as $service)

                    <li class="portfolio-item isotope-item category-artwork category-banner  has-thumbnail">
                        <div class="portfolio-item-fw-bg">
                            <div class="portfolio-item-fill"></div>
                            <div class="list_style_header">
                                <h3 class="entry-title" itemprop="headline"><a class="link" href="#">{{ $service->name }}</a></h3>
                                <div class="links_wrapper">
                                    <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a><a href="portfolio_item5.html" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                </div>
                            </div>

                            <div class="image_frame scale-with-grid">
                                <div class="image_wrapper">
                                    <a href="/services/{{ $service->name }}">
                                        <div class="mask"></div><img width="960" height="720" src="{{$service->image_url}}" class="scale-with-grid wp-post-image" alt="">
                                    </a>
                                    <div class="image_links triple">
                                        <a href="{{$service->image_url}}" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a>
                                        <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://{{$vendor->name}}.maistorimo.bg/services/{{ $service->name }}&display=popup" class="external"><i class="icon-forward"></i></a>
                                        <a href="/services/{{ $service->name }}" class="link"><i class="icon-link"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="desc">
                                <div class="title_wrapper">
                                    <h5 class="entry-title" itemprop="headline"><a class="link" href="/services/{{ $service->name }}">{{ $service->name }}</a></h5>

                                </div>
                                <div class="details-wrapper">
                                    <dl>
                                        <dt>
                                            Client
                                        </dt>
                                        <dd>
                                            BeantownThemes
                                        </dd>
                                        <dt>
                                            Date
                                        </dt>
                                        <dd>
                                            February 3, 2017
                                        </dd>
                                        <dt>
                                            Website
                                        </dt>
                                        <dd>
                                            <a target="_blank" href="#"><i class="icon-forward"></i>View website</a>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="desc-wrapper"></div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

</div>

<div class="section">
    @else
    <div id="Subheader">
        <div class="container">
            <div class="column one services_bottom_heading">
                <h1 class="title">Вие все още нямате създадена услуга</h1>
                <ul class="breadcrumbs no-link services_bottom_ul">
                    <li>
                        <a href="about.html">Създай услуга</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endif
</div>


@endsection
