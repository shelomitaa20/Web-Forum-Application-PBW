{{-- resources/views/forum/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="content">New Post</label>
                            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="images">Upload Images</label>
                            <div id="image-upload-container">
                                <input type="file" name="images[]" class="form-control mb-2" onchange="handleFiles(this.files)" accept="image/*">
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" onclick="addImageUploadField()">Add Another Image</button>
                            <div id="preview" class="mt-2"></div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let uploadCount = 1;

    //
    function addImageUploadField() {
        if (uploadCount >= 4) {
            alert('You can only upload a maximum of 4 images');
            return;
        }

        uploadCount++;

        const container = document.getElementById('image-upload-container');
        const input = document.createElement('input');
        input.type = 'file';
        input.name = 'images[]';
        input.className = 'form-control mb-2';
        input.accept = 'image/*';
        input.onchange = function() {
            handleFiles(this.files);
        };
        container.appendChild(input);
    }

    //preview image
    function handleFiles(files) {
        const previewContainer = document.getElementById('preview');
        previewContainer.innerHTML = ''; 

        const allFiles = document.querySelectorAll('input[type="file"][name="images[]"]');
 
        allFiles.forEach(input => {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail', 'mr-2', 'mb-2');
                    img.style.maxHeight = '150px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    }

    function resetUploadFields() {
        const container = document.getElementById('image-upload-container');
        container.innerHTML = '<input type="file" name="images[]" class="form-control mb-2" onchange="handleFiles(this.files)" accept="image/*">';
        document.getElementById('preview').innerHTML = '';
        uploadCount = 1;
    }
</script>
@endsection
