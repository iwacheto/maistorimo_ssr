@extends('website.master')
@section('header')
@include('website.partials.portfolioHeader')
@endsection()

@section('content')

<div class="content_wrapper clearfix">
    <div class="sections_group">
        <div id="Subheader">
            <div class="container">
                <div class="column one">
                    <h1 class="title">Проекти</h1>
                </div>
            </div>
        </div>

        <!-- <div class="section section-filters">
                    <div class="section_wrapper clearfix">
                        <div id="Filters" class="column one  isotope-filters">
                            <ul class="filters_buttons">
                                <li class="label">
                                    Филтър
                                </li>
                                <li class="categories">
                                    <a class="open" href="#"><i class="icon-docs"></i>Категорий<i class="icon-down-dir"></i></a>
                                </li>
                                <li class="reset">
                                    <a class="close" data-rel="*" href="/portfolio"><i class="icon-cancel"></i> Покажи всички</a>
                                </li>
                            </ul>
                            <div class="filters_wrapper" data-cat="">
                                <ul class="categories">
                                    <li class="reset-inner current-cat">
                                        <a class="close" data-rel="*" href="portfolio.html">Всички</a>
                                    </li>
                                    <li class="artwork">
                                        <a data-rel=".category-artwork" href="portfolio_category_type.html">Произведения на изкуството</a>
                                    </li>
                                    <li class="banner">
                                        <a data-rel=".category-banner" href="portfolio_category_type.html">Банери</a>
                                    </li>
                                    <li class="design">
                                        <a data-rel=".category-design" href="portfolio_category_type.html">Дизайн</a>
                                    </li>
                                    <li class="close">
                                        <a href="#"><i class="icon-cancel"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
        <div class="section">
            <div class="section_wrapper clearfix">
                <div class="column one column_portfolio">
                    <div class="portfolio_wrapper isotope_wrapper">
                        <ul class="portfolio_group lm_wrapper isotope grid col-3">
                            @foreach($projects as $k => $project)
                            <li class="portfolio-item isotope-item category-artwork category-banner  has-thumbnail">
                                <div class="portfolio-item-fw-bg">
                                    <div class="portfolio-item-fill"></div>
                                    <div class="list_style_header">
                                        <h3 class="entry-title" itemprop="headline"><a class="link" href="/portfolio/{{ $project->title }}">{{ $project->title }}</a></h3>
                                        <div class="links_wrapper">
                                            <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a><a href="/portfolio/{{ $project->title }}" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                        </div>
                                    </div>
                                    <div class="image_frame scale-with-grid">
                                        <div class="image_wrapper">
                                            <a href="/portfolio/{{ $project->title }}">
                                                <div class="mask"></div><img width="960" height="720" src="{{ $project->ProjectMainImage ? $project->ProjectMainImage->url : '' }}" class="scale-with-grid wp-post-image" alt="">
                                            </a>
                                            <div class="image_links triple">
                                                <a href="{{ $project->ProjectMainImage ? $project->ProjectMainImage->url : '' }}" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a>
                                                <a class="external" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://{{$vendor->name}}.maistorimo.bg/portfolio/{{ $project->title }}&display=popup"><i class="icon-forward"></i></a>
                                                <a href="/portfolio/{{ $project->title }}" class="link"><i class="icon-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="desc">
                                        <div class="title_wrapper">
                                            <h5 class="entry-title" itemprop="headline"><a class="link" href="/portfolio/{{ $project->title }}">{{ $project->title }}</a></h5>
                                            {{-- <div class="button-love">
                                                        <a href="#" class="mfn-love" data-id="34"><span class="icons-wrapper"><i class="icon-heart-empty-fa"></i><i class="icon-heart-fa"></i></span><span class="label">38</span></a>
                                                    </div> --}}
                                        </div>
                                        <div class="details-wrapper">
                                            <dl>
                                                <dt>
                                                    Клиент
                                                </dt>
                                                <dd>
                                                    Тема
                                                </dd>
                                                <dt>
                                                    Дата
                                                </dt>
                                                <dd>
                                                    February 3, 2017
                                                </dd>
                                                <dt>
                                                    Уебсаийт
                                                </dt>
                                                <dd>
                                                    <a target="_blank" href="#"><i class="icon-forward"></i>Виж уебсайта</a>
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
    </div>
</div>
@endsection
