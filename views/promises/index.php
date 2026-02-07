
<ul>
<?php foreach ($promises as $p): ?>
    <li style="margin-bottom:8px;">
        <a href="index.php?action=detail&id=<?= $p['promise_id'] ?>">
            <?= $p['description'] ?>
        </a>
        <br>
        <small>
            พรรค: <?= $p['party'] ?> |
            แก้ไขล่าสุด: <?= $p['last_update'] ?>
        </small>
    </li>
<?php endforeach; ?>
</ul>
