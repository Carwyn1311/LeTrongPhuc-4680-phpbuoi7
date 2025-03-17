<!-- app/views/shares/header.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Website Quản lý Sinh viên - Học phần</title>
    <style>
        body {
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f5f5f5;
        }
        header {
            background-color: #6200ee;
            color: #fff;
            padding: 16px 24px;
        }
        header h1 {
            margin: 0;
            font-size: 24px;
        }
        nav {
            margin-top: 8px;
        }
        nav a {
            color: #fff;
            margin-right: 10px;
            text-decoration: none;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container, .home-container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        .nav-links {
            list-style: none;
            padding-left: 0;
        }
        .nav-links li {
            margin-bottom: 8px;
        }
        .nav-links a {
            color: #6200ee;
            text-decoration: none;
            font-weight: bold;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #eee; 
            text-align: center; 
            padding: 12px; 
            margin-top: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Quản lý Sinh viên - Học phần</h1>
    <nav>
        <a href="?controller=default&action=index">Trang chủ</a> |
        <a href="?controller=sinhvien&action=index">Sinh viên</a> |
        <a href="?controller=hocphan&action=index">Học phần</a>
    </nav>
</header>
<div class="container">
