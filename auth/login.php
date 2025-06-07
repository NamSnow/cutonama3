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

include ('../includes/db.php'); // Ensure this path is correct for your project

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
    <title>Đăng nhập - Trang Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Optional: A subtle background pattern or gradient for added visual interest */
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
        }
    </style>
</head>
<body class="font-sans antialiased flex items-center justify-center min-h-screen text-gray-800">
    <div class="bg-white p-8 md:p-10 rounded-lg shadow-2xl w-full max-w-md transform hover:scale-105 transition-all duration-300 ease-in-out">
        <h2 class="text-3xl font-extrabold text-center text-blue-600 mb-6">Đăng nhập</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Lỗi!</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-5">
                <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Tên đăng nhập</label>
                <input
                    type="text"
                    class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    id="username"
                    name="username"
                    placeholder="Nhập tên đăng nhập của bạn"
                    required
                >
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Mật khẩu</label>
                <input
                    type="password"
                    class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 mb-3 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                    id="password"
                    name="password"
                    placeholder="Nhập mật khẩu của bạn"
                    required
                >
            </div>
            <button
                type="submit"
                name="login_submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition duration-300 transform hover:-translate-y-0.5 shadow-md"
            >
                Đăng nhập
            </button>
            <div class="mt-6 text-center text-gray-600">
                Chưa có tài khoản?
                <a href="register.php" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-200">Đăng ký ngay</a>
            </div>
        </form>
    </div>
</body>
</html>