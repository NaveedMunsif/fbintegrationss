
@extends('layouts.admin_main')

@section('content')

        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="{{$userdata->fbphoto}}" alt="Food Deliver UI dashboards" class="rounded">
                                </div>
                                <div class="col">
                                    <h3 class="card-title mb-1">
                                        <a href="" class="text-reset">Facebook Profile</a>
                                    </h3>
                                    <div class="text-muted">
                                        {{$userdata->fbname}}
                                    </div>
                                </div>
                            </div>


                                        <div class="card-title">Basic info</div>
                                        <div class="mb-2">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/book -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><line x1="3" y1="6" x2="3" y2="19" /><line x1="12" y1="6" x2="12" y2="19" /><line x1="21" y1="6" x2="21" y2="19" /></svg>
                                            Email: <strong>{{$userdata->fbemail}}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/briefcase -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="7" width="18" height="13" rx="2" /><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><line x1="12" y1="12" x2="12" y2="12.01" /><path d="M3 13a20 20 0 0 0 18 0" /></svg>
                                            Page Name: <strong>{{$userdata->pagename}}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                            Page Category: <strong>{{$userdata->pagecategory}}</strong>
                                        </div>
                                        <div class="mb-2">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/map-pin -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="11" r="3" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                                            Compnay Name: <strong>
                                                {{$userdata->companyname}}</strong>
                                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <img src="{{asset($userdata->image_name)}}" alt="Food Deliver UI dashboards" class="rounded">
                                </div>
                                <div class="col">
                                    <h3 class="card-title mb-1">
                                        <a href="" class="text-reset">Seology Profile</a>
                                    </h3>
                                    <div class="text-muted">
                                        {{$userdata->name}}
                                    </div>
                                </div>
                            </div>


                            <div class="card-title">Basic info</div>
                            <div class="mb-2">
                                <!-- Download SVG icon from http://tabler-icons.io/i/book -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" /><line x1="3" y1="6" x2="3" y2="19" /><line x1="12" y1="6" x2="12" y2="19" /><line x1="21" y1="6" x2="21" y2="19" /></svg>
                                Email: <strong>{{$userdata->email}}</strong>
                            </div>
                            <div class="mb-2">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                Company Name: <strong>{{$userdata->companyname}}</strong>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cards">
            <div class="col-12">
                <div class="bg-light clearfix" style="padding: 10px">

                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">Add New Notes</button>


                    <!-- Button trigger modal -->


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New Note</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form  action="{{route('addnote')}}" method="get">

                                        <label>Title </label>
                                        <input type="text" class="card-title col-md-12" name="notetitle">

                                        <label>Text </label>
                                        <textarea name="notetext" class="col-md-12" style="height: 10rem;" ></textarea>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">


                    @foreach($allnotes  as $key => $note )
                        <div class="col-4" style="margin-bottom: 5px">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">{{$note->notetitle}}</h3>
                                    <p>{{$note->notetext}}</p>
                                </div>
                                <!-- Card footer -->
                                <div class="card-footer">
                                    <div class="d-flex">
                                        <a href='delete/{{$note->id}}' class="btn btn-primary ms-auto">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
            </div>






        </div>


@endsection
