<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expenditures list');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
  
    
    $gridColumns=[
        ['class' => 'kartik\grid\SerialColumn'],

        //'id',
        [
            'attribute'=>'exp_dt',
            'pageSummary'=>'Total',
        ],
        [
                'attribute'=>'amount',
            'format'=>['decimal', 2],
                'pageSummary'=>true,
                'footer'=>true
        ],
        [
            'attribute'=>'type',
            'value'=>'expType.type',
        ],
        'description',
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
        'maker_id',
        'maker_time',
        'checker',
        'checker_time'


    ];
    ?>
    <?php
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' =>
            [
                ['class' => 'kartik\grid\SerialColumn'],

                //'id',
                [
                    'attribute'=>'exp_dt',
                    'pageSummary'=>'Total',
                ],
                [
                    'attribute'=>'amount',
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'footer'=>true
                ],
                [
                    'attribute'=>'type',
                    'value'=>'expType.type',
                ],
                'description',
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
        //'class'=>'\kartik\grid\DataColumn',
        // 'pageSummary'=>'Total',
        'fontAwesome' => true,

        'showPageSummary' => true,
        'dropdownOptions' => [
            'label' => 'Export All',
            'class' => 'btn btn-success'
        ]
    ]);


    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'panel' => [
                    'heading'=>'<h4 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Expenditures</h4>',
                    'type'=>'default',
                    'before'=>Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class' => 'btn btn-default']),
                    'after'=>''
                ],
                'toolbar' => [
                   
                    '{export}',
                ],

                'pjax'=>true,
                'showHeader' => true,
        'columns' =>$gridColumns,


        'showPageSummary'=>true,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],


    ]); ?>
</div>
