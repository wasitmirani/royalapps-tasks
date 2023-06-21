<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <x-auth-session-status class="mb-4" :status="session('message')" />
            <form class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6" method="POST" action="{{route('book.store')}}">
            @csrf
                <h2 class="text-2xl font-semibold mb-4">Create New Book</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="author">Author:</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded" id="author" name="author" required>
                      <option value="" disabled selected>Select an author</option>
                      @foreach ($authors->items  as $author)
                      <option value="{{$author->id}}">{{ $author->first_name .' '.$author->last_name}}</option>
                      @endforeach
                      
                 
                      <!-- Add more options for authors as needed -->
                    </select>
                  </div>
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Title:</label>
                  <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" id="title" name="title" placeholder="Enter the title" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">Release Date:</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded" type="date" id="title" name="release_date" placeholder="Enter the release date" required>
                  </div>
                
               
                
                <div class="mb-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description:</label>
                  <textarea class="w-full px-3 py-2 border border-gray-300 rounded" id="description" name="description" placeholder="Enter the description" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="isbn">Isbn:</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" id="isbn" name="isbn" placeholder="Enter the isbn" required>
                  </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="isbn">Format:</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" id="isbn" name="format" placeholder="Enter the format" required>
                  </div>
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="pages">Pages:</label>
                    <input class="w-full px-3 py-2 border border-gray-300 rounded" type="number" id="pages" name="pages" placeholder="Enter the format" required>
                  </div>
                  
                <div class="flex justify-end">
                  <button style="background-color: green;" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded" type="submit">Create</button>
                </div>
              </form>
              
          
        </div>
    </div>
</x-app-layout>