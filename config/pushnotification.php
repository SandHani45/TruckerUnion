<?php

return [
  'gcm' => [
      'priority' => 'normal',
      'dry_run' => false,
      'apiKey' => 'My_ApiKey',
  ],
  'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
  ],
  'apn' => [
      'certificate' => __DIR__ . '/iosCertificates/pushcert.pem',
      'passPhrase' => 'MyPassPhrase', //Optional
      'passFile' => __DIR__ . '/iosCertificates/pushcert.pem', //Optional
      'dry_run' => true
  ]
];