<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  
  <x-my-navbar>

  </x-my-navbar>

    <div class="container d-flex justify-content-center">
        <div class="card border border-pr" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Name: {{ $profileData['name'] }}</h5>
                <h5 class="card-title mb-2">Email: {{ $profileData['email'] }}</h5>
                <!-- <p class="card-text">Some additional information or a short bio</p> -->
            </div>
        </div>
        @error('message')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>