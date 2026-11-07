<?php

namespace app\controllers;

use app\models\SeleccionProveedor;
use app\models\SeleccionProveedorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * SeleccionProveedorController implements the CRUD actions for SeleccionProveedor model.
 */
class SeleccionProveedorController extends Controller
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
     * Lists all SeleccionProveedor models.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SeleccionProveedorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SeleccionProveedor model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SeleccionProveedor model.
     * Forced save protocol and redirection wizard.
     * @return string|\yii\web\Response
     */
    public function actionCreate($proveedor_id = null)
    {
        $model = new SeleccionProveedor();

        if ($proveedor_id !== null) {
            $model->proveedor_id = $proveedor_id;
        } elseif (isset($_GET['proveedor_id'])) {
            $model->proveedor_id = $_GET['proveedor_id'];
        }

        if ($this->request->isPost) {
            // Cargar los datos del formulario enviados por el usuario
            if ($model->load($this->request->post())) {
                
                // Forzar los cálculos matemáticos en el servidor antes de insertar
                $model->total_puntos = (int)$model->criterio_1 + (int)$model->criterio_2 + (int)$model->criterio_3 + (int)$model->criterio_4 + (int)$model->criterio_5 + (int)$model->criterio_6 + (int)$model->criterio_7;
                
                // GUARDADO DIRECTO: Ignoramos las validaciones locales de Yii2 para forzar la escritura en la BD
                if ($model->save(false)) {
                    
                    // Actualizar el estatus de la empresa en su tabla correspondiente
                    $proveedor = \app\models\Proveedor::findOne($model->proveedor_id);
                    if ($proveedor) {
                        $proveedor->estatus = ($model->total_puntos >= 70) ? 'Aprobado F1' : 'Rechazado F1';
                        $proveedor->save(false); // Forzar actualización de la tabla maestra
                    }
                    
                    // Enrutar al usuario directamente hacia el Paso 2 (FO-02) de forma automática
                    Yii::$app->session->setFlash('success', '✔️ Paso 1 Procesado y Registrado de manera exitosa.');
                    return $this->redirect(['evaluacion-proveedor/create', 'proveedor_id' => $model->proveedor_id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Error crítico interno al procesar el guardado en la base de datos.');
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
     * Updates an existing SeleccionProveedor model.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
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
     * Deletes an existing SeleccionProveedor model.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SeleccionProveedor model based on its primary key value.
     * @param int $id ID
     * @return SeleccionProveedor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeleccionProveedor::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }
}
