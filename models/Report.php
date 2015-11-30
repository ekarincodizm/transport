<?php
namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Typecar;

class Report{
    function Get_type(){
        $type = Typecar::find()->all();
        return $type;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

