@extends('layouts.web')
@push('style')
    <style>
        #style-3::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px #fff;
            background-color: #fff;
        }

        #style-3::-webkit-scrollbar
        {
            width: 3px;
            background-color: #F5F5F5;
        }

        #style-3::-webkit-scrollbar-thumb
        {
            background-color: #fff;
        }

    </style>
@endpush
@section('conten')   
    <div id="content" class="content">
        <!-- begin breadcrumb -->
        <ol class="breadcrumb float-xl-right">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">{{$menu}}</a></li>
        </ol>
        
        <h1 class="page-header">{{$menu}} <small>{{name()}}</small></h1>
        
        <div class="row">
            <!-- begin col-6 -->
            <div class="col-xl-12 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse" data-sortable-id="chart-js-1">
                    <div class="panel-heading ui-sortable-handle">
                        <h4 class="panel-title">Line Chart</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>
                            A line chart is a way of plotting data points on a line.
                            Often, it is used to show trend data, and the comparison of two data sets.
                        </p>
                        <div>
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="bar-chart" data-render="chart-js" width="495" height="247" style="display: block; width: 495px; height: 247px;" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                <!-- end panel -->
            </div>
            <!-- end col-6 -->
            
        </div>
        
    </div>
@endsection
@push('ajax')
    <script>
    </script>

@endpush