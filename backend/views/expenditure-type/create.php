<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ExpenditureType */

$this->title = Yii::t('app', 'Create Expenditure Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenditure Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-type-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
