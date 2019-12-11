<?php
namespace App\Lib\Message\Factory;
 
use App\Lib\Message\Object\Message;
use App\Lib\Message\Repository\MessageRepository;
 
/**
 * メッセージのファクトリ
 */
class MessageFactory extends \CakeObject
{
    private static $instance;
 
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
     * 配列からObjectへの変換
     *
     * @param array $data
     * @return Message
     */
    public function fromData(array $data): Message
    {
        $data = isset($data[MessageRepository::MODEL_NAME]) ? $data[MessageRepository::MODEL_NAME] : $data;
        $object = new Message();
 
        // Key
        $object->id = isset($data['id']) ? (int)$data['id'] : false;
        $object->userId = (int)$data['user_id'];
        $object->boardId = (int)$data['board_id'];
 
        // Data
        $object->description = $data['description'];
 
        // Meta
        $object->created  = $data['created'] ?? date('Y-m-d H:i:s');
        $object->modified = $data['modified'] ?? date('Y-m-d H:i:s');
 
        return $object;
    }
 
    /**
     * ObjectをModelで扱う配列形式に変換する
     *
     * @param Message $object
     * @return array
     */
    public function toData(Message $object): array
    {
        $data = [];
 
        // Key -- fully
        if ($object->id) { // Skipping validation on create
            $data['id'] = $object->id;
            $data['user_id'] = $object->userId;
            $data['board_id'] = $object->boardId;
        }
 
        // Data
        $data['description'] = $object->description;
 
        // Meta
        $data['created'] = $object->created;
        $data['modified'] = $object->modified;
 
        return [MessageRepository::MODEL_NAME => $data];
    }
}
