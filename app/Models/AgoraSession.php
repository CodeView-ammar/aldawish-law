<?php

namespace Tasawk\Models;

use Carbon\Carbon;
use Packages\Agora\AgoraFactory;

trait AgoraSession {
    public function isRunning(): bool
    {
        $startSessionDate = Carbon::parse($this->date);
        return $startSessionDate <= now() && $startSessionDate->addMinutes(1) >= now();
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }

    public function generateVoiceCall(): void {
        $token = AgoraFactory::make()->generateVoiceCall("order_" . $this->id, $this->date, 1000*24, $this->customer_id);
        $this->conversation()->updateOrCreate(['order_id' => $this->id], ['token' => $token]);
    }

    public function generateChatTokens(): array {
        $admin = User::first();
        return [
            'channel' => "order_" . $this->id,
            'type' => 'calling',
            "client" => [
                "id" => AgoraFactory::make()->fetchUser($this->customer),
                "token" => AgoraFactory::make()->generateChatToken($this->customer, 30),
                "name" => $this->customer->name,
                "avatar" => $this->customer->getFirstMediaUrl()
            ],
            "partner" => [
                "id" => AgoraFactory::make()->fetchUser($admin),
                "token" => AgoraFactory::make()->generateChatToken($admin, 30),
                "name" => $admin->name,
                "avatar" => $admin->getFirstMediaUrl()
            ]
        ];
    }

    public function customerInConversation(): bool
    {
        return !is_null($this->conversation?->customer_start_at);
    }

    public function customerEndConversation(): bool
    {
        return !is_null($this->conversation?->finished_at);
    }

    public function contractorInConversation(): bool
    {
        return !is_null($this->conversation?->contractor_start_at);
    }

    public function agoraSessionCanStart(): bool
    {
        return $this->isRunning() && $this->isPaid() && is_null($this->conversation?->customer_end_at);
    }

    public function partnerThatNotJoiningTheCallYet()
    {
        if (!$this->conversation->startedByCustomer() && !$this->conversation->startedByContractor()) {
            return null;
        }
        if (!$this->conversation->startedByContractor()) {
            return $this->contractor;
        }
        if (!$this->conversation->startedByCustomer()) {
            return $this->customer;
        }
    }
}