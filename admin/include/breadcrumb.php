<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php
        $bc_counter = 0;
        foreach ($nav_breadcrumbs as $breadcrumb) {
            $bc_counter++;
            $status = 'class="breadcrumb-item"';
            $link = "#";
            $icon = "";

            if (count($nav_breadcrumbs) == $bc_counter) $status = 'class="breadcrumb-item active" id="active" aria-current="page"';
            if ($breadcrumb[1] != "") $link = $breadcrumb[1];
            if ($breadcrumb[2] != "") $icon = '<i class="bi ' . $breadcrumb[2] . '"></i> ';
        ?>
            <li <?= $status ?>><a href="<?= $link ?>"><?= $icon ?><?= $breadcrumb[0] ?></a></li>
        <?php
        }
        ?>
    </ol>
</nav>