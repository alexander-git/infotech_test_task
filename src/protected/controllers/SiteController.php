<?php

class SiteController extends Controller
{
	public function actionIndex(): void
	{
		$this->render('index');
	}

	public function actionError(): void
	{
		if ($error=Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
		}
	}

	public function actionLogin(): void
	{
		$model = new LoginForm();

		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['LoginForm'])) {
			$model->attributes=$_POST['LoginForm'];
			if($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
		}

		$this->render('login',array('model'=>$model));
	}

	public function actionLogout(): void
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
