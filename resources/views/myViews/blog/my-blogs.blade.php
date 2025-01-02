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
        <h3 class="text-center mb-4">My Blog Posts</h3>
        
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @if (!empty($blogs))
                @foreach ($blogs as $blog)
                    <div class="col">
                        <div class="card h-100">
                            <!-- <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Blog post image"> -->
                             @if ($blog['blog_image'] == null)
                             <img src="https://via.placeholder.com/350x200" class="card-img-top" style="height: 15rem; object-fit: cover;" alt="Blog post image">
                             @else
                             <img src="images/{{ $blog['blog_image'] }}" class="card-img-top" style="height: 15rem; object-fit: cover;" alt="Blog post image">
                             @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog['title'] }}</h5>
                                <p class="card-text text-truncate">{{ $blog['body'] }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- <small class="text-muted">Posted 3 days ago</small> -->
                                    <a href="/view-blog/{{$blog['id']}}" class="btn btn-primary">View Post</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h5 class="card-title text-center text-muted">No Blog Posts Found!</h5>
            @endif 
        </div>
        @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
