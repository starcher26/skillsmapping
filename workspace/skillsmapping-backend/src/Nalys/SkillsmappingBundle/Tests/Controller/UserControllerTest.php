<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:43
 */

namespace Nalys\SkillsmappingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Nalys\SkillsmappingBundle\Controller\UsersController;


class UsersControllerTest extends WebTestCase
{
    const CLIENT_ID = "4_2hl92c84uhq8cw0w4gco0cw0k8k40s0cg8gcsogg4o8ggo8ogg";
    const CLIENT_SECRET = "3rptysr1u5mogkwsk4owg8880ws00s4skso4wgccskkc0g0oc0";
    const OAUTH_URL = "/oauth/v2/token";
    const USERNAME = "test";
    const PASSWORD = "test123";
    const GRANT_TYPE = "password";

    private function getOAuthToken($username=self::USERNAME, $password=self::PASSWORD)
    {
        $client = static::createClient();
        $data = array(
            "grant_type" => self::GRANT_TYPE,
            "client_id" => self::CLIENT_ID,
            "client_secret" => self::CLIENT_SECRET,
            "username" => self::USERNAME,
            "password" => self::PASSWORD
        );
        $client->request('GET', self::OAUTH_URL, $data);
        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);
        return $content['access_token'];
    }
    public function testGetAction()
    {
        $client = static::createClient();
        $access_token = $this->getOAuthToken();
        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer ".$access_token,
            'CONTENT_TYPE' => 'application/json',
        );
        //$data = array("access_token" => $access_token);
        $crawler = $client->request('GET', '/api/users/9', array(), array(), $headers);

        $response = $client->getResponse();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // Assert that the "Content-Type" header is "application/json"
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
        $content = json_decode($response->getContent(), true);

        $this->assertInternalType('array', $content);
        //$this->assertCount(1, $content);

        //$element = $content[0];
        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('username', $content);
        $this->assertArrayHasKey('email', $content);
        $this->assertArrayHasKey('first_name', $content);
        $this->assertArrayHasKey('last_name', $content);
        $this->assertArrayHasKey('hired_date', $content);
        $this->assertArrayHasKey('groups', $content);
        $this->assertArrayHasKey('enabled', $content);
        $this->assertArrayHasKey('divisions', $content);

    }
    public function testCgetAction()
    {
        $client = static::createClient();
        $access_token = $this->getOAuthToken();
        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer ".$access_token,
            'CONTENT_TYPE' => 'application/json',
        );
        //$data = array("access_token" => $access_token);
        $crawler = $client->request('GET', '/api/users', array(), array(), $headers);

        $response = $client->getResponse();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content);

        foreach ($content as $user)
        {
            $this->assertArrayHasKey('id', $user);
            $this->assertArrayHasKey('username', $user);
            $this->assertArrayHasKey('email', $user);
            $this->assertArrayHasKey('first_name', $user);
            $this->assertArrayHasKey('last_name', $user);
            $this->assertArrayHasKey('hired_date', $user);
            $this->assertArrayHasKey('groups', $user);
            $this->assertArrayHasKey('enabled', $user);
            $this->assertArrayHasKey('divisions', $user);
        }

    }
    public function testRemoveUserAction()
    {

        $client = static::createClient();
        $access_token = $this->getOAuthToken();
        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer ".$access_token,
            'CONTENT_TYPE' => 'application/json',
        );
        //$data = array("access_token" => $access_token);
        $crawler = $client->request('DELETE', '/api/users/11', array(), array(), $headers);
        $response = $client->getResponse();
        $this->assertEquals(204, $client->getResponse()->getStatusCode());

        // Check user deactivation
        $crawler = $client->request('GET', '/api/users/11', array(), array(), $headers);
        $response = $client->getResponse();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content);
        $this->assertEquals(
            false,
            $content['enabled']
        );
    }
    public function testPostAction()
    {

        $client = static::createClient();
        $access_token = $this->getOAuthToken();
        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer ".$access_token,
            'CONTENT_TYPE' => 'application/json',
        );
        $data = array(
            //"access_token" => $access_token,
            "username" => "user_test",
            "password" => "test1234",
            "groups" => array(),
            "email" => "user@user.com",
            "hiredDate" => \DateTime::createFromFormat('Y-m-d', '2017-01-09'),
            "lastName" => "USER",
            "firstName" => "User"
        );

        $crawler = $client->request('POST', '/api/users', $data, array(), $headers);
        $response = $client->getResponse();
        print_r($response);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content);

        $this->assertArrayHasKey('id', $content);
        $this->assertArrayHasKey('username', $content);
        $this->assertArrayHasKey('email', $content);
        $this->assertArrayHasKey('first_name', $content);
        $this->assertArrayHasKey('last_name', $content);
        $this->assertArrayHasKey('hired_date', $content);
        $this->assertArrayHasKey('enabled', $content);
    }
}
