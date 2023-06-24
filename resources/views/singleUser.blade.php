


@extends('layouts.main')

@section('content')


<div class="col-12">
    <div class="card">
        <div class="row row-0">
            <div class="col-3">
                <img src="{{$user->fbphoto}}" class="w-100 h-100 object-cover" alt="Card side image">
            </div>
            <div class="col">
                <div class="card-body">
                    <h3 class="card-title"> {{$user->name}}</h3>


                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt, iste, itaque minima
                        neque pariatur perferendis sed suscipit velit vitae voluptatem.</p>





                </div>
            </div>
        </div>
    </div>
</div>

@endsection
