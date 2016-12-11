<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>To-Do List</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/my_style.css">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
</head>
<body>
<div class="container">

    <!-- NAVBAR START -->
    <nav class="navbar navbar-default nbstart">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">TO-DO List</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR END -->

    @yield('content')

</div>

<!-- CATEGORY MODAL START -->
<div id="create_category_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Create New Category</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>List Name</label>
                        <input type="text" class="form-control" placeholder="List Name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- CATEGORY MODAL END -->

<!-- TASK MODAL START -->
<div id="create_task_modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Create New Task</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Task</label>
                        <input type="text" class="form-control" placeholder="Task">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control">
                            <option>None</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
<!-- TASK MODAL END -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="/js/application.js"></script>

</body>