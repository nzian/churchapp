<?php

declare(strict_types=1);

namespace Tests\integration;

use Fig\Http\Message\StatusCodeInterface;

class User_attendanceTest extends TestCase
{
    private static $id;

    public function testCreate(): void
    {
        $params = [
            '' => '',
            'user_id' => 1,
            'church_id' => 1,
            'user_type' => 'aaa',
            'qr_code_text' => 'aaa'
        ];
        $req = $this->createRequest('POST', '/user_attendance');
        $request = $req->withParsedBody($params);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        self::$id = json_decode($result)->id;

        $this->assertEquals(StatusCodeInterface::STATUS_CREATED, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetAll(): void
    {
        $request = $this->createRequest('GET', '/user_attendance');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetOne(): void
    {
        $request = $this->createRequest('GET', '/user_attendance/' . self::$id);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testGetOneNotFound(): void
    {
        $request = $this->createRequest('GET', '/user_attendance/123456789');
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_NOT_FOUND, $response->getStatusCode());
        $this->assertStringContainsString('error', $result);
    }

    public function testUpdate(): void
    {
        $req = $this->createRequest('PUT', '/user_attendance/' . self::$id);
        $request = $req->withParsedBody(['' => '']);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_OK, $response->getStatusCode());
        $this->assertStringContainsString('id', $result);
        $this->assertStringNotContainsString('error', $result);
    }

    public function testDelete(): void
    {
        $request = $this->createRequest('DELETE', '/user_attendance/' . self::$id);
        $response = $this->getAppInstance()->handle($request);

        $result = (string) $response->getBody();

        $this->assertEquals(StatusCodeInterface::STATUS_NO_CONTENT, $response->getStatusCode());
        $this->assertStringNotContainsString('error', $result);
    }
}
