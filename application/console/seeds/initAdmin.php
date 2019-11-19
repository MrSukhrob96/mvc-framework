<?php
$db = require_once dirname(__DIR__).'/../bootstrap/db.php';

$user = $db->getRepository(\App\Models\User::class)->findOneBy(['username' => 'admin']);
if (!is_a($user, \App\Models\User::class)) {
    $user = new \App\Models\User();
    $user->setRole(\App\Models\User::ROLE_ADMIN);
    $user->setPassword(123);
    $user->setEmail("admin@localhost");
    $user->setUsername("admin");
    $db->persist($user);
    $db->flush();
}
