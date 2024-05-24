@extends('admin_layouts.master')

@section('style')
    <!-- Include any additional CSS stylesheets or inline styles -->
@endsection

@section('content')
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Testimonial</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <form method="POST" action="{{ route('testimonials.update', $testimonial->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" class="form-control" value="{{ $testimonial->first_name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" value="{{ $testimonial->last_name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" class="form-control" value="{{ $testimonial->designation }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea name="content" class="form-control">{{ $testimonial->content }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="imageInput" class="form-control" onchange="previewImage(event)">
                                        @if($testimonial->image)
                                            <img id="imagePreview" src="{{ asset('uploads/' . $testimonial->image) }}" alt="" style="height: 100px; width: 100px;">
                                        @else
                                            <img id="imagePreview" src="#" alt="Image Preview" style="display: none; height: 100px; width: 100px;">
                                        @endif
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const imageInput = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }

        reader.readAsDataURL(imageInput);
    }
    </script>
@endsection
