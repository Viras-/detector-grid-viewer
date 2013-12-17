<?php
/* @var $this TagOccurenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tag Occurences',
);

$this->menu=array(
);
?>

<h1>Tag Occurence visualization</h1>

<div style="height: 1000px;">
<?php
$offset = 250;
foreach( $models_tagOccurence as $model_tagOccurence ) {
    // draw the inner and the outer circle
    for( $i = $model_tagOccurence->strength; $i <= $model_tagOccurence->strength + 1; $i++ ) {
        $width = ($i) * 5 * 50;
        $height = $width;
        $top = $offset + intval($model_tagOccurence->reader->positionY * 50 - ($height / 2));
        $left = $offset * 2 + intval($model_tagOccurence->reader->positionX * 50 - ($height / 2));
        $radius = intval($width / 2);
        ?>
        <div style="font-size: 20px; font-weight: bold; text-align: center; border-radius: <?php echo $radius; ?>px; -moz-border-radius: <?php echo $radius; ?>px; height: <?php echo $height; ?>px; width: <?php echo $width;?>px; border: 1px solid #FF0000; position: absolute; top: <?php echo $top; ?>px; left: <?php echo $left; ?>px;" id="<?php echo $model_tagOccurence->tag_occurence_id; ?>"><?php echo $model_tagOccurence->reader_id; ?></div>
        <?php
    }
}
?>
</div>