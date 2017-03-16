<?php
namespace App\Controllers;

use Slim\Response;
use Slim\Container;

use App\Models\CompanyModel;
use App\Lib\GenericTableCrud;
use App\Controllers\BaseController;
/**
 * ROUTES:
 *
 * Creating new company in db
 * /company
 *   method - post
 *   params - company
 *
 * Listing all companies
 * /company
 *   method - get
 *
 * Listing single company
 * /company/:id
 *   method - GET
 *   param - /:id
 *
 * Updating existing company
 * /company
 *   method - PUT
 *   params - company
 *
 * Deleting company
 * /company/:id
 *   method - DELETE
 */
class CompanyController extends BaseController
{
    /**
    * Listing all companies
    * method GET
    * url /company
    */
    public function get($request, $response, $args)
    {
        // create Table instance
        $table = new GenericTableCrud(
            $this->getPDO(),
            CompanyModel::class
        );
        // execute query
        $query = $table->getAll();
        // send results
        if ($query['result']) {
            $response = $response->withJson($query['data']);
        } else {
            $response->withStatus(500);
        }
        return $response;
    }
    /**
    * Listing single company
    * /company/:id
    *   method - GET
    *   param - /:id
    */
    public function getById($request, $response, $args)
    {
        $id = (int)$args['id'];
        // We sanitize the received data
        $id = filter_var($id, FILTER_SANITIZE_STRING);

        // create Table instance
        $table = new GenericTableCrud(
            $this->getPDO(),
            CompanyModel::class
        );

        // execute query
        $query = $table->getById($id);

        // send results
        if ($query['result']) {
            $response = $response->withJson($query['data']);
        } else {
            $response = $response->withStatus(500);
        }
        return $response;
    }
   /**
    * Create new company
    * /company
    *   method - POST
    *   params - company
   */
    public function post($request, $response, $args)
    {
        // Parse and sanitize received fields
        $data = $request->getParsedBody();
        $insertData = $this->sanitize($data);
        // set id = null for insert
        $insertData['id'] = null;
        // create Table instance
        $table = new GenericTableCrud(
            $this->getPDO(),
            CompanyModel::class
        );

        // execute insert
        $query = $table->insertOrUpdate($insertData);
        // send results
        if ($query['result']) {
            $response = $response->withStatus(201); // created
        } else {
            $response = $response->withStatus(500);
        }
        return $response;
    }
    /*
    * Updating existing company
    * /company
    *   method - PUT
    *   params - company
    */
    public function put($request, $response, $args)
    {
        // Parse and sanitize received fields
        $data = $request->getParsedBody();
        $updateData = $this->sanitize($data);

        // create Table instance
        $table = new GenericTableCrud(
            $this->getPDO(),
            CompanyModel::class
        );
        // execute update
        $query = $table->insertOrUpdate($updateData);
        // send results
        if ($query['result']) {
            $response = $response->withStatus(202); // acepted
        } else {
            $response = $response->withStatus(500);
        }
        return $response;
    }
    /**
    * Deleting company
    * /company/:id
    *   method - DELETE
    */
    public function delete($request, $response, $args)
    {
        $id = (int)$args['id'];
        // We sanitize the received data
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        // create Table instance
        $table = new GenericTableCrud(
            $this->getPDO(),
            CompanyModel::class
        );
        // execute query
        $query = $table->delete($id);

        // send results
        if ($query['result'] && $query['data'] == 1) {
            $response = $response->withStatus(202); // acepted
        } else {
            $response = $response->withStatus(500);
        }
        return $response;
    }
    /**
     * sanitize body recived data
     * @param array $data
     *
     * @return array
     */
    private function sanitize($data)
    {
        // We sanitize the received data
        $sanitizedData = [];
        foreach ($data as $key => $value) {
            $sanitizedData[$key] = filter_var($value, FILTER_SANITIZE_STRING);
        }
        return $sanitizedData;
    }
}
