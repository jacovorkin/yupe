<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'mail-template-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

<div class="alert alert-info"><?php echo Yii::t('yupe','Поля, отмеченные');?> <span class="required">*</span> <?php echo Yii::t('yupe','обязательны.');?></div>

	<?php echo  $form->errorSummary($model); ?>
        
<div class='control-group <?php echo $model->hasErrors("event_id")?"error":"" ?>'><?php echo  $form->dropDownListRow($model,'event_id',CHtml::listData(MailEvent::model()->findAll(),'id','name'),array('class'=>'span5','maxlength'=>10,'empty' => Yii::t('mail','--выберите--'))); ?></div>

	<div class='control-group <?php echo $model->hasErrors("code")?"error":"" ?>'><?php echo  $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>100)); ?></div>	

	<div class='control-group <?php echo $model->hasErrors("name")?"error":"" ?>'><?php echo  $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>300)); ?></div>

	<div class='control-group <?php echo $model->hasErrors("description")?"error":"" ?>'><?php echo  $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?></div>

	<div class='control-group <?php echo $model->hasErrors("from")?"error":"" ?>'><?php echo  $form->textFieldRow($model,'from',array('class'=>'span5','maxlength'=>300)); ?></div>

	<div class='control-group <?php echo $model->hasErrors("to")?"error":"" ?>'><?php echo  $form->textFieldRow($model,'to',array('class'=>'span5','maxlength'=>300)); ?></div>

	<div class='control-group <?php echo $model->hasErrors("theme")?"error":"" ?>'><?php echo  $form->textAreaRow($model,'theme',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?></div>

	<div class='control-group <?php echo $model->hasErrors("body")?"error":"" ?>'><?php echo  $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?></div>

	<div class='control-group <?php echo $model->hasErrors("status")?"error":"" ?>'><?php echo  $form->dropDownListRow($model,'status',$model->getStatusList(),array('class'=>'span5')); ?></div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('yupe','Создать') : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>