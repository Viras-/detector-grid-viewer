<?php
/* @var $this TagOccurenceController */
/* @var $model TagOccurence */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tag-occurence-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'oid'); ?>
		<?php echo $form->textField($model,'oid'); ?>
		<?php echo $form->error($model,'oid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'strength'); ?>
		<?php echo $form->textField($model,'strength'); ?>
		<?php echo $form->error($model,'strength'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'seenTick'); ?>
		<?php echo $form->textField($model,'seenTick'); ?>
		<?php echo $form->error($model,'seenTick'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reader_id'); ?>
		<?php echo $form->textField($model,'reader_id'); ?>
		<?php echo $form->error($model,'reader_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->