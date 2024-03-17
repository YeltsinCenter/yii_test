<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

echo $sort->link('title') . ' | ' . $sort->link('upload_date_time');
?>
<ul>
    <?php foreach ($images as $image) : ?>
    <li>
        <div>
            <a href="/uploads/<?= $image['title'] ?>" target="_blank">
                <img width="100px" height="100px" src="/uploads/<?= $image['title'] ?>">
            </a>
        </div>
        <p>
            Название картинки - <?= $image['title'] ?>
        </p>
        <p>
            Дата добавление картинки - <?= $image['upload_date_time'] ?>
        </p>
        <p>
            <a href="/download?filename=<?= $image['title'] ?>">Скачать картинку в архиве</a>
        </p>
    </li>
    <?php endforeach; ?>
</ul>
