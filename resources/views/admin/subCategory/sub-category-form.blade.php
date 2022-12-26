@extends('admin.layouts.master')

@section('title', $title)

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/page-form.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col">
        <nav class="breadcrumb justify-content-sm-start justify-content-center text-center text-light bg-dark ">
            <a class="breadcrumb-item text-white" href="#">{{ __('Home') }}</a>
            <span class="breadcrumb-item active">{{ __($title) }}</span>
            <span class="breadcrumb-info" id="time"></span>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card card-dark bg-dark">
            <div class="card-header">
                <h6 class="card-title">{{ __($title) }}</h6>
            </div>
            <div class="card-body ">
                <form action="{{route('admin.store-sub-category',$subcategory!=null?$subcategory->id:'')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <p class="mb-1">{{__('Category Name:')}} </p>
                        <div class="input-group input-group-lg mb-3">
                            <select class="form-control form-control-lg" name="category_id">
                                <option value="" selected disabled>Select category name</option>
                               @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ $subcategory?(($subcategory->category_id==$category->id)?'selected':''):''}}>{{__($category->name)}}</option>
                                @endforeach
                            </select>
                            <br>
                            @if ($errors->has('category_id'))
                                <span class="text-danger">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>

                        
                    </div>
                    <div class="form-row">
                        <p class="mb-1">Sub Category Name: </p>
                        <div class="input-group input-group-lg mb-3">
                            <input type="text" name="name"  class="form-control" aria-label="Large"
                                    aria-describedby="inputGroup-sizing-sm" value="{{ $subcategory!=null?$subcategory->name:''}}" placeholder="Full Name" >
                            <br>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 btn-lg my-2">Save Sub Category</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection


@push('scripts')
@include('admin.includes.message')
@endpush