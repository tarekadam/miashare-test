@extends('layouts.app')

@section('content')


    <div class="container">

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>
                    {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
                </strong>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('forms.tasks') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(!Auth::user()->is_administrator)
                            <form class="form-inline" method="POST" action="{{ route('tasks.store') }}">
                                {{ csrf_field() }}
                                <div class="input-group my-4 col-6 mx-auto">
                                    <input class="form-control"
                                           name="memo"
                                           placeholder="Type something..."
                                           value="{{ old('memo') }}"
                                    >
                                    <span class="input-group-append">
                                <button class="btn btn-outline-primary rounded-right" type="submit">
                                    <i class="fas fa-save"></i> {{ __('buttons.save') }}
                                </button>
                            </span>
                                </div>

                            </form>
                            @else
                            <p class="alert alert-info">{{ __('instruction.administrator') }}</p>
                        @endif

                        @if($tasks->count())
                            <div class="list-group">
                                @foreach($tasks as $task)
                                    <div
                                        class="list-group-item list-group-item-action flex-column align-items-start @if($task->trashed()) list-group-item-danger @endif @if($task->done) list-group-item-success @endif">
                                        <div class="d-flex w-100 justify-content-between">
                                            @if(Auth::user()->is_administrator)
                                                <h5 class="mb-1">{{ $task->getKey() }} :: {{$task->User->name}}</h5>
                                            @endif
                                            <small>{{ $task->nice_date }}</small>
                                        </div>
                                        <p class="mb-1">{{ $task->memo }}</p>
                                        @if(!$task->done and !$task->trashed() and !Auth::user()->is_administrator)
                                            <div style="text-align: right; ">

                                                    <form style="display: block; float: right; margin-left: 0.5em;" action="{{ route('tasks.destroy', $task->getRouteKey()) }}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" class="btn btn-danger" title="Delete"
                                                           data-toggle="tooltip"
                                                           onclick="this.closest('form').submit();return false;">
                                                            <i class="bi bi-trash-fill" style="color:white"></i>X
                                                        </a>
                                                    </form>

                                                    <form style="display: block; float: right;" action="{{ route('tasks.update', $task->getRouteKey()) }}"
                                                          method="post">
                                                        @method('PUT')
                                                        @csrf
                                                        <a href="#" class="btn btn-success" title="Done"
                                                           data-toggle="tooltip"
                                                           onclick="this.closest('form').submit();return false;">
                                                            <i class="bi bi-trash-fill" style="color:white"></i>&checkmark;
                                                        </a>
                                                    </form>



                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
@endsection
