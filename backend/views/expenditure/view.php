<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Expenditure */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenditures'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-view">

    <h1><?php // Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'exp_dt',
            'amount',
            'description',
            [
                'attribute'=>'type',
                'value'=>$model->expType->type,
            ],
            'description',
            [
                'attribute'=>'branch_id',
                'value'=>$model->branch->branch_name,
            ],
            [
                'attribute'=>'department_id',
                'value'=>$model->department->dept_name,
            ],
            [
                'attribute'=>'payment_method',
                'value'=>function($model){

                    if($model->payment_method==null){

                        return "";
                    }
                    elseif($model->payment_method!=null){

                        return $model->payment->method_name;

                    }

                }
            ],
            [
                'attribute'=>'fund_source',
                'value'=>function($model){
                    if($model->fund_source=='I'){
                        return 'Within budget';
                    }
                    elseif($model->fund_source=='O'){

                        return 'Out of budget';

                    }
                }
            ],
            'reference_no',



        ],
    ]) ?>

</div>
