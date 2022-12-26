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
{{--            {!! html_entity_decode($page->icon? '<img src="'. asset('upload/backend/pages/' . $page->icon) .'" alt="" class="img-fluid mx-auto my-2">':'') !!}--}}
            {{--<h2>{{ $page->title?$page->title:'' }}</h2>--}}
            {{--<p>{{ $page->sub_title?$page->sub_title:'' }}</p>--}}

            <h2>Contact</h2>
          
        </div>
    </div>
</section>
<section class="contact-details pb-70">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12 col-sm-12 section-content">
                <form method="post" action={{route('store-contact')}}>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" name="f_name" id="f_name" class="form-control" placeholder="First Name" required>
                            @if ($errors->has('f_name'))
                            <br><span class="text-danger">{{ $errors->first('f_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="l_name" id="l_name" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                            @if ($errors->has('email'))
                            <br><span class="text-danger">{{ $errors->email('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject" required>
                            @if ($errors->has('subject'))
                            <br><span class="text-danger">{{ $errors->subject('subject') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <div class="contact-textarea">
                                <textarea class="form-control" rows="6" placeholder="Write Message" id="message" name="message" required></textarea>
                                @if ($errors->has('message'))
                                <br><span class="text-danger">{{ $errors->message('message') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">{{__('Send Message')}}</button>
                        </div>
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
                    </div>
                </form>
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
