<?php
session_start();

// 1. DATA & LOGIKA (Tetap sama)
$staticUsers = [
    ['nama' => 'Dani Permana', 'status' => 'Online', 'akses' => 'Super Admin'],
    ['nama' => 'Anisa Sugiarti', 'status' => 'Offline', 'akses' => 'View Only'],
    ['nama' => 'Shintya Mustika', 'status' => 'Offline', 'akses' => 'Super Admin'],
    ['nama' => 'Afiyah Meyfrida', 'status' => 'Online', 'akses' => 'View Only'],
    ['nama' => 'Hani Istiana', 'status' => 'Online', 'akses' => 'Super Admin'],
    ['nama' => 'Ledys', 'status' => 'Online', 'akses' => 'Super Admin'],
    ['nama' => 'Indira Cesilia', 'status' => 'Offline', 'akses' => 'Super Admin'],
    ['nama' => 'Bachtiar Alif', 'status' => 'Online', 'akses' => 'View Only'],
    ['nama' => 'Qurrota', 'status' => 'Online', 'akses' => 'Super Admin'],
    ['nama' => 'Helva', 'status' => 'Offline', 'akses' => 'View Only'],
    ['nama' => 'Anisa febrianti', 'status' => 'Offline', 'akses' => 'Super Admin'],
    ['nama' => 'Salsabila diva', 'status' => 'Online', 'akses' => 'View Only'],
    ['nama' => 'nadia laela', 'status' => 'Offline', 'akses' => 'Super Admin'],
    ['nama' => 'ayunda', 'status' => 'Online', 'akses' => 'View Only'],
    ['nama' => 'devy', 'status' => 'Offline', 'akses' => 'Super Admin'],
];

if (!isset($_SESSION['myListData'])) { $_SESSION['myListData'] = []; }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'save') {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    if (!empty($nama) && !empty($email)) {
        $_SESSION['myListData'][] = ['nama' => $nama, 'email' => $email];
        header("Location: " . $_SERVER['PHP_SELF'] . "?page=page3&status=success&p=1");
        exit();
    }
}

// 2. NAVIGASI LOGIC
$itemsPerPage = 5;
$activePage = isset($_GET['page']) ? $_GET['page'] : 'page1';
$currentPaging = isset($_GET['p']) ? (int)$_GET['p'] : 1;
if ($currentPaging < 1) $currentPaging = 1;
$offset = ($currentPaging - 1) * $itemsPerPage;

// Breadcrumbs Mapping
if ($activePage == 'page2') {
    $subPage = "Daftar Pengguna"; $action = "Halaman " . $currentPaging;
} elseif ($activePage == 'page3') {
    $subPage = "Database"; $action = "Input & Riwayat";
} else {
    $subPage = "Dashboard"; $action = "Utama";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Web - Nur Afiyah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Gradasi Ungu, Pink, Peach */
        body { 
            background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 50%, #ffecd2 100%); 
            min-height: 100vh; 
            font-family: 'Poppins', sans-serif; 
            background-attachment: fixed;
        }
        
        .navbar-custom { 
            background-color: rgba(255, 255, 255, 0.85) !important; 
            backdrop-filter: blur(10px); 
            box-shadow: 0 4px 15px rgba(161, 140, 209, 0.2); 
        }

        .breadcrumb-box { 
            background: rgba(255, 255, 255, 0.7); 
            border-radius: 15px; 
            padding: 12px 25px; 
            margin-bottom: 30px; 
            border-left: 5px solid #a18cd1; /* Warna Ungu */
        }
        
        .breadcrumb-item a { color: #8a2be2; text-decoration: none; font-weight: 500; }
        .breadcrumb-item.active { color: #6c757d; font-weight: 400; }
        
        .main-content { padding-top: 100px; padding-bottom: 50px; }
        .page { display: none; }
        .active-page { display: block; animation: fadeIn 0.4s ease-in; }

        /* Card Styling */
        .card-custom { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            background: rgba(255, 255, 255, 0.9); 
        }

        /* Tombol & Aksen Warna */
        .btn-theme { 
            background: linear-gradient(to right, #a18cd1, #fbc2eb); 
            color: white; 
            border: none;
            border-radius: 50px; 
            transition: 0.3s;
        }
        .btn-theme:hover { 
            background: linear-gradient(to right, #8e44ad, #ff69b4); 
            color: white; 
            transform: translateY(-2px); 
            box-shadow: 0 5px 15px rgba(161, 140, 209, 0.4);
        }

        .text-theme-purple { color: #6a5acd; }
        .text-theme-pink { color: #ff69b4; }
        
        /* Pagination */
        .pagination .page-link { 
            color: #a18cd1; 
            border-radius: 10px; 
            margin: 0 3px; 
            border: none; 
        }
        .pagination .page-item.active .page-link { 
            background-color: #a18cd1; 
            color: white; 
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="container main-content">
        <?php include 'breadcrumbs.php'; ?>

        <section id="page1" class="page <?php echo ($activePage == 'page1') ? 'active-page' : ''; ?>">
            <div class="card card-custom p-5 text-center">
                <h1 class="display-5 fw-bold text-theme-purple">Selamat Datang Kembali!</h1>
                <p class="text-muted mb-4">DI WEBSITE <span class="text-theme-pink fw-bold">AFIYAH MEYFRIDA</span>.</p>
                <div class="d-flex justify-content-center">
                    <a href="?page=page2&p=1" class="btn btn-theme px-5 py-2">Kelola Pengguna</a>
                </div>
            </div>
        </section>

        <section id="page2" class="page <?php echo ($activePage == 'page2') ? 'active-page' : ''; ?>">
            <div class="card card-custom p-4">
                <h3 class="text-theme-purple mb-4 fw-bold">Daftar Pengguna Sistem</h3>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr style="background: #fdf0f6;">
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Status Aktif</th>
                                <th>Level Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $totalStaticPages = ceil(count($staticUsers) / $itemsPerPage);
                            $displayStatic = array_slice($staticUsers, $offset, $itemsPerPage);
                            $no = $offset + 1;
                            foreach ($displayStatic as $user): ?>
                            <tr class="text-center">
                                <td><?php echo $no++; ?></td>
                                <td class="fw-bold text-start text-secondary"><?php echo $user['nama']; ?></td>
                                <td>
                                    <span class="badge rounded-pill <?php echo ($user['status'] == 'Online') ? 'bg-success' : 'bg-secondary'; ?> p-2 px-3">
                                        <?php echo $user['status']; ?>
                                    </span>
                                </td>
                                <td><span class="text-muted small"><?php echo $user['akses']; ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php 
                    $totalPages = $totalStaticPages; 
                    include 'pagination.php'; 
                ?>
            </div>
        </section>

        <section id="page3" class="page <?php echo ($activePage == 'page3') ? 'active-page' : ''; ?>">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <div class="card card-custom p-4">
                        <h4 class="text-theme-purple fw-bold mb-3">Tambah Data</h4>
                        <form action="?page=page3" method="POST">
                            <input type="hidden" name="action" value="save">
                            <div class="mb-3">
                                <input type="text" name="nama" class="form-control border-0 bg-light" placeholder="Nama" required style="border-radius: 10px;">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control border-0 bg-light" placeholder="Email" required style="border-radius: 10px;">
                            </div>
                            <button type="submit" class="btn btn-theme w-100 fw-bold">SIMPAN DATA</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7">
                    <h4 class="text-white fw-bold mb-3" style="text-shadow: 1px 1px 5px rgba(0,0,0,0.2);">Riwayat Input</h4>
                    <div class="list-group shadow-sm">
                        <?php 
                        $totalSessionPages = ceil(count($_SESSION['myListData']) / $itemsPerPage);
                        $displaySession = array_slice(array_reverse($_SESSION['myListData']), $offset, $itemsPerPage);
                        if(empty($displaySession)) {
                            echo "<div class='list-group-item card-custom border-0 p-4 text-center text-muted'>Belum ada riwayat data.</div>";
                        }
                        foreach ($displaySession as $item): ?>
                            <div class="list-group-item card-custom border-0 mb-3 p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1 text-theme-purple fw-bold"><?php echo $item['nama']; ?></h6>
                                        <p class="mb-0 text-secondary small"><?php echo $item['email']; ?></p>
                                    </div>
                                    <div class="badge bg-peach text-dark" style="background-color: #ffecd2;">Baru</div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php 
                        $totalPages = $totalSessionPages; 
                        include 'pagination.php'; 
                    ?>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>