<?php

class m260526_152457_seed_books_and_authors extends CDbMigration
{
    public function up()
    {
        $names = [
            'Иван',
            'Пётр',
            'Александр',
            'Сергей',
            'Дмитрий',
            'Андрей',
            'Михаил',
            'Алексей',
            'Николай',
            'Владимир',
            'Евгений',
            'Максим',
            'Виктор',
            'Юрий',
            'Олег',
            'Антон',
            'Павел',
            'Игорь',
            'Кирилл',
            'Роман',
            'Константин',
            'Денис',
            'Валерий',
            'Фёдор',
            'Аркадий',
            'Борис',
            'Степан',
            'Григорий',
            'Леонид',
            'Василий',
        ];

        $surnames = [
            'Иванов',
            'Петров',
            'Сидоров',
            'Смирнов',
            'Кузнецов',
            'Попов',
            'Волков',
            'Фёдоров',
            'Морозов',
            'Новиков',
            'Алексеев',
            'Лебедев',
            'Семёнов',
            'Егоров',
            'Павлов',
            'Козлов',
            'Степанов',
            'Николаев',
            'Орлов',
            'Андреев',
            'Макаров',
            'Захаров',
            'Белов',
            'Гусев',
            'Тихонов',
            'Комаров',
            'Соловьёв',
            'Михайлов',
            'Баранов',
            'Яковлев',
        ];

        $patronymics = [
            'Александрович',
            'Сергеевич',
            'Петрович',
            'Иванович',
            'Дмитриевич',
            'Владимирович',
            'Николаевич',
            'Андреевич',
            'Михайлович',
            'Евгеньевич',
            'Викторович',
            'Юрьевич',
            'Олегович',
            'Павлович',
            'Константинович',
            'Романович',
            'Васильевич',
            'Фёдорович',
            'Григорьевич',
            'Борисович',
        ];

        for ($i = 0; $i < 30; $i++) {
            $this->insert('author', [
                'name' => $names[$i],
                'surname' => $surnames[$i],
                'patronymic' =>  $patronymics[array_rand($patronymics)],
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {
            $this->insert('book', [
                'title' => "Книга {$i}",
                'year' => rand(2000, 2026),
                'isbn' => sprintf(
                    '%03d-%d-%05d-%d',
                    rand(100, 999),
                    rand(1, 9),
                    rand(10000, 99999),
                    rand(1, 9)
                ),
                'description' => "Описание книги {$i}",
                'main_page_photo_url' => "https://picsum.photos/seed/book{$i}/600/800",
            ]);
        }

        $authorIds = Yii::app()->db->createCommand()
            ->select('id')
            ->from('author')
            ->queryColumn();

        $bookIds = Yii::app()->db->createCommand()
            ->select('id')
            ->from('book')
            ->queryColumn();

        foreach ($bookIds as $bookId) {
            $authorsCount = rand(1, 3);

            $randomKeys = array_rand($authorIds, min($authorsCount, count($authorIds)));
            if (!is_array($randomKeys)) {
                $randomKeys = [$randomKeys];
            }

            foreach ($randomKeys as $key) {
                $this->insert('book_author', [
                    'book_id' => $bookId,
                    'author_id' => $authorIds[$key],
                ]);
            }
        }
    }

    public function down()
    {
        $this->delete('book_author');
        $this->delete('book');
        $this->delete('author');
    }
}
