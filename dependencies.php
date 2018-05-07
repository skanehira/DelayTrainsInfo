<?php
use Abraham\TwitterOAuth\TwitterOAuth;
require "config.php";

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// TwitterOAuth
$container['TwitterOAuth'] = function ($c) {
        // Twitter接続
        try {
            $Twitter = new TwitterOAuth(API_KEY, API_SECRET, ACCESS_TOKEN, ACCESS_SECRET);
            return $Twitter;
        } catch (Exception $e) {
            // 結果を返却
            return $e;
        }
};