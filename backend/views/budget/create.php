<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Budget */

$this->title = Yii::t('app', 'Create Budget');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budgets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
