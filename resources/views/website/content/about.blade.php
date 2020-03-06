@extends('website.master')
@section('header')
    @include('website.partials.portfolioHeader')
@endsection()

@section('content')


<div class="content_wrapper clearfix">
        <div class="sections_group">
            <div class="entry-content">
                <div class="section mcb-section" style="padding-top:80px; padding-bottom:40px;">
                    <div class="section_wrapper mcb-section-inner">
                        <div class="wrap mcb-wrap one valign-top clearfix">
                            <div class="mcb-wrap-inner">
                                <div class="column mcb-column one-second column_column">
                                    <div class="column_attr clearfix">
                                        <h3 class="themecolor">Нашата компания</h3>
                                        <p class="big">
                                            {!! $settings->about_us !!}
                                        </p>
                                    </div>
                                </div>
                                <div class="column mcb-column one-second column_column">
                                    <div class="column_attr clearfix">
                                        <h3 class="themecolor">Мисия</h3>
                                        <p class="big">
                                                {!! $settings->about_us_2 !!}
                                        </p>
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
