<?php

class NotifyService
{
    public static function notifySubscribersAboutNewBook(int $bookId): void
    {
        $book = Book::model()->findByPk($bookId);
        // Тут можно сделать более сложную логику, показывающую в сообщении имя автора появившейся книги.
        // В этом случае нужно учитывать, что книга может быть от нескольких авторов и подписчик в свою очередь может
        // подписан на нескольких авторов.Отправлять нужно будет только одну sms на подписчика, а не несколько sms
        // для каждого автора на которого подписан подписчик.
        $phones = Subscription::getPhonesByBookId($bookId);
        $message = "Появилась новая книга - {$book->title}";
        foreach ($phones as $phone) {
            Yii::app()->smsSender->send($phone, $message);
        }
    }
}
