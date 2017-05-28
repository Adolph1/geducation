<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BudgetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Budget Transactions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'New Budget'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'trn_dt',
            'amount',
            [
                    'attribute'=>'branch_id',
                    'value'=>'branch.branch_name',
            ],

            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view} {approve} {reject} {delete}',

            'buttons'=>[
                'view' => function ($url, $model) {
                    $url=['view','id' => $model->id];
                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => 'View',
                        'data-toggle'=>'tooltip','data-original-title'=>'Save',
                        'class'=>'btn btn-info',

                    ]);


                },

                'delete' => function ($url, $model) {
                    $url=['delete','id' => $model->id];
                    return Html::a('<span class="fa fa-times"></span>', $url, [
                        'title' => 'Delete',
                        'data-toggle'=>'tooltip','data-original-title'=>'Save',
                        'class'=>'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this batch?'),
                            'method' => 'post',
                        ],

                    ]);


                }

                    ]

            ],
        ],
    ]); ?>
</div>
