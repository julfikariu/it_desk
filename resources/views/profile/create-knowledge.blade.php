@extends('layouts.guest')

@section('title', 'Create Knowledge')

@push('css')
<link rel="stylesheet" href="{{asset('frontend/css/tagin.min.css')}}" />
<style type="text/css">
    /*-- your custom css here --*/
    
</style>
@endpush


@section('content')

<section class="hm-banner">
    <div class="container">
        <div class="col text-center mb-5">
            <h2 class="h4 font_style_normal">New Knowledge Form</h2>
            <p>Write your knowledge to share others </p>
        </div>
       
    </div>
</section>
<section class="contact-details pb-70">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-1 col-sm-12">
               
            </div>
            <div class="col-md-10 col-sm-12 section-content">
                <form method="post" action={{route('store-knowledge')}}>
                    @csrf
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
                                    <div class="h5 mb-0">New Knowledge Form</div>
                                </div>
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input type="text" name="title" id="title" class="form-control" placeholder="Knowledgre Title" required>
                                            @if ($errors->has('title'))
                                            <br><span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    
                                        <div class="form-group col-md-12">
                                            <div class="contact-textarea">
                                                <textarea  class="form-control" rows="6" placeholder="Write description..." id="summernote" name="description" required></textarea>
                                                @if ($errors->has('body'))
                                                <br><span class="text-danger">{{ $errors->message('description') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @auth
                                        <input type="hidden" class="" name="user_id" value="{{Auth::user()->id}}">
                                        @endauth
                                        <div class="form-group col-md-12">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-ticket rotate_45"></i> {{__('Create Knowledge')}}</button>
                                        </div>
                                    
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card_shadow border-0">
                                <div class="card-header bg-white h5">Categories</div>
                                <div class="">
                                    <div class=" mt-3">
                                        <div class="form-group col-md-12">
                                            <select name="sub_categories_id" class="form-control" id="valid">
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach ($sub_categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                                
                                            </select>
                                            @if ($errors->has('sub_categories_id'))
                                            <br><span class="text-danger">{{ $errors->subject('sub_categories_id') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card card_shadow border-0 mt-4">
                                <div class="card-header bg-white h5">Tags</div>
                                <div class="">
                                    <div class=" mt-3">
                                        <div class="form-group col-md-12">
                                            <code class="small text-muted">Write tags separated by comma</code>
                                            <input type="text" name="tags" id="tags" class="form-control tagin" placeholder="Tags separated by comma" required>
                                            @if ($errors->has('tags'))
                                            <br><span class="text-danger">{{ $errors->first('tags') }}</span>
                                            @endif
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
           
            <div class="col-md-1 col-sm-12">
               
              </div>
        </div>
        
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('frontend/js/form-summernote.js') }}"></script>
<script src="{{ asset('frontend/js/tagin.min.js') }}"></script>
<script>
// Your custom JavaScript here...
for (const el of document.querySelectorAll('.tagin')) {
      tagin(el)
    }
</script>
@endpush
