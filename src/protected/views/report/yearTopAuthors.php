<?php
/* @var $this ReportController */
/* @var $year int */
/* @var $authors Author[] */

?>

<h3>Топ 10 Авторов за <?=$year; ?> год </h3>

<?php if ($authors !== []): ?>
<table class="detail-view">
    <thead>
        <tr>
            <th>Место</th>
            <th>Автор</th>
            <th>Количество книг</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($authors as $i => $author): ?>
        <tr>
            <td><?=($i + 1) ?></td>
            <td><?= $author->fullName ?></td>
            <td><?=$author->bookCount ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <h3>Нет данных для отчета</h3>
<?php endif; ?>