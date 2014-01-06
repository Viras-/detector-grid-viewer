<?php
/* @var $this TagOccurenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag Occurences',
);

$this->menu=array();
?>

<h1>Find a tag</h1>

Searching for tag '<?php echo CHtml::encode($tag_code); ?>' - please be patient. Redirecting in 5 seconds.

<script type="text/javascript">
    window.setTimeout("window.location = '<?php echo $this->createUrl('tagOccurence/visualize', array('tag_code' => $tag_code)); ?>';", 5000);
</script>
