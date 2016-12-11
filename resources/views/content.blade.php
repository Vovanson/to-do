@extends('base')

@section('content')
    <!-- CONTENT START -->
    <div class="row" id="first">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading lead clearfix">
                    Categories
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                            data-target="#create_category_modal">
                        Create New Category
                    </button>
                </div>
                <div class="panel-body list-group" id="categories">
                    <a href="#" class="list-group-item active">
                        <span class="badge"></span>
                        All
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading lead clearfix">
                    Tasks
                    <button type="button" class="btn btn-success pull-right" data-toggle="modal"
                            data-target="#create_task_modal">
                        Create New Task
                    </button>
                </div>
                <div class="panel-body">
                    <ul class="todo-list ui-sortable" id="tasks">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT END -->
@endsection