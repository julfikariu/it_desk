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
        <div class="col text-center mb-5">
            <h2 class="how_can_help font_style_normal">How long will you take?</h2>
            <p>Find quick answers to frequent pre-sale questions asked by customers.</p>
        </div>
      
    </div>
</section>
<section class=" pb-70">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12 col-sm-12 section-content">
                <div class="our-faq bg-white p-4">
                    <div class="" id="accordion">
                        <ul class="list-group list-unstyled">
                            @foreach ($faqs as $faq)
                            <li class="list-group-item">
                                <div class="py-2 ">
                                    <div class="">
                                        <h4 class="">
                                            <a class="accordion-toggle d-block position-relative text-primary font-weight-bold collapsible-link" data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{$loop->index+1}}"> {{$faq->question}}</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne{{$loop->index+1}}" class="panel-collapse collapse in">
                                        <div class="pt-3">
                                            {!! strip_tags($faq->answer) !!}
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
        <div class="row mt-5">
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Your custom JavaScript here...
</script>
@endpush
