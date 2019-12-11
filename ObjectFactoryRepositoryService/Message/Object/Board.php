<?php
namespace App\Lib\Message\Object;
 
use App\Lib\Message\Factory\BoardFactory;
 
/**
 * ボードのオブジェクト
 */
class Board extends \CakeObject
{
    // Key
    public $id;
 
    // Data
    public $title;
    public $description;
 
    // Meta
    public $created;
    public $modified;
 
    /**
     * 配列からの変換のエイリアス
     *
     * @return Board
     */
    public static function fromData(array $data): Board
    {
        return BoardFactory::getInstance()->fromData($data);
    }
 
    /**
     * 配列形式にして出力
     *
     * @return array
     */
    public function toData(): array
    {
        return BoardFactory::getInstance()->toData($this);
    }
}
