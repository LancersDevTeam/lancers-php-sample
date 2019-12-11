<?php
namespace App\Lib\Message\Repository;
 
use App\Lib\Message\Object\Board;
 
/**
 * メッセージのボードのリポジトリ
 */
class BoardRepository extends \CakeObject
{
    public const MODEL_NAME = 'Board';
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
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct(static::MODEL_NAME);
    }
 
    /**
     * ボードの作成
     *
     * @param Board $board
     * @return Board
     */
    public function add(Board $board): Baord
    {
        $board->id = false;
        return $this->save($board);
    }
 
    /**
     * 保存
     *
     * @param Board $object
     * @return Board
     * @throws \RepositoryException
     */
    public function save(Board $object): Board
    {
        $Model = $this->loadModel(static::MODEL_NAME);
        $Model->create($object->toData());
 
        $data = $Model->save($object->toData(), false);
 
        if (empty($data)) {
            throw new \RepositoryException(
                $Model->validationErrors ? current(current($Model->validationErrors)) : __METHOD__
            );
        }
 
        if (!$data[static::MODEL_NAME]['id']) {
            $data[static::MODEL_NAME]['id'] = $Model->id;
        }
 
        return Board::fromData($data);
    }
 
    /**
     * IDからボードを取得
     *
     * @param int $id
     * @return Board|null
     */
    public function get(int $id): ?Board
    {
        $data = $this->loadModel(static::MODEL_NAME)->findById($id);
 
        if (empty($data)) {
            return false;
        }
 
        return Board::fromData($data);
    }
}
