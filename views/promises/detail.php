<h1><?= $promise['description'] ?></h1>
<p>
    สถานะ: <strong><?= $promise['status'] ?></strong>
</p>

<p>
    นักการเมือง: <?= $politician['name'] ?><br>
    พรรคการเมือง: <strong><?= $politician['party'] ?></strong>
</p>
<hr>
<h3>ประวัติการอัปเดต</h3>

<?php if (empty($updates)): ?>
    <p>ยังไม่มีการอัปเดต</p>
<?php else: ?>
    <?php foreach ($updates as $u): ?>
        <div style="border:1px solid #ccc; padding:8px; margin-bottom:8px;">
            <small>อัปเดตเมื่อ: <?= $u['update_date'] ?></small>
            <p><?= $u['detail'] ?></p>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


<?php if ($_SESSION['user'] === 'admin'): ?>

    <!-- ฟอร์มแก้สถานะ -->
    <form method="post" action="index.php?action=updateStatus&id=<?= $promise['promise_id'] ?>">
        <select name="status">
            <option value="ยังไม่เริ่ม">ยังไม่เริ่ม</option>
            <option value="กำลังดำเนินการ">กำลังดำเนินการ</option>
            <option value="เงียบหาย">เงียบหาย</option>
        </select>
        <button type="submit">บันทึกสถานะ</button>
    </form>

    <?php if ($promise['status'] !== 'เงียบหาย'): ?>
        <a href="index.php?action=update&id=<?= $promise['promise_id'] ?>">
            เพิ่มความคืบหน้า
        </a>
    <?php endif; ?>

<?php endif; ?>

