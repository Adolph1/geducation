<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Budget */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="budget-form">
    <div class="panel panel-success">
        <div class="panel-heading">Budget Form</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
