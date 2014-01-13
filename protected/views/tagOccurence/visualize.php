<?php
/* @var $this TagOccurenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag Occurences',
);

$this->menu=array();
?>

<h1>Visualization for tag '<?php echo CHtml::encode($tag_code); ?>'</h1>

<div>
    <img style="border: 1px solid #000000;" src="<?php echo $this->createUrl('tagOccurence/visualizeImage', array('tag_code' => $tag_code)); ?>" />
</div>
