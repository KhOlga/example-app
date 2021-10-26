<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <style>
            /* Variables */
            * {
                box-sizing: border-box;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, sans-serif;
                font-size: 16px;
                -webkit-font-smoothing: antialiased;
                display: flex;
                justify-content: center;
                align-content: center;
                height: 100vh;
                width: 100vw;
            }

            form {
                width: 30vw;
                min-width: 500px;
                align-self: center;
                box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
                0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
                border-radius: 7px;
                padding: 40px;
            }

            input {
                border-radius: 6px;
                margin-bottom: 6px;
                padding: 12px;
                border: 1px solid rgba(50, 50, 93, 0.1);
                height: 44px;
                font-size: 16px;
                width: 100%;
                background: white;
            }

            .result-message {
                line-height: 22px;
                font-size: 16px;
            }

            .result-message a {
                color: rgb(89, 111, 214);
                font-weight: 600;
                text-decoration: none;
            }

            .hidden {
                display: none;
            }

            #card-error {
                color: rgb(105, 115, 134);
                text-align: left;
                font-size: 13px;
                line-height: 17px;
                margin-top: 12px;
            }

            #card-element {
                border-radius: 4px 4px 0 0 ;
                padding: 12px;
                border: 1px solid rgba(50, 50, 93, 0.1);
                height: 44px;
                width: 100%;
                background: white;
            }

            #payment-request-button {
                margin-bottom: 32px;
            }

            /* Buttons and links */
            button {
                background: #5469d4;
                color: #ffffff;
                font-family: Arial, sans-serif;
                border-radius: 0 0 4px 4px;
                border: 0;
                padding: 12px 16px;
                font-size: 16px;
                font-weight: 600;
                cursor: pointer;
                display: block;
                transition: all 0.2s ease;
                box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
                width: 100%;
            }
            button:hover {
                filter: contrast(115%);
            }
            button:disabled {
                opacity: 0.5;
                cursor: default;
            }

            /* spinner/processing state, errors */
            .spinner,
            .spinner:before,
            .spinner:after {
                border-radius: 50%;
            }
            .spinner {
                color: #ffffff;
                font-size: 22px;
                text-indent: -99999px;
                margin: 0px auto;
                position: relative;
                width: 20px;
                height: 20px;
                box-shadow: inset 0 0 0 2px;
                -webkit-transform: translateZ(0);
                -ms-transform: translateZ(0);
                transform: translateZ(0);
            }
            .spinner:before,
            .spinner:after {
                position: absolute;
                content: "";
            }
            .spinner:before {
                width: 10.4px;
                height: 20.4px;
                background: #5469d4;
                border-radius: 20.4px 0 0 20.4px;
                top: -0.2px;
                left: -0.2px;
                -webkit-transform-origin: 10.4px 10.2px;
                transform-origin: 10.4px 10.2px;
                -webkit-animation: loading 2s infinite ease 1.5s;
                animation: loading 2s infinite ease 1.5s;
            }
            .spinner:after {
                width: 10.4px;
                height: 10.2px;
                background: #5469d4;
                border-radius: 0 10.2px 10.2px 0;
                top: -0.1px;
                left: 10.2px;
                -webkit-transform-origin: 0px 10.2px;
                transform-origin: 0px 10.2px;
                -webkit-animation: loading 2s infinite ease;
                animation: loading 2s infinite ease;
            }

            @-webkit-keyframes loading {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @keyframes loading {
                0% {
                    -webkit-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }

            @media only screen and (max-width: 600px) {
                form {
                    width: 80vw;
                }
            }

        </style>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @stack('scripts')

        @livewireScripts
    </body>
</html>
