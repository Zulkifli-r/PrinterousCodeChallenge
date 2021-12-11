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
            <div class="bg-transparent rounded overflow-hidden p-8">
              <div class="flex justify-between">
                  <p class="font-bold text-lg">PIC</p>
                  <a href="{{ route('organization.people.create', $organization) }}" class="bg-green-400 rounded text-white px-2 hover:bg-green-600">+</a>
              </div>
              <table class="min-w-full leading-normal">
                  <thead>
                    <tr>
                      <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                      >
                        Name
                      </th>
                      <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                      >
                        Phone
                      </th>
                      <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider"
                      >
                        Email
                      </th>
                      <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"
                      >
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($organization->people as $person)
                    <tr>
                      <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex">
                          <div class="flex-shrink-0 w-10 h-10">
                            @if ($person->getFirstMedia('avatar'))
                              <img
                                class="w-full h-full rounded-full"
                                src="{{ asset($person->getFirstMedia('avatar')->getUrl()) }}"
                                alt=""
                              />
                            @endif
                          </div>
                          <div class="ml-3 pt-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                              {{ $person->name }}
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $person->phone }}
                      </td>
                      <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                          {{ $person->email }}
                        </td>
                      <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center flex justify-between">
                          <a href="{{ route('organization.people.edit', [$organization, $person]) }}" class="font-bold py-2 px-4 mr-1 text-yellow-400"><i class="ri-edit-line"></i></a>
                          <form method="POST" action="{{ route('organization.people.delete', [$organization, $person]) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="font-bold py-2 px-4 -mr-1 text-red-400"><i class="ri-delete-bin-line"></i></button>
                          </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
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