<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExpenditureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Expenditures list');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expenditure-index">

    <h3><?= Html::encode($this->title) ?></h3>

<?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        //'showFooter'=>true,
        //'showHeader' => true,
        //'showPageSummary' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'exp_dt',

                //'pageSummary'=>'Total',
            ],
            [
                'attribute'=> 'amount',

            ],

            [
                'attribute'=>'type',
                'value'=>'expType.type',
            ],
            'description',
            'maker_id',
            [
                'label'=>'attachment',
                'format' => 'raw',
                'value'=>function($model){
                    if($model->attachment==null){
                        return '';
                    }
                    elseif($model->attachment!=null){


                        $basepath = Yii::$app->request->baseUrl.'/uploads/'.$model->attachment;
                        //$path = str_replace($basepath, '', $model->attachment);
                        return Html::a('<i class="fa fa-eye"></i> View', $basepath, array('target'=>'_blank'));


                    }
                }
            ],
            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'Actions',
                'template'=>'{view} {delete}',
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
    'clientOptions' => [
        "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
        "info"=>false,
        "responsive"=>true,
        "dom"=> 'lfTrtip',
        "tableTools"=>[
            "aButtons"=> [
                [
                    "sExtends"=> "xls",
                    "oSelectorOpts"=> ["page"=> 'current']
                ],
                [
                    "sExtends"=> "pdf",
                    "sButtonText"=> Yii::t('app',"Save to PDF")
                ],
                [
                    "sExtends"=> "print",
                    "sButtonText"=> Yii::t('app',"Print")
                ],
            ]
        ]
    ],


    ]); ?>
</div>
