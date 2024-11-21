<div class="w-full flex h-svh max-h-svh">
    <div class="h-full flex-[0.3]  ">

      <div class="grid h-full bg-white shadow py-28">
          {{-- <nav class="text-white text-base font-semibold pt-52">
              <a href="" class="flex items-center text-black opacity-75 hover:opacity-100 py-4 pl-28 nav-item"
              wire:navigate>
                  Home
              </a>
              <a href="" class="flex items-center text-black opacity-75 hover:opacity-100 py-4 pl-28 nav-item"
              wire:navigate>
                  Home
              </a>
              <a href="" class="flex items-center text-black opacity-75 hover:opacity-100 py-4 pl-28 nav-item"
              wire:navigate>
                  Home
              </a>
          </nav> --}}

              <div class="flex justify-center h-16 ">
                  <div class="flex" >
                      <div class="flex">
                          <ul>
                              <li class="py-2">
                                  <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                                      wire:navigate>
                                      Home
                                  </x-nav-link>
                              </li>
                              <li class="py-2">

                                  <x-nav-link href="{{ route('prueba') }}" :active="request()->routeIs('prueba')"
                                      wire:navigate>
                                      Prueba
                                  </x-nav-link>
                              </li>
                          </ul>
                          </div>
                  </div>
              </div>

      </div>
    </div>

    <div class="h-full flex-1">


    </div>


  </div>
