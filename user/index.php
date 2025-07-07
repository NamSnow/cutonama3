<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /cutonama3/auth/login.php"); // Adjust path if needed
    exit();
}

require_once '../includes/db.php';

// Initialize search query variable
$search_query = '';
// Check if a search query was submitted
if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
    $search_query = '%' . $_GET['search_query'] . '%'; // Add wildcards for LIKE search
}

// Base SQL query for latest news
$sqlLatestNews = "SELECT * FROM news WHERE is_published = 1";
if (!empty($search_query)) {
    $sqlLatestNews .= " AND (title LIKE :search_query OR summary LIKE :search_query OR content LIKE :search_query)";
}
$sqlLatestNews .= " ORDER BY created_at DESC LIMIT 6";

$stmtLatestNews = $pdo->prepare($sqlLatestNews);
if (!empty($search_query)) {
    $stmtLatestNews->bindValue(':search_query', $search_query);
}
$stmtLatestNews->execute();
$latestNewsList = $stmtLatestNews->fetchAll(PDO::FETCH_ASSOC);

// Base SQL query for football news
$sqlFootballNews = "SELECT * FROM football_news WHERE is_published = 1";
if (!empty($search_query)) {
    $sqlFootballNews .= " AND (title LIKE :search_query OR summary LIKE :search_query OR content LIKE :search_query)";
}
$sqlFootballNews .= " ORDER BY created_at DESC LIMIT 3";

$stmtFootballNews = $pdo->prepare($sqlFootballNews);
if (!empty($search_query)) {
    $stmtFootballNews->bindValue(':search_query', $search_query);
}
$stmtFootballNews->execute();
$footballNewsList = $stmtFootballNews->fetchAll(PDO::FETCH_ASSOC);

// Base SQL query for celebrity news
$sqlCelebrityNews = "SELECT * FROM celebrity_news WHERE is_published = 1";
if (!empty($search_query)) {
    $sqlCelebrityNews .= " AND (title LIKE :search_query OR summary LIKE :search_query OR content LIKE :search_query)";
}
$sqlCelebrityNews .= " ORDER BY created_at DESC LIMIT 3";

$stmtCelebrityNews = $pdo->prepare($sqlCelebrityNews);
if (!empty($search_query)) {
    $stmtCelebrityNews->bindValue(':search_query', $search_query);
}
$stmtCelebrityNews->execute();
$celebrityNewsList = $stmtCelebrityNews->fetchAll(PDO::FETCH_ASSOC);

// Base SQL query for game news
$sqlGameNews = "SELECT * FROM game_news WHERE is_published = 1";
if (!empty($search_query)) {
    $sqlGameNews .= " AND (title LIKE :search_query OR summary LIKE :search_query OR content LIKE :search_query OR game_title LIKE :search_query OR platform LIKE :search_query)";
}
$sqlGameNews .= " ORDER BY created_at DESC LIMIT 3";

$stmtGameNews = $pdo->prepare($sqlGameNews);
if (!empty($search_query)) {
    $stmtGameNews->bindValue(':search_query', $search_query);
}
$stmtGameNews->execute();
$gameNewsList = $stmtGameNews->fetchAll(PDO::FETCH_ASSOC);


// Get user information from session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quảng Cáo Tin Tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .navbar-nav .nav-item {
            margin-left: 1rem;
        }

        .navbar-nav .nav-link {
            color: #333;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .hero {
            margin-bottom: 2rem;
        }

        .hero .card-img-overlay {
            background-color: rgba(0, 0, 0, 0.6); /* Overlay tối hơn một chút */
            border-radius: 0;
        }

        .hero .card-title {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .hero .card-text {
            font-size: 1rem;
        }

        .news-list {
            margin-bottom: 2rem;
        }

        .news-list h2,
        .ads h2 {
            border-bottom: 3px solid #007bff;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .card {
            border: none;
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.03);
            border-radius: 0.25rem;
            overflow: hidden; /* Để bo tròn góc ảnh nếu cần */
        }

        .card-img-top {
            border-radius: 0;
            object-fit: cover;
            height: 200px; /* Chiều cao cố định cho ảnh tin tức */
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #eee;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            color: #777;
        }

        .btn-outline-primary {
            border-radius: 0.2rem;
        }

        .ads {
            margin-bottom: 2rem;
        }

        .ads .card {
            border: 1px solid #ddd;
            box-shadow: none;
            border-radius: 0.25rem;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        footer p {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        /* Điều chỉnh cho phần đầu (header và hero) */
        .bg-light {
            background-color: #fff !important; /* Đảm bảo màu trắng */
            border-bottom: 1px solid #eee;
        }

        .navbar-light .navbar-toggler {
            border-color: rgba(0, 0, 0, 0.1);
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(0, 0, 0, 0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Điều chỉnh khoảng cách giữa logo và nav */
        .align-items-center > .col-md-3 {
            display: flex;
            align-items: center;
        }

        .align-items-center > .col-md-9 {
            display: flex;
            justify-content: flex-end;
        }
        /* Add some basic styling for the search form */
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-form .form-control {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <header class="bg-light py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <a href="#" class="logo">TinTucAZ</a>
                </div>
                <div class="col-md-9">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="index.php">Trang chủ</a>
                                    </li>
                                    <li class="nav-item">
                                        <form class="d-flex search-form" action="index.php" method="GET">
                                            <input class="form-control me-2" type="search" placeholder="Tìm kiếm tin tức..." aria-label="Search" name="search_query" value="<?php echo isset($_GET['search_query']) ? htmlspecialchars($_GET['search_query']) : ''; ?>">
                                            <button class="btn btn-outline-success" type="submit">Tìm</button>
                                        </form>
                                    </li>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <li class="nav-item">
                                            <span class="nav-link">Chào, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/cutonama3/auth/logout.php">Đăng xuất</a>
                                        </li>
                                    <?php else: ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/cutonama3/auth/login.php">Đăng nhập</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/cutonama3/auth/register.php">Đăng ký</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main class="container mt-4">
        <section class="hero">
            <div class="row">
                <div class="col-md-8">
                    <div class="card bg-dark text-white rounded-0">
                        <img src="https://gcs.tripi.vn/public-tripi/tripi-feed/img/482599XAF/anh-mo-ta.png" class="card-img" alt="Tin nổi bật" style="object-fit: cover; height: 400px;">
                        <div class="card-img-overlay d-flex flex-column justify-content-end">
                            <h5 class="card-title fw-bold">Tiêu đề tin nổi bật số 1</h5>
                            <p class="card-text">Mô tả ngắn gọn về tin tức nổi bật này...</p>
                            <a href="#" class="btn btn-primary btn-sm">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card rounded-0 mb-2">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZKhlwd1pW2djeJeGe7Z_7apZxBXfxTjEIJg&s" alt="">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">Tiêu đề tin nhỏ 1</h6>
                            <p class="card-text">Mô tả ngắn gọn...</p>
                        </div>
                    </div>
                    <div class="card rounded-0 mb-2">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWqofI0IZ3KQqVHLYzFwK-eRKkYzye1MGPjw&s" class="card-img-top" alt="Tin nổi bật nhỏ 2">
                        <div class="card-body">
                            <h6 class="card-title fw-bold">Tiêu đề tin nhỏ 2</h6>
                            <p class="card-text">Mô tả ngắn gọn...</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="news-list">
            <?php if (!empty($_GET['search_query'])): ?>
                <h2>Kết quả tìm kiếm cho "<?php echo htmlspecialchars($_GET['search_query']); ?>"</h2>
            <?php else: ?>
                <h2>Tin tức mới nhất</h2>
            <?php endif; ?>
            <div class="row">
                <?php if (!empty($latestNewsList)): ?>
                    <?php foreach ($latestNewsList as $news): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <?php if (!empty($news['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($news['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($news['title']); ?>" style="object-fit: cover; height: 200px;">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="No Image" style="object-fit: cover; height: 200px;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($news['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($news['summary']); ?></p>
                                </div>
                                <div class="card-footer text-end">
                                    <small class="text-muted"><?php echo date('d/m/Y', strtotime($news['created_at'])); ?></small>
                                    <a href="news_detail.php?id=<?php echo $news['news_id']; ?>" class="btn btn-outline-primary btn-sm float-end">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-12">Không tìm thấy tin tức nào.</div>
                <?php endif; ?>
            </div>
        </section>

        <section class="ads">
            <h2>Tin bóng đá</h2>
            <div class="row">
                <?php if (!empty($footballNewsList)): ?>
                    <?php foreach ($footballNewsList as $footballNews): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <?php if (!empty($footballNews['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($footballNews['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($footballNews['title']); ?>" style="object-fit: cover; height: 200px;">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="No Image" style="object-fit: cover; height: 200px;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($footballNews['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($footballNews['summary']); ?></p>
                                </div>
                                <div class="card-footer text-end">
                                    <small class="text-muted"><?php echo date('d/m/Y', strtotime($footballNews['created_at'])); ?></small>
                                    <a href="football_news_detail.php?id=<?php echo $footballNews['football_news_id']; ?>" class="btn btn-outline-primary btn-sm float-end">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-12">Không có tin tức bóng đá nào.</div>
                <?php endif; ?>
            </div>
        </section>

        <section class="ads">
            <h2>Tin những người nổi tiếng</h2>
            <div class="row">
                <?php if (!empty($celebrityNewsList)): ?>
                    <?php foreach ($celebrityNewsList as $celebrityNews): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <?php if (!empty($celebrityNews['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($celebrityNews['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($celebrityNews['title']); ?>" style="object-fit: cover; height: 200px;">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="No Image" style="object-fit: cover; height: 200px;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($celebrityNews['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($celebrityNews['summary']); ?></p>
                                </div>
                                <div class="card-footer text-end">
                                    <small class="text-muted"><?php echo date('d/m/Y', strtotime($celebrityNews['created_at'])); ?></small>
                                    <a href="celebrity_news_detail.php?id=<?php echo $celebrityNews['celebrity_news_id']; ?>" class="btn btn-outline-primary btn-sm float-end">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-12">Không có tin tức về người nổi tiếng.</div>
                <?php endif; ?>
            </div>
        </section>


        <section class="ads">
            <h2>Tin tức Game</h2>
            <div class="row">
                <?php if (!empty($gameNewsList)): ?>
                    <?php foreach ($gameNewsList as $gameNews): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <?php if (!empty($gameNews['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($gameNews['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($gameNews['title']); ?>" style="object-fit: cover; height: 200px;">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="No Image" style="object-fit: cover; height: 200px;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($gameNews['title']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($gameNews['summary']); ?></p>
                                    <p class="card-text"><small class="text-muted">Game: <?php echo htmlspecialchars($gameNews['game_title']); ?> - Nền tảng: <?php echo htmlspecialchars($gameNews['platform']); ?></small></p>
                                </div>
                                <div class="card-footer text-end">
                                    <small class="text-muted"><?php echo date('d/m/Y', strtotime($gameNews['created_at'])); ?></small>
                                    <a href="game_news_detail.php?id=<?php echo $gameNews['game_news_id']; ?>" class="btn btn-outline-primary btn-sm float-end">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-md-12">Không có tin tức game nào.</div>
                <?php endif; ?>
            </div>
        </section>

    </main>

    <footer class="text-center">
        <p>&copy; 2025 TinTucAZ | All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>