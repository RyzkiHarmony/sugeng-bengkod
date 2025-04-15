<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sugeng - Hospital Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Hero Section -->
    <div class="bg-primary text-white py-5">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-lg-8 mx-auto text-center py-5">
                    <i class="fas fa-hospital fa-3x mb-4"></i>
                    <h1 class="display-4 fw-bold mb-4">Sugeng</h1>
                    <p>Policlinics Management System</p>

                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="/auth/login" class="btn btn-light btn-lg px-4 me-md-2">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                        <a href="/auth/register" class="btn btn-outline-light btn-lg px-4">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-primary text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5>Sugeng</h5>
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>