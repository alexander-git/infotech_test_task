<?php

class SmsSender extends CApplicationComponent
{
    public string $apiUrl = 'https://smspilot.ru/api.php';
    public string $apiKey = '';

    public bool $emulateRequest = true;


    public function send(string $phone, string $message): bool
    {
        $query = http_build_query([
            'send' => $message,
            'to' => $phone,
            'apikey' => $this->apiKey,
            'test' => $this->emulateRequest ? 1 : 0,
        ]);

        $url = $this->apiUrl . '?' . $query;
        $streamContext = stream_context_create(['http' => ['timeout' => 5]]);
        $response = file_get_contents($url, false, $streamContext);
        if ($response === false) {
            $error = error_get_last();
            $errorMessage = $error['message'] ?? 'неизвестная ошибка';
            Yii::log("Не удалось отправить SMS:  $errorMessage", CLogger::LEVEL_ERROR);
            return false;
        }

        if (strpos($response, 'ERROR') === 0) {
            Yii::log("Ошибка при отправке SMS: $response", CLogger::LEVEL_ERROR);
            return false;
        }

        return true;
    }
}
