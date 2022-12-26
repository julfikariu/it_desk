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
        @if($page->ad_layout == 2 || $page->ad_layout == 6 || $page->ad_layout == 8 ||$page->ad_layout == 9 || $page->ad_layout == 11 || $page->ad_layout == 12)
            @if (!empty($topAd->content))
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="text-center">
                            {!! html_entity_decode($topAd->content) !!}
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
</section>
<section class="contact-details pb-70">
    <div class="container py-4">
        <div class="row justify-content-md-center">
            <div class="col-md-2 col-sm-12">
                @if($page->ad_layout == 5 || $page->ad_layout == 7 || $page->ad_layout == 8 ||$page->ad_layout == 10 || $page->ad_layout == 11 || $page->ad_layout == 12)
                    @if (!empty($leftAd->content))
                        {!! html_entity_decode($leftAd->content) !!}
                    @endif
                @endif
            </div>
            <div class="col-md-8 col-sm-12  section-content">
                {!! html_entity_decode($page->page_content) !!}
                <form method="post" action={{route('store-contact')}}>
                    @csrf
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
                    <div class="my-3">
                        <div class="contact-textarea">
                            <textarea class="form-control" rows="4" placeholder="Please write your message here, why would you like to delete your account" id="message" name="message" required></textarea>
                            @if ($errors->has('message'))
                            <br><span class="text-danger">{{ $errors->message('message') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="btn btn-info btn-lg w-25">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-sm-12">
                @if($page->ad_layout == 3 || $page->ad_layout == 7 || $page->ad_layout == 8 ||$page->ad_layout == 9 || $page->ad_layout == 10 || $page->ad_layout == 12)
                    @if (!empty($rightAd->content))
                        {!! html_entity_decode($rightAd->content) !!}
                    @endif
                @endif
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="text-center">
                    @if($page->ad_layout == 4 || $page->ad_layout == 6 || $page->ad_layout == 9 ||$page->ad_layout == 10 || $page->ad_layout == 11 || $page->ad_layout == 12)
                        @if (!empty($bottomAd->content))
                            {!! html_entity_decode($bottomAd->content) !!}
                        @endif
                    @endif
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
