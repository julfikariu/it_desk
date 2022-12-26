@extends('layouts.guest')

@section('title', 'Welcome')

@push('css')
    <style type="text/css">
        /*-- your custom css here --*/

    </style>
@endpush


@section('content')

    <section class="hm-banner">
        <div class="container">
            <div class="col-12 col-md-8 offset-md-2  text-center mb-5">

                <h2 class="how_can_help font_style_normal">How can we help you?</h2>
                <p>Ask Questions. Browse Articles. Find Answers.</p>

                <div class="position-relative">
                    <form action="{{ route('knowledge-search') }}" method="get">
                        <input type="text" name="search" class="help_search_input" placeholder="Enter your question or keyword here" autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true">
                        <span class="header-src-icon" onclick="event.preventDefault(); this.closest('form').submit();"> <i class="fa fa-search"></i></span>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <section class="contact-details pb-70">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-1 col-sm-12">

                </div>
                <div class="col-md-10 col-sm-12 section-content">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h4 class="h4">Still Need Support?</h4>
                            <p class="">We normally response within 24 hours</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ route('open-ticket')}}" class="btn btn-primary"><i class="fa fa-ticket rotate_45"></i> Open Ticket</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-12">

                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-details pb-70">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-1 col-sm-12">

                </div>
                <div class="col-md-10 col-sm-12 section-content">

                    @foreach ($categories as $category )

                        <div class="{{$loop->first?'':'mt-4'}}">

                            <h2 class="h2 mb-4 italic_none">
                                <a href="{{ route('help-single-category',$category->id) }}" class="text-dark ">
                                {{$category->name}}
                                </a>
                            </h2>


                            <div class="row help_center_content">
                                @foreach($category->subCategories as $subcategory)
                                    <div class="col-md-4">

                                        <h3 class="category_heading">
                                            <a href="{{route('help-single-sub-category',$subcategory->id)}}" class="text-dark">
                                                <span class="italic_none">{{$subcategory->name}}</span>
                                                <span class="italic_none">({{$subcategory->knowledge->count()}})</span>
                                            </a>
                                        </h3>

                                        <ul class="list-unstyled list mt-3 sub_category_list">
                                            @foreach($subcategory->knowledge as $knowledge)

                                                <li class="mb-3 ml-0 d-flex align-items-center">
                                                    <i class="fa fa-file-pdf-o mr-3 text-muted"></i>
                                                    <a href="{{route('help-single-knowledge',[$category->id,$knowledge->id])}}" class="text-dark">{{$knowledge->title}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-1 col-sm-12">

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
