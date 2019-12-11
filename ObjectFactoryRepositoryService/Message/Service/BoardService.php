<?php
namespace App\Lib\Message\Service;
 
use App\Lib\Message\Object\Message;
use App\Lib\Message\Object\Board;
use App\Lib\Message\Repository\BoardRepository;
use App\Lib\Message\Repository\MessageRepository;
 
class BoardService
{
    /**
     * ボードと最初のメッセージを作成する
     *
     * @param array $data
     * @param int $userId
     * @return Message
     */
    public static function add(array $data, int $userId): Message
    {
        $board = Board::fromData($data);
        BoardRepository::getInstance()->add($board);
        $message = Message::fromData($data);
        $result = MessageRepository::getInstance()->add($message);
        return $result;
    }
}
