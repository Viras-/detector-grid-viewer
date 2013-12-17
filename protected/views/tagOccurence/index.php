<?php
/* @var $this TagOccurenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag Occurences',
);

$this->menu=array(
	array('label'=>'Create TagOccurence', 'url'=>array('create')),
	array('label'=>'Manage TagOccurence', 'url'=>array('admin')),
);
?>

<h1>Tag Occurences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
