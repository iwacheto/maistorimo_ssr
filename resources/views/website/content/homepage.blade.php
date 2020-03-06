@extends('website.master')
@section('header')
@include('website.partials.homeHeader', ['settings' => $settings, 'colors' => $colors])
@endsection()
@section('content')
<div class="content_wrapper clearfix">
    <div class="sections_group">
        <div class="entry-content">
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
                                                            <a href="{{ $project->ProjectMainImage ? $project->ProjectMainImage->url : '' }}" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a><a target="_blank" href="#" class="external"><i class="icon-forward"></i></a><a href="/portfolio/{{ $project->title }}" class="link"><i class="icon-link"></i></a>
                                                        </div>
                                                    </div>
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

        </div>
    </div>
</div>

@endsection
