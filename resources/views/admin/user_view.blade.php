@extends('layouts.admin_main')

@section('content')

    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Overview
                </div>
                <h2 class="page-title">
                  User's Information
                </h2>
            </div>
            <!-- Page title actions -->

        </div>
        <div class="row row-cards">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">UserName</label>
                            <input type="text" class="form-control" name="username" value="{{$user_data->detail->username}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email"
                                   value="{{$user_data->detail->email}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="password"
                                   value="{{$user_data->detail->password}}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Joined</label>
                            <input type="text" class="form-control" name="joineddate"
                                   value="{{  date("M, d Y", strtotime($user_data->detail->created_at)) }}" disabled>
                        </div>


                    </div>
                </div>
                @if($user_data->deleted == 0)
                <div class="col-lg-12 mt-2">
                    <a href="{{route('user_edit', ['id' => $user_data->id,'action' => 1])}}" class="btn btn-danger w-100">
                        Delete
                    </a>
                </div>
                @else
                    <div class="col-lg-12 mt-2">
                        <a href="{{route('user_edit', ['id' => $user_data->id,'action' => 0])}}" class="btn btn-success w-100">
                            Restore
                        </a>
                    </div>

                @endif


            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
