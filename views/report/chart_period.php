<?php

use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

//echo $category;

echo Highcharts::widget([
    'scripts' => [
//'modules/exporting',
        'themes/grid-light',
    ],
    'options' => [
        'credits' => ['enabled' => false],
        'title' => [
            'text' => "$title",
        ],
        'xAxis' => [
            'categories' => ['ไตรมาส 1','ไตรมาส 2','ไตรมาส 3','ไตรมาส 4'],
        ],
        'labels' => [
            'items' => [
                [
                    //'html' => $labels,
                    'style' => [
                        'left' => '50px',
                        'top' => '18px',
                        'color' => new JsExpression('(Highcharts.theme && Highcharts.theme.textColor) || "black"'),
                    ],
                ],
            ],
        ],
        /*
         * yAxis: {
          min: 0,
          title: {
          text: 'จำนวน (คน)'
          }
          },
          legend: {
          enabled: false
          },

         */
        'yAxis' => [
            'min' => 0,
            'title' => [
                'text' => 'จำนวน(บาท)'
            ],
            'legend' => [
                'enabled' => false
            ],
            'labels' => [
                'formatter' => new JsExpression('function(){ return this.value; }')
            ]
        ],
        'series' => [
            [
                'type' => 'column',
                'color' => 'green',
                'name' => 'รายรับ',
                'data' => $val_income,
            ],
            [
                'type' => 'column',
                'name' => 'รายจ่าย',
                'color' => 'red',
                'data' => $val_outcome,
            ],
            
        ],
    ]
]);
