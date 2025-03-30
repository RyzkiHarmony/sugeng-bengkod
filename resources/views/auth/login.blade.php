<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sugeng Hospital</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-hospital text-primary fa-3x mb-3"></i>
                            <h3 class="fw-bold">Sugeng Hospital</h3>
                            <p class="text-muted">Login to access your account</p>
                        </div>

                        <form action="/auth/login" method="POST">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" required
                                        autocomplete="email" autofocus>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <!-- Remember me -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Ingat Saya</label>
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary py-2">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                            </div>

                            <!-- Register and forgot password links -->
                            <div class="text-center">
                                <p class="mb-0">
                                    <a href="/auth/register" class="text-decoration-none">Belum memiliki akun?
                                        Register</a>
                                </p>
                                <p>
                                    <a href="/auth/forgot-password" class="text-decoration-none">Lupa Kata Sandi?</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Back to home link -->
                <div class="text-center mt-3">
                    <a href="/" class="text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Home
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>