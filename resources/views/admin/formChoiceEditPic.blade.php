@extends('layouts.app')

@section('content')
<style>
    .image-preview {
        width: 200px;
        height: 200px;
        border: 1px solid #dddddd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc;
    }
    .image-preview__image {
        display: none;
        width: 100%;
        height: 100%;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">เพิ่มภาพข้อตรวจ</div>

                <div class="card-body">
                   
                    <form action="{{route('admin_ChoiceUpdatePic',['id'=>request()->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @foreach ($ChoiceEdit as $item)
                        <p>หมวดหมู่ :: {{$item->category_name}}</p>
                        <input type="hidden" name="cate_id" value="{{$item->category_id}}">
                        <div class="mb-3">
                          <label for="choiceEdit" class="form-label">ข้อตรวจ : {{$item->form_choice}}</label>                                      
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">รูปภาพประจำข้อตรวจ</label>
                            <input class="form-control form-control-sm" id="imageUpload" type="file" name="img_choice" accept="image/*">
                          </div>
                          <hr>
                       
                          <div class="image-preview" id="imagePreview">
                            <img src="" alt="Image Preview" class="image-preview__image">
                            <span class="image-preview__default-text">Image Preview</span>
                        </div>
                        <hr>
                        @endforeach
                        <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                      </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewImage = imagePreview.querySelector('.image-preview__image');
    const imagePreviewDefaultText = imagePreview.querySelector('.image-preview__default-text');

    imageUpload.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                imagePreviewDefaultText.style.display = "none";
                imagePreviewImage.style.display = "block";
                imagePreviewImage.setAttribute('src', this.result);
            });

            reader.readAsDataURL(file);
        } else {
            imagePreviewDefaultText.style.display = null;
            imagePreviewImage.style.display = null;
            imagePreviewImage.setAttribute('src', '');
        }
    });
</script>
@endsection
