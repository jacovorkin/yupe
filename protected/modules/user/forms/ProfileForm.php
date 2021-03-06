<?php
class ProfileForm extends CFormModel
{
    public $nick_name;

    public $first_name;

    public $middle_name;

    public $last_name;

    public $email;

    public $password;
    
    public $cPassword;

    public $verifyCode;

    public $about;

    public $gender;

    public $birth_date;

    public function rules()
    {
        $module = Yii::app()->getModule('user');

        return array(
            array('nick_name, email, first_name, last_name, middle_name, about','filter','filter' => 'trim'),
            array('nick_name, email, first_name, last_name, middle_name, about','filter','filter' => array($obj = new CHtmlPurifier(),'purify')),
            array('nick_name, email', 'required'),
            array('gender', 'numerical', 'min'=>0, 'max'=>3, 'integerOnly'=>true),
            array('gender', 'default', 'value'=>0),
            array('birth_date', 'date', 'allowEmpty'=>true, 'format'=>Yii::app()->locale->dateFormat),
            array('birth_date', 'default', 'value'=> null),
            array('nick_name, email, first_name, last_name, middle_name', 'length', 'max' => 50),
            array('about', 'length', 'max' => 300),
            array('password, cPassword', 'length', 'min' => $module->minPasswordLength),
            array('nick_name','match','pattern' =>  '/^[A-Za-z0-9]{2,50}$/','message' => Yii::t('user','Неверный формат поля "{attribute}" допустимы только буквы и цифры, от 2 до 20 символов')),
            array('nick_name','checkNickName'),
            array('password', 'compare', 'compareAttribute' => 'cPassword', 'message' => Yii::t('user', 'Пароли не совпадают.')),
            array('email','email'),                                    
            array('email','checkEmail'),
        );
    }

    public function beforeValidate()
    {
        if ( Yii::app()->getModule('user')->autoNick )
            $this->nick_name=substr(User::model()->generateSalt(),10);

        return parent::beforeValidate();
    }

    public function afterValidate()
    {
        if ($this->birth_date)
            $this->birth_date = date("c",strtotime($this->birth_date));

        parent::afterValidate();
    }


    public function checkNickName($attribute,$params)
    {
        // Если ник поменяли
	if (Yii::app()->user->profile->nick_name != $this->nick_name)
	{
            $model = User::model()->find('nick_name = :nick_name',array(
               ':nick_name' => $this->nick_name
            ));

            if($model)        
                 $this->addError('nick_name',Yii::t('user','Ник уже занят'));
        }
    }

    public function checkEmail($attribute,$params)
    {
        // Если мыло поменяли
        if ( Yii::app()->user->profile->email != $this->email )
        {
            $model = User::model()->find('email = :email',array(
                ':email' => $this->email
            ));

            if($model)
                $this->addError('email',Yii::t('user','Email уже занят'));
        }
    }

    public function attributeLabels()
    {
        return array(
            'first_name' => Yii::t('user', 'Имя'),
            'last_name' => Yii::t('user', 'Фамилия'),
            'middle_name' => Yii::t('user', 'Отчество'),
            'nick_name' => Yii::t('user', 'Имя пользователя'),
            'email' => Yii::t('user', 'Email'),
            'password' => Yii::t('user', 'Новый пароль'),
            'cPassword' => Yii::t('user', 'Подтверждение пароля'),
            'gender' => Yii::t('user', 'Пол'),
            'birth_date' => Yii::t('user', 'Дата рождения'),
            'about' => Yii::t('user', 'О себе'),
        );
    }

}