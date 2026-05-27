<?php

class ReportController extends Controller
{
    public function filters(): array
    {
        return ['accessControl'];
    }

    public function accessRules(): array
    {
        return [
            [
                'allow',
                'actions' => ['years', 'yearTopAuthors'],
                'users' => ['*'],
            ],
            [
                'deny',
                'users' => ['*'],
            ],
        ];
    }

    public function actionYears(): void
    {
        $this->render('years', [
            'years' => Book::getAllAvailableYears(),
        ]);
    }

    public function actionYearTopAuthors($year): void
    {
        $year = (int) $year;
        $this->render('yearTopAuthors', [
            'year' => $year,
            'authors' => Author::getYearTopAuthors($year),
        ]);
    }
}
