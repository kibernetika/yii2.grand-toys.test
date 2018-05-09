<?php
use yii\widgets\ListView;
use \yii\widgets\Pjax;
use app\assets\ItemListViewAsset;
use app\assets\ModalAsset;
use app\assets\SiteIndexAsset;

/* @var $this yii\web\View */

ItemListViewAsset::register($this);
SiteIndexAsset::register($this);

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <? Pjax::begin(); ?>
    <?= $this->render('../goods/_search', ['model' => $searchModel]);?>
    <?
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_item',
        ]);
    ?>
    <?php Pjax::end(); ?>
</div>
