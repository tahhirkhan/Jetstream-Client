<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Edit Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
    
<body>

    <x-my-navbar>
        
    </x-my-navbar>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center mb-0">Edit Blog Image</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/update-blog-image/{{ $blog['id'] }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                @if ($blog['blog_image'] == null)
                                <img src="https://via.placeholder.com/350x200" style="height: 20rem; object-fit: cover;" alt="Blog post image" class="img-fluid rounded mb-4 w-100">
                                @else
                                <img src="/images/{{ $blog['blog_image'] }}" style="height: 20rem; object-fit: cover;" alt="Blog post image" class="img-fluid rounded mb-4 w-100">
                                @endif
                                
                            </div>
                            
                            <div class="mb-3">
                                <label for="blogImage" class="form-label">Blog Image</label>
                                <input name="blogImg" type="file" class="form-control" id="blogImage" accept="image/*">
                            </div>

                            <!-- <div class="text-center mb-3">
                                <a href="" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">Edit Blog Image</a>
                            </div> -->
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>