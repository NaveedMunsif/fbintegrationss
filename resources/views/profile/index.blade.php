@extends('layouts.main')

@section('content')
<style>
fieldset {
    line-height: 16px;
    padding: 0 10px;
    border: 1px solid #e0e0e0;
    background-color: rgb(232 232 232 / 30%);
    margin: 5px;
}
legend {
    background-color: #fff;
    width:inherit;
    padding:0 10px;
    border-bottom:none;
    border: 1px solid #e0e0e0;
    padding: 10px;
}
</style>
    <div class="container">
        <div class="main-body">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                @if(auth()->user()->image_name != null)

                                    <img src="{{asset(auth()->user()->image_name ??'')}}" alt="Admin" class="rounded-circle p-1 bg-danger" width="110">
                                @else
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                         class="rounded-circle p-1 bg-danger" width="110">
                                @endif
                                <div class="mt-3">
                                    <h4>{{ auth()->user()->name ??''}}</h4>
                                    <p class="text-secondary mb-1">{{ auth()->user()->email ??''}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <fieldset>
                                <legend>Profile</legend>
                                <form action="{{route('profile.store')}}" class="formsubmit" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6>Name</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" required value="{{Auth::user()->name??''}}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email ??''}}" required readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Profile Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <button type="submit" class="btn btn-primary px-4">Save Changes <span class="submitspinner"></span></button>
                                        </div>
                                    </div>

                                </form>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('script')
    <script>
        $( document ).ready(function() {
            $('body').on('submit', '.formsubmit', function(e) {
                e.preventDefault();
                $.ajax({
                    url:$(this).attr('action'),
                    data:new FormData(this),
                    type:'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('.submitspinner').html('<i class="fa fa-spinner fa-spin"></i>')
                    },
                    success: function (data) {
                    $('.submitspinner').html('');
                    if (data.status==200) {
                        $.confirm({
                            title: 'Success!',
                            content: data.msg,
                            autoClose: 'cancelAction|3000',
                            buttons: {
                                cancelAction: function (e) {}
                            }
                        });
                    }
                    if (data.status==400) {
                        $.alert({
                            title: 'Success!',
                            content: data.msg,
                        });
                    }
                        location.reload();
                    },
                })
            });

            $('body').on('click', '.store_page_id', function(e) {
                var data = $('.facebook_page_id').val();
                $.ajax({
                url: '{{route("facebook_page_id")}}',
                data: {facebook_page_id:data},
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    $('.submitspinnerpage').html('<i class="fa fa-spinner fa-spin"></i>')
                },
                success: function (data) {
                    $('.submitspinnerpage').html('');
                    if (data.status == 200) {
                        $.confirm({
                            title: 'Success!',
                            content: data.msg,
                            autoClose: 'cancelAction|3000',
                            buttons: {
                                cancelAction: function (e) {}
                            }
                        });
                    }
                    if (data.status == 400) {
                        $.alert({
                            title: 'Alert!',
                            content: data.msg,
                        });
                    }
                },
            });
            });
        });
    </script>

    @endpush
@endsection
