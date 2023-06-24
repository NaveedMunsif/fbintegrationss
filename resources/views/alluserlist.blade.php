

@extends('layouts.main')

@section('content')

    <div class="col-12">
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

                                <button type="button" class="btn btn-white" data-toggle="modal" data-target="#exampleModal-{{$key}}">
                                Edit
                                </button>

                            <div class="modal fade" id="exampleModal-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">{{$user->name}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="" action="{{route('pagecategory')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="currentuserid" value="{{$user->id}}">
                                                <div class="form-group">
                                                    <label>Page Name</label>
                                                    <input type="text" class="form-control" name="pagecategory" id="pagecategory" value="{{$user->pagename}}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Page Category</label>
                                                    <input type="text" class="form-control" name="pagecategory" id="pagecategory" value="{{$user->pagecategory}}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <img src="{{asset($user->fbphoto ??'')}}" alt="" class="" width="300px" style="display: block;margin: auto">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit <samp class="spinner"></samp></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>





















                            {{--<div class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                                    Actions
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">
                                        Action
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Another action
                                    </a>
                                </div>
                            </div>--}}
                        </div>
                    </td>
                </tr>

                </tbody>
                @endforeach
            </table>


            <!-- Button trigger modal -->

            <!-- Modal -->

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
