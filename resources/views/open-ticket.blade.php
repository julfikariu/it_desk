@extends('layouts.guest')

@section('title', 'Open Tickets')

@push('css')
<style type="text/css">
    /*-- your custom css here --*/
    
</style>
@endpush


@section('content')

<section class="hm-banner">
    <div class="container">
        <div class="col text-center mb-5">
            <h2 class="h4 font_style_normal">New Ticket Form</h2>
            <p>Write your ticket for </p>
        </div>
       
    </div>
</section>
<section class="contact-details pb-70">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12 col-sm-12 section-content">
                <div class="row">
                    <div class="col-md-8">
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
                        <div class="card card_shadow border-0">
                            <div class="card-header bg-white">
                                <div class="h5 mb-0">New Ticket Form</div>
                            </div>
                            <div class="card-body">
                                <form method="post" action={{route('store-ticket')}}>
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Ticket Subject" required>
                                            @if ($errors->has('subject'))
                                            <br><span class="text-danger">{{ $errors->first('subject') }}</span>
                                            @endif
                                        </div>
                                        @guest
                                        <div class="form-group col-md-12">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                                            @if ($errors->has('email'))
                                            <br><span class="text-danger">{{ $errors->email('email') }}</span>
                                            @endif
                                        </div>
                                        @endguest
                                       
                                        <div class="form-group col-md-12">
                                            <select name="priority" class="form-control" id="priority">
                                                <option value="" disabled selected>Select Priority</option>
                                                <option value="Low">Low</option>
                                                @auth
                                                <option value="Medium">Medium</option>
                                                <option value="High">High</option>
                                                <option value="Urgent">Urgent</option>
                                                @endauth
                                            </select>
                                            @if ($errors->has('priority'))
                                            <br><span class="text-danger">{{ $errors->subject('priority') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <select name="category_id" class="form-control" id="valid">
                                                <option value="" disabled selected>Select Ticket Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                                   
                                            </select>
                                            @if ($errors->has('category_id'))
                                            <br><span class="text-danger">{{ $errors->subject('category_id') }}</span>
                                            @endif
                                        </div>
                                       
                                        <div class="form-group col-md-12">
                                            <div class="contact-textarea">
                                                <textarea  class="form-control" rows="6" placeholder="Wright Message"  name="body" required></textarea>
                                                @if ($errors->has('body'))
                                                <br><span class="text-danger">{{ $errors->message('body') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @auth
                                        <input type="hidden" class="" name="user_id" value="{{Auth::user()->id}}">
                                        @endauth
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-ticket rotate_45"></i> {{__('Create Ticket')}}</button>
                                        </div>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card_shadow border-0">
                            <div class="card-header bg-white h5">Categories</div>
                            <div class="">
                                <ul class="left_category_section mb-0">
                                    @foreach ($categories as $category)
                                    <li class="px-1">
                                       <h5 class="m-0">
                                          <a href="">
                                          <i class="fa fa-angle-double-right"></i> {{$category->name}} <span class="float-right">( {{$category->subCategories->count()}} )</span>
                                          </a>
                                       </h5>
                                    </li>
                                    @endforeach
                                 </ul>
                            </div>
                        </div>
                        <div class="card card_shadow border-0 mt-4">
                            <div class="card-header bg-white h5">Popular Knowledge</div>
                            <div class="">
                                <ul class="left_category_section mb-0">
                                    @foreach ($categories as $category)
                                    <li class="px-1">
                                       <h5 class="m-0">
                                          <a href="">
                                          <i class="fa fa-angle-double-right"></i> {{$category->name}} <span class="float-right">( {{$category->subCategories->count()}} )</span>
                                          </a>
                                       </h5>
                                    </li>
                                    @endforeach
                                 </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection

@push('scripts')
{{--<script src="{{ asset('frontend/js/form-summernote.js') }}"></script>--}}
<script>
// Your custom JavaScript here...
</script>
@endpush
