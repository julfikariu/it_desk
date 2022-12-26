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
                <form action="{{route('admin.faq.store',$faq!=null?$faq->id:'')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-9">
                            <p class="mb-1">Faq Question: </p>
                                <div class="input-group input-group-lg mb-3">
                                    <input type="text" name="question"  class="form-control" aria-label="Large"
                                           aria-describedby="inputGroup-sizing-sm" value="{{ $faq!=null?$faq->question:''}}" placeholder="Full Name" required>
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
                                                        <input type="checkbox" name="status"  {{ $faq?($faq->status?'checked':''):'checked' }} 
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
                            <p class="mb-1">Faq Answer: </p>
                            <div class="input-group  mb-3">
                                <textarea class="form-control" name="answer" aria-label="With textarea" rows="10" required>{!! $faq?strip_tags($faq->answer):'' !!}</textarea>
                                <br>
                                @if ($errors->has('answer'))
                                    <span class="text-danger">{{ $errors->first('answer') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 btn-lg my-2">Save faq</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection


@push('scripts')
@include('admin.includes.message')
@endpush