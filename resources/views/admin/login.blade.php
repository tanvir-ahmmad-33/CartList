<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $title }}</title>

    <!-- bootstrap cdn css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <div class="container border-1 vh-100 d-flex justify-content-center align-items-center">
        <div class="row border border-dark rounded w-50">
        <h4 class="pt-3 pb-3 bg-dark text-white">{{ $title}} </h4>
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('admin.authenticate') }}" method="POST" id="adminLoginForm" class="adminLoginForm" name="adminLoginForm">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control border border-dark @error('email') is-invalid @enderror" value="{{ old('email') }}">
                @error('email')
                <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control border border-dark @error('password') is-invalid @enderror">
                @error('password')
                <p class="invalid-feedback"> {{ $message }} </p>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="login-btn btn btn-primary">Login</button>
            </div>
        </form>
        <a href="#" class="forgot-pasword text-decoration-none pb-2">I forgot my password</a>
        </div>
    </div>

    <!-- boostrap cdn js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>