<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <x-my-navbar>

    </x-my-navbar>

    <div class="container mt-5">
        <!-- Author and Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <!-- <img src="/api/placeholder/40/40" alt="Author Avatar" class="rounded-circle me-2"> -->
                <div>
                    <h6 class="mb-0">{{ $blog_author }}</h6>
                    <small class="text-muted">Posted on {{ \Carbon\Carbon::parse($blog['created_at'] )->format('d M, Y') }}</small>
                </div>
            </div>
            <div class="d-flex gap-1">
                <a href="/edit-blog/{{ $blog['id'] }}"><button class="btn btn-outline-primary me-2">Edit</button></a>
                <form action="/delete-blog/{{ $blog['id'] }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>

        <!-- Blog Content -->
        <article class="p-4 rounded">
            <!-- Featured Image -->
            @if ($blog['blog_image'] == null)
            <img src="https://via.placeholder.com/350x200" style="height: 20rem; object-fit: cover;" alt="Blog post image" class="img-fluid rounded mb-4 w-100">
            @else
            <img src="/images/{{ $blog['blog_image'] }}" style="height: 20rem; object-fit: cover;" alt="Blog post image" class="img-fluid rounded mb-4 w-100">
            @endif
            <!-- <img src="https://via.placeholder.com/250x150" style="height: 20rem; object-fit: cover;" alt="Blog Featured Image" class="img-fluid rounded mb-4 w-100"> -->
            
            <h1 class="display-4 mb-4">{{ $blog['title'] }}</h1>
            <div class="lead mb-4">
                <p>{{ $blog['body'] }}</p>
            </div>
        </article>
        @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>