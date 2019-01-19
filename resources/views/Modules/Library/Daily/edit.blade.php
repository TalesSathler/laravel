@extends('layouts.adminLTE.head')

@section('content')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('layouts/MaterialAdminLTE/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('layouts/MaterialAdminLTE/bower_components/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ isset($daily)? 'Edit' : 'New' }} Daily Read</h3>
                    </div>
                    <!-- /.box-header -->

                    <form data-toggle="validator" role="form" method="post" action="{{ (isset($daily) ? route('library-daily-edit') : route('library-daily-create')) }}">
                        <div class="box-body">
                            {{ csrf_field() }}

                            <input type="hidden" name="daily_id" value="{{ isset($daily) && $daily['daily_id'] ? $daily['daily_id'] :  '' }}" />


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group {{ $errors->has('book_id') ? 'is-focused' : '' }}">
                                        <label for="book_id">Book</label>
                                        <select class="form-control select2" name="book_id" id="book_id" required style="width: 100%">
                                            @foreach($books as $item)
                                                <option value="{{ $item->book_id }}">{{ $item->book_name }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('book_id'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('book_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group {{ $errors->has('daily_description') ? 'is-focused' : '' }}">
                                        <label for="daily_description">Description</label>
                                        <textarea class="form-control" id="daily_description" name="daily_description"
                                        >{{ isset($daily) && $daily['daily_description'] ? $daily['daily_description'] :  old('daily_description') }}</textarea>

                                        @if ($errors->has('daily_description'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('daily_description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('daily_time_start') ? 'is-focused' : '' }}">
                                        <label for="daily_time_start">Start Time</label>
                                        <input type="text" class="form-control" id="daily_time_start" name="daily_time_start"
                                               value="{{ isset($daily) && $daily['daily_time_start'] ? $daily['daily_time_start'] :  old('daily_time_start') }}">

                                        @if ($errors->has('daily_time_start'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('daily_time_start') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group {{ $errors->has('daily_time_end') ? 'is-focused' : '' }}">
                                        <label for="daily_time_end">End Time</label>
                                        <input type="text" class="form-control" id="daily_time_end" name="daily_time_end"
                                               value="{{ isset($daily) && $daily['daily_time_end'] ? $daily['daily_time_end'] :  old('daily_time_end') }}">

                                        @if ($errors->has('daily_time_end'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('daily_time_end') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ route('library-daily-index') }}" class="btn btn-primary pull-left">
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

    <!-- Datetimepicker -->
    <script src="{{ asset('layouts/MaterialAdminLTE/bower_components/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Inputmask -->
    <script type="application/javascript" src="{{ asset('layouts/MaterialAdminLTE/bower_components/inputmask/dist/min/jquery.inputmask.bundle.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            $('#book_id').select2().select2('val', {{ isset($daily) ? json_encode(array_column($daily->books()->get()->toArray(), 'book_id')) : '' }});


            debugger;
            var startdate = $('#daily_time_start').val();
            var enddate = $('#daily_time_start').val();

            if(startdate){
                startdate = new Date(startdate);
            }


            $('#daily_time_start').datetimepicker({
                format: 'MM/DD/YYYY HH:mm:ss',
                defaultDate: startdate
            });

            $('#daily_time_end').datetimepicker({
                format: 'MM/DD/YYYY HH:mm:ss',
                defaultDate: enddate
            });
        });
    </script>
@endsection