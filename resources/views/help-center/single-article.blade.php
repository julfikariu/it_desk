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
                                    <a href="{{route('help-single-sub-category',$sub_category->id)}}"><h3>{{$sub_category->name}}</h3></a>
                               <ul>
                                @foreach($sub_category->knowledge as $left_knowledge)
                                  <li>
                                      <a class="{{ $left_knowledge->id==$knowledge->id?'text-theme':'' }}" href="{{route('help-single-knowledge',[$category->id,$left_knowledge->id])}}">
                                          {{$left_knowledge->title}}
                                      </a>

                                  </li>
                                @endforeach

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
                            <a class="article_item" href="{{ route('help-single-category',$category->id) }}">
                               {{$category->name}}
                            </a>
                            <span  class="px-1 text-muted small"><i class="fa fa-chevron-right"></i></span>
                            <a class="article_item" href="{{route('help-single-sub-category',$knowledge->subcategory->id)}}">
                                 {{$knowledge->subcategory->name}}
                            </a>
                            <span  class="px-1 text-muted small"><i class="fa fa-chevron-right"></i></span>
                            <span  class="article_item text-theme text-primary">
                                 Knowledge
                            </span>
                            
                        </div>

                        <div class="article_description py-5 px-2">

                            <h1 class="h2 text-center">{{$knowledge->title}}</h1>
                            <hr class="mt-0 mb-4">
                            
                            <div class="">
                                {!! __(html_entity_decode($knowledge->description))!!}
                            </div>

                            <hr>
                            <div class="mt-5">
                                <div class="d-flex justify-content-start">
                                   <div class="h5 mt-1 mr-3">Was this article helpful?</div> 
                                    <div class="feedback-buttons">
                                        <button type="button" class="button-outline-success yes">
                                            <i class="fa fa-check"></i>
                                            <span trans="">Yes</span>
                                        </button>
                                        <button type="button" class="button-outline-danger no">
                                            <i class="fa fa-close"></i>
                                            <span trans="">No</span>
                                        </button>
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
