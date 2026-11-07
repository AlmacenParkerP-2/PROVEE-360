<?php

namespace app\controllers;

use Yii;
use app\models\EvaluacionProveedor;
use app\models\EvaluacionProveedorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EvaluacionProveedorController implementa las acciones CRUD para el modelo EvaluacionProveedor.
 */
class EvaluacionProveedorController extends Controller
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
     * Muestra la lista de todas las evaluaciones de desempeño.
     */
    public function actionIndex()
    {
        $searchModel = new EvaluacionProveedorSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra el detalle de una sola evaluación de desempeño.
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo registro del Formato de Evaluación de Desempeño (FO-02).
     */
    public function actionCreate($proveedor_id = null)
    {
        $model = new EvaluacionProveedor();

        if ($proveedor_id !== null) {
            $model->proveedor_id = $proveedor_id;
        } elseif (isset($_GET['proveedor_id'])) {
            $model->proveedor_id = $_GET['proveedor_id'];
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                
                // Cálculo estricto usando las columnas reales detectadas en tu base de datos
                $model->total_puntos = (int)$model->criterio_1 + (int)$model->criterio_2;
                
                // Guardado directo forzado en MySQL sin la propiedad ficticia dictamen
                if ($model->save(false)) {
                    
                    // Actualizar el estatus general en la tabla maestra de proveedores
                    $proveedor = \app\models\Proveedor::findOne($model->proveedor_id);
                    if ($proveedor) {
                        $proveedor->estatus = 'Evaluado FO-02';
                        $proveedor->save(false);
                    }
                    
                    Yii::$app->session->setFlash('success', '✔️ Paso 2: Evaluación de Desempeño registrada correctamente.');
                    
                    // Redireccionar de vuelta al perfil del proveedor para liberar el Paso 3
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
     * Modifica una evaluación de desempeño existente.
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
     * Elimina un registro de evaluación de desempeño.
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo EvaluacionProveedor basado en su llave primaria.
     */
    protected function findModel($id)
    {
        if (($model = EvaluacionProveedor::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página de evaluación solicitada no existe.');
    }
}
