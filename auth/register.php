<?php
session_start();

include ('../includes/db.php'); // Ensure this path is correct for your project

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
    $role = 'editor'; // Default role for new registrations

    // Input validation
    if (empty($username) || empty($password) || empty($email)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email không hợp lệ.";
    } else {
        // Check for duplicate username or email
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $stmt_check->bindParam(':username', $username);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();
        $count = $stmt_check->fetchColumn();

        if ($count > 0) {
            $error = "Tên đăng nhập hoặc email đã tồn tại.";
        } else {
            // Hash password and insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt_insert = $pdo->prepare("INSERT INTO users (username, password, email, full_name, role)
                                           VALUES (:username, :password, :email, :full_name, :role)");
            $stmt_insert->bindParam(':username', $username);
            $stmt_insert->bindParam(':password', $hashed_password);
            $stmt_insert->bindParam(':email', $email);
            $stmt_insert->bindParam(':full_name', $full_name);
            $stmt_insert->bindParam(':role', $role);

            if ($stmt_insert->execute()) {
                // Log in the user automatically after successful registration
                $_SESSION['user_id'] = $pdo->lastInsertId(); // Get the ID of the newly inserted user
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role; // Set the role in session as well
                header("Location: /cutonama3/user"); // Redirect to user dashboard or main page
                exit();
            } else {
                $error = "Lỗi khi đăng ký tài khoản. Vui lòng thử lại.";
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
    <title>Đăng ký tài khoản - Trang Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Optional: A subtle background pattern or gradient for added visual interest, consistent with login */
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #d9e2ec 100%);
        }
    </style>
</head>
<body class="font-sans antialiased flex items-center justify-center min-h-screen text-gray-800 py-10">
    <div class="bg-white p-8 md:p-10 rounded-lg shadow-2xl w-full max-w-md transform hover:scale-105 transition-all duration-300 ease-in-out">
        <h2 class="text-3xl font-extrabold text-center text-green-600 mb-6">Đăng ký tài khoản</h2>

        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Lỗi!</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>
        <?php if ($success): // Although direct redirect is used for success, keep this for potential future changes ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Thành công!</strong>
                <span class="block sm:inline"><?php echo htmlspecialchars($success); ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-5">
                <label for="username" class="block text-gray-700 text-sm font-semibold mb-2">Tên đăng nhập</label>
                <input
                    type="text"
                    class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                    id="username"
                    name="username"
                    placeholder="Chọn tên đăng nhập của bạn"
                    value="<?php echo htmlspecialchars($username); ?>"
                    required
                >
            </div>
            <div class="mb-5">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Mật khẩu</label>
                <input
                    type="password"
                    class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                    id="password"
                    name="password"
                    placeholder="Tạo mật khẩu mạnh"
                    required
                >
            </div>
            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input
                    type="email"
                    class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                    id="email"
                    name="email"
                    placeholder="Nhập địa chỉ email của bạn"
                    value="<?php echo htmlspecialchars($email); ?>"
                    required
                >
            </div>
            <div class="mb-6">
                <label for="full_name" class="block text-gray-700 text-sm font-semibold mb-2">Họ và tên (Tùy chọn)</label>
                <input
                    type="text"
                    class="shadow-sm appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                    id="full_name"
                    name="full_name"
                    placeholder="Ví dụ: Nguyễn Văn A"
                    value="<?php echo htmlspecialchars($full_name); ?>"
                >
            </div>
            <button
                type="submit"
                name="register_submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75 transition duration-300 transform hover:-translate-y-0.5 shadow-md"
            >
                Đăng ký
            </button>
            <div class="mt-6 text-center text-gray-600">
                Đã có tài khoản?
                <a href="login.php" class="text-blue-600 hover:text-blue-800 font-semibold transition duration-200">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
</body>
</html>