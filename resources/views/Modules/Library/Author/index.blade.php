@extends('layouts.adminLTE.head')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Authors</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="30%">Name</th>
                            <th width="20%">Born Date</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($authors) && $authors->count())
                            @foreach($authors as $item)
                                <tr>
                                    <td>
                                        {{ $item->author_id }}
                                    </td>
                                    <td>
                                        {{ $item->author_name }}
                                    </td>
                                    <td>
                                        {{ $item->author_birthday }}
                                    </td>
                                    <td>
                                        <a href="{{ route('library-author-edit', ['author_id' => $item->author_id]) }}">
                                            <i class="fa fa-edit" aria-hidden="true"
                                               data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                        </a>

                                        <a href="{{ route('library-author-delete', ['author_id' => $item->author_id]) }}"
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

                    @if(!empty($authors) && $authors->count())
                        <div class="text-center">
                            {{ $authors->links() }}
                        </div>
                    @endif

                    <div class="box-footer">
                        <a href="{{ route('library-author-create') }}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus-square-o"></i> New Author
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