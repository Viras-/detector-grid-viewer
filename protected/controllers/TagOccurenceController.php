<?php

class TagOccurenceController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('index', 'view', 'visualize', 'findTag'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new TagOccurence;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TagOccurence'])) {
            $model->attributes = $_POST['TagOccurence'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->tag_occurence_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TagOccurence'])) {
            $model->attributes = $_POST['TagOccurence'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->tag_occurence_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('TagOccurence');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new TagOccurence('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['TagOccurence']))
            $model->attributes = $_GET['TagOccurence'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Visualize occurence info for a given tag id
     * @param string $tag_code code of tag to find
     */
    public function actionVisualize($tag_code) {
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
        $im = imagecreatetruecolor($model_mostRecentTagOccurence->reader->area->width * 50, $model_mostRecentTagOccurence->reader->area->height * 50);
        // fill image background with white
        $color_white = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $color_white);
        
        // draw all occurence records
        $alpha_level = 127 - intval(127 / count($models_tagOccurence));
        $color_red = imagecolorallocatealpha($im, 255, 0, 0, $alpha_level);
        // upper boundary
        foreach( $models_tagOccurence as $model_tagOccurence ) {
            imagefilledellipse($im, $model_tagOccurence->reader->positionX * 50, $model_tagOccurence->reader->positionY * 50, ($model_tagOccurence->strength + 1) * 5 * 50, ($model_tagOccurence->strength + 1) * 5 * 50, $color_red);
        }
        // lower boundary
        foreach( $models_tagOccurence as $model_tagOccurence ) {
            imagefilledellipse($im, $model_tagOccurence->reader->positionX * 50, $model_tagOccurence->reader->positionY * 50, $model_tagOccurence->strength * 5 * 50, $model_tagOccurence->strength * 5 * 50, $color_white);
        }
        
        // draw a green circle for all readers in this area
        $color_green = imagecolorallocate($im, 0, 255, 0);
        foreach( $models_reader as $model_reader ) {
            imagefilledellipse($im, $model_reader->positionX * 50, $model_reader->positionY * 50, 10, 10, $color_green);
        }

        // output image to browser
        header ('Content-Type: image/png');
        imagepng($im);
        imagedestroy($im);
        
        exit(0);
    }

    /**
     * Send tag find request to spread daemon
     * @param string $tag_code code of tag to find
     */
    public function actionFindTag($tag_code) {
        // connect to spread daemon
        $resource = spread_connect(Yii::app()->params['spreadDaemon'], "viewer" . rand(0, 10000), false);

        // send the findTag message for the given tag code
        spread_multicast($resource, "detectorGridClient", "findTag:" . $tag_code);

        // disconnect from spread
        spread_disconnect($resource);

        // go back to index page
        $this->actionIndex();
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
