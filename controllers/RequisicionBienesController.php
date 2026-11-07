<?php

namespace app\controllers;

use Yii;
use app\models\RequisicionBienes;
use app\models\RequisicionBienesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequisicionBienesController implementa las acciones CRUD para el modelo RequisicionBienes.
 */
class RequisicionBienesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Muestra la lista de requisiciones.
     */
    public function actionIndex()
    {
        $searchModel = new RequisicionBienesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra una sola requisición.
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea una nueva requisición de bienes y servicios (FO-03).
     */
    public function actionCreate($proveedor_id = null)
    {
        $model = new RequisicionBienes();

        if ($proveedor_id !== null) {
            $model->proveedor_id = $proveedor_id;
        } elseif (isset($_GET['proveedor_id'])) {
            $model->proveedor_id = $_GET['proveedor_id'];
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                
                // Forzar estatus por defecto de la requisición según tu base de datos
                $model->estatus_requisicion = 'Solicitado';
                
                // Guardado directo sin restricciones de validación locales
                if ($model->save(false)) {
                    
                    // Actualizar el estatus global del proveedor a "Requisitado FO-03"
                    $proveedor = \app\models\Proveedor::findOne($model->proveedor_id);
                    if ($proveedor) {
                        $proveedor->estatus = 'Requisitado FO-03';
                        $proveedor->save(false);
                    }
                    
                    Yii::$app->session->setFlash('success', '✔️ Paso 3: Requisición de Bienes creada correctamente en el sistema.');
                    
                    // Redireccionar automáticamente de vuelta a la ficha para ver el alta en catálogo
                    return $this->redirect(['proveedor/view', 'id' => $model->proveedor_id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Modifica una requisición existente.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Elimina un registro de requisición.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo RequisicionBienes basado en su llave primaria.
     */
    protected function findModel($id)
    {
        if (($model = RequisicionBienes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página de requisición solicitada no existe.');
    }
}
