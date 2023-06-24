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

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <fieldset>
                                <legend>Facebook Token</legend>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="{{Auth::user()->token ??''}}" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="{{route('facebook')}}" class="btn btn-info px-4 " title="click"> <i class="fa fa-key" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control facebook_page_id" name="facebook_page_id" placeholder="facebook_page_id" value="{{Auth::user()->facebook_page_id ??''}}" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:void(0)" class="btn btn-info px-4 store_page_id" title="click"><i class="fa fa-upload" aria-hidden="true"></i> <samp class="submitspinnerpage"></samp></a>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pagename" placeholder="Facebook Page Name" value="{{Auth::user()->pagename ??''}}" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:void(0)" class="btn btn-info px-4" title="click"><i class="fa fa-upload" aria-hidden="true"></i> <samp class=""></samp></a>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pagecategory" placeholder="pagecategory" value="{{Auth::user()->pagecategory ??''}}" readonly>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:void(0)" class="btn btn-info px-4" title="click"><i class="fa fa-upload" aria-hidden="true"></i> <samp class=""></samp></a>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control companyname" name="companyname" placeholder="Enter Company Name"  value="{{Auth::user()->companyname ??''}}">

                                    </div>
                                    <div class="col-sm-2">
                                        <a href="javascript:void(0)" class="btn btn-info px-4 storecompanyname" title="click"><i class="fa fa-upload" aria-hidden="true"></i> <samp class="submitspinnerpage"></samp></a>

                                    </div>
                                </div>

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
                            location.reload();
                        },
                    });
                });



                $('body').on('click', '.storecompanyname', function(e) {
                    var data = $('.companyname').val();
                    $.ajax({
                        url: '{{route("companyname")}}',
                        data: {companyname:data},
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
