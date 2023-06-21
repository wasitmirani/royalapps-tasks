<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Author Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                  <img class="w-16 h-16 rounded-full mr-4" src="https://placeimg.com/200/200/women" alt="Author Avatar">
                  <div>
                    <h2 class="text-xl font-semibold">{{$author->first_name}} {{$author->last_name}}</h2>
                    <p class="text-gray-500">{{$author->gender}}</p>
                  </div>
                </div>
                <p class="mt-4">
                {{$author->biography}}
                </p>
                
              </div>
              <br>
              <hr>
              
              <h1 style="text-align: center">{{$author->first_name}} {{$author->last_name}} Books List</h1>
              <br>
              <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <x-auth-session-status class="mb-4" :status="session('message')" />
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                  <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Title
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Release Date
                             </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            isbn
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Format
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Pages
                          </th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($author->books as $book)
                      <tr>
                        
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                              {{$book->title}}
                            </span>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                @php
                                $date = $book->release_date;
                                $formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i:sP', $date)->format('Y-m-d');
                            @endphp
                            
                            {{ $formattedDate }}
                             
                            </span>
                          </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ Str::limit($book->description, 10,'...') }}
                                </span>
                              </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{$book->isbn}}
                              </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{$book->format}}
                              </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                  {{$book->number_of_pages}}
                                </span>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap">
                              
                                <x-nav-link :href="route('book.delete',['id'=>$book->id])">
                                    {{ __('Delete') }}
                                </x-nav-link>
                              </td>
                           
                      </tr>
                      @endforeach
                    
                        <!-- More table rows -->
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
        </div>
    </div>
</x-app-layout>
