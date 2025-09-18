<?php

namespace leealex\telegram;

use GuzzleHttp\Client;
use SleekDB\Store;

/**
 * Class Api
 * @package leealex\telegram
 */
class Api
{
    /**
     * Telegram API URI
     */
    const API_URL = 'https://api.telegram.org/bot';
    /**
     * @var integer
     */
    public $chatId;
    /**
     * @var int
     */
    public $threadId;
    /**
     * @var string
     */
    protected $token;
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var Store
     */
    protected $db;

    /**
     * @param $action
     * @return array
     */
    public function sendChatAction($action): array
    {
        try {
            $response = $this->get('sendChatAction', ['action' => $action]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $message
     * @param string $format html|markdown
     * @param bool $preview
     * @param null $replyMarkup
     * @param null $replyTo
     * @return array
     */
    public function sendMessage($message, string $format = 'html', bool $preview = true, $replyMarkup = null, $replyTo = null): array
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $response = $this->get('sendMessage', [
                'parse_mode' => $format,
                'text' => $message,
                'disable_web_page_preview' => $preview,
                'reply_markup' => $replyMarkup,
                'reply_to_message_id' => $replyTo
            ]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|string $fromChatId Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param int $messageId Message identifier in the chat specified in from_chat_id
     * @param int|null $messageThreadId Unique identifier for the target message thread (topic) of the forum; for forum supergroups only
     * @return array|mixed
     */
    public function forwardMessage($chatId, $fromChatId, int $messageId, int $messageThreadId = null)
    {
        try {
            $query = [
                'chat_id'      => $chatId,
                'from_chat_id' => $fromChatId,
                'message_id'   => $messageId,
            ];

            if (!empty($messageThreadId)) {
                $query['message_thread_id'] = $messageThreadId;
            }

            $response = $this->get('forwardMessage', $query);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $queryId
     * @param null $text
     * @return array
     */
    public function answerCallback($queryId, $text = null): array
    {
        try {
            $response = $this->get('answerCallbackQuery', [
                'callback_query_id' => $queryId,
                'text' => $text
            ]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param string $audio
     * @param null $message
     * @param string $format
     * @param string $replyMarkup
     * @return array
     */
    public function sendAudio(string $audio, $message = null, $format = 'html', $replyMarkup = null): array
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query = ['parse_mode' => $format, 'caption' => $message, 'audio' => $audio];
            if ($replyMarkup) {
                $query['reply_markup'] = $replyMarkup;
            }
            $response = $this->get('sendAudio', $query);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param string $photo
     * @param null $message
     * @param string $format
     * @param string $replyMarkup
     * @return array
     */
    public function sendPhoto(string $photo, $message = null, $format = 'html', $replyMarkup = null): array
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query = ['parse_mode' => $format, 'caption' => $message, 'photo' => $photo];
            if ($replyMarkup) {
                $query['reply_markup'] = $replyMarkup;
            }
            $response = $this->get('sendPhoto', $query);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param string $animation
     * @param null $message
     * @param string $format
     * @param int $width
     * @param int $height
     * @param string $replyMarkup
     * @return array
     */
    public function sendAnimation(string $animation, $message = null, $format = 'html', $width = 600, $height = 600, $replyMarkup = null): array
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query = [
                'parse_mode' => $format,
                'caption' => $message,
                'animation' => $animation,
                'width' => $width,
                'height' => $height
            ];

            if ($replyMarkup) {
                $query['reply_markup'] = $replyMarkup;
            }

            $response = $this->get('sendAnimation', $query);

            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param string $video
     * @param null $message
     * @param string $format
     * @param int $width
     * @param int $height
     * @param string $replyMarkup
     * @return array
     */
    public function sendVideo(string $video, $message = null, $format = 'html', $width = 640, $height = 640, $replyMarkup = null): array
    {
        try {
            if (is_array($message)) {
                $message = implode("\n", $message);
            }
            $query =[
                'parse_mode' => $format,
                'caption' => $message,
                'video' => $video,
                'width' => $width,
                'height' => $height
            ];

            if ($replyMarkup) {
                $query['reply_markup'] = $replyMarkup;
            }

            $response = $this->get('sendVideo', $query);

            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
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
     * @return array
     */
    public function sendMediaGroup(array $media): array
    {
        try {
            $response = $this->get('sendMediaGroup', ['media' => json_encode($media)]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * Send Poll
     *
     * @param string $question Poll question, 1-300 characters
     * @param array $options List of poll options
     * @param bool $isAnonymous If the poll is anonymous
     * @return array
     */
    public function sendPoll(string $question, array $options, bool $isAnonymous = false): array
    {
        try {
            $response = $this->get('sendPoll', [
                'question' => $question,
                'options' => json_encode($options),
                'is_anonymous' => $isAnonymous
            ]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param integer $messageId Identifier of the original message with the poll
     * @return array
     */
    public function stopPoll(int $messageId): array
    {
        try {
            $response = $this->get('stopPoll', ['message_id' => $messageId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $sticker
     * @param $replyToMessageId
     * @return array
     */
    public function sendSticker($sticker, $replyToMessageId = null): array
    {
        try {
            $response = $this->get('sendSticker', [
                'sticker' => $sticker,
                'reply_to_message_id' => $replyToMessageId
            ]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }
    /**
     * @param $fileId
     * @return array
     */
    public function getFile($fileId): array
    {
        try {
            $response = $this->get('getFile', ['file_id' => $fileId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $messageId
     * @return array
     */
    public function pinChatMessage($messageId): array
    {
        try {
            $response = $this->get('pinChatMessage', ['message_id' => $messageId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param null $messageId
     * @return array
     */
    public function unpinChatMessage($messageId = null): array
    {
        try {
            $response = $this->get('unpinChatMessage', ['message_id' => $messageId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @return array
     */
    public function unpinAllChatMessage(): array
    {
        try {
            $response = $this->get('unpinAllChatMessages');
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $userId
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function getUserProfilePhotos($userId, $limit = null, $offset = null): array
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
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param string $messageId
     * @return array
     */
    public function deleteMessage(string $messageId): array
    {
        try {
            $response = $this->get('deleteMessage', ['message_id' => $messageId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $chatId
     * @return array
     */
    public function getChat($chatId): array
    {
        try {
            $response = $this->get('getChat', ['chat_id' => $chatId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $chatId
     * @param $userId
     * @return array
     */
    public function getChatMember($chatId, $userId): array
    {
        try {
            $response = $this->get('getChatMember', ['chat_id' => $chatId, 'user_id' => $userId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $chatId
     * @return array
     */
    public function getChatAdministrators($chatId): array
    {
        try {
            $response = $this->get('getChatAdministrators', ['chat_id' => $chatId]);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $chatId
     * @param string|null $name
     * @param int|null $expireDate
     * @param int|null $memberLimit
     * @param bool $createsJoinRequest
     * @return array|mixed
     */
    public function createChatInviteLink($chatId, string $name = null, int $expireDate = null, int $memberLimit = null, bool $createsJoinRequest = false)
    {
        try {
            $params = [
                'chat_id' => $chatId,
                'creates_join_request' => $createsJoinRequest
            ];

            if ($name) {
                $params['name'] = $name;
            }
            if ($expireDate) {
                $params['expire_date'] = $expireDate;
            }
            if ($memberLimit) {
                $params['member_limit'] = $memberLimit;
            }

            $response = $this->get('createChatInviteLink', $params);
            $data = $response->getBody()->getContents();

            return json_decode($data, true);
        } catch (\Throwable $e) {
            return [
                'ok'          => false,
                'description' => $e->getMessage()
            ];
        }
    }

    /**
     * Making GET request
     * @param $uri
     * @param array $query
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function get($uri, array $query = [])
    {
        if (empty($query['chat_id'])) {
            $query['chat_id'] = $this->chatId;
        }

        if (!empty($this->threadId)) {
            $query['message_thread_id'] = $this->threadId;
        }

        return $this->client->get(self::API_URL . $this->token . '/' . $uri, ['query' => $query]);
    }
}
