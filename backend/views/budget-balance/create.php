<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BudgetBalance */

$this->title = Yii::t('app', 'Create Budget Balance');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Budget Balances'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-balance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
