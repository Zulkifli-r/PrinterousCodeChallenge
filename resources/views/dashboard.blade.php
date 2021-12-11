<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <x-success class="my-1" />
    <div class="container mx-auto p-4">
        <form action="{{ route('home') }}" method="GET">
        <div class="font-sans text-black flex items-center justify-center m-5">
            <div class="border rounded overflow-hidden flex">
              <input type="text" class="px-4 py-2" placeholder="Search..." style="border-color: white" name="keyword">
              <button class="flex items-center justify-center px-4 border-l" type="submit">
                <svg class="h-4 w-4 text-grey-dark" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
              </button>
            </div>
        </div>
        </form>
        <!-- card grid-->
        <div class="grid gap-4 gap-y-8 md:grid-cols-2 lg:grid-cols-3 mb-16">
            @foreach ($organizations as $organization)
            <!-- card -->
               <div class="bg-white rounded-md overflow-hidden relative shadow-md">
                   <div class="p-4">
                    @if ($organization->getFirstMedia('logo'))
                        <img class="rounded-full h-20 w-20 flex items-center justify-center mx-auto mb-8" src="{{ asset($organization->getFirstMedia('logo')->getUrl()) }}" alt="">
                    @else
                        <div class="rounded-full h-20 w-20 flex items-center justify-center bg-gray-700 mx-auto mb-8 text-gray-400 text-sm text-center">No Image Available  
                        </div>
                    @endif
                   <h2 class="text-xl text-blue-400">{{ $organization->name }}</h2>
                   <div class="flex justify-between mt-4 mb-4 text-gray-500">
                       <div class="flex items-center">
                       <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                           <path d="M0 0h24v24H0z" fill="none"/>
                           <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                       </svg>
                       <span class="ml-1">{{ $organization->phone }}</span>
                       </div>
                   </div>
                   <div class="flex justify-between mt-4 mb-4 text-gray-500">
                       <div class="flex items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                               <path d="M0 3v18h24v-18h-24zm6.623 7.929l-4.623 5.712v-9.458l4.623 3.746zm-4.141-5.929h19.035l-9.517 7.713-9.518-7.713zm5.694 7.188l3.824 3.099 3.83-3.104 5.612 6.817h-18.779l5.513-6.812zm9.208-1.264l4.616-3.741v9.348l-4.616-5.607z"/>
                           </svg>
                           <span class="ml-1">{{ $organization->email }}</span>
                       </div>
                   </div>
                   <div class="flex justify-between mt-4 mb-4 text-gray-500">
                       <div class="flex items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                               <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 16.057v-3.057h2.994c-.059 1.143-.212 2.24-.456 3.279-.823-.12-1.674-.188-2.538-.222zm1.957 2.162c-.499 1.33-1.159 2.497-1.957 3.456v-3.62c.666.028 1.319.081 1.957.164zm-1.957-7.219v-3.015c.868-.034 1.721-.103 2.548-.224.238 1.027.389 2.111.446 3.239h-2.994zm0-5.014v-3.661c.806.969 1.471 2.15 1.971 3.496-.642.084-1.3.137-1.971.165zm2.703-3.267c1.237.496 2.354 1.228 3.29 2.146-.642.234-1.311.442-2.019.607-.344-.992-.775-1.91-1.271-2.753zm-7.241 13.56c-.244-1.039-.398-2.136-.456-3.279h2.994v3.057c-.865.034-1.714.102-2.538.222zm2.538 1.776v3.62c-.798-.959-1.458-2.126-1.957-3.456.638-.083 1.291-.136 1.957-.164zm-2.994-7.055c.057-1.128.207-2.212.446-3.239.827.121 1.68.19 2.548.224v3.015h-2.994zm1.024-5.179c.5-1.346 1.165-2.527 1.97-3.496v3.661c-.671-.028-1.329-.081-1.97-.165zm-2.005-.35c-.708-.165-1.377-.373-2.018-.607.937-.918 2.053-1.65 3.29-2.146-.496.844-.927 1.762-1.272 2.753zm-.549 1.918c-.264 1.151-.434 2.36-.492 3.611h-3.933c.165-1.658.739-3.197 1.617-4.518.88.361 1.816.67 2.808.907zm.009 9.262c-.988.236-1.92.542-2.797.9-.89-1.328-1.471-2.879-1.637-4.551h3.934c.058 1.265.231 2.488.5 3.651zm.553 1.917c.342.976.768 1.881 1.257 2.712-1.223-.49-2.326-1.211-3.256-2.115.636-.229 1.299-.435 1.999-.597zm9.924 0c.7.163 1.362.367 1.999.597-.931.903-2.034 1.625-3.257 2.116.489-.832.915-1.737 1.258-2.713zm.553-1.917c.27-1.163.442-2.386.501-3.651h3.934c-.167 1.672-.748 3.223-1.638 4.551-.877-.358-1.81-.664-2.797-.9zm.501-5.651c-.058-1.251-.229-2.46-.492-3.611.992-.237 1.929-.546 2.809-.907.877 1.321 1.451 2.86 1.616 4.518h-3.933z"/>
                           </svg>
                           <span class="ml-1">{{ $organization->website }}</span>
                       </div>
                   </div>
                   <div class="flex justify-between mt-4 mb-4 text-gray-500">
                       <div class="flex items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                               <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                           </svg>
                           <span class="ml-1">{{ $organization->people_count ?? 0 }}</span>
                       </div>
                   </div>
                   <div class="text-right">
                       <a href="{{ route('organization.show', $organization) }}" class="text-white bg-blue-400 p-1 rounded w-full uppercase text-sm">Details</a>
                   </div>
                   </div>
               </div>
             <!-- card -->
            @endforeach
    </div>
    {{ $organizations->links() }}
</x-app-layout>
