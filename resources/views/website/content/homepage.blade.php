@extends('website.master')
@section('header')
@include('website.partials.homeHeader', ['settings' => $settings, 'colors' => $colors])
@endsection()
@section('content')
<div class="content_wrapper clearfix">
    <div class="ochra-line"></div>
    <div class="sections_group">
        <div class="entry-content">
            <div class="yellow-shape"><span>Услуги</span></div>
            <div class="section mcb-section" style="padding-top:70px; padding-bottom:30px;">
                <div class="section_wrapper mcb-section-inner">
                    <div class="wrap mcb-wrap one valign-top clearfix">
                        <div class="mcb-wrap-inner">
                            <div class="column mcb-column one-third column_icon_box">
                                <div class="icon_box icon_position_top has_border">
                                    <div class="icon_wrapper">
                                        <div class="icon">
                                            <i class="icon-docs"></i>
                                        </div>
                                    </div>
                                    <div class="desc_wrapper">
                                        <h4 class="title">{{ $settings->bullet_1_heading }}</h4>
                                        <div class="desc">
                                            {{ $settings->bullet_1_content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column mcb-column one-third column_icon_box ">
                                <div class="icon_box icon_position_top has_border">
                                    <div class="icon_wrapper">
                                        <div class="icon">
                                            <i class="icon-cog-line"></i>
                                        </div>
                                    </div>
                                    <div class="desc_wrapper">
                                        <h4 class="title">{{ $settings->bullet_2_heading }}</h4>
                                        <div class="desc">
                                            {{ $settings->bullet_2_content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column mcb-column one-third column_icon_box ">
                                <div class="icon_box icon_position_top no_border">
                                    <div class="icon_wrapper">
                                        <div class="icon">
                                            <i class="icon-star-line"></i>
                                        </div>
                                    </div>
                                    <div class="desc_wrapper">
                                        <h4 class="title">{{ $settings->bullet_3_heading }}</h4>
                                        <div class="desc">
                                            {{ $settings->bullet_3_content }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="section mcb-section full-width no-margin-h no-margin-v" style="margin-bottom:30px; padding-top:60px; padding-bottom:60px; background-color:{{ $colors[$settings->color] }}">
                <svg xmlns="" xmlns:xlink="" width="143" height="124" viewBox="0 0 143 124">
                    <image id="Background" width="143" height="124" xlink:href="data:img/png;base64,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"/>
                </svg>
                <div class="section_wrapper mcb-section-inner">
                    <div class="wrap mcb-wrap one valign-top clearfix">
                        <div class="mcb-wrap-inner">
                            <div class="column mcb-column one column_column">

                                <div class="column_attr clearfix align_center">
                                    <h2 style="margin: 0; color: #fff;">Нашите проекти</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="small-yellow-shape"></div>


            <!-- Test Content -->
            <div class="content_wrapper clearfix">
                <div class="sections_group">

                    <div class="section">
                        <div class="section_wrapper clearfix">
                            <div class="column one column_portfolio">
                            <div class="portfolio_wrapper isotope_wrapper">
                                    <ul class="portfolio_group lm_wrapper isotope grid col-3">
                                        @foreach($projects as $k => $project)
                                        <li class="portfolio-item isotope-item category-artwork category-banner  has-thumbnail">
                                            <!-- <div class="portfolio-item-fw-bg"> -->
                                                <!-- <div class="portfolio-item-fill"></div>
                                                <div class="list_style_header">
                                                    <h3 class="entry-title" itemprop="headline"><a class="link" href="/portfolio/{{ $project->title }}">{{ $project->title }}</a></h3>
                                                    <div class="links_wrapper">
                                                        <a href="#" class="button button_js portfolio_prev_js"><span class="button_icon"><i class="icon-up-open"></i></span></a><a href="#" class="button button_js portfolio_next_js"><span class="button_icon"><i class="icon-down-open"></i></span></a><a href="/portfolio/{{ $project->title }}" class="button button_left button_theme button_js"><span class="button_icon"><i class="icon-link"></i></span><span class="button_label">Read more</span></a>
                                                    </div>
                                                </div> -->
                                                <div class="image_frame scale-with-grid">
                                                    <div class="image_round_line"></div>
                                                    <div class="image_wrapper">
                                                        <div class="mask">
                                                            <a href="/portfolio/{{ $project->title }}">
                                                                <img width="960" height="720" src="{{ $project->ProjectMainImage ? $project->ProjectMainImage->url : '' }}" class="scale-with-grid wp-post-image" alt="">
                                                            </a>
                                                        </div>
                                                        <!-- <div class="image_links triple">
                                                            <a href="{{ $project->ProjectMainImage ? $project->ProjectMainImage->url : '' }}" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a target="_blank" href="#" class="external"><i class="icon-forward"></i></a><a href="/portfolio/{{ $project->title }}" class="link"><i class="icon-link"></i></a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                        </li>
                                        @endforeach
                                    </ul>
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
