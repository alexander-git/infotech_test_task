<?php

class BookController extends Controller
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
                'actions' => ['create', 'update',  'delete'],
                'users' => ['@'],
            ],
            ['deny', 'users' => ['*']],
        ];
    }

    public function actionIndex(): void
    {
        $model = new Book('search');
        $model->unsetAttributes();
        if (isset($_GET['Book'])) {
            $model->attributes = $_GET['Book'];
        }

        $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionView(int $id): void
    {
        $this->render('view', ['model' => $this->loadModel($id)]);
    }

    public function actionCreate(): void
    {
        $model = new Book();
        if (isset($_POST['Book'])) {
            $model->scenario = Book::SCENARIO_SAVE_WITH_AUTHORS;
            $model->attributes = $_POST['Book'];
            if ($model->saveWithAuthors()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('create', [
            'model' => $model,
            'allAuthors' => Author::getAllAuthors(),
        ]);
    }

    public function actionUpdate(int $id): void
    {
        $model = $this->loadModel($id);
        $model->authorIds = array_map(static fn(Author $author): int => $author->id, $model->authors);

        if (isset($_POST['Book'])) {
            $model->scenario = Book::SCENARIO_SAVE_WITH_AUTHORS;
            $model->attributes = $_POST['Book'];
            if ($model->saveWithAuthors()) {
                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('update', [
            'model' => $model,
            'allAuthors' => Author::getAllAuthors(),
        ]);
    }

    public function actionDelete(int $id): void
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['admin']);
        }
    }

    /**
     * @throws CHttpException
     */
    public function loadModel(int $id): Book
    {
        $model = Book::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}
