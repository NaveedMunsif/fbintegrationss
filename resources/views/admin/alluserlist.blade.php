

@extends('layouts.admin_main')
@section('content')

    <div class="col-12">
        <div class="row g-2 align-items-center mb-4">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dashboard
                </div>
                <h2 class="page-title">
                   All Users
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-simple">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Create new user
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form method="post" action="{{route('add_new_user')}}">
                        @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">


                            <div class="col-md-6 col-xl-12">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="username" placeholder="Input name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Input email">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Input password">
                                </div>

                                <div class="mb-3">
                                    <div class="form-label">Admin</div>
                                    <div>
                                        <label class="form-check">
                                            <input type="hidden" class="form-check-input" name="admin" value="0">
                                            <input class="form-check-input" name="admin" value="1" type="checkbox">
                                            <span class="form-check-label">Make it Admin</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <div class="card">
        <div class="table-responsive">
            <table
                class="table table-vcenter table-mobile-md card-table">
                <thead>
                <tr>
                    <td colspan="9" class="text-right">
                        <div class="ms-auto text-muted">

                            <div class="ms-2 d-inline-block">
                                Search:
                                <input type="text"  id="myInput" class="form-control form-control-sm" aria-label="Search invoice">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Page</th>
                    <th>Company</th>
                    <th class="w-1">
                    Action
                    </th>
                </tr>
                </thead>
                @foreach($alluserdata  as $key =>  $user)
                <tbody id="myTable">
                <tr>
                    <td data-label="Name" >
                        <div class="d-flex py-1 align-items-center">
                            <span class="avatar me-2" style="background-image: url({{$user->fbphoto}})"></span>
                                <a href='userprofiles/{{$user->id}}' >
                                    <div class="flex-fill">
                                        <div class="font-weight-medium">{{$user->name}}</div>
                                        <div class="text-muted"><a href="#" class="text-reset">{{$user->email}}</a></div>
                                    </div>
                                </a>
                        </div>
                    </td>
                    <td data-label="Title" >
                        <div>{{$user->pagename}}</div>
                        <div class="text-muted">{{$user->pagecategory}}</div>
                    </td>
                    <td class="text-muted" data-label="Role" >
                        {{$user->companyname}}
                    </td>
                    <td>
                        <div class="btn-list flex-nowrap">

                            <a type="button" class="btn btn-white" href="{{ route('user_view',['user' => $user->id]) }}">
                                Edit
                            </a>
                        </div>
                    </td>
{{--                    <td>--}}
{{--                        <div class="btn-list flex-nowrap">--}}

{{--                                <button type="button" class="btn btn-white" data-toggle="modal" data-target="#exampleModal-{{$key}}">--}}
{{--                                Edit--}}
{{--                                </button>--}}

{{--                            <div class="modal fade" id="exampleModal-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--                                <div class="modal-dialog" role="document">--}}
{{--                                    <div class="modal-content">--}}
{{--                                        <div class="modal-header">--}}
{{--                                            <h5 class="modal-title" id="exampleModalLabel">{{$user->name}}</h5>--}}
{{--                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                                <span aria-hidden="true">&times;</span>--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                        <div class="modal-body">--}}
{{--                                            <form class="" action="{{route('pagecategory')}}" method="POST" enctype="multipart/form-data">--}}
{{--                                                @csrf--}}
{{--                                                <input type="hidden" name="currentuserid" value="{{$user->id}}">--}}
{{--                                                <div class="form-group">--}}

{{--                                                    <label>User Name</label>--}}
{{--                                                    <input type="text" class="form-control" name="username" id="pagecategory1" value="{{$user->detail}}" disabled>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Email</label>--}}
{{--                                                    <input type="text" class="form-control" name="email" id="pagecategory2" value="{{$user->detail}}" disabled>--}}
{{--                                                </div>--}}

{{--                                                <div class="form-group">--}}
{{--                                                    <label>Password</label>--}}
{{--                                                    <input type="text" class="form-control" name="password" id="pagecategory3" value="{{$user->detail}}" disabled>--}}
{{--                                                </div>--}}

{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit <samp class="spinner"></samp></button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                            <form class="" action="{{route('pagecategory')}}" method="POST" enctype="multipart/form-data">--}}
{{--                                                @csrf--}}
{{--                                                <input type="hidden" name="currentuserid" value="{{$user->id}}">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Page Name</label>--}}
{{--                                                    <input type="text" class="form-control" name="pagecategory" id="pagecategory" value="{{$user->pagename}}" readonly>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Page Category</label>--}}
{{--                                                    <input type="text" class="form-control" name="pagecategory" id="pagecategory" value="{{$user->pagecategory}}" required>--}}
{{--                                                </div>--}}

{{--                                                <div class="form-group">--}}
{{--                                                    <label>Image</label>--}}
{{--                                                    <img src="{{asset($user->fbphoto ??'')}}" alt="" class="" width="300px" style="display: block;margin: auto">--}}
{{--                                                </div>--}}

{{--                                                <div class="modal-footer">--}}
{{--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit <samp class="spinner"></samp></button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </td>--}}
                </tr>

                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

@endsection
