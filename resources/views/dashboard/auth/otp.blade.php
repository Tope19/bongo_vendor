<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Bongo Express</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('dashboard/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('dashboard/images/favicon/site.webmanifest') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .teal-bg {
            background-color: #1A5157;
        }

        .light-teal-bg {
            background-color: #5ABECD;
        }
    </style>
</head>

@php
    $email = decrypt(request()->query('email'));
@endphp

<body>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
        <div class="w-full max-w-6xl overflow-hidden flex flex-col md:flex-row rounded-xl shadow-lg bg-white">
            <!-- Left side with images -->
            <div class="w-full md:w-1/2 bg-white flex flex-col gap-4 p-4 md:p-6">
                <!-- Grid of images -->
                <div class="grid grid-cols-2 gap-4 h-full">
                    <div class="teal-bg rounded-lg aspect-square md:aspect-auto"></div>
                    <div class="rounded-lg overflow-hidden">
                        <img src="{{ asset('dashboard/images/login-1.jpg') }}" alt="Person with vegetables"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-lg overflow-hidden col-span-1">
                        <img src="{{ asset('dashboard/images/login-2.jpg') }}" alt="Delivery person"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="light-teal-bg rounded-lg aspect-square md:aspect-auto"></div>
                </div>
            </div>

            <!-- Right side with sign in form -->
            <div class="w-full md:w-1/2 p-6 md:p-10 flex flex-col">
                <!-- Logo -->
                <div class="flex justify-end mb-6">
                    <div class="text-[#1A5157] flex items-center">
                        <div class="w-8 h-8 bg-[#1A5157] rounded"></div>
                        <div class="ml-2">
                            <div class="font-bold text-lg">Bongo</div>
                            <div class="text-sm -mt-1">Express</div>
                        </div>
                    </div>
                </div>

                <!-- OTP form -->
                <div class="flex-1 flex flex-col">
                    <h1 class="text-3xl font-bold text-gray-800 mb-8">Enter your OTP</h1>

                    <form class="space-y-6" method="POST" action="{{ route('auth.vendor.otp.save') }}">
                        @csrf
                        @include('dashboard.status.status')

                        <div class="space-y-2" style="display: none;">
                            <label for="email" class="text-sm text-gray-600">Email</label>
                            <input type="hidden" value="{{ $email }}" name="email" required placeholder="Email address"
                                class="flex h-10 w-full rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-base focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-400 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm" />
                        </div>

                        <div class="space-y-4 w-full max-w-md mx-auto">
                            <label class="text-sm text-gray-600 block">Enter OTP</label>

                            <div class="grid grid-cols-4 gap-4 w-full">
                                @for ($i = 1; $i <= 4; $i++)
                                    <input type="text" name="code[]" maxlength="1" required
                                        class="aspect-square w-full text-center text-lg rounded-md border border-gray-300 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                        oninput="handleInput(event, {{ $i }})" id="code{{ $i }}" />
                                @endfor
                            </div>

                            <button type="submit"
                                class="inline-flex h-12 w-full items-center justify-center gap-2 whitespace-nowrap rounded-md bg-[#1A5157] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-[#153e44] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-400 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50">
                                Verify OTP
                            </button>
                        </div>
                    </form>

                    <div class="text-center text-sm text-gray-500 pt-5">
                        Didn't receive the code?<br>
                        <form action="{{ route('auth.vendor.otp.resend') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <button type="submit" class="text-[#1A5157] hover" class="text-blue-500 hover:text-blue-700">Resend OTP</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function handleInput(e, index) {
            const input = e.target;
            const nextInput = document.getElementById('code' + (index + 1));
            const prevInput = document.getElementById('code' + (index - 1));

            if (input.value.length === 1 && nextInput) {
            nextInput.focus();
            } else if (input.value.length === 0 && prevInput) {
            prevInput.focus();
            }
        }
    </script>
</body>

</html>
