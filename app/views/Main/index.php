<? if (!empty($posts)) { ?>
    <? foreach ($posts as $item) { ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $item['name']; ?></h5>
                <p class="card-text"><?= $item['description']; ?></p>
            </div>
        </div>
    <? } ?>
<? } ?>