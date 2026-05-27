<?php

class AuthorController extends Controller
{
     public $layout = '//layouts/column2';


    public function filters(): array
    {
        return [
            'accessControl',
            'postOnly + delete',
        ];
    }

    public function accessRules(): array
    {
        return [
            [
                'allow',
                'actions' => ['index', 'view'],
                'users' => ['*'],
            ],
            [
                'allow',
                'actions' => ['create', 'update', 'delete'],
                'users' => ['@'],
            ],
            [
                'deny',
                'users' => ['*'],
            ],
        ];
    }

    public function actionIndex(): void
    {
        $model = new Author('search');
        $model->unsetAttributes();
        if (isset($_GET['Author'])) {
            $model->attributes = $_GET['Author'];
        }

        $this->render('index', ['model' => $model]);
    }

    public function actionView(int $id): void
    {
        $canSubscribe = Yii::app()->user->isGuest;
        $author = $this->loadModel($id);
        $subscription = new Subscription();
        if ($canSubscribe && isset($_POST['Subscription'])) {
            $subscription->attributes = $_POST['Subscription'];
            $subscription->author_id = $author->id;
            if ($subscription->save()) {
                Yii::app()->user->setFlash('success', 'Подписка оформлена');
                $this->refresh();
            }
        }

        $this->render('view', [
            'author' => $author,
            'subscription' => $subscription,
        ]);
    }

    public function actionCreate(): void
    {
        $model = new Author();
        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id): void
    {
        $model = $this->loadModel($id);
        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('update', ['model' => $model]);
    }

    public function actionDelete(int $id): void
    {
        $this->loadModel($id)->delete();
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        }
    }

    /**
     * @throws CHttpException
     */
    public function loadModel(int $id): Author
    {
        $model = Author::model()->with('books')->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}