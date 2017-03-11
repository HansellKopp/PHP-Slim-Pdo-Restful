<?php
namespace App\Lib;

use \PDO;
use App\Container;
use App\Lib\AbstractBase;

class GenericTableCrud
{
    private $db;
    private $model;
    /**
     * constructor
     * @param object $db       slim-pdo
     * @param object $model    table name and fields
     */
    public function __CONSTRUCT($db, $model)
    {
        $this->db = $db;
        $this->model = $model;
    }
    /**
     * get all records
     * @return array [
     *                  array $data, or errors     // records
     *                  boolean $result            // true ok, false errors
     *               ]
     */
    public function getAll()
    {
        try {
            // get all records
            $stmt = $this->db->select($this->model::FIELDS)
                ->from($this->model::TABLE)
                ->execute();

            // prepare response
            return [
                'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
                'result' => true
            ];
        } catch (PDOException $e) {
            return [
                'data' => $e->getMessage(),
                'result' => false
            ];
        }
    }

    /**
     * get record by id
     * @param string $id
     *
     * @return array [
     *                  array $data, or errors     // records
     *                  boolean $result            // true ok, false errors
     *               ]
     */
    public function getById($id)
    {
        try {
            // get single record by id
            $stmt = $this->db->select($this->model::FIELDS)
                ->from($this->model::TABLE)
                ->where('id', '=', $id)
                ->execute();

            // prepare response
            return [
                'data' => $stmt->fetch(PDO::FETCH_ASSOC),
                'result' => true
            ];
        } catch (PDOException $e) {
            return [
                'data' => $e->getMessage(),
                'result' => false
            ];
        }
    }

    /**
     * insert or update record
     * @param array $data                 // [field => value] fields
     *
     * @return array [
     *                  mixed $data, or error message   // affected records
     *                  boolean $result                 // true ok, false errors
     *               ]
     */
    public function insertOrUpdate($data)
    {
        $fields = $this->model::FIELDS;
        // remove id field
        array_shift($fields);
        try {
            if (!isset($data['id'])) {
                $values = [];
                foreach ($fields as $field) {
                    $values[] = $data[$field];
                }
                $statement = $this->db->insert($fields)
                         ->into($this->model::TABLE)
                         ->values($values);
                // response
                return [
                    'data' => $statement->execute(),
                    'result' => true
                ];
            } else {
                $updateFields = [];
                foreach ($fields as $field) {
                    $updateFields[$field] = $data[$field];
                }
                $updateFields['updated_at'] = date("Y/m/d H:i:s");
                $statement = $this->db->update($updateFields)
                        ->table($this->model::TABLE)
                        ->where('id', '=', (int)$data['id']);
                // response
                return [
                    'data' => $statement->execute(),
                    'result' => true
                ];
            }
        } catch (PDOException $e) {
            return [
                'data' => $e->getMessage(),
                'result' => false
            ];
        }
    }
    /**
     * delete record by id
     * @param string $id
     *
     * @return array [
     *                  mixed $data, or error message   // affected records
     *                  boolean $result                 // true ok, false errors
     *               ]
     */
    public function delete($id)
    {
        try {
            $statement = $this->db->delete()
                ->from($this->model::TABLE)
                ->where('id', '=', (int)$id);
            // response
            return [
                'data' => $statement->execute(),
                'result' => true
            ];
        } catch (PDOException $e) {
            return [
                'data' => $e->getMessage(),
                'result' => false
            ];
        }
    }
}
