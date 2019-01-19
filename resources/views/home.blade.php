@extends('layouts.adminLTE.head')

@section('content')

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $qnt_books }}</h3>

                    <p>My Books</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-bookmarks"></i>
                </div>
                <a href="{{ route('library-book-index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box -->
        </div>
        <!-- right col -->

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-light-blue">
                <div class="inner">
                    <h3>{{ $qnt_authors }}</h3>

                    <p>My Authors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-person"></i>
                </div>
                <a href="{{ route('library-author-index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box -->
        </div>
        <!-- right col -->

        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
                <div class="inner">
                    <h3>{{ $qnt_dailies }}</h3>

                    <p>My daily read</p>
                </div>
                <div class="icon">
                    <i class="ion ion-calendar"></i>
                </div>
                <a href="{{ route('library-daily-index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            <!-- /.box -->
        </div>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
</section>

@endsection

@section('js')
    <!-- Morris.js charts -->
    <script src="{{ asset('layouts/MaterialAdminLTE/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('layouts/MaterialAdminLTE/bower_components/morris.js/morris.min.js') }}"></script>
@endsection