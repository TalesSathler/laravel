@extends('layouts.adminLTE.head')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Books</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="30%">Name</th>
                            <th width="20%">Year</th>
                            <th width="20%">Author</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($books) && $books->count())
                            @foreach($books as $item)
                                <tr>
                                    <td>
                                        {{ $item->book_id }}
                                    </td>
                                    <td>
                                        {{ $item->book_name }}
                                    </td>
                                    <td>
                                        {{ $item->book_year }}
                                    </td>
                                    <td>
                                        {{ implode(', ', array_column($item->authors->toArray(), 'author_name')) }}
                                    </td>
                                    <td>
                                        <a href="{{ route('library-book-edit', ['book_id' => $item->book_id]) }}">
                                            <i class="fa fa-edit" aria-hidden="true"
                                               data-toggle="tooltip" data-placement="top" title="Edit"></i>
                                        </a>

                                        <a href="{{ route('library-book-delete', ['book_id' => $item->book_id]) }}"
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

                    @if(!empty($books) && $books->count())
                        <div class="text-center">
                            {{ $books->links() }}
                        </div>
                    @endif

                    <div class="box-footer">
                        <a href="{{ route('library-book-create') }}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus-square-o"></i> New Book
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