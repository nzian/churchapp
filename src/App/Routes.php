<?php

declare(strict_types=1);


$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');
$app->get('/data', 'App\Controller\Home:getJsonData');
$app->get('/cfc2/data', 'App\Controller\Home:getCfc2JsonData');
$app->get('/cfc3/data', 'App\Controller\Home:getCfc3JsonData');
$app->get('/remove-old-notification', 'App\Controller\Home:removeOldNotification');

$app->get('/test-push-notification', 'App\Controller\Home:testPushNotification');
$app->get('/qrcodes', 'App\Controller\Home:getAllQrCodes');

$app->get('/city-province', App\Controller\CityProvince::class);


$app->get('/churches', App\Controller\Churches\GetAll::class);
$app->post('/churches', App\Controller\Churches\Create::class);
$app->get('/churches/{id}', App\Controller\Churches\GetOne::class);
$app->put('/churches/{id}', App\Controller\Churches\Update::class);
$app->delete('/churches/{id}', App\Controller\Churches\Delete::class);

$app->get('/users', App\Controller\Users\GetAll::class);
$app->post('/users', App\Controller\Users\Create::class);
$app->get('/users/{id}', App\Controller\Users\GetOne::class);

$app->post('/users/by-email', App\Controller\Users\GetUserByEmail::class);


$app->get('/users/{id}/notifications', App\Controller\Users\GetUserNotifications::class);
$app->get('/users/{user_id}/notifications/read/{notification_id}', App\Controller\Users\UpdateUserNotificationsRead::class);
$app->get('/users/{user_id}/notifications/unread/{notification_id}', App\Controller\Users\UpdateUserNotificationsUnread::class);

$app->put('/users/{id}', App\Controller\Users\Update::class);
$app->delete('/users/{id}', App\Controller\Users\Delete::class);

$app->get('/user_notifications', App\Controller\User_notifications\GetAll::class);
$app->post('/user_notifications', App\Controller\User_notifications\Create::class);
$app->get('/user_notifications/{id}', App\Controller\User_notifications\GetOne::class);
$app->put('/user_notifications/{id}', App\Controller\User_notifications\Update::class);
$app->delete('/user_notifications/{id}', App\Controller\User_notifications\Delete::class);

$app->get('/pastors', App\Controller\Pastors\GetAll::class);
$app->post('/pastors', App\Controller\Pastors\Create::class);

$app->post('/pastors/by-email', App\Controller\Pastors\PastorByEmail::class);
$app->get('/pastors/notification/{id}', App\Controller\Notifications\PastorNotifications::class);
$app->get('/pastors/{pastor_id}/notification/delete/{id}', App\Controller\Notifications\PastorNotificationDelete::class);

$app->get('/pastors/{id}', App\Controller\Pastors\GetOne::class);
$app->put('/pastors/{id}', App\Controller\Pastors\Update::class);
$app->delete('/pastors/{id}', App\Controller\Pastors\Delete::class);

$app->get('/notifications', App\Controller\Notifications\GetAll::class);

$app->post('/notifications', App\Controller\Notifications\Create::class);

$app->get('/notifications/{id}', App\Controller\Notifications\GetOne::class);
$app->put('/notifications/{id}', App\Controller\Notifications\Update::class);
$app->delete('/notifications/{id}', App\Controller\Notifications\Delete::class);

$app->get('/user_attendance', App\Controller\User_attendance\GetAll::class);
//$app->post('/user_attendance', App\Controller\User_attendance\Create::class);
$app->post('/checkin/success', App\Controller\User_attendance\Create::class);
$app->post('/attendance/{id}', App\Controller\User_attendance\GetAttendance::class);
$app->get('/user_attendance/{id}', App\Controller\User_attendance\GetOne::class);
$app->put('/user_attendance/{id}', App\Controller\User_attendance\Update::class);
$app->delete('/user_attendance/{id}', App\Controller\User_attendance\Delete::class);

$app->get('/user_information', App\Controller\User_information\GetAll::class);
$app->post('/user_information', App\Controller\User_information\Create::class);
$app->post('/member-login', App\Controller\User_information\MemberLogin::class);
$app->post('/submit/guest/info', App\Controller\User_information\SubmitGuest::class);
$app->get('/user_information/{id}', App\Controller\User_information\GetOne::class);
$app->put('/user_information/{id}', App\Controller\User_information\Update::class);
$app->delete('/user_information/{id}', App\Controller\User_information\Delete::class);
$app->get('/member-info/{user_id}', App\Controller\User_information\MemberInformation::class);
$app->post('/member-search', App\Controller\User_information\MemberSearch::class);
$app->post('/member-search-criteria', App\Controller\User_information\MemberSearchCriteria::class);
$app->get('/allmember', App\Controller\User_information\GetAllMember::class);

$app->get('/province', App\Controller\Province\GetAll::class);
$app->post('/province', App\Controller\Province\Create::class);
$app->get('/province/{id}', App\Controller\Province\GetOne::class);
$app->put('/province/{id}', App\Controller\Province\Update::class);
$app->delete('/province/{id}', App\Controller\Province\Delete::class);

$app->get('/city', App\Controller\City\GetAll::class);
$app->post('/city', App\Controller\City\Create::class);
$app->get('/city/{id}', App\Controller\City\GetOne::class);
$app->put('/city/{id}', App\Controller\City\Update::class);
$app->delete('/city/{id}', App\Controller\City\Delete::class);


