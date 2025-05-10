<?php
session_start();

include ('../includes/db.php');

$error = "";
$success = "";
$username = "";
$email = "";
$full_name = "";

if (isset($_POST['register_submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $full_name = trim($_POST['full_name']);
    $role = 'editor';

    // Kiểm tra dữ liệu rỗng
    if (empty($username) || empty($password) || empty($email)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ.";
    } else {
        // Kiểm tra tài khoản trùng lặp
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $stmt_check->bindParam(':username', $username);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            $error = "Tên đăng nhập hoặc email đã tồn tại.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt_insert = $pdo->prepare("INSERT INTO users (username, password, email, full_name, role) 
                                           VALUES (:username, :password, :email, :full_name, :role)");
            $stmt_insert->bindParam(':username', $username);
            $stmt_insert->bindParam(':password', $hashed_password);
            $stmt_insert->bindParam(':email', $email);
            $stmt_insert->bindParam(':full_name', $full_name);
            $stmt_insert->bindParam(':role', $role);

            if ($stmt_insert->execute()) {
                $_SESSION['user_id'] = $pdo->lastInsertId(); // Lưu user_id
                $_SESSION['username'] = $username;
                header("Location: /cutonama3/user");
                exit();
            } else {
                $error = "Lỗi khi đăng ký tài khoản.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
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
                <h2 class="text-center mb-4">Đăng ký tài khoản</h2>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" 
                               value="<?php echo htmlspecialchars($username); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" 
                               value="<?php echo htmlspecialchars($full_name); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="register_submit">Đăng ký</button>
                    <div class="mt-3 text-center">
                        Đã có tài khoản? <a href="login.php">Đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
