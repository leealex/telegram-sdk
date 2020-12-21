<?php

namespace TgSdk;

use GuzzleHttp\Client;
use SleekDB\SleekDB;

/**
 * Class Telegram API
 */
class Api
{
    const API_URL = 'https://api.telegram.org/bot';
    /**
     * @var
     */
    protected $chatId;
    /**
     * @var
     */
    protected $token;
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var SleekDB
     */
    protected $db;


    /**
     * @param $action
     * @return \Exception|mixed|\Throwable
     */
    public function sendChatAction($action)
    {
        try {
            $response = $this->get('sendChatAction', ['action' => $action]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
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
            $response = $this->get('sendMessage', [
                'parse_mode' => $format,
                'text' => $message,
                'disable_web_page_preview' => $preview,
                'reply_markup' => $reply_markup
            ]);
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
            $response = $this->get('answerCallbackQuery', [
                'callback_query_id' => $queryId,
                'text' => $text
            ]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param string $audio
     * @param null $message
     * @param string $format
     * @param null $reply_markup
     * @return \Exception|mixed|\Throwable
     */
    public function sendAudio(string $audio, $message = null, $format = 'html', $reply_markup = null)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query = ['parse_mode' => $format, 'caption' => $message, 'audio' => $audio];
            if ($reply_markup) {
                $query['reply_markup'] = $reply_markup;
            }
            $response = $this->get('sendAudio', $query);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param string $photo
     * @param null $message
     * @param string $format
     * @param null $reply_markup
     * @return \Exception|mixed|\Throwable
     */
    public function sendPhoto(string $photo, $message = null, $format = 'html', $reply_markup = null)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query = ['parse_mode' => $format, 'caption' => $message, 'photo' => $photo];
            if ($reply_markup) {
                $query['reply_markup'] = $reply_markup;
            }
            $response = $this->get('sendPhoto', $query);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param string $animation
     * @param null $message
     * @param string $format
     * @param int $width
     * @param int $height
     * @return \Exception|mixed|\Throwable
     */
    public function sendAnimation(string $animation, $message = null, $format = 'html', $width = 600, $height = 600)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $response = $this->get('sendAnimation', [
                'parse_mode' => $format,
                'caption' => $message,
                'animation' => $animation,
                'width' => $width,
                'height' => $height
            ]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param string $video
     * @param null $message
     * @param string $format
     * @param int $width
     * @param int $height
     * @return \Exception|mixed|\Throwable
     */
    public function sendVideo(string $video, $message = null, $format = 'html', $width = 640, $height = 640)
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $response = $this->get('sendVideo', [
                'parse_mode' => $format,
                'caption' => $message,
                'video' => $video,
                'width' => $width,
                'height' => $height
            ]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Send media group
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
            $response = $this->get('sendMediaGroup', ['media' => json_encode($media)]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param $fileId
     * @return false[]
     */
    public function getFile($fileId)
    {
        try {
            $response = $this->get('getFile', ['file_id' => $fileId]);
            $data = $response->getBody()->getContents();
            $data = json_decode($data, true);

            return ArrayHelper::getValue($data, 'result');
        } catch (\Throwable $e) {
            Yii::error($e, __METHOD__);

            return ['success' => false];
        }
    }

    /**
     * @param $messageId
     * @return \Exception|mixed|\Throwable
     */
    public function pinChatMessage($messageId)
    {
        try {
            $response = $this->get('pinChatMessage', ['message_id' => $messageId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param null $messageId
     * @return \Exception|mixed|\Throwable
     */
    public function unpinChatMessage($messageId = null)
    {
        try {
            $response = $this->get('unpinChatMessage', ['message_id' => $messageId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param $userId
     * @param null $limit
     * @param null $offset
     * @return \Exception|\Throwable
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
            $response = $this->get('getUserProfilePhotos', $query);
            $data = $response->getBody()->getContents();

            return json_decode($data);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * @param string $userId
     * @param string $messageId
     * @return \Exception|mixed|\Throwable
     */
    public function deleteMessage(string $userId, string $messageId)
    {
        try {
            $response = $this->get('deleteMessage', ['message_id' => $messageId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return $e;
        }
    }

    /**
     * Making GET request
     * @param $uri
     * @param array $query
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function get($uri, $query = [])
    {
        $query = array_merge(['chat_id' => $this->chatId], $query);

        return $this->client->get(self::API_URL . $this->token . '/' . $uri, ['query' => $query]);
    }
}
