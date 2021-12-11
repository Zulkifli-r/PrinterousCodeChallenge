<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Organization Details') }}
        </h2>
    </x-slot>
    <x-success class="my-1" />
    <section class="bg-grey-lightest py-8">
      <div class="w-full max-w-6xl ml-auto mr-auto mt-8">
        <div class="flex flex-wrap -mx-6 -my-6">
          {{-- ORGANIZATION DETAILS --}}
          <div class="w-full lg:w-4/12 py-6 min-h-full">
            <div class="bg-white rounded shadow-lg overflow-hidden p-8">
              @if ($organization->getFirstMedia('logo'))
                <img class="rounded-full h-40 w-40 flex items-center justify-center mx-auto mb-8" src="{{ asset($organization->getFirstMedia('logo')->getUrl()) }}" alt="">
              @else
                <div class="rounded-full h-40 w-40 flex items-center justify-center bg-gray-700 mx-auto mb-8 text-gray-400">No Image Available  
                </div>
              @endif
              <div class="font-bold text-xl mb-2 text-center">{{ $organization->name }}</div>
              <div class="flex justify-between mt-4 mb-4 text-gray-500">
                  <div class="flex items-center">
                  <i class="ri-phone-fill"></i>
                  <span class="ml-1">{{ $organization->phone }}</span>
                  </div>
              </div>
              <div class="flex justify-between mt-4 mb-4 text-gray-500">
                  <div class="flex items-center">
                    <i class="ri-mail-fill"></i>
                    <span class="ml-1">{{ $organization->email }}</span>
                  </div>
              </div>
              <div class="flex items-center text-gray-500">
                <i class="ri-global-line"></i>
                <span class="ml-1">{{ $organization->website }}</span>
              </div>
              <div class="flex justify-between">
                <a href="{{ route('organization.edit', $organization) }}" class="text-yellow-400 font-semibold mt-4 py-2 px-4 hover:border-transparent "><i class="ri-edit-line text-lg"></i></a>
                <form id="delete-organization" action="{{ route('organization.delete', $organization) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="text-red-400 font-semibold mt-4 py-2 px-4 hover:border-transparent "><i class="ri-delete-bin-line text-lg"></i></button> 
                </form>
              </div>
            </div>
          </div>
          {{-- PIC --}}
          <div class="w-full lg:w-8/12 py-6">
            
          </div>
        </div>
      </div>
    </section>
    <script>
      document.addEventListener("DOMContentLoaded", function(event) { 
          let deleteForm = document.getElementById('delete-organization');
          deleteForm.addEventListener('submit', function(e){
            let answer = confirm('Are you sure?');
            if (!answer) {
              e.preventDefault();
            }
          })
      });
    </script>
  </x-app-layout>