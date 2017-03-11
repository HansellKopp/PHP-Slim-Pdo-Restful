<?php namespace App\Tests\Functional;

class SearchControllerTest extends BaseTestCase
{
    /**
     * Test company get all
     */
    public function testGetAll()
    {
        // Call without parameters
        $response = $this->runApp('GET', '/company');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
