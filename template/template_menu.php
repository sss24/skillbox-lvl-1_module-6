<div class='menu <?= $flat ?>'>
    <ul>
        <? foreach ($menu as $k => $v) : ?>
            <? $item = cutTitle($v['title']); ?>
            <? if (strpos($queryString, $v['path']) !== false) : ?>

                <li><a class='active' href='<?= $v['path']; ?>'><?= $item ?></a></li>
                <? continue; ?>
            <? endif; ?>
            <li><a href='<?= $v['path']; ?>'><?= $item ?></a></li>
        <? endforeach; ?>
    </ul>
</div>
