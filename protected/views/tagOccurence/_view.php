<?php
/* @var $this TagOccurenceController */
/* @var $data TagOccurence */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('tag_occurence_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->tag_occurence_id), array('view', 'id'=>$data->tag_occurence_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oid')); ?>:</b>
	<?php echo CHtml::encode($data->oid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('strength')); ?>:</b>
	<?php echo CHtml::encode($data->strength); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seenTick')); ?>:</b>
	<?php echo CHtml::encode($data->seenTick); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reader_id')); ?>:</b>
	<?php echo CHtml::encode($data->reader_id); ?>
	<br />


</div>