<?php
/* @var $this TagOccurenceController */
/* @var $model TagOccurence */

$this->breadcrumbs=array(
	'Tag Occurences'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TagOccurence', 'url'=>array('index')),
	array('label'=>'Manage TagOccurence', 'url'=>array('admin')),
);
?>

<h1>Create TagOccurence</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>