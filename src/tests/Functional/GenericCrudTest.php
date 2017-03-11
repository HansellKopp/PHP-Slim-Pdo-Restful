<?php namespace App\Tests\Functional;

use App\Models\CompanyModel;
use App\Lib\GenericTableCrud;

class GenericCrudTest extends BaseTestCase
{
    /**
     * Test Crud Methods
     */
    public function testTableCrud()
    {
        // create Table Crud instance
        $db = $this->getPDO();
        $db->prepare('TRUNCATE TABLE company')->execute();
        $table = new GenericTableCrud($db, CompanyModel::class);

        // set insert data
        $insertData = [
                'taxId' => 'V10332591',
                'name' => 'Hansell Kopp',
                'address' => 'Res. Madre Vieja 32-I',
                'phoneNumber' => '0582-9877097',
                'email' => 'hansellkopp@gmail.com'
        ];

        // execute insert
        $result = $table->insertOrUpdate($insertData);
        // asserts
        $this->assertEquals(true, $result['result']);
        $this->assertEquals(1, $result['data']);

        // set update data
        $updateData = [
                'id' => '1',
                'taxId' => 'V9877097',
                'name' => 'Petra Erns',
                'address' => 'Küstriner Str. 6A, 130',
                'phoneNumber' => '0582-9877097',
                'email' => 'petro@gmail.com'
        ];

        // execute update
        $result = $table->insertOrUpdate($updateData);
        // asserts
        $this->assertEquals(true, $result['result']);
        $this->assertEquals($result['data'], 1);

        // set data
        $data = '1';
        $result = $table->getById($data);
        $this->assertEquals('Petra Erns', $result['data']['name']);


        // execute delete
        $result = $table->delete($data);
        // asserts
        $this->assertEquals(true, $result['result']);

        // find deleted record
        $result = $table->getById($data);
        // asserts
        $this->assertEquals(true, $result['result']);
        $this->assertEquals($result['data'], null);
    }
}
