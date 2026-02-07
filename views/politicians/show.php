<?php
$model = new Politician();

foreach ($politicians as $i => $p):
    if ($i === 0) continue;
?>
    <hr>
    <h2><?= $p[1] ?> (<?= $p[2] ?>)</h2>

    <ul>
    <?php
        $promises = $model->getPromisesByPolitician($p[0]);
        $shownPromises = []; 

        foreach ($promises as $pr):

            if (in_array($pr[2], $shownPromises)) continue;
            $shownPromises[] = $pr[2];
    ?>
        <li>
            <a href="index.php?action=detail&id=<?= $pr[0] ?>">
                <?= $pr[2] ?>
            </a>
            — <?= $pr[4] ?>
        </li>
    <?php endforeach; ?>
    </ul>

<?php endforeach; ?>
