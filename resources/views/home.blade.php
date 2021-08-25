<x-app-layout>
    <div id="user_id" hidden >{{auth()->user()->id}}</div>
    <div class="container flex flex-col items-center justify-center max-w-4xl">
        <div class="flex flex-col justify-center">

            <div class="header flex justify-between items-center py-5">
                <div class="app-name"></div>
                <div class="animation flex flex-col items-center justify-center">
                    <img width="70" height="60" src="https://emojipedia-us.s3.amazonaws.com/source/skype/289/octopus_1f419.png" alt="">
                    <div class="font-black text-xl p-5">Task Management</div>
                </div>
                <div class="logout px-4">
                    <form method="post" action="{{route('logout')}}">
                        {{ csrf_field() }}
                        <button type="submit"><img src="https://img.icons8.com/plumpy/24/000000/export.png"/></button>
                    </form>
                </div>
            </div>

            <div class="board">

                <div class="board-top flex justify-between pt-10 py-6">
                    <select name="" id="boardSelect" class="boardSelectBox bg-gray-100 text-gray-800 font-semibold py-3 focus:ring-gray-200 focus:outline-none ring-gray-500 rounded-sm">
                        <option value="{{auth()->user()->id}}">My Tasks</option>
                        @foreach($users as $user)
                            <option value="{{$user->boards->first()->id}}" >{{$user->name.'\'s tasks'}}</option>
                        @endforeach
                    </select>
                    <button type="button" class="addNewTaskBtn px-4 py-3 bg-gray-300 rounded text-gray hover:bg-gray-400 focus:outline-none shadow mx-1 flex">
                        <img alt="add icon" class="h-6 w-6" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABRklEQVRIidWVu04DMRBFD8tLoFCASJWEEigJP8CnsXwabRoeBbC0JIg0ISIR6QKFZ1cTy/ZsojS5kiWPZ3zv+DWGTceW4c+AtrRj4FDGf4FvoC9tvopAB7gCGkYSU+AR+Ag5tyOiXeAa2DPIkZgzYBcY1hHoApc1iH2cCt9XSqCDyzyGHLgB7iP+JjAGfsqBHeXMcHuewrnhB7cDn8jBZ8rRxj7QOmgIFyGBdaEVEjgxJumDvzBiKy59BgdeUE58z289uwDulF0+yIUV+PhL+KzYytYrmAFHytYZgduWMvMceE8IzsqOXsHIyLJQ/RT5ApcW6BuTlkHF5QtM1kA+BQYhgTnwZEwugDcj5gFVvkPletViB/CCl2Somg5lvLkk+Svw7A+GBMCV3DHuRe4bxBOgR+Rm1f0yWyKmv8wR7mIMSHyZm49/O8g4woHgoiYAAAAASUVORK5CYII="/>
                        <span class="ml-2 font-bold text-gray-900"> New Task</span>
                    </button>
                </div>

                <div class="bg-gray-300 my-5 p-5 rounded-lg" hidden>
                    <div class="text-2xl font-bold text-gray-800 flex justify-center">Add new Task</div>
                    <div class="flex flex-col">
                        <label class="text-lg font-bold text-gray-700 my-2" for="">Title</label>
                        <input class="rounded-lg bg-gray-100 border-none h-14" type="text" name="title">
                    </div>
                    <div class="flex flex-col">
                        <label class="text-lg font-bold text-gray-700 my-2" for="">Descritption</label>
                        <textarea class="rounded-lg bg-gray-100 border-none" name="" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="p-2">
                        <button class="px-4 py-3 bg-gray-800 w-80 rounded text-white hover:bg-gray-400 focus:outline-none shadow my-3 flex justify-center">Save Task</button>
                    </div>
                </div>

                <div class="tasks bg-gray-200 rounded-lg p-4"  >
                    <div id="incomplete-tasks" class="incomplete">
                        @foreach($tasks as $task)
                            @if(!($task->status->name == 'completed'))
                                <div class="task task-active"  id="{{$task->id}}">
                                    <div class="bg-white flex justify-between my-5 p-5 rounded-md shadow">
                                        <div class="flex">
                                            <div class="px-4 flex items-center">
                                                <input class="checkTask rounded-sm h-5 w-5  text-gray-600" type="checkbox"/>
                                            </div>
                                            <div class="text-xl  text-gray-800 taskTitle">{{$task->title}}</div>
                                        </div>
                                        <div id="actions" class="flex items-center">
                                            <div class="px-3"><img src="https://img.icons8.com/plumpy/24/000000/visible.png" alt="View Task" /></div>
                                            <div class="px-3"><img src="https://img.icons8.com/plumpy/24/000000/edit--v1.png" alt="Edit Task" /></div>
                                            <div style="display: {{$task->user_id == auth()->user()->id ? 'block' : 'none'}}" class=" px-2" >
                                                <button  class="deleteTask">
                                                    <img src="https://img.icons8.com/plumpy/24/000000/trash.png" alt="Delete Task"/>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div id="completed-tasks" class="completed">
                        <div class="text-md font-bold text-gray-400 pt-5">Completed tasks</div>
                        @foreach($tasks as $task)
                            @if($task->status->name == 'completed')
                                <div class="task task-inactive"  id="{{$task->id}}">
                                    <div class="bg-gray-200 border-2 border-gray-300 flex justify-between my-5 p-5 rounded-md shadow">
                                        <div class="flex">
                                            <div class="px-4 flex items-center">
                                                <input class="uncheckTask rounded-sm h-5 w-5 text-gray-600" type="checkbox" checked/>
                                            </div>
                                            <div class="text-xl text-gray-600 taskTitle">{{$task->title}}</div>
                                        </div>
                                        <div id="actions" class="flex items-center">

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
