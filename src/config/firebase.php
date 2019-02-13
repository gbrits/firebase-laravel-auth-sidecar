<?php
return [
  'api_key' => env('FIREBASE_API_KEY', null),
  'auth_domain' => env('FIREBASE_AUTH_DOMAIN', null),
  'database_url' => env('FIREBASE_DATABASE_URL', null),
  'project_id' => env('FIREBASE_PROJECT_ID', null),
  'storage_bucket' => env('FIREBASE_STORAGE_BUCKET', null),
  'messaging_sender_id' => env('FIREBASE_MESSAGING_SENDER_ID', null)
];
