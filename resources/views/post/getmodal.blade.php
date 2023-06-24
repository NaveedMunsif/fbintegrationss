<style>
    .ModelImage {
        max-width: 30%;
    }
</style>


<form class="formsubmit" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($data) && !empty($data->id))
        <input type="hidden" name="id" value="{{ encrypt($data->id) }}">
    @endif
    <div class="form-group">
        <label>Post Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name ?? '' }}" required>
    </div>
    <div class="form-group">
        <label>Post Text</label>
        <textarea class="form-control" name="message" id="message" cols="" rows="5"
            required>{{ $data->message ?? '' }}</textarea>
    </div>
    <div class="form-group row">
        &nbsp;&nbsp; Post Image
        <div class="col-md-12">
            <div class="" style="margin: 2px;">
                <div class="avatar-edit">
                    @if (isset($data) && !empty($data->image))
                        <img src="{{asset("images/".$data->image)}}" class="ModelImage">
                    @else

                    <input type="file" name="image"  onChange="img_pathUrl(this);" id="image" required/>
                    <img class="ModelImage" src="" id="img_url" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn me-auto model-close" data-bs-dismiss="modal">Close</button>

        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Submit <samp class="spinner"></samp></button>
    </div>

</form>

<script>
    function img_pathUrl(input){
        $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }

</script>
