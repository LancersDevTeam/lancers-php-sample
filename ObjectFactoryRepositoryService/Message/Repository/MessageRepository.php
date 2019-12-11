<?php
namespace App\Lib\Message\Repository;
 
use App\Lib\Message\Object\Message;
 
/**
 * メッセージのリポジトリ
 */
class MessageRepository extends \CakeObject
{
    public const MODEL_NAME = 'Message';
    protected static $instance;
    protected $cache = [];
 
    /**
     * インスタンスの取得
     *
     * @return static
     */
    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }
 
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct(static::MODEL_NAME);
    }
 
    /**
     * メッセージの作成
     *
     * @param Message $message
     * @return Message
     * @throws \RepositoryException
     */
    public function add(Message $message): Message
    {
        $message->id = false;
        return $this->save($message);
    }
 
    /**
     * 保存
     *
     * @param Message $object
     * @return Message
     * @throws \RepositoryException
     */
    public function save(Message $object): Message
    {
        $Model = $this->loadModel(static::MODEL_NAME);
        $data  = $object->toData();
        $Model->create($data);
        $result = $Model->save($data, false);
 
        if (empty($result)) {
            throw new \RepositoryException(
                $Model->validationErrors ? current(current($Model->validationErrors)) : __METHOD__
            );
        }
 
        if (!$result[static::MODEL_NAME]['id']) {
            $result[static::MODEL_NAME]['id'] = $Model->id;
        }
 
        return Message::fromData($result);
    }
 
    /**
     * メッセージIDからメッセージを取得
     *
     * @param int $id
     * @return Message|null
     */
    public function get(int $id): ?Message
    {
        $data = $this->loadModel(static::MODEL_NAME)->findById($id);
 
        if (empty($data)) {
            return null;
        }
 
        return Message::fromData($data);
    }
 
    /**
     * ボードIDからメッセージの一覧を取得
     *
     * @param int $boardId
     * @return array
     */
    public function findByBoardId(int $boardId): array
    {
        $messages = $this->loadModel(static::MODEL_NAME)->findAllByBoardId($boardId);
 
        if (empty($messages)) {
            return [];
        }
 
        $data = [];
        foreach ($messages as $message) {
            $data[] = Message::fromData($message);
        }
 
        return $data;
    }
 
}
