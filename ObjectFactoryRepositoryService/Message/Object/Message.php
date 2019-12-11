<?php
namespace App\Lib\Message\Object;
 
use App\Lib\Message\Repository\MessageOpenRepository;
 
/**
 * メッセージのオブジェクト
 */
class Message extends \CakeObject
{
    // Key
    public $id;
    public $userId;
    public $boardId;
 
    // Data
    public $description;
 
    // Meta
    public $created;
    public $modified;
 
    // Relation
    private $board;
 
    /**
     * 配列からの変換のエイリアス
     * @param $data
     * @return Message
     */
    public static function fromData(array $data): Message
    {
        return MessageFactory::getInstance()->fromData($data);
    }
 
    /**
     * 配列形式にして出力
     *
     * @return array
     */
    public function toData(): array
    {
        return MessageFactory::getInstance()->toData($this);
    }
 
    /**
     * ボードを取得
     *
     * @return Board
     */
    public function getBoard(): Board
    {
        if (!empty($this->board)) {
            return $this->board;
        }
 
        $this->board = BoardRepository::getInstance()->get($this->boardId);
        return $this->board;
    }
}
