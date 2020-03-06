@extends('website.master')
@section('header')
    @include('website.partials.portfolioHeader', ['project' => $project]);
    @include('website.partials.projectDetailsSubheader', ['project' => $project]);
@endsection()

@section('content')
                <div class="content_wrapper clearfix">
                    <div class="sections_group">
                        <div class="no-title portfolio type-portfolio has-post-thumbnail hentry portfolio-types-artwork portfolio-types-banner">

                            <div class="section section-post-header">
                                <div class="section_wrapper clearfix">
                                    <div class="column one single-photo-wrapper image">
                                        {{-- <div class="share_wrapper">
                                            <span class='st_facebook_vcount' displayText='Facebook'></span><span class='st_twitter_vcount' displayText='Tweet'></span><span class='st_pinterest_vcount' displayText='Pinterest'></span>
                                            <script src="../../w.sharethis.com/button/buttons.js"></script>
                                            <script>
                                                stLight.options({
                                                    publisher: "1390eb48-c3c3-409a-903a-ca202d50de91",
                                                    doNotHash: false,
                                                    doNotCopy: false,
                                                    hashAddressBar: false
                                                });
                                            </script>
                                        </div> --}}
                                        {{-- <div class="image_frame scale-with-grid">
                                            <div class="image_wrapper">
                                                <a href="{{ $project->ProjectMainImage->url }}" rel="prettyphoto">
                                                    <div class="mask"></div><img width="1200" height="675" src="{{ $project->ProjectMainImage->url }}" class="scale-with-grid wp-post-image" alt="">
                                                </a>
                                                <div class="image_links">
                                                    @foreach($project->projectGalleries as $key => $image)
                                                        <a href="{{ $image->url }}" class="zoom" rel="prettyphoto"><i class="icon-search"></i></a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div id="nanogallery2"
                                                data-nanogallery2 = '{
                                                "thumbnailWidth":   "auto",
                                                "thumbnailHeight":  200,
                                                "itemsBaseURL":     "https://nanogallery2.nanostudio.org/samples/"
                                                }'
                                            >
                                            <!-- content of the gallery -->
                                            @foreach($project->projectGalleries as $key => $image)
                                                <a href="{{ $image->url }}" data-ngthumb="{{ $image->url }}"></a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="column one project-description">
                                        <ul>
                                            <li class="one-third">
                                                <span class="label">Категория:</span> {{ $project->category()->first()->title }}
                                            </li>
                                            <li class="one-third">
                                                <span class="label">Адрес</span> {{ $project->formatted_address }}
                                            </li>
                                            <li class="one-third">
                                                <span class="label">Тагове</span>
                                                    @foreach($project->tags()->get() as $k => $tag)
                                                        <span>#{{ $tag->tag->tag }} </span>
                                                    @endforeach
                                            </li>
                                            <li>
                                                <span class="label">Задачи</span>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui non felis.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="entry-content">
                                <div class="section mcb-section" style="padding-top:0px; padding-bottom:40px;">
                                    <div class="section_wrapper mcb-section-inner">
                                        <div class="wrap mcb-wrap one valign-top clearfix">
                                            <div class="mcb-wrap-inner">
                                                <div class="column mcb-column one column_column  column-margin-20px">
                                                    <div class="column_attr clearfix">
                                                        {!! $project->description !!}
                                                    </div>
                                                </div>
                                                {{-- <div class="column mcb-column one-second column_column">
                                                    <div class="column_attr clearfix">
                                                        <p>
                                                            Lorem ipsum dolor sit amet magna. Nulla tincidunt in, cursus sed, sollicitudin id, luctus diam bibendum tellus, fringilla metus, vulputate et, imperdiet sit amet, consectetuer massa. Nulla gravida gravida sem. Nulla gravida sagittis. Nullam et magnis dis montes, nascetur ridiculus mus. Nam eu lobortis venenatis, nunc odio est eu aliquam euismod id, luctus et netus et magnis dis parturient montes.
                                                        </p>
                                                        <p>
                                                            Fusce fringilla tempus purus feugiat facilisis at, cursus molestie. Quisque facilisis est pretium magna. Curabitur interdum at, bibendum a, iaculis nisl. Ut vel massa. Aliquam risus velit, rhoncus eget, porta ornare, erat consectetuer pede, luctus et nunc ac arcu mi facilisis vel, accumsan pede interdum vitae, ornare egestas non, sollicitudin ac, felis. Nunc in orci orci, viverra justo. Curabitur ac tortor. Morbi risus sit amet enim.
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="column mcb-column one-second column_column">
                                                    <div class="column_attr clearfix">
                                                        <p>
                                                            Nam tempor ac, felis. Duis aliquam, libero. Nulla facilisi. Etiam dolor. Vestibulum convallis consequat. Integer sodales quam quam nulla, at metus. Proin volutpat enim eu urna. Nam eget justo. Vestibulum scelerisque. Duis tempor, sapien dui lectus blandit lobortis. Vivamus nonummy porttitor lectus felis sed interdum adipiscing elit. Pellentesque dapibus sit amet lacus. Nunc sit amet tempus purus non felis. Morbi mattis ac, ante. Nullam nec magna. Ut eget elit. Lorem ipsum primis in wisi. Vivamus lacus egestas risus nisl, blandit vel, arcu. Suspendisse dignissim id, wisi. Sed et imperdiet felis, nec augue. Pellentesque fringilla erat. Vivamus sed ante vitae erat libero, posuere in, purus. Duis a dui. Sed fringilla mi, rutrum et, congue vel, hendrerit nulla ornare a, vestibulum in, accumsan fringilla faucibus, erat felis.
                                                        </p>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="section section-post-footer">
                                <div class="section_wrapper clearfix">
                                    <div class="column one post-pager"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
