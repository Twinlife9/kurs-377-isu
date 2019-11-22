<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\ActiveRecord;
use dektrium\user\models\User;
use yii\web\UploadedFile;
/**
 * This is the model class for table "portfolio".
 *
 * @property int $id
 * @property int $id_user
 * @property string $heading
 * @property string $description
 * @property string $link
 * @property int $id_type
 * @property string $image
 * @property string $date
 *
 * @property Type $type
 * @property User $user
 */
class Portfolio extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'portfolio';
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_type'], 'integer'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['image'], 'safe'],
            [['heading', 'link'], 'string', 'max' => 100],
            [['imageFile'], 'file', 'skipOnEmpty' =>false, 'extensions' => 'png, jpg'],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['id_type' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'heading' => 'Heading',
            'description' => 'Description',
            'link' => 'Link',
            'id_type' => 'Id Type',
            'imageFile' => 'Image',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'id_type']);
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
                    ],
                    'value' => new Expression('NOW()'),
                ],
            ];
        }
        public function upload()
        {
            if ($this->validate()) {
                $this->imageFile->saveAs('upload/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
                \Yii::debug($this->imageFile->tempName ='upload/' . $this->imageFile->baseName . '.' . $this->imageFile->extension );
                return true;
            } else {
                return false;
            }
        }
}

