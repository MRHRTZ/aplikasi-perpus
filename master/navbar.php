<?php
    session_start();

    $nama = $_SESSION['user']['nama'];
    $username = $_SESSION['user']['username'];
?>
<head>
    <style>
        body, html {
            margin: 0;
            padding: 0;
        }
        .header {
            padding-left: 20px;
        }
        .userinfo {
            padding-right: 20px;
        }
        .navbar {
            background-color: #333;
            color: white;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
        }
        .logout {
            padding: 10px;
            text-decoration: none;
            color: red;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="header">
            <h1>Aplikasi Perpustakaan</h1>
        </div>
        <div class="userinfo">
            <?= $nama ?> (<?= $username ?>)
            <a href="../logout.php" class="logout" target="_top">logout</a>
        </div>
    </div>
</body>