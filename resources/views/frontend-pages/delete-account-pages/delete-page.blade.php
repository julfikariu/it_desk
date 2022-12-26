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
            <div class="col-2"></div>
            <div class="col-8 section-content">
                <div id="form-messages">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>

                {!! html_entity_decode($page->page_content) !!}

                <div class="mt-4">
                    <a href="{{ route('login') }}">
                        <button type="button" class="btn btn-info btn-lg ">{{__('Login to Delete your Account')}}</button>
                    </a>
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Your custom JavaScript here...
</script>
@endpush
