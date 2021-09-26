<ul class="pagination justify-content-center" style="padding-top: 20px;">
    <li class="page-item <?= ($total_pages == 1 || $current_page == 1) ? 'disabled' : '' ?>">
        <a class="page-link btn-previous-page" href="#" tabindex="-1">Previous</a>
    </li>

    <?php
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page)
            echo '<li class="page-item active"><a class="page-link btn-pagination" page=' . $i . '>' . $i . '</a></li>';
        else {
            echo '<li class="page-item"><a class="page-link btn-pagination" page=' . $i . '>' . $i . '</a></li>';
        }
    }
    ?>

    <li class="page-item <?= ($total_pages == 1 || $total_pages == $current_page) ? 'disabled' : '' ?>">
        <a class="page-link btn-next-page" href="#">Next</a>
    </li>
</ul>