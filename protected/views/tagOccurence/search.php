<?php
/* @var $this TagOccurenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag Occurences',
);

$this->menu=array();
?>

<h1>Search for a tag</h1>

Enter the code of the tag you want to search for.

<div class="form">
    <form action="<?php echo $this->createUrl('tagOccurence/findTag') ?>" method="POST">
        <div class="row">
            <?php echo CHtml::label('Tag Code', 'tag_code'); ?>
            <?php echo CHtml::textField('tag_code'); ?>
        </div>
        
        <div class="row">
            <?php echo CHtml::submitButton(); ?>
        </div>
    </form>
</div>