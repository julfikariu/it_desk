@extends('layouts.guest')

@section('title', $title)

@push('css')
<style type="text/css">
    /*-- your custom css here --*/
</style>
@endpush


@section('content')

<section class="hm-banner m-banner">
    <div class="container">
        <div class="col text-center mb-5">
            {!! html_entity_decode($page->icon? '<img src="'. asset('upload/backend/pages/' . $page->icon) .'" alt="" class="img-fluid mx-auto my-2">':'') !!}
            <h2>{{ $page->title?$page->title:'' }}</h2>
            <p>{{ $page->sub_title?$page->sub_title:'' }}</p>
        </div>
    </div>
</section>
<section class="contact-details pb-70">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-10 mx-auto col-sm-12 section-content">
                <div class="text-justify lead">
                    {{$page->page_content}}
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
