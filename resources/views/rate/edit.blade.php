<x-app-layout>
    <div>
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
            <div class="container mx-auto px-6 py-1 pb-16">
                <div class="bg-white rounded my-6 p-5" style="background-color: #FCB22D">
                    <h1 class="text-center font-bold">Edit Department</h1>
                </div>
                <div class="bg-white shadow-md rounded my-6 p-5">
                    <form method="POST" action="{{ route('admin.rates.update',$data['rate']->id)}}">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-gray-700 select-none font-medium">Title</label>
                            <input id="title" type="text" name="content" value="{{ old('content',$data['rate']->content) }}" placeholder="Feedback Content" class="px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200" />
                        </div>
                        <div class="flex gap-2 ">
                            <div>
                                <label for="description" class="text-gray-700 select-none font-medium">User</label>
                                <div class="flex gap-2">
                                    <select class="border border-gray-300  text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" name="user_id" @if(!auth()->user()->hasRole('admin')) disabled @endif>
                                        <option value="" disabled>Select User</option>
                                        @foreach($data['users'] as $user)
                                            <option value="{{$user->id}}" @if($user->id===$data['rate']->user_id) selected @endif>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                        <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <label for="description" class="text-gray-700 select-none font-medium">Star</label>
                                <div class="flex gap-2">
                                    <select name="star" class="border border-gray-300   text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                                        <option value="" disabled>Select Star</option>
                                        @for($i=0; $i<5; $i++)
                                            <option @if($data['rate']->star==$i+1) selected @endif value="{{$i+1}}">{{$i+1}} @if($i+1>1) Stars @else Star @endif</option>
                                        @endfor
                                    </select>
                                </div>
                                <div>
                                    <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                                        <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-16 mb-16">
                            <button type="submit" class="bg-blue-500 text-white font-bold px-5 py-1 rounded focus:outline-none shadow hover:bg-blue-500 transition-colors ">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>