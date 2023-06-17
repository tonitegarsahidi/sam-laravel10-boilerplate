<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hello, World!</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .jumbotron .row {
      display: flex;
      align-items: center;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">My Website</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{route("login")}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route("register")}}">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="https://images.unsplash.com/photo-1648518295678-f78670c35924?w=640" alt="Random Image" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
          <h1 class="display-4 text-right">Hello, World!</h1>
          <p class="text-right">Sure you can modify me as you wants</p>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer bg-dark text-light text-center py-3">
    <div class="container">
      <div class="row">
        <div class="col-12 text-light">
            Sam Laravel 10 Boilerplate - are created by SamToni
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
