$(document).on('click', ".addNewTaskBtn", function (e) {
    console.log('Add new task')
});

$(document).on('change', ".boardSelectBox", function (e) {
    var board = $('#boardSelect').find(":selected").val();
    axios.get('boards/' +board+ '/tasks').then(res =>{
        $('.task').remove();
        renderTasks(res.data)
    })
});

$(document).on('click', '.deleteTask', function (e){
    var task_id = $(this).closest('.task').attr('id');
    axios.delete('tasks/'+task_id).then(res => {
        $("#"+task_id).remove();
    })
})


$(document).on('change', '.checkTask', function (e) {
    var task_id = $(this).closest('.task').attr('id');
    axios.patch('tasks/'+task_id, {
        status_id: 3,
    }).then(res => {
        var task_title = res.data['title'];
        $('#'+task_id).remove();
        renderTasks([res.data])
    })
});

$(document).on('change', '.uncheckTask', function (e) {
    var task_id = $(this).closest('.task').attr('id');
    axios.patch('tasks/'+task_id, {
        status_id: 1,
    }).then(res => {
        $('#'+task_id).remove();
        renderTasks([res.data])
    })
});

function renderTasks(tasks) {
    var userId = $('#user_id').text();
    for (task of tasks) {
        if(!(task['status_id'] === 3)){ // INCOMPLETE
            var deleteable = 'none';
            if(task['user_id'] == userId) deleteable = 'block';
            $('#incomplete-tasks').append("<div class=\"task task-active\">\n" +
                "                                    <div id=\"" + task['id'] + "\" class=\"bg-white flex justify-between my-5 p-5 rounded-md shadow\">\n" +
                "                                        <div class=\"flex\">\n" +
                "                                            <div class=\"px-4 flex items-center\">\n" +
                "                                                <input class=\"rounded-sm h-5 w-5  text-gray-600\" type=\"checkbox\"/>\n" +
                "                                            </div>\n" +
                "                                            <div class=\"text-xl  text-gray-800 \">" + task['title'] +"</div>\n" +
                "                                        </div>\n" +
                "                                        <div id=\"actions\" class=\"flex items-center\">\n" +
                "                                            <div class=\"px-3\"><img src=\"https://img.icons8.com/plumpy/24/000000/visible.png\" alt=\"View Task\" /></div>\n" +
                "                                            <div class=\"px-3\"><img src=\"https://img.icons8.com/plumpy/24/000000/edit--v1.png\" alt=\"Edit Task\" /></div>\n" +
                "                                            <div style=\"display: " + deleteable + "\" class=\"px-2\" >\n" +
                "                                                <img src=\"https://img.icons8.com/plumpy/24/000000/trash.png\" alt=\"Delete Task\"/>\n" +
                "                                            </div>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "                                </div>");
        }else {
            $('#completed-tasks').append("" +
                "<div class=\"task task-inactive\">\n" +
                "                                    <div id=\"" + task['id'] + "\" class=\"bg-gray-200 border-2 border-gray-300 flex justify-between my-5 p-5 rounded-md shadow\">\n" +
                "                                        <div class=\"flex\">\n" +
                "                                            <div class=\"px-4 flex items-center\">\n" +
                "                                                <input class=\"rounded-sm h-5 w-5 text-gray-600\" type=\"checkbox\" checked/>\n" +
                "                                            </div>\n" +
                "                                            <div class=\"text-xl text-gray-600\">" + task['title'] +"</div>\n" +
                "                                        </div>\n" +
                "                                        <div id=\"actions\" class=\"flex items-center\">\n" +
                "\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "                                </div>" +
                "");
        }


    }
}


