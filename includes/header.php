<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DemografiKu - Dashboard Kepadatan Penduduk</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.3em;
        }
        .navbar-nav .nav-link {
            margin-left: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }
        .navbar-nav .nav-link.active {
            background-color: rgba(255,255,255,0.3);
            font-weight: 600;
        }
        .main-container {
            padding: 30px 0;
            min-height: calc(100vh - 200px);
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.15);
        }
        .kpi-card {
            text-align: center;
            padding: 25px;
        }
        .kpi-value {
            font-size: 2.5em;
            font-weight: bold;
            color: #667eea;
            margin: 15px 0;
        }
        .kpi-label {
            font-size: 1em;
            color: #666;
            font-weight: 500;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-chart-bar"></i> DemografiKu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= !isset($_GET['page']) ? 'active' : '' ?>" href="index.php">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'list' ? 'active' : '' ?>" href="index.php?page=list">
                            <i class="fas fa-users"></i> Data Penduduk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'wilayah' ? 'active' : '' ?>" href="index.php?page=wilayah">
                            <i class="fas fa-map"></i> Data Wilayah
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid main-container">