$(document).ready(function () {
    var categories = [];
    var category_select;
    var obj_categories;
    var active = '';

    listCategorias();

    //get Categories & Tasks List
    function listCategorias() {
        $.getJSON('/category', function (data) {
            getAllList(data);
        });
    }


    function getAllList(data) {
        var oll_tasks = 0;
        obj_categories = data;

        $('#categories  a:first').addClass('active');
        $('#categories a:not(:first)').remove();
        $('#create_task_modal select option:not(:first)').remove();
        $('#tasks li').remove();

        $.each(data, function (key, value) {
            categories[value.id] = value.name;

            if (value.name == category_select) {
                $('#categories > a').removeClass('active');
                active = 'active';
                listTasks(value);
            }

            //formation the list of categories
            $('#categories').append('<a href="#" class="list-group-item ' + active + '"><span class="badge">' +
                value.tasks.length + '</span>' + value.name + '</a>');

            if (!category_select) {
                listTasks(value);
            }

            //drop-down list of categories
            $('#create_task_modal select').append('<option>' + value.name + '</option>');

            oll_tasks += value.tasks.length;
            active = '';
        });

        //all categories
        $('#categories span:first').html(oll_tasks);
    }

    //Task list
    function listTasks(value) {
        var check = '';
        var done = '';
        $.each(value.tasks, function (item, tasks) {
            if (tasks.done) {
                done = 'class="done"';
                check = ' checked ';
            }

            $('#tasks').append('<li ' + done + ' id-task=' + tasks.id + '><input type="checkbox" value=' + tasks.id + check + '><span class="text">' +
                tasks.name + '</span><small class="label label-' + tasks.state + '">' +
                value.name + '</small><div class="tools">' +
                '<i class="glyphicon glyphicon glyphicon-pencil"></i>' +
                '<i class="glyphicon glyphicon-remove-circle"></i></div></li>');

            done = '';
            check = '';
        });
    };

    //Add Category
    $('#create_category_modal').on('click', '.btn-primary', function () {

        $('#create_category_modal .btn-primary').attr('disabled', true);
        var new_category = $('#create_category_modal input').val();

        $.ajax({
            type: 'post',
            url: '/category',
            data: {
                'name': new_category, '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data);
                if (data != 'Error') {
                    $('#create_category_modal .close span').click();

                    listCategorias();
                    $('#create_category_modal input').val('');
                    $('#create_category_modal .btn-primary').attr('disabled', false);

                } else {
                    alert('Category is present');
                    $('#create_category_modal .btn-primary').attr('disabled', false);
                }
            }
        });
    });

    //Add Task
    $('#create_task_modal').on('click', '.btn-primary', function () {

        $('#create_task_modal .btn-primary').attr('disabled', true);
        var new_task = $('#create_task_modal input').val();
        var category_task = $('#create_task_modal select').val();
        var category_id = categories.indexOf(category_task);

        $.ajax({
            type: 'post',
            url: '/task',
            data: {
                'name': new_task,
                'category_id': category_id,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                console.log(data);
                if (data != 'Error') {
                    $('#create_task_modal .close span').click();
                    $('#create_task_modal input').val('');

                    listCategorias();
                    $('#create_task_modal .btn-primary').attr('disabled', false);
                } else {
                    alert('Task is present');
                    $('#create_task_modal .btn-primary').attr('disabled', false);
                }
            }
        });
    });

    // Select Category
    $('#categories').on('click', 'a', function () {

        var cat = $(this).contents();
        $('#tasks li').remove();
        category_select = cat[1].data;
        $('#categories > a').removeClass('active');

        if (!category_select) {
            getAllList(obj_categories);
        } else {
            $.each(obj_categories, function (key, value) {

                if (value.name == category_select)
                    listTasks(obj_categories[key]);
            });
        }
        $(this).addClass('active');
    });

    //Delete Task
    $('#tasks').on('click', '.glyphicon-remove-circle', function () {

        var task_id = $(this).closest('li').attr('id-task');
        $.ajax({
            type: 'delete',
            url: '/task/' + task_id,
            data: {
                'name': task_id, '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                listCategorias();
            }
        });

    });

    // Edit Task
    $('#tasks').on('click', '.glyphicon-pencil', function () {
        var danger;
        var li = $(this).closest('li');
        var small = li.children('small');

        if (small.hasClass('label-success')) {
            small.removeClass('label-success');
            small.addClass('label-danger');
            state = 'danger';
        } else {
            small.removeClass('label-danger');
            small.addClass('label-success');
            state = 'success';
        }
        var input = li.children('input');
        var task_id = input.val();
        $.ajax({
            type: 'patch',
            url: '/task/' + task_id,
            data: {
                active: 'state', 'state': state, '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                listCategorias();
            }
        });
    });

    // Checkbox done
    $('#tasks').on('click', 'input', function () {
        var done;
        var li = $(this).closest('li');
        var check = $(this).closest('input');
        var task_id = check.val();
        if (check.prop('checked') == false) {
            li.removeClass('done');
            done = '0';
        } else {
            li.addClass('done');
            done = '1';
        }
        $.ajax({
            type: 'patch',
            url: '/task/' + task_id,
            data: {
                active: 'done', 'done': done, '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                listCategorias();
            }
        });
    });
});
