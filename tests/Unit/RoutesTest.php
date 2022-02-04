<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    // Test Response of Login Request
    public function test_login()
    {
        $this->json('post', 'api/v1/login')->assertStatus(200);
    }

    // Test Response of Register Request
    public function test_register()
    {
        $this->json('post', 'api/v1/register')->assertStatus(200);
    }

    // Test Response of Logout Request
    public function test_logout()
    {
        $this->json('post', 'api/v1/logout')->assertStatus(200);
    }

    // Test IF Admin Exist In Database Or Not
    public function test_admin_exist()
    {
        $this->assertDatabaseHas('users', [
            'name' => 'Admin'
        ]);
    }
    /******************************************* TEST TAGS ***********************************************/

    // Test Response of View Tags Request
    public function test_view_tags(){
        $this->json('get', 'api/v1/tags')->assertStatus(200);
    }

    // Test Response of Add Tag Request
    public function test_add_tags(){
        $this->json('post', 'api/v1/tags')->assertStatus(200);
    }

    // Test Response of Edit Tag Request
    public function test_edit_tags(){
        $this->json('PUT', 'api/v1/tags/1')->assertStatus(200);
    }

    // Test Response of Delete Tag Request
    public function test_delete_tags(){
        $this->json('delete', 'api/v1/tags/1')->assertStatus(200);
    }

    /******************************************* TEST CATEGORIES ********************************************/

    // Test Response of View categories Request
    public function test_view_categories(){
        $this->json('get', 'api/v1/categories')->assertStatus(200);
    }

    // Test Response of Add Category Request
    public function test_add_categories(){
        $this->json('post', 'api/v1/categories')->assertStatus(200);
    }

    // Test Response of Edit Category Request
    public function test_edit_categories(){
        $this->json('PUT', 'api/v1/categories/1')->assertStatus(200);
    }

    // Test Response of Delete Category Request
    public function test_delete_categories(){
        $this->json('delete', 'api/v1/categories/1')->assertStatus(200);
    }

    /******************************************* TEST ADS ***********************************************/

    // Test Response of View Ads Request
    public function test_view_Allads(){
        $this->json('get', 'api/v1/ads')->assertStatus(200);
    }

    // Test Response of Add Ads Request
    public function test_add_ads(){
        $this->json('post', 'api/v1/store/ads')->assertStatus(200);
    }

    // Test Response of Show Advertiser's Ads Request
    public function test_show_advertiser_ads(){
        $this->json('get', 'api/v1/show/advertiser/ads')->assertStatus(200);
    }

    // Test Response of Filter Ads BY Categories or Tags Request
    public function test_filter_ads(){
        $this->json('post', 'api/v1/filter/ads')->assertStatus(200);
    }

    // Test Response of Show My Ads Request
    public function test_show_my_ads(){
        $this->json('get', 'api/v1/show/my/ads')->assertStatus(200);
    }


}
