<nav aria-label="breadcrumb" class="breadcrumb-box shadow-sm">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="?page=page1">Aplikasi</a></li>
        <li class="breadcrumb-item">
            <a href="?page=<?php echo $activePage; ?>&p=1"><?php echo $subPage; ?></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <?php echo $action; ?>
        </li>
    </ol>
</nav>