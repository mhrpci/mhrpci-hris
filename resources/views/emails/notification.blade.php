<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
        }
        .divider {
            border-top: 1px solid #e8e8e8;
            margin: 20px 0;
        }
        .footer {
            font-size: 0.9em;
            color: #666;
            margin-top: 30px;
        }
        .small-text {
            font-size: 0.8em;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>{{ $notifications->first()['subject'] }}</h1>

    @foreach($notifications as $notification)
        <div class="notification">
            <p>{{ $notification['content']['greeting'] }}</p>

            <p>{{ $notification['content']['message'] }}</p>

            @foreach($notification['content']['details'] as $label => $value)
                <p><strong>{{ $label }}:</strong> {{ $value }}</p>
            @endforeach

            @if(isset($notification['content']['action']))
                <a href="{{ $notification['content']['action']['url'] }}" class="button">
                    {{ $notification['content']['action']['text'] }}
                </a>
            @endif

            <div class="divider"></div>
        </div>
    @endforeach

    <div class="footer">
        <p>Thanks,<br>
        {{ config('app.name') }}</p>

        <p class="small-text">If you don't want to receive these emails, you can update your notification preferences in your account settings.</p>
    </div>
</body>
</html>
