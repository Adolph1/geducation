<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use backend\models\PaymentMethod;
use backend\models\ExpenditureType;

/* @var $this yii\web\View */
/* @var $model backend\models\Expenditure */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="expenditure-form">
    <div class="panel panel-success">
        <div class="panel-heading">Expenditure Form</div>
        <div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8 text-center"><small><b>Please fill the form correctly</b></small></div>
        <div class="col-md-4">
        <?= $form->field($model, 'exp_dt')->widget(DatePicker::ClassName(),
            [
                //'name' => 'purchase_date',
                //'value' => date('d-M-Y', strtotime('+2 days')),
                'options' => ['placeholder' => 'Enter date'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
            ]);?>
    </div>
    </div>
        <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'fund_source')->dropDownList(['I'=>'Within budget','O'=>'Out the budget'],['prompt'=>'--Select--']) ?>
        </div>
            <div class="col-md-6">
                <?= $form->field($model, 'amount')->textInput() ?>
            </div>
    </div>
    <div class="row">
        <div class="col-md-6">
    <?= $form->field($model, 'type')->dropDownList([ExpenditureType::getAll(),'prompt'=>Yii::t('app','--Select--')]) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
            <?php
            if(!$model->isNewRecord) {
                if ($model->fund_source == 'O') {
                    ?>
                    <div class="row">

                        <div class="col-md-6">
                            <?= $form->field($model, 'payment_method')->dropDownList(PaymentMethod::getAll(), ['prompt' => Yii::t('app', '--Select--')]) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'reference_no')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-2">
                            <?= $form->field($model, 'attachment_file')->fileInput(['maxlength' => true]) ?>
                        </div>

                    </div>
                    <?php
                } else {

                    ?>

                    <div class="row">
                        <div id="fund_source">
                            <div class="col-md-6">
                                <?= $form->field($model, 'payment_method')->dropDownList(PaymentMethod::getAll(), ['prompt' => Yii::t('app', '--Select--')]) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'reference_no')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-2">
                                <?= $form->field($model, 'attachment_file')->fileInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
                else{
            ?>
            <div class="row">
                <div id="fund_source">
                    <div class="col-md-6">
                        <?= $form->field($model, 'payment_method')->dropDownList(PaymentMethod::getAll(), ['prompt' => Yii::t('app', '--Select--')]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'reference_no')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'attachment_file')->fileInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
            <?php }?>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 text-left">
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
