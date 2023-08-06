@extends('layouts.master')
@section('title', 'Local Statistics')

@section('content')
    <!-- Your statistics content here -->
    <!-- For example: -->
    <h2>Statistics for Local: {{ $localLabel }}</h2>
    <!-- Display the specific statistics for the local with its ID -->
    <!-- Example: -->
    <p>Total Invoices: {{ $localStats['total_invoices'] }}</p>
    <p>Total Amount: {{ $localStats['total_amount'] }}</p>
    <!-- Add other statistics as needed -->

@endsection
