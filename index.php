<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang tin tức - Cao đẳng Bách khoa Việt Nam</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Optional: Custom gradient background for a modern touch */
        body {
            background: linear-gradient(to right, #ece9e6, #ffffff);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 flex items-center justify-center min-h-screen">
    <div class="max-w-xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden p-8 transform hover:scale-105 transition-all duration-300 ease-in-out">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold text-blue-600 mb-3 leading-tight">
                Chào mừng đến với
                <br>
                <span class="text-green-500">Project Trang Tin Tức</span>
            </h1>
            <p class="text-xl text-gray-600">
                của Trường Cao đẳng Bách khoa Việt Nam
            </p>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-3 border-b-2 border-gray-200 pb-2">Thành viên thực hiện:</h2>
            <ul class="list-none space-y-2 text-lg text-gray-700">
                <li class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Phạm Hoài Nam
                </li>
                <li class="flex items-center">
                    <svg class="w-5 h-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Nguyễn Danh Lưu
                </li>
            </ul>
        </div>

        <p class="text-center text-xl text-gray-700 mb-6">Bạn muốn bắt đầu như thế nào?</p>

        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <a href="/cutonama3/auth/login.php" class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                Đăng nhập
            </a>
            <a href="/cutonama3/auth/register.php" class="flex-1 text-center bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg">
                Đăng ký
            </a>
        </div>
    </div>
</body>
</html>