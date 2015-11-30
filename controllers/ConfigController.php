<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;

/**
 * AffiliatedController implements the CRUD actions for Affiliated model.
 */
class ConfigController extends Controller {

    public $layout = "admin-lte";

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionSet_theme() {
        $theme = Yii::$app->request->post('theme');
        $session = Yii::$app->session;
        $session['themes'] = "content-bg-" . $theme;
    }

}
