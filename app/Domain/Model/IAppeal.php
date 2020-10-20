<?php


namespace App\Domain\Model;


interface IAppeal
{
    static function get(string $id) : array;
    static function getNotRead() : array;
    static function getNotProcessed() : array;
    static function create(string $id, string $from, string $email, string $appeal_text) : void;
    static function markRead(string $id) : void;
    static function markProcessed(string $id) : void;
    static function markRejected(string $id, string $reason) : void;
}
