@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <h1 class="text-center mb-4" style="font-family: 'Dancing Script', cursive; font-weight: bold; font-style: italic;">Employee Birthdays</h1>

    <!-- Back to Employee Index Button -->
    <div class="text-center mb-4">
        <a href="{{ route('employees.index') }}" class="btn btn-primary rounded-pill">
            <i class="fas fa-list"></i> Back to List
        </a>
    </div>

    <div class="flowchart">
        @foreach ($months as $month)
            <div class="month-box">
                <h2 class="month-title">{{ $month }}</h2>
                @if (isset($birthdays[$month]) && count($birthdays[$month]) > 0)
                    <ul class="employee-list">
                        @foreach ($birthdays[$month] as $employee)
                            <li>{{ $employee['date'] }} - {{ $employee['name'] }}</li>
                        @endforeach
                    </ul>
                @else
                    <h5>No birthdays</h5>
                @endif
            </div>
        @endforeach
    </div>
</div>

<style>
    body {
        background-color: #f4f6f9; /* Light background for contrast */
        font-family: Arial, sans-serif; /* Change font for better readability */
        background-image: url('https://example.com/path/to/balloon1.png'), url('https://example.com/path/to/balloon2.png'); /* Add balloon images */
        background-size: contain; /* Ensure balloons are sized correctly */
        background-repeat: no-repeat; /* Prevent repeat of images */
        background-position: right top, left bottom; /* Position the balloons */
    }

    .container {
        position: relative;
        z-index: 1; /* Ensure content is above the background */
    }

    .flowchart {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px; /* Add margin at the top */
    }

    .month-box {
        background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%); /* Gradient background */
        border-radius: 10px; /* Rounded corners */
        padding: 20px;
        margin: 15px;
        flex: 0 0 30%; /* Adjust width as needed (30% for 3 columns) */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Enhanced shadow */
        transition: transform 0.3s;
        position: relative; /* For adding decorative elements */
        z-index: 2; /* Ensure box is above the background */
    }

    .month-box:hover {
        transform: translateY(-5px); /* Lift effect on hover */
    }

    .month-title {
        text-align: center;
        font-size: 1.8rem; /* Adjust title size */
        color: #ffffff; /* White text for contrast */
        margin-bottom: 10px; /* Spacing below title */
        font-weight: bold; /* Make title bold */
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Text shadow for better visibility */
    }

    .employee-list {
        list-style-type: none; /* Remove bullet points */
        padding: 0; /* Remove default padding */
        text-align: center; /* Center the list items */
    }

    .employee-list li {
        margin: 5px 0; /* Spacing between list items */
        font-size: 1.2rem; /* Adjust font size */
        color: #333; /* Darker text color for contrast */
    }

    /* Additional styles for month boxes */
    .month-box:nth-child(odd) {
        background: linear-gradient(135deg, #85e3ff 0%, #d9e4f5 100%); /* Light blue gradient for odd months */
    }

    .month-box:nth-child(even) {
        background: linear-gradient(135deg, #ffcc9e 0%, #ff99b3 100%); /* Light orange gradient for even months */
    }

    h5 {
        text-align: center; /* Center align "No birthdays" message */
        font-style: italic; /* Italicize the message */
        color: #777; /* Grey color for the message */
    }

    /* Decorative Elements */
    .month-box::after {
        content: '';
        position: absolute;
        top: 10px;
        right: 10px;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.3); /* Slightly transparent white circle */
        border-radius: 50%; /* Make it circular */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    }
</style>
@endsection
