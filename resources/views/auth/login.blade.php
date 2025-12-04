<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="min-width:340px;">
            <h3 class="mb-3 text-center">Login</h3>
            <div class="alert alert-info text-center">
                Silakan login sebagai seller melalui halaman berikut:<br>
                <a href="{{ route('seller.login') }}" class="btn btn-primary mt-3">Seller Login</a>
            </div>
        </div>
    </div>
</body>
</html>
