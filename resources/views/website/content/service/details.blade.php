@extends('website.master')
@section('header')
@include('website.partials.portfolioHeader')
@endsection()

@section('content')

<div id="Subheader">
    <div class="container">
        <div class="column one">
            <h1 class="title">{{ $service->name }}</h1>
        </div>
    </div>
</div>

<div id="Content">
    <div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="no-title portfolio type-portfolio has-post-thumbnail hentry portfolio-types-artwork portfolio-types-banner">
                <div class="section section-post-header">
                    <div class="section_wrapper clearfix">
                        <div class="column one post-header">
                        </div>
                        <div class="column one single-photo-wrapper image">
                            <div class="image_frame scale-with-grid">
                                <div class="image_wrapper">
                                    <a href="{{ $service->image_url }}" rel="prettyphoto">
                                        <div class="mask"></div><img width="1200" height="675" src="{{ $service->image_url }}" class="scale-with-grid wp-post-image" alt="">
                                    </a>
                                    <div class="image_links">
                                        <a href="{{ $service->image_url }}" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="entry-content">
                    <div class="section mcb-section" style="padding-top:0px; padding-bottom:40px;">
                        <div class="section_wrapper mcb-section-inner">
                            <div class="wrap mcb-wrap one valign-top clearfix">
                                <div class="mcb-wrap-inner">
                                    <div class="column mcb-column one column_column  column-margin-20px">

                                    </div>
                                    <div class="column mcb-column one-second column_column">
                                        <div class="column_attr clearfix">
                                            <p> {!! $service->first_description!!} </p>
                                        </div>
                                    </div>
                                    <div class="column mcb-column one-second column_column">
                                        <div class="column_attr clearfix">
                                            <p> {!! $service->second_description!!} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="section section-post-related">
                    <div class="section_wrapper clearfix">
                    @if(count($service->projectServices)>0)
                        <div class="section-related-adjustment simple">
                            <h4>Проекти</h4>
                            <div class="section-related-ul col-3">

                                @foreach($service->projectServices as $projectService)
                                <div class="column post-related post-33 portfolio type-portfolio has-post-thumbnail hentry portfolio-types-banner portfolio-types-design">
                                    <div class="image_frame scale-with-grid">
                                        <div class="image_wrapper">
                                            <a href="/portfolio/{{ $projectService->sProject->title }}">
                                                <div class="mask"></div><img width="960" height="720" src="{{ $projectService->sProject->ProjectMainImage->url }}" class="scale-with-grid wp-post-image" alt="">
                                            </a>
                                            <div class="image_links double">
                                                <a href="" class="zoom" rel="prettyphoto">
                                                <i class="icon-search"></i></a><a href="portfolio_item7.html" class="link"><i class="icon-link"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="desc">
                                        <h4><a href="/portfolio/{{ $projectService->sProject->title }}"> {{ $projectService->sProject->title }}</a></h4>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
