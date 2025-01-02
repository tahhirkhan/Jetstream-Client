<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post Form</title>
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
                        <h3 class="text-center mb-0">Create New Blog Post</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/create-blog" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="blogTitle" class="form-label">Blog Title</label>
                                <input name="title" type="text" class="form-control" id="blogTitle" placeholder="Enter blog title" required value="{{ old('title') }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="blogBody" class="form-label">Blog Content</label>
                                <textarea name="body" class="form-control" id="blogBody" rows="6" placeholder="Write your blog content here" required value="{{ old('body') }}"></textarea>
                                @error('body')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="blogImage" class="form-label">Blog Image</label>
                                <input name="blogImg" type="file" class="form-control" id="blogImage" accept="image/*">
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Publish Post</button>
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
