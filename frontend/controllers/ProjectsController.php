<?php

namespace frontend\controllers;

use Yii;
use common\models\Projects;
use frontend\models\ProjectsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\EncryptHelper;
use common\models\ProjectsVisitor;
use common\models\ProjectMsg;
use yii\filters\AccessControl;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
{
    public $layout = 'user';
    public function init(){
        $this->enableCsrfValidation = false;
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view','show','info','create','upload','update','save-visitor','save-msg','delete'],
                'rules' => [
                    [
                        'actions' => ['info','show','save-visitor','save-msg'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','view','create','upload','update','delete','info','show','save-visitor','save-msg'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $project_ids = $dataProvider->keys;
        $data = ProjectMsg::find()->select(['project_id','count(*) as cou'])->where(['project_id'=>$project_ids])->groupBy('project_id')->asArray()->all();
        foreach ($project_ids as $e){
            $msg_data[$e]['cou'] = 0;
        }
        if ($data){
            foreach ($data as $d){
                $msg_data[$d['project_id']]['cou'] = number_format($d['cou'],0);
            }
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'msg_data' => $msg_data
        ]);
    }

    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $invite_url = Yii::$app->params['web_url']."/projects/info?";
        $encrypt_key = Yii::$app->params['encrypt_key'];
        $key_value = EncryptHelper::encrypt_str("id=".$id, $encrypt_key);
        $invite_url .= $key_value;
        return $this->render('view', [
            'model' => $this->findModel($id),
            'url' => $invite_url,
            'key_value' => $key_value
        ]);
    }
    
    public function actionShow(){
        $data = Yii::$app->request->get();
        $str = '';
        if ($data && count($data) ==1){
            $key = Yii::$app->params['encrypt_key'];
            foreach ($data as $k=>$v){
                $str = $k;
            }
            $value = EncryptHelper::geturl($str, $key);
            if ($value && isset($value['id']) && intval($value['id'])>0){
                $Projects = new Projects();
                if(!isset($_COOKIE["visited".$value['id']])){
                    $Projects->updateAllCounters(['hit'=>1],"id = '".$value['id']."'");
                    setcookie('visited'.$value['id'], $value['id'], time()+3600*24*30);
                }
                
                $this->layout = false;
                return $this->render('show', [
                    'model' => $this->findModel($value['id']),
                    'key_value' => $str,
                ]);
            }
            else{
                die('URL Error,Please check.');
            }
        }
    }
    
    public function actionInfo(){
        $data = Yii::$app->request->get();
        $str = '';
        if ($data && count($data) ==1){
            $key = Yii::$app->params['encrypt_key'];
            foreach ($data as $k=>$v){
                $str = $k;
            }
            $value = EncryptHelper::geturl($str, $key);
            if ($value && isset($value['id']) && intval($value['id'])>0){
                $this->layout = false;
                return $this->render('info', [
                        'model' => $this->findModel($value['id']),
                        'key_value' => $str,
                    ]);
            }
            else{
                die('URL Error,Please check.');
            }
        }
    }
    
    

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();
        if (Yii::$app->request->post()){
            $data = Yii::$app->request->post();
            $data['Projects']['status'] = 1;
            $data['Projects']['user_id'] = Yii::$app->getUser()->id;
            $model = new Projects();
            $res = $model->addProject($data);
            if ($model->load($data) && $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
            return $this->render('create', [
                'model' => $model,
            ]);
    }
    
    public function actionUpload(){
        if($_FILES["file"]["error"] > 0){
            $data = ['error'=>'1','msg'=>'Image Upload Fail,Please reupload.','info'=>''];
            echo json_encode($data);die;
        }
        $filepath = "./upload";
        !is_dir($filepath) && mkdir($filepath, 0777, true);
        $arr=explode(".", $_FILES["file"]["name"]);
        $hz=strtolower($arr[count($arr)-1]);
        $randname = date("Y").date("m").date("d").date("H").date("i").date("s").rand(1000, 9999).".".$hz;
        if(is_uploaded_file($_FILES["file"]["tmp_name"])){      //将临时位置的文件移动到指定的目录上即可
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath.'/'.$randname)){
                $excelFile = $filepath.'/'.$randname;       //上传成功的节奏
//                 chmod($excelFile, 0777);
            }
        }
        if(!$excelFile){        //文件不存在
            $data = ['error'=>'2','msg'=>'Image Upload Fail,Please reupload.','info'=>''];
        }else{
            $data = [
                        'error'=>0,
                        'msg' => 'Upload Success',
                        'info' => ltrim($excelFile,'.'),
            ];
        }
        echo json_encode($data);
    }
    
    public function actionSaveVisitor(){
        $data = Yii::$app->request->post();
        $key = Yii::$app->params['encrypt_key'];
        $value = EncryptHelper::geturl($data['key'], $key);
        if (!$value){
            echo json_encode(['error'=>1,'msg'=>'Save Error,Please Try Again.']);
            die;
        }
        $ProjectMsg = new ProjectMsg();
        $project = new Projects();
        $info = $project->find()->where(['id'=>$value['id']])->asArray()->one();
        if (!$info){
            echo json_encode(['error'=>1,'msg'=>'Save Error,Please Try Again.']);
            die;
        }
        $res = $ProjectMsg->addMsg(['name'=>$data['name'],'tel'=>$data['phone'],'project_id'=>$value['id'],'msg'=>'','user_id'=>$info['user_id']]);
        if ($res){
            $invite_url = Yii::$app->params['web_url']."/projects/show?".$data['key'];
            echo json_encode(['error'=>0,'msg'=>'Save Success.','info'=>$invite_url]);
            die; 
        }
            echo json_encode(['error'=>1,'msg'=>'Save Error,Please Try Again.']);
            die;
    }
    
    public function actionSaveMsg(){
        $data = Yii::$app->request->post();
        $key = Yii::$app->params['encrypt_key'];
        $value = EncryptHelper::geturl($data['key'], $key);
        if (!$value){
            echo json_encode(['error'=>1,'msg'=>'Save Error,Please Try Again.']);
            die;
        }
        $ProjectMsg = new ProjectMsg();
        $project = new Projects();
        $info = $project->find()->where(['id'=>$value['id']])->asArray()->one();
        if (!$info){
            echo json_encode(['error'=>1,'msg'=>'Save Error,Please Try Again.']);
            die;
        }
        $res = $ProjectMsg->addMsg(['name'=>$data['name'],'tel'=>$data['phone'],'project_id'=>$value['id'],'msg'=>$data['msg'],'user_id'=>$info['user_id']]);
        if ($res){
            echo json_encode(['error'=>0,'msg'=>'Save Success.','info'=>'']);
            die; 
        }
            echo json_encode(['error'=>1,'msg'=>'Save Error,Please Try Again.']);
            die;
    }
    
    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $encrypt_key = Yii::$app->params['encrypt_key'];
        $key_value = EncryptHelper::encrypt_str("id=".$id, $encrypt_key);
        $invite_url = Yii::$app->params['web_url']."/projects/info?";
        $invite_url .= $key_value;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'url' => $invite_url,
                'key_value' => $key_value
            ]);
        }
    }

    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        
        ProjectMsg::deleteAll(['project_id'=>$id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
