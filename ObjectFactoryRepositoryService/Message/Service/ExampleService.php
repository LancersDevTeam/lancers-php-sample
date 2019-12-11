<?php
namespace App\Lib\Message\Service;
 
use App\Lib\Message\Repository\MessageRepository;
 
class ExampleService
{
    /**
     * メッセージのオブジェクトからボードのタイトルを取得するサンプル
     *
     * @param int $messageId
     * @return string ボードのタイトル
     */
    public static function example(int $messageId): string
    {
        $message = MessageRepository::getInstance()->get($messageId);
        return $messga->getBoard()->title;
    }
}
