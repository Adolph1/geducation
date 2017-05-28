<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Expenditure */

$this->title = Yii::t('app', 'Create Expenditure');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenditures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
