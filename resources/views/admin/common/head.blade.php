<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> {{ $title }} </title>
		
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('assets/admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

		
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('assets/admin-assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/admin-assets/plugins/dropzone/min/dropzone.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/admin-assets/css/custom.css') }}">

		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>