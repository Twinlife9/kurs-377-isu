<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use dektrium\user\helpers\Timezone;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */

$this->params['breadcrumbs'][] = Yii::t('user', 'Show settings');
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<h1> Личный кабинет </h1>
<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('user', 'Информация'); ?>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'show-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'template' => "{label}\n<div class=\"col-lg-9\">{input}</div>\n<div class=\"col-sm-offset-3 col-lg-9\">{error}\n{hint}</div>",
                        'labelOptions' => ['class' => 'col-lg-3 control-label'],
                    ],
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false,
                    'validateOnBlur' => false,
                ]); ?>
                <?php ActiveForm::end(); ?>

    <div class="col-sm-6 col-md-8  text-justife">
        <h4><?= $this->title ?></h4>
        <ul class="" style="padding: 0; list-style: none outside none; font-size: 20px;">

            <?php if (($profile->terms)==0): ?>
                <li>
                    <i class="glyphicon glyphicon-lock text-muted"></i> <?= Html::encode("Ученик колледжа") ?>
                </li>

            <?php endif; ?>

            <?php if (($profile->terms)==1): ?>
                <li>
                    <i class="glyphicon glyphicon-star-empty text-muted"></i> <?= Html::encode("Преподаватель колледжа") ?>
                </li>

            <?php endif; ?>

            <?php if (!empty($profile->firstname)): ?>
                <li>
                    <i class="glyphicon glyphicon-asterisk text-muted"></i> <?= Html::encode($profile->firstname) ?>
                </li>

            <?php endif; ?>

            <?php if (!empty($profile->name)): ?>
                <li>
                     <i class="glyphicon glyphicon-hand-right text-muted"></i> <?= Html::encode($profile->name) ?>
                </li>

            <?php endif; ?>


            <?php if (!empty($profile->lastname)): ?>
                <li>
                    <i class="glyphicon glyphicon-asterisk text-muted"></i> <?= Html::encode($profile->lastname) ?>
                </li>

            <?php endif; ?>

            <?php if (!empty($profile->birthday)): ?>
            <li>
                <i class="glyphicon glyphicon-heart text-muted"></i> <?= Html::encode($profile->birthday) ?>
            </li>

            <?php endif; ?>
            <?php if (!empty($profile->location)): ?>
                <li>
                    <i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($profile->location)?>
                </li>
            <?php endif; ?>
            <?php if (!empty($profile->website)): ?>
                <li>
                    <i class="glyphicon glyphicon-globe text-muted"></i> <?= Html::a(Html::encode($profile->website), Html::encode($profile->website)) ?>
                </li>
            <?php endif; ?>
            <?php if (!empty($profile->public_email)): ?>
                <li>
                    <i class="glyphicon glyphicon-envelope text-muted"></i> <?= Html::a(Html::encode($profile->public_email), 'mailto:' . Html::encode($profile->public_email)) ?>
                </li>
            <?php endif; ?>

            <?php if (!empty($profile->signature)): ?>
                <li>
                    <i class="glyphicon glyphicon-ok"></i> <?= Html::encode($profile->signature) ?>
                </li>

            <?php endif; ?>
            <li>
                <i class="glyphicon glyphicon-time text-muted"></i> <?= Yii::t('user', 'Joined on {0, date}', $profile->user->created_at) ?>
            </li>
        </ul>

    </div>
</div>
</div>
</div>
</div>

