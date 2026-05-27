<?php
/* @var $this ReportController */
/* @var $years array */

?>

<?php if ($years !== []) : ?>
    <h3>Авторы выпустившие больше всего книг в определенный год</h3>
    <ul>
        <?php foreach ($years as $year): ?>
            <li>
                <?=CHtml::link($year, ['report/yearTopAuthors', 'year' => $year]); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <h3>Нет данных для отчетов</h3>
<?php endif;?>
