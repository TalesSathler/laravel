@extends('layouts.adminLTE.head')

@section('content')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('layouts/MaterialAdminLTE/bower_components/select2/dist/css/select2.min.css') }}">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ isset($book)? 'Edit' : 'New' }} Book</h3>
                    </div>
                    <!-- /.box-header -->

                    <form data-toggle="validator" role="form" method="post" action="{{ (isset($book) ? route('library-book-edit') : route('library-book-create')) }}">
                        <div class="box-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="book_id" value="{{ isset($book) && $book['book_id'] ? $book['book_id'] :  '' }}" />


                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group {{ $errors->has('book_name') ? 'is-focused' : '' }}">
                                        <label for="book_name">Name</label>
                                        <input type="text" class="form-control" id="book_name" name="book_name"
                                               value="{{ isset($book) && $book['book_name'] ? $book['book_name'] :  old('book_name') }}" required>

                                        @if ($errors->has('book_name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('book_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group {{ $errors->has('author_id') ? 'is-focused' : '' }}">
                                        <label for="author_id">Authors</label>
                                        <select class="form-control select2" name="author_id[]" id="author_id" multiple="multiple" required style="width: 100%">
                                            @foreach($authors as $item)
                                                <option value="{{ $item->author_id }}">{{ $item->author_name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('author_id'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('author_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group {{ $errors->has('book_publisher') ? 'is-focused' : '' }}">
                                        <label for="book_publisher">Publisher</label>
                                        <input type="text" class="form-control" id="book_publisher" name="book_publisher"
                                               value="{{ isset($book) && $book['book_publisher'] ? $book['book_publisher'] :  old('book_publisher') }}" required>

                                        @if ($errors->has('book_publisher'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('book_publisher') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group {{ $errors->has('book_year') ? 'is-focused' : '' }}">
                                        <label for="book_year">Year</label>
                                        <input type="text" class="form-control" id="book_year" name="book_year"
                                               value="{{ isset($book) && $book['book_year'] ? $book['book_year'] :  old('book_year') }}">

                                        @if ($errors->has('book_year'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('book_year') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group {{ $errors->has('book_language') ? 'is-focused' : '' }}">
                                        <label for="book_language">Language</label>
                                        <input type="text" class="form-control" id="book_language" name="book_language"
                                               value="{{ isset($book) && $book['book_language'] ? $book['book_language'] :  old('book_language') }}">

                                        @if ($errors->has('book_language'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('book_language') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group {{ $errors->has('book_pages') ? 'is-focused' : '' }}">
                                        <label for="book_pages">Pages</label>
                                        <input type="number" class="form-control" id="book_pages" name="book_pages"
                                               value="{{ isset($book) && $book['book_pages'] ? $book['book_pages'] :  old('book_pages') }}">

                                        @if ($errors->has('book_pages'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('book_pages') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{{ route('library-book-index') }}" class="btn btn-primary pull-left">
                                <i class="fa fa-rotate-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="fa fa-save"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <!-- Select2 -->
    <script src="{{ asset('layouts/MaterialAdminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('layouts/MaterialAdminLTE/bower_components/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#author_id').select2().select2('val', {{ isset($book) ? json_encode(array_column($book->authors()->get()->toArray(), 'author_id')) : '' }});

            $("[name='book_year']").inputmask("9999", {
                postValidation: function (buffer, opts) {
                    return parseInt(buffer.join('')) <= (new Date()).getFullYear();
                }
            });
        });
    </script>
@endsection