<nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold text-pink" href="?page=page1">Nur Afiyah App</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activePage == 'page1') ? 'active fw-bold text-pink' : ''; ?>" href="?page=page1">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activePage == 'page2') ? 'active fw-bold text-pink' : ''; ?>" href="?page=page2&p=1">Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($activePage == 'page3') ? 'active fw-bold text-pink' : ''; ?>" href="?page=page3&p=1">Database</a>
                </li>
            </ul>
        </div>
    </div>
</nav>