<?php

namespace TgSdk;

use GuzzleHttp\Client;
use SleekDB\SleekDB;

/**
 * Class Telegram
 */
class Api
{
    const FORMAT_AUDIO = 'audio';
    const FORMAT_PHOTO = 'photo';
    const FORMAT_DOCUMENT = 'document';
    /**
     * @var
     */
    public $chatId;
    /**
     * @var
     */
    private $token;
    /**
     * @var
     */
    private $apiUrl = 'https://api.telegram.org/bot';

    /**
     * @var Client
     */
    private $client;
    /**
     * @var SleekDB
     */
    private $db;

    /**
     */
    public function __construct()
    {
        $this->client = new Client();
        $this->db = new SleekDB();
    }

    /**
     * @param $message
     * @param string $format html|markdown
     * @param bool $preview
     * @param null $reply_markup
     * @return mixed
     */
    public function sendMessage($message, $format = 'html', $preview = true, $reply_markup = null)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $response = $this->client->get($this->apiUrl . $this->token . '/sendMessage', ['query' => [
                'chat_id' => $this->chatId,
                'parse_mode' => $format,
                'text' => $message,
                'disable_web_page_preview' => $preview,
                'reply_markup' => $reply_markup
            ]]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param $queryId
     * @param null $text
     * @return \Exception|mixed|\Throwable
     */
    public function answerCallback($queryId, $text = null)
    {
        try {
            $response = $this->client->get($this->apiUrl . $this->token . '/answerCallbackQuery', ['query' => [
                'callback_query_id' => $queryId,
                'text' => $text
            ]]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Отправка аудио
     *
     * @param string $audio Ссылка на файл или file_id
     * @param null $message Текст сообщения
     * @param string $format html|markdown
     * @param null $reply_markup
     * @return mixed
     */
    public function sendAudio(string $audio, $message = null, $format = 'html', $reply_markup = null)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query = [
                'chat_id' => $this->chatId,
                'parse_mode' => $format,
                'caption' => $message,
                'audio' => $audio
            ];
            if ($reply_markup) {
                $query['reply_markup'] = $reply_markup;
            }
            $response = $this->client->get($this->apiUrl . $this->token . '/sendAudio', ['query' => $query]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Отправка фото
     *
     * @param string $photo Ссылка на файл или file_id
     * @param null $message Текст сообщения
     * @param string $format html|markdown
     * @param null $reply_markup Клавиатура
     * @return mixed
     */
    public function sendPhoto(string $photo, $message = null, $format = 'html', $reply_markup = null)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query = ['chat_id' => $this->chatId, 'parse_mode' => $format, 'caption' => $message, 'photo' => $photo];
            if ($reply_markup) {
                $query['reply_markup'] = $reply_markup;
            }
            $response = $this->client->get($this->apiUrl . $this->token . '/sendPhoto', ['query' => $query]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Отправка анимации
     *
     * @param string $animation
     * @param null $message Текст сообщения
     * @param string $format html|markdown
     * @param int $width
     * @param int $height
     * @return mixed
     */
    public function sendAnimation(string $animation, $message = null, $format = 'html', $width = 600, $height = 600)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $response = $this->client->get($this->apiUrl . $this->token . '/sendAnimation', ['query' => [
                'chat_id' => $this->chatId,
                'parse_mode' => $format,
                'caption' => $message,
                'animation' => $animation,
                'width' => $width,
                'height' => $height
            ]]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Отправка анимации
     *
     * @param string $video Ссылка на файл
     * @param null $message Текст сообщения
     * @param string $format html|markdown
     * @param int $width
     * @param int $height
     * @return mixed
     */
    public function sendVideo(string $video, $message = null, $format = 'html', $width = 640, $height = 640)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $response = $this->client->get($this->apiUrl . $this->token . '/sendVideo', ['query' => [
                'chat_id' => $this->chatId,
                'parse_mode' => $format,
                'caption' => $message,
                'video' => $video,
                'width' => $width,
                'height' => $height
            ]]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Отправка альбома
     *
     * @param array $media [
     *  'type' => 'audio',
     *  'media' => 'url',
     *  'caption' => '',
     *  'parse_mode' => 'html'
     * ]
     * @return mixed
     */
    public function sendMediaGroup(array $media)
    {
        try {
            $response = $this->client->get($this->apiUrl . $this->token . '/sendMediaGroup', ['query' => [
                'chat_id' => $this->chatId,
                'media' => Json::encode($media)
            ]]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Информация о файле
     *
     * @param $fileId
     * @return mixed
     */
    public function getFile($fileId)
    {
        try {
            $response = $this->client->get($this->apiUrl . $this->token . '/getFile', ['query' => ['file_id' => $fileId]]);
            $data = $response->getBody()->getContents();
            $data = Json::decode($data);

            return ArrayHelper::getValue($data, 'result');
        } catch (\Throwable $e) {
            Yii::error($e, __METHOD__);

            return ['success' => false];
        }
    }

    /**
     * Закрепить сообщение
     *
     * @param $messageId
     * @return false[]|mixed|null
     */
    public function pinChatMessage($messageId)
    {
        try {
            $response = $this->client->get($this->apiUrl . $this->token . '/pinChatMessage', ['query' => [
                'chat_id' => $this->chatId, 'message_id' => $messageId
            ]]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Открепить сообщение
     *
     * @param null $messageId ID сообщения, которое нужно открепить, если не передано, то будет откреплено самое последнее.
     * @return false[]|mixed|null
     */
    public function unpinChatMessage($messageId = null)
    {
        try {
            $query = ['chat_id' => $this->chatId];
            if ($messageId) {
                $query['message_id'] = $messageId;
            }
            $response = $this->client->get($this->apiUrl . $this->token . '/unpinChatMessage', ['query' => $query]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Массив фотографий пользователя
     *
     * @param $userId
     * @param null $offset
     * @param null $limit
     * @return array
     */
    public function getUserProfilePhotos($userId, $limit = null, $offset = null)
    {
        try {
            $query = ['user_id' => $userId];
            if ($offset) {
                $query['offset'] = $offset;
            }
            if ($limit) {
                $query['limit'] = $limit;
            }
            $response = $this->client->get($this->apiUrl . $this->token . '/getUserProfilePhotos', ['query' => $query]);
            $data = $response->getBody()->getContents();
            $data = Json::decode($data);

            return ArrayHelper::getValue($data, 'result.photos', []);
        } catch (\Throwable $e) {
            Yii::error($e, __METHOD__);

            return ['success' => false];
        }
    }

    /**
     * Удаление сообщения
     *
     * @param string $userId
     * @param string $messageId
     * @return false[]|mixed|null
     */
    public function deleteMessage(string $userId, string $messageId)
    {
        try {
            $response = $this->client->get($this->apiUrl . $this->token . '/deleteMessage', ['query' => [
                'chat_id' => $userId,
                'message_id' => $messageId
            ]]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
