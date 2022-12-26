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
                <h2 class="how_can_help font_style_normal">Ticket</h2>
            </div>

        </div>
    </section>
    <section class=" pb-70">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-12 col-sm-12 section-content">


                    <div class="card bg-light shadow">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col-lg-6 d-flex justify-content-start">
                                    <div class=""><a href="{{ route('dashboard') }}"><i class="fa fa-arrow-left h6"></i></a></div>

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
                                        <form action="{{route('user.ticketReply.store')}}" method="POST">
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
