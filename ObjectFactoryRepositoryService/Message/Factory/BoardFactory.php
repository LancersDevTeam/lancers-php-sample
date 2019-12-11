<?php
namespace App\Lib\Message\Factory;
 
use App\Lib\Message\Object\Board;
use App\Lib\Message\Repository\BoardRepository;
 
/**
 * ボードのファクトリ
 */
class BoardFactory extends \CakeObject
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
     * @return Board
     */
    public function fromData(array $data): Board
    {
        $data = isset($data[BoardRepository::MODEL_NAME]) ? $data[BoardRepository::MODEL_NAME] : $data;
        $object = new Board();
 
        // Key
        $object->id = isset($data['id']) ? (int)$data['id'] : false;
 
        // Data
        $object->title = $data['title'];
        $object->description = $data['description'];
 
        // Meta
        $object->created  = $data['created'] ?? date('Y-m-d H:i:s');
        $object->modified = $data['modified'] ?? date('Y-m-d H:i:s');
 
        return $object;
    }
 
    /**
     * ObjectをModelで扱う配列形式に変換する
     *
     * @param Board $object
     * @return array
     */
    public function toData(Board $object): array
    {
        $data = [];
 
        // Key -- fully
        if ($object->id) { // Skipping validation on create
            $data['id'] = $object->id;
        }
 
        // Data
        $data['title'] = $object->title;
        $data['description'] = $object->description;
 
        // Meta
        $data['created'] = $object->created;
        $data['modified'] = $object->modified;
 
        return [BoardRepository::MODEL_NAME => $data];
    }
}
