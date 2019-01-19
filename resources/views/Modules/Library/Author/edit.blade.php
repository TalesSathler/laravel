@extends('layouts.adminLTE.head')

@section('content')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('layouts/MaterialAdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ isset($author)? 'Edit' : 'New' }} author</h3>
                    </div>
                    <!-- /.box-header -->

                    <form data-toggle="validator" role="form" method="post" action="{{ (isset($author) ? route('library-author-edit') : route('library-author-create')) }}">
                        <div class="box-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="author_id" value="{{ isset($author) && $author['author_id'] ? $author['author_id'] :  '' }}" />


                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="form-group {{ $errors->has('author_name') ? 'is-focused' : '' }}">
                                        <label for="author_name">Name</label>
                                        <input type="text" class="form-control" id="author_name" name="author_name"
                                               value="{{ isset($author) && $author['author_name'] ? $author['author_name'] :  old('author_name') }}" required>

                                        @if ($errors->has('author_name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('author_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group {{ $errors->has('author_birthday') ? 'is-focused' : '' }}">
                                        <label for="author_birthday">Born Date</label>
                                        <input type="text" class="form-control" id="author_birthday" name="author_birthday"
                                               value="{{ isset($author) && $author['author_birthday'] ? $author['author_birthday'] :  old('author_birthday') }}">

                                        @if ($errors->has('author_birthday'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('author_birthday') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{{ route('library-author-index') }}" class="btn btn-primary pull-left">
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
    <script src="{{ asset('layouts/MaterialAdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#author_birthday').datepicker({
                autoclose: true
            });
        });
    </script>
@endsection