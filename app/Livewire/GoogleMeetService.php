<?php

namespace Tasawk\Livewire;

use Google\Client;
use Google\Service\Meet;
use Google\Service\Meet\CreateSpaceRequest;

class GoogleMeetService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName('Your Application Name');
        $this->client->setScopes(['https://www.googleapis.com/auth/meetings.space.created']);
        $this->client->setAuthConfig('/home/ammarwadood/web/aldawishlaw.com.sa/public_html/aldawish-law/app/Livewire/credentials.json'); // تأكد من المسار الصحيح
        $this->client->setAccessType('offline');

        // Load previously authorized credentials from a file
        if (file_exists('app\Livewire\token.json')) {
            $accessToken = json_decode(file_get_contents('app\Livewire\token.json'), true);
            $this->client->setAccessToken($accessToken);
        }

        // Refresh the token if it's expired
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            } else {
                $authUrl = $this->client->createAuthUrl();
                // توجه: يجب عليك عرض رابط المصادقة للمستخدم هنا
                throw new \Exception("Open this link in your browser: $authUrl");
            }
            // Save the credentials to a file
            file_put_contents('app\Livewire\token.json', json_encode($this->client->getAccessToken()));
        }
    }

    public function createMeeting()
    {
        try {
            $meetService = new Meet($this->client);
            $request = new CreateSpaceRequest();
            $response = $meetService->spaces->create($request);

            return $response->meetingUri; // إرجاع رابط الاجتماع
        } catch (\Exception $e) {
            throw new \Exception('An error occurred: ' . $e->getMessage());
        }
    }
}