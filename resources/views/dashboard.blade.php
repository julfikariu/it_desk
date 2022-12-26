@extends('layouts.guest')

@section('title', 'Dashboard')

@push('css')
<style type="text/css">
    /*-- your custom css here --*/
</style>
@endpush


@section('content')

<section class="hm-banner">
    <div class="container">
        <div class="col text-center mb-5">
            <h2>Dashboard</h2>
        </div>
    </div>
</section>
<section class="contact-details pb-70">
    <div class="container py-4">
        <div class="row">
            <div class="col-12 section-content px-3">
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
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3 col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src=" {{ asset('upload/frontend/profile/' . ($user->profile_photo_path ?? 'avatar.jpg')) }}" alt="User" class="rounded-circle"
                                        width="150">
                                    <div class="mt-3 mb-3">
                                        <h4>{{ $user->name}}</h4>
                                    </div>
                                </div>
                                <div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0">Name</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            {{ $user->name}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-8 text-secondary">
                                            {{ $user->email}}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="{{ route('user.profile') }}" class="btn btn-info btn-block" >Edit Profile</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-8 col-sm-12 pl-0 col-sm-8">
                        <h2>My Tickets</h2>
                        <div class="table-responsive-sm">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Subject</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($myTickets as $myTicket)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $myTicket->subject  }}</td>
                                        <td>{{ $myTicket->category_id }}</td>
                                        <td>{{ $myTicket->status }} </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('user.ticket.show', $myTicket->id) }}" class="btn btn-sm btn btn-primary mr-2">View</a>
                                                {{--<form action="{{ route('user.ticket.destroy', $myTicket->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="delete">
                                                    <button type="submit" class="btn btn-sm btn btn-danger">Delete</button>
                                                </form>--}}

                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                    </div>
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
