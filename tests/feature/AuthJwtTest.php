<?php


namespace Tests\Feature;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Faker\Generator;

class AuthJwtTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;


    // For Migrations
    protected $migrate     = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = NULL;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        //

    }

    /*
     * Test the Register Page
     * Create a user and login with JWT (Must be JSON
     * @return void
     */
    public function testRegisterPage()
    {
        // Check if the user was created
    }


    /*
     * Test the Login Page
     * Login with JWT (Must be JSON)
     * @return void
     */
    public function testLoginPage(){
        // Check if the user was logged in
    }
}