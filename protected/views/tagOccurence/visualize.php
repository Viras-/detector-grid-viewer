<?php
/* @var $this TagOccurenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag Occurences',
);

$this->menu=array();
?>

<h1>Visualize tag</h1>

Visualization for tag '<?php echo CHtml::encode($tag_code); ?>'.

<img src="<?php echo $this->createUrl('tagOccurence/visualizeImage', array('tag_code' => $tag_code)); ?>" />
