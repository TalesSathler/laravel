@extends('layouts.adminLTE.head')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dailies Reads</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="25%">Book Name</th>
                            <th width="25%">Description</th>
                            <th width="15%">Time Start</th>
                            <th width="15%">Time End</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($dailies) && $dailies->count())
                            @foreach($dailies as $item)
                                <tr>
                                    <td>
                                        {{ $item->daily_id }}
                                    </td>
                                    <td>
                                        {{ $item->books->book_name }}
                                    </td>
                                    <td>
                                        {{ $item->daily_description }}
                                    </td>
                                    <td>
                                        {{ $item->daily_time_start }}
                                    </td>
                                    <td>
                                        {{ $item->daily_time_end }}
                                    </td>
                                    <td>
                                        <a href="{{ route('library-daily-edit', ['daily_id' => $item->daily_id]) }}">
                                            <i class="fa fa-edit" aria-hidden="true"
                                               data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                        </a>

                                        <a href="{{ route('library-daily-delete', ['daily_id' => $item->daily_id]) }}"
                                           class="delete-data"><i class="fa fa-trash-o" aria-hidden="true"
                                                                  data-toggle="tooltip" data-placement="top" title="Remove"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center">
                                <td colspan="5">No records found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    </div>

                    @if(!empty($dailies) && $dailies->count())
                        <div class="text-center">
                            {{ $dailies->links() }}
                        </div>
                    @endif

                    <div class="box-footer">
                        <a href="{{ route('library-daily-create') }}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus-square-o"></i> New Daily Read
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/Library/index.js') }}"></script>
@endsection