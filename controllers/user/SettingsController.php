<?php
namespace app\controllers\user;

use cinghie\userextended\controllers\SettingsController as BaseAdminController;
use yii\filters\AccessControl;

class SettingsController extends BaseAdminController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['shoiw'],
                        'roles' => ['?'],
                    ],

                ],
            ],
        ];
    }
    public function actionShow($id){
        $profile = $this->finder->findProfileById(\Yii::$app->user->identity->getId());

        if ($profile == null) {
            $profile = \Yii::createObject(Profile::className());
            $profile->link('user', \Yii::$app->user->identity);
        }

        $event = $this->getProfileEvent($profile);

        $this->performAjaxValidation($profile);

        return $this->render('show', [
            'profile' => $profile,
        ]);
    }
}