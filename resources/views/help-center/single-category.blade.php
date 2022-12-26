@extends('layouts.guest')

@section('title', 'Page Title')

@push('css')
    <style type="text/css">
        /*-- your custom css here --*/

    </style>
@endpush


@section('content')

    <section class="hm-banner">
        <div class="container">
            <div class="col-12 col-md-8 offset-md-2  text-center ">
                <div class="position-relative">
                    <form action="{{ route('knowledge-search') }}" method="get">
                        <input type="text" name="search" class="help_search_input rounded" placeholder="Search help center..." autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true">
                        <span class="header-src-icon"  onclick="event.preventDefault(); this.closest('form').submit();"> <i class="fa fa-search"></i></span>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <section class="contact-details pb-70">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-0 col-sm-12">

                </div>
                <div class="col-md-12 col-sm-12 section-content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="hc-content">
                                <div class="left hc-sidenav">
                                    @foreach($category->subCategories as $sub_category)
                                        <h3>{{$sub_category->name}}</h3>
                                        <ul>
                                            @foreach($sub_category->knowledge as $left_knowledge)
                                                <li>
                                                    <a class="" href="{{route('help-single-knowledge',[$category->id,$left_knowledge->id])}}">
                                                        {{$left_knowledge->title}}
                                                    </a>

                                                </li>
                                        @endforeach
                                        <!---->
                                        </ul>
                                @endforeach
                                <!---->

                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="article_breadcumb">
                                <a class="article_item" href="{{ route('/') }}">
                                    Help Center
                                </a>
                                <span  class="px-1 text-muted small"><i class="fa fa-chevron-right"></i></span>
                                <span  class="article_item text-theme">
                                    {{$category->name}}
                                </span>

                            </div>

                            <div class="article_description pt-4 pb-5 px-2">

                                <h1 class="h2 text-center pb-2">{{$category->name}}</h1>
                                <hr class="mt-0 mb-4">

                                <div class="">

                                    <div class="single_category_box">
                                        <div class="list-group rounded-0">

                                            @foreach($category->subCategories as $subcategory)
                                                @foreach($subcategory->knowledge as $knowledge)
                                                <a href="{{route('help-single-knowledge',[$category->id,$knowledge->id])}}" class="rounded-0 single_category_box_item text-muted">
                                                    <div class="media d-flex align-items-center">
                                                        <i class="fa fa-file-pdf-o text-muted"></i>
                                                        <div class="media-body ml-4">
                                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                                <h6 class="mb-0 h5 ">{{$knowledge->title}}</h6>
                                                            </div>
                                                            <p class="font-italic mb-0 text-muted">{{Str::limit(strip_tags($knowledge->description),'250','...')}}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                    <hr>
                                                 @endforeach
                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-md-0 col-sm-12">

                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Your custom JavaScript here...
    </script>
@endpush
