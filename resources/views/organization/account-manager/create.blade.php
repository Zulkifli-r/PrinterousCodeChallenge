<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Assign Account Manager for ').$organization->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
          <div>
            <h2 class="text-2xl font-semibold leading-tight">Available Users</h2>
          </div>
          <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div
              class="inline-block min-w-full shadow-md rounded-lg overflow-hidden"
            >
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
                      email
                    </th>
                    <th
                      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"
                    >
                    
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr>
                      <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex">
                          <div class="ml-3">
                            <p class="text-gray-900 whitespace-no-wrap">
                              {{ $user->name }}
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        {{ $user->email }}
                      </td>
                      <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <form action="{{ route('organization.account-manager.store', [$organization, $user] ) }}" method="POST">
                          @csrf
                          <button type="submit" class="bg-green hover:bg-green-600 text-white font-bold py-2 px-4 -mr-1 bg-green-400 shadow">Assign</button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">No Data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
