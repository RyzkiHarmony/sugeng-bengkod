<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sugeng Hospital</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-hospital text-primary fa-3x mb-3"></i>
                            <h3 class="fw-bold">Sugeng Hospital</h3>
                            <p class="text-muted">Create your account</p>
                        </div>

                        <form action="/auth/register" method="POST">
                            <!-- CSRF Token -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" class="form-control" id="nama" name="nama" required autofocus>
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">Nomor Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email" required>
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

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" required>
                                </div>
                            </div>

                            <!-- Submit button -->
                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn btn-primary py-2">
                                    <i class="fas fa-user-plus me-2"></i>Register
                                </button>
                            </div>

                            <!-- Login link -->
                            <div class="text-center">
                                <p class="mb-0">
                                    <a href="/auth/login" class="text-decoration-none">Sudah punya akun?
                                        Login</a>
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