<?php
namespace Hidehalo\Nanoid\Test;

use Hidehalo\Nanoid\Client;
use PHPUnit\Framework\TestCase;
use Hidehalo\Nanoid\Test\Support\DummyGenerator;

class ClientTest extends TestCase
{
    /**
     * @group passed
     * @dataProvider clientProvider
     * @param Client $client
     */
    public function testGenerateId(Client $client)
    {
        $size = 7;
        $normalRandom = $client->generateId($size);
        $this->assertEquals($size, strlen($normalRandom));
        $dynamicRandom = $client->generateId($size, Client::MODE_DYNAMIC);
        $this->assertEquals($size, strlen($dynamicRandom));
        $this->assertNotEquals($normalRandom, $dynamicRandom);
    }

    /**
     * @group passed
     * @dataProvider clientProvider
     * @param Client $client
     */
    public function testFormatedId(Client $client)
    {
        $size = 10;
        $alphabet = '0123456789abcdefghi';
        $id = $client->formatedId($alphabet, $size);
        $this->assertEquals($size, strlen($id));
        $dummyId = $client->formatedId($alphabet, $size, new DummyGenerator);
        $this->assertEquals($size, strlen($dummyId));
        $this->assertNotEquals($id, $dummyId);
    }

    /**
     * Client Provider
     *
     * @return mixed
     */
    public function clientProvider()
    {
        return [
            [new Client()]
        ];
    }
}
