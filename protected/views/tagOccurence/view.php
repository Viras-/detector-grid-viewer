<?php
/* @var $this TagOccurenceController */
/* @var $model TagOccurence */

$this->breadcrumbs=array(
	'Tag Occurences'=>array('index'),
	$model->tag_occurence_id,
);

$this->menu=array(
	array('label'=>'List TagOccurence', 'url'=>array('index')),
	array('label'=>'Create TagOccurence', 'url'=>array('create')),
	array('label'=>'Update TagOccurence', 'url'=>array('update', 'id'=>$model->tag_occurence_id)),
	array('label'=>'Delete TagOccurence', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->tag_occurence_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TagOccurence', 'url'=>array('admin')),
);
?>

<h1>View TagOccurence #<?php echo $model->tag_occurence_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'tag_occurence_id',
		'oid',
		'strength',
		'seenTick',
		'reader_id',
	),
)); ?>
