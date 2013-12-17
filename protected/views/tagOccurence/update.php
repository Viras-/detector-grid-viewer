<?php
/* @var $this TagOccurenceController */
/* @var $model TagOccurence */

$this->breadcrumbs=array(
	'Tag Occurences'=>array('index'),
	$model->tag_occurence_id=>array('view','id'=>$model->tag_occurence_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TagOccurence', 'url'=>array('index')),
	array('label'=>'Create TagOccurence', 'url'=>array('create')),
	array('label'=>'View TagOccurence', 'url'=>array('view', 'id'=>$model->tag_occurence_id)),
	array('label'=>'Manage TagOccurence', 'url'=>array('admin')),
);
?>

<h1>Update TagOccurence <?php echo $model->tag_occurence_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>