
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Bongo Express</title>
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/images/favicon/favicon-16x16.png') }}">
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
<body>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-6xl overflow-hidden flex flex-col md:flex-row rounded-xl shadow-lg bg-white">
      <!-- Left side with images -->
      <div class="w-full md:w-1/2 bg-white flex flex-col gap-4 p-4 md:p-6">
        <!-- Grid of images -->
        <div class="grid grid-cols-2 gap-4 h-full">
          <div class="teal-bg rounded-lg aspect-square md:aspect-auto"></div>
          <div class="rounded-lg overflow-hidden">
            <img
              src="{{ asset("dashboard/images/login-1.jpg") }}"
              alt="Person with vegetables"
              class="w-full h-full object-cover"
            >
          </div>
          <div class="rounded-lg overflow-hidden col-span-1">
            <img
              src="{{ asset("dashboard/images/login-2.jpg") }}"
              alt="Delivery person"
              class="w-full h-full object-cover"
            >
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

        <!-- Login form -->
        <div class="flex-1 flex flex-col">
          <h1 class="text-3xl font-bold text-gray-800 mb-8">Nice to see you again</h1>

          <form class="space-y-6" method="POST" action="{{ route("auth.admin.login.save") }}">@csrf
            @include("dashboard.status.status")
            <div class="space-y-2">
              <label for="email" class="text-sm text-gray-600">Email</label>
              <input
                id="email"
                type="email"
                name="email"
                required
                placeholder="Email address"
                class="flex h-10 w-full rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-base focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-400 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
              />
            </div>

            <div class="space-y-2">
              <label for="password" class="text-sm text-gray-600">Password</label>
              <div class="relative">
                <input
                  id="password"
                  type="password"
                  name="password"
                  required
                  placeholder="Enter password"
                  class="flex h-10 w-full rounded-md border border-gray-200 bg-gray-50 px-3 py-2 pr-10 text-base focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-400 focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                />
                <button
                  type="button"
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"
                  onclick="togglePasswordVisibility()"
                >
                  <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  <svg id="eye-off-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                    <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/>
                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/>
                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/>
                    <line x1="2" x2="22" y1="2" y2="22"/>
                  </svg>
                </button>
              </div>
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-2">
                <input type="checkbox" id="remember" name="remember_me" class="h-4 w-4 rounded-sm border border-gray-500 text-[#1A5157]" />
                <label for="remember" class="text-sm text-gray-500 cursor-pointer">
                  Remember me
                </label>
              </div>
              <a href="#" class="text-sm text-[#1A5157] hover:underline">
                Forgot password?
              </a>
            </div>

            <button
              type="submit"
              class="inline-flex h-10 w-full items-center justify-center gap-2 whitespace-nowrap rounded-md bg-[#1A5157] px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-[#153e44] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-gray-400 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
            >
              Sign in
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eye-icon');
      const eyeOffIcon = document.getElementById('eye-off-icon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.style.display = 'none';
        eyeOffIcon.style.display = 'block';
      } else {
        passwordInput.type = 'password';
        eyeIcon.style.display = 'block';
        eyeOffIcon.style.display = 'none';
      }
    }
  </script>
</body>
</html>
