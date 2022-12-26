@extends('admin.layouts.master')

@section('title', $title)

@push('css')
<link rel="stylesheet" href="{{ asset('backend/assets/css/page-form.css') }}">
<link rel="stylesheet" href="{{asset('frontend/css/tagin.min.css')}}" />
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
                <form action="{{route('admin.knowledge.store',$knowledge?$knowledge->id:'')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-9">
                            <p class="mb-1">Knowledge title: </p>
                                <div class="input-group input-group-lg mb-3">
                                    <input type="text" name="title"  class="form-control" aria-label="Large"
                                           aria-describedby="inputGroup-sizing-sm" value="{{ $knowledge!=null?$knowledge->title:''}}" placeholder="Knowledge title" required>
                                    <br>
                                    @if ($errors->has('question'))
                                        <span class="text-danger">{{ $errors->first('question') }}</span>
                                    @endif
                                </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-row mb-3">
                                <div class="col-12">
                                    <table class="table table-responsive-sm">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label for="programStatus">
                                                        <span class="card-title">Publish status</span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="switch float-left">
                                                        <input type="checkbox" name="status"  {{ $knowledge?($knowledge->status?'checked':''):'checked' }} 
                                                            id="programStatus">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-md-9">
                            <p class="mb-1">{{__('Category Name:')}} </p>
                            <div class="input-group input-group-lg mb-3">
                                <select id="knowledge_category"  class="form-control form-control-lg" name="category_id">
                                    <option  value="" selected disabled>Select category name</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ $knowledge?(($knowledge->subcategory->category->id==$category->id)?'selected':''):''}}>{{__($category->name)}}</option>
                                    @endforeach
                                </select>
                                <br>
                                @if ($errors->has('category_id'))
                                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-9">
                            <p class="mb-1">{{__('Sub Category Name:')}} </p>
                            <div class="input-group input-group-lg mb-3">
                                <select id="knowledge_subcategories_id" class="form-control form-control-lg" name="sub_categories_id">
                                    <option value="" selected disabled>Select category name</option>
                                    @if($knowledge)
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" {{ $knowledge?(($knowledge->sub_categories_id==$subcategory->id)?'selected':''):''}}>{{__($subcategory->name)}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <br>
                                @if ($errors->has('sub_categories_id'))
                                    <span class="text-danger">{{ $errors->first('sub_categories_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="pageContent">
                                    <span class="d-block card-title mb-1">Description</span>
                                    @error('page_content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                    @enderror
                                </label>
                                <textarea name="description" id="summernote"class="form-control">{!! __(html_entity_decode($knowledge? $knowledge->description:'')) !!}</textarea>
                                <br>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <p class="mb-1">Knowledge Tags: </p>
                            <code class="small">Write tags separated by comma</code>
                            <div class="input-group input-group-lg mb-3">
                               {{--  @php 
                                   $tags = explode(',',$knowledge->tags);
                                @endphp --}}
                                <input type="text" name="tags" id="tags" class="form-control tagin" placeholder="Tags separated by comma" value="{{ $knowledge?$knowledge->tags:''}}" required>
                                @if ($errors->has('tags'))
                                <br><span class="text-danger">{{ $errors->first('tags') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">

                    <button type="submit" class="btn btn-danger w-100 btn-lg my-2">Save Knowledge</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection


@push('scripts')
<script src="{{ asset('backend/assets/js/form-summerNote.js') }}"></script>
<script src="{{ asset('frontend/js/tagin.min.js') }}"></script>
<script>
// Your custom JavaScript here...
for (const el of document.querySelectorAll('.tagin')) {
      tagin(el)
    }
</script>
<script src="{{asset('backend/assets/js/get-knowledge-subcategory.js')}}"></script>
@include('admin.includes.message')
@endpush