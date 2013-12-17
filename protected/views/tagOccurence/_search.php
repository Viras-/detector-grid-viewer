<?php
/* @var $this TagOccurenceController */
/* @var $model TagOccurence */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'tag_occurence_id'); ?>
		<?php echo $form->textField($model,'tag_occurence_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'oid'); ?>
		<?php echo $form->textField($model,'oid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'strength'); ?>
		<?php echo $form->textField($model,'strength'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seenTick'); ?>
		<?php echo $form->textField($model,'seenTick'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reader_id'); ?>
		<?php echo $form->textField($model,'reader_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->