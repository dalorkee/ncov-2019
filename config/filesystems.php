<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

	'disks' => [
		'local' => [
			'driver' => 'local',
			'root' => storage_path('app'),
		],
		'public' => [
			'driver' => 'local',
			'root' => storage_path('app/public'),
			'url' => env('APP_URL').'/storage',
			'visibility' => 'public',
		],
		/*
		'invest' => [
			'driver' => 'local',
			'root' => public_path(). '/files/invest',
		],
		*/
		'invest' => [
			'driver' => 'sftp',
			'host' => '203.157.41.104',
			'username' => 'sftp_covid19',
			'password' => 'wxw;w,jCje',
			'port' => 22,
			'root' => '/public/files/invest',
		],
		'export' => [
			'driver' => 'local',
			'root' => public_path(). '/exports',
		],
		'upload' => [
			'driver' => 'local',
			'root' => public_path(). '/files/upload',
		],
		'tmp' => [
			'driver' => 'local',
			'root' => public_path(). '/tmp',
		],
		's3' => [
			'driver' => 's3',
			'key' => env('AWS_ACCESS_KEY_ID'),
			'secret' => env('AWS_SECRET_ACCESS_KEY'),
			'region' => env('AWS_DEFAULT_REGION'),
			'bucket' => env('AWS_BUCKET'),
			'url' => env('AWS_URL'),
		],
		'smb' => [
			'driver'    => 'smb',
			'host'      => '\\203.157.41.104\covid19',
			'username'  => 'covid19',
			'password'  => 'F8;bf19',
			'workgroup' => 'workgroup', // OR DOMAIN
			'path'      => 'home/covid/covid19',
		],

		'ftp' => [
			'driver'   => 'ftp',
			'host'     => '203.157.41.104',
			'username' => 'ddccovid',
			'password' => 'wxw;w,jCje',
			// Optional FTP Settings...
			// 'port'     => 21,
			// 'root'     => '',
			// 'passive'  => true,
			// 'ssl'      => true,
			// 'timeout'  => 30,
		],
		'sftp' => [
			'driver'        => 'sftp',
			'host'          => '203.157.41.104',
			'username'      => 'ddccovid',
			'password'      => 'wxw;w,jCje',
			// Optional SFTP Settings
			// 'privateKey'    => 'path/to/or/contents/of/privatekey',
			'port'          => 22,
			'root'          => '/covid19',
			// 'timeout'       => 30,
			// 'directoryPerm' => 0755,
			// 'permPublic'    => 0644,
			// 'permPrivate'   => 0600,
		],
		'vfs' => [
			'driver' => 'vfs',
		],
	],
];
