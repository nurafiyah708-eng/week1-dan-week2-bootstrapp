<nav class="mt-4">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php echo ($currentPaging <= 1) ? 'disabled' : ''; ?>">
            <a class="page-link shadow-sm" href="?page=<?php echo $activePage; ?>&p=<?php echo $currentPaging - 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo; Sebelumnya</span>
            </a>
        </li>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo ($currentPaging == $i) ? 'active' : ''; ?>">
                <a class="page-link shadow-sm" href="?page=<?php echo $activePage; ?>&p=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
        <?php endfor; ?>

        <li class="page-item <?php echo ($currentPaging >= $totalPages) ? 'disabled' : ''; ?>">
            <a class="page-link shadow-sm" href="?page=<?php echo $activePage; ?>&p=<?php echo $currentPaging + 1; ?>" aria-label="Next">
                <span aria-hidden="true">Selanjutnya &raquo;</span>
            </a>
        </li>
    </ul>
</nav>