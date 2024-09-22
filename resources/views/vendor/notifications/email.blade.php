<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        h1, h2 {
            color: #333;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .footer {
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{url('/assets/img/logo/logo.png')}}" alt="Description" style="width: 100%; max-width: 100px; max-height:100px; display: block; margin: 0 auto;">


        {{-- Greeting --}}
        <h1>
            @if (!empty($greeting))
                {{ $greeting }}
            @else
                @if ($level === 'error')
                    Oh No!
                @else
                    Assalamualaikum!
                @endif
            @endif
        </h1>

        {{-- Intro Lines --}}
        @foreach ($introLines as $line)
            <p>{{ $line }}</p>
        @endforeach

        {{-- Action Button --}}
        @isset($actionText)
            <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
        @endisset

        {{-- Outro Lines --}}
        @foreach ($outroLines as $line)
            <p>{{ $line }}</p>
        @endforeach

        {{-- Salutation --}}
        <p>
            @if (!empty($salutation))
                {{ $salutation }}
            @else
                Regards,<br>{{ config('app.name') }}
            @endif
        </p>

        {{-- Subcopy --}}
        @isset($actionText)
            <p class="footer">
                If you're having trouble clicking the "{{ $actionText }}" button, copy and paste the URL below into your web browser:<br>
                <a href="{{ $actionUrl }}">{{ $actionUrl }}</a>
            </p>
        @endisset
    </div>
</body>
</html>
