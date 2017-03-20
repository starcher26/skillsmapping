<?php
/**
 * Created by PhpStorm.
 * User: Mounir
 * Date: 18/03/2017
 * Time: 22:55
 */
namespace Nalys\SkillsmappingBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GroupControllerTest extends WebTestCase
{
    const CLIENT_ID = "4_2hl92c84uhq8cw0w4gco0cw0k8k40s0cg8gcsogg4o8ggo8ogg";
    const CLIENT_SECRET = "3rptysr1u5mogkwsk4owg8880ws00s4skso4wgccskkc0g0oc0";
    const OAUTH_URL = "/oauth/v2/token";
    const USERNAME = "test";
    const PASSWORD = "test123";
    const GRANT_TYPE = "password";

    private function getOAuthToken()
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

    public function testCgetAction()
    {
        $client = static::createClient();
        $access_token = $this->getOAuthToken();

        $headers = array(
            'HTTP_AUTHORIZATION' => "Bearer ".$access_token,
            'CONTENT_TYPE' => 'application/json',
        );
        $crawler = $client->request('GET', '/api/groups', array(), array(), $headers);

        $response = $client->getResponse();

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $content = json_decode($response->getContent(), true);
        $this->assertInternalType('array', $content);

        foreach ($content as $group)
        {
            $this->assertArrayHasKey('id', $group);
            $this->assertArrayHasKey('name', $group);
            $this->assertArrayHasKey('roles', $group);
        }
    }
}
