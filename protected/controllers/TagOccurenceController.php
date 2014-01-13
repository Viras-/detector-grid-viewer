<?php

class TagOccurenceController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    
    /**
     * Change default action to 'search'
     * @var string
     */
    public $defaultAction = 'search';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('visualize', 'findTag', 'visualizeImage', 'search'),
                'users' => array('*'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    /**
     * Display a search form for tag(s)
     */
    public function actionSearch() {
        $this->render('search');
    }

    /**
     * Display page for visualizing a given tag
     * @param type $tag_code
     */
    public function actionVisualize($tag_code) {
        $this->render('visualize', array(
            'tag_code' => $tag_code,
        ));
    }

    /**
     * Visualize occurence info for a given tag id
     * @param string $tag_code code of tag to find
     */
    public function actionVisualizeImage($tag_code) {
        // find most recent tag occurence
        $dbCriteria = new CDbCriteria();
        $dbCriteria->order = "timestamp ASC";
        $dbCriteria->limit = 1;
        $dbCriteria->compare('oid', $tag_code);
        $model_mostRecentTagOccurence = TagOccurence::model()->find($dbCriteria);
        
        // find all entries from the most recent area
        $dbCriteria = new CDbCriteria();
        $dbCriteria->with = array('reader');
        $dbCriteria->compare('reader.area_id', $model_mostRecentTagOccurence->reader->area_id);
        $models_tagOccurence = TagOccurence::model()->findAll($dbCriteria);
        
        // find all readers in the given area
        $models_reader = Reader::model()->findAllByAttributes(array(
            'area_id' => $model_mostRecentTagOccurence->reader->area_id,
        ));
        
        // create the basic image
        $im = imagecreatetruecolor($model_mostRecentTagOccurence->reader->area->width * Yii::app()->params['pixelsPerMeter'], $model_mostRecentTagOccurence->reader->area->height * Yii::app()->params['pixelsPerMeter']);
        // fill image background with white
        $color_white = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $color_white);
        
        // draw all occurence records
        $alpha_level = 127 - intval(127 / count($models_tagOccurence));
        $color_red = imagecolorallocatealpha($im, 255, 0, 0, $alpha_level);
        // upper boundary
        foreach( $models_tagOccurence as $model_tagOccurence ) {
            imagefilledellipse($im, $model_tagOccurence->reader->positionX * Yii::app()->params['pixelsPerMeter'], $model_tagOccurence->reader->positionY * Yii::app()->params['pixelsPerMeter'], ($model_tagOccurence->strength + 1) * 5 * Yii::app()->params['pixelsPerMeter'], ($model_tagOccurence->strength + 1) * 5 * Yii::app()->params['pixelsPerMeter'], $color_red);
        }
        // lower boundary
        foreach( $models_tagOccurence as $model_tagOccurence ) {
            imagefilledellipse($im, $model_tagOccurence->reader->positionX * Yii::app()->params['pixelsPerMeter'], $model_tagOccurence->reader->positionY * Yii::app()->params['pixelsPerMeter'], $model_tagOccurence->strength * 5 * Yii::app()->params['pixelsPerMeter'], $model_tagOccurence->strength * 5 * Yii::app()->params['pixelsPerMeter'], $color_white);
        }
        
        // draw a green circle for all readers in this area
        $color_green = imagecolorallocate($im, 0, 255, 0);
        foreach( $models_reader as $model_reader ) {
            imagefilledellipse($im, $model_reader->positionX * Yii::app()->params['pixelsPerMeter'], $model_reader->positionY * Yii::app()->params['pixelsPerMeter'], 10, 10, $color_green);
        }

        // output image to browser
        header ('Content-Type: image/png');
        imagepng($im);
        imagedestroy($im);
        
        exit(0);
    }

    /**
     * Send tag find request to spread daemon
     */
    public function actionFindTag() {
        $tag_code = $_POST['tag_code'];
        
        // connect to spread daemon
        $resource = spread_connect(Yii::app()->params['spreadDaemon'], "viewer" . rand(0, 10000), false);

        // send the findTag message for the given tag code
        spread_multicast($resource, "detectorGridClient", "findTag:" . $tag_code);

        // disconnect from spread
        spread_disconnect($resource);
        
        // render redirect page to visualization
        $this->render('findTag', array(
            'tag_code' => $tag_code,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return TagOccurence the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = TagOccurence::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param TagOccurence $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tag-occurence-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
