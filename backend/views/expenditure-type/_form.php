<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Department;

/* @var $this yii\web\View */
/* @var $model backend\models\ExpenditureType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="expenditure-type-form">
    <div class="panel panel-success">
        <div class="panel-heading">Expenditure type Form</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'department_id')->dropDownList(Department::getAll(),['prompt'=>Yii::t('app','--Select--')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
