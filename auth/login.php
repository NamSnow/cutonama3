<?php
session_start();

// Kiểm tra xem đã đăng nhập chưa để chuyển hướng
if (isset($_SESSION['user_id'])) {
    // Kiểm tra role người dùng
    if ($_SESSION['role'] === 'admin') {
        header("Location: /cutonama3/admin");
    } else {
        header("Location: /cutonama3/user");
    }
    exit();
}

include ('../includes/db.php');

$error = "";

if (isset($_POST['login_submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Vui lòng điền đầy đủ thông tin đăng nhập.";
    } else {
        $stmt = $pdo->prepare("SELECT user_id, username, password, role FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Lưu thông tin người dùng vào session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Kiểm tra và chuyển hướng dựa trên role
            if ($user['role'] === 'admin') {
                header("Location: /cutonama3/admin"); // Đường dẫn trang admin
            } else {
                header("Location: /cutonama3/user"); // Đường dẫn trang chính cho user thường
            }
            exit();
        } else {
            $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4">Đăng nhập</h2>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="login_submit">Đăng nhập</button>
                        <div class="mt-3 text-center">
                            Chưa có tài khoản? <a href="register.php">Đăng ký</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
