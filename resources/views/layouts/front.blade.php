<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('output.css')}}" rel="stylesheet">
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <title>@yield('title')</title>
  <!-- CSS -->
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>
<body class="font-poppins text-black">
    <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen flex flex-col gap-8 pb-[120px]">
        @if (request()->is('/'))
            <nav class="mt-8 px-4 w-full flex items-center justify-between">
                @auth
                    <div class="flex items-center gap-3">
                    <div class="w-12 h-12 border-4 border-white rounded-full overflow-hidden flex shrink-0 shadow-[6px_8px_20px_0_#00000008]">
                        <img src="{{ Storage::url(Auth::user()->avatar)}}" class="w-full h-full object-cover object-center" alt="photo">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="text-xs tracking-035">Welcome!</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                    </div>
                    </div>
                @endauth
                @guest
                    <a href="{{ route('login')}}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                        Login
                    </a>
                @endguest
              <a href="">
                <div class="w-12 h-12 rounded-full bg-white overflow-hidden flex shrink-0 items-center justify-center shadow-[6px_8px_20px_0_#00000008]">
                  <img src="{{ asset('assets/icons/bell.svg')}}" alt="icon">
                </div>
              </a>
            </nav>
        @elseif (request()->is('detail/*'))
            <nav class="mt-8 px-4 w-full flex items-center justify-between">
              <a href="{{ url('/')}}">
                <img src="{{ asset('assets/icons/back.png')}}" alt="back">
              </a>
              <p class="text-center m-auto font-semibold">Details</p>
              <a href="">
                <img src="{{ asset('assets/icons/more-dots.svg')}}" alt="more">
              </a>
            </nav>
        @endif
        @yield('content')
        @if (request()->is('/'))
            <div class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
              <a href="{{ url('/')}}" class="menu {{ request()->is('/') ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/home.svg')}}" alt="icon">             
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Home</p>
                </div>
              </a>
              <a href="" class="menu opacity-25">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/search.svg')}}" alt="icon">            
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Search</p>
                </div>
              </a>
              <a href="{{ route('dashboard.bookings')}}" class="menu opacity-25">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/calendar-blue.svg')}}" alt="icon">              
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Schedule</p>
                </div>
              </a>
              <a href="{{ route('dashboard')}}" class="menu opacity-25">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/user-flat.svg')}}" alt="icon">               
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Profile</p>
                </div>
              </a>
            </div>
        @elseif (request()->is('dashboard/my-bookings*'))
            <div class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-white rounded-t-[25px] flex items-center justify-evenly py-[45px]">
              <a href="{{ url('/')}}" class="menu {{ request()->is('/') ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/home.svg')}}" alt="icon">             
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Home</p>
                </div>
              </a>
              <a href="" class="menu {{ request()->is('/') ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/search.svg')}}" alt="icon">            
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Search</p>
                </div>
              </a>
              <a href="{{ route('dashboard.bookings')}}" class="menu {{ request()->is('dashboard/my-bookings*') ? '' : 'opacity-25' }}">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/calendar-blue.svg')}}" alt="icon">              
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Schedule</p>
                </div>
              </a>
              <a href="{{ route('dashboard')}}" class="menu opacity-25">
                <div class="flex flex-col justify-center w-fit gap-1">
                  <div class="w-4 h-4 flex shrink-0 overflow-hidden mx-auto text-[#4D73FF]">
                    <img src="{{ asset('assets/icons/user-flat.svg')}}" alt="icon">               
                  </div>
                  <p class="font-semibold text-xs leading-[20px] tracking-[0.35px]">Profile</p>
                </div>
              </a>
            </div>
        @endif
    </section>
</body>
</html>