@extends('admin.layouts.master')

@section('title', $title)

@push('css')

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
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-start">
                            <div class=""><a href=""><i class="fa fa-arrow-left h6"></i></a></div>
                            <div class="px-3">
                                <a href="javascript:void(0)"><i class="fa fa-user h6"></i></a>
                            </div>
                            <div class="">
                                <a href="" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-flag h6"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Open</a>
                                    <a class="dropdown-item" href="#">Pending</a>
                                    <a class="dropdown-item" href="#">Resolved</a>
                                    <a class="dropdown-item" href="#">Closed</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 d-flex justify-content-end">
                            <div class="">#1</div>
                            <div class="pl-3">
                                <span class="badge badge-success">Open</span>
                            </div>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="row ">
                        <div class="col d-flex justify-content-between align-items-center">
                            <div class="">
                                <p class="h6 pt-2">{{ $ticket->subject }}</p>
                            </div>
                            <div class="">
                                <span>{{ Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}</span>
                                <button class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapseReply" role="button" aria-expanded="false" aria-controls="collapseReply"><i class="fa fa-reply"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr class="my-1">

                    <div class="row ">
                        <div class="col">
                            <div class="collapse" id="collapseReply">
                                <form action="{{route('admin.ticketReply.store')}}" method="POST">
                                    @csrf

                                    <div class="row">
                                        <div class="col">
                                            <div class="">
                                                <textarea name="body"  rows="5" class="p-2 w-100" required></textarea>
                                                <br>
                                                @if ($errors->has('body'))
                                                    <span class="text-danger">{{ $errors->first('body') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id}}">

                                    <button type="submit" class="btn btn-sm btn-primary w-25 btn-lg float-right">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col">
                            <hr class=" bg-light">


                            @forelse($ticket->replies as $reply)
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="">

                                            <img src="{{ $reply->user->user_type=='ADM'?asset('upload/backend/'.($reply->user->profile_photo_path??'mail_blank_avatar.jpg')): asset('upload/frontend/profile/' . ($reply->user->profile_photo_path ?? 'avatar.jpg')) }}" alt="" class="" width="60" height="40">
                                        </div>
                                        <div class="ml-2">
                                            <p class="mb-0 h6">{{ ($reply->user_id==auth()->user()->id)?'You':$reply->user->name }} <sub>Replied</sub></p>
                                            <p class="mb-0 pt-2">{{ $reply->body }}</p>
                                        </div>
                                    </div>
                                    <div class="">
                                        {{  date('M, d, h:i: A', strtotime($reply->created_at)) }}
                                    </div>
                                </div>
                                <hr class=" bg-light">
                            @empty
                                <div class="card">
                                    <div class="card-body">
                                        <div class="alert alert-warning mb-0">No reply Found</div>
                                    </div>
                                </div>
                            @endforelse



                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

@endsection


@push('scripts')
    @include('admin.includes.message')
@endpush