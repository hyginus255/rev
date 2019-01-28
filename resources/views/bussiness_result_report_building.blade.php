@extends('layouts.app')
@section('header')
<style>
    .links-margin{margin:3px;}
</style>
@endsection
@section('content')
<script>
window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer",
	{
        animationEnabled: true,
        theme: "light2",
        title:{
            text: <?php echo json_encode($search_info['name'], JSON_NUMERIC_CHECK) ; ?>
        },
        axisY: {
            title: <?php echo json_encode($search_info['axisY'], JSON_NUMERIC_CHECK) ; ?>
        },
        axisX: {
            title: <?php echo json_encode($search_info['axisX'], JSON_NUMERIC_CHECK) ; ?>
        },
        data: [
        {
            type: "pie",
            dataPoints: <?php echo json_encode($data_points, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });

 chart.render();

var chartType = document.getElementById('chartType');
chartType.addEventListener( "change",  function(){
  chart.options.data[0].type = chartType.options[chartType.selectedIndex].value;
  chart.render();
});
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Search Result</div>

                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                            <div class="row">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('business_search_report')}}">Back to Search</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">General Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{route('business_result_report_building')}}">Bulding Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('business_result_report_staff')}}">Staff Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Ward Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Streets Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Category Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Revenue Report</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-md-3" style="padding:25px 20px 10px 20px;">
                                    <div class="form-group">
                                    <label for="chart_type"><strong>Chart Type</strong></label>
                                    <select class="form-control" id="chartType" name="Chart Type">
                                        <option>Select Chart Type</option>
                                        <option value="pie">Pie</option>
                                        <option value="bar">Bar</option>
                                        <option value="column">Column</option>
                                        <option value="line">Line</option>
                                        <option value="scatter">Scatter</option>
                                        <option value="area">Area</option>
                                        <option value="spline">Spline</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <br/><br/>
                        <hr/>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong>Table</strong>
                                </div>
                            </div>
                            <div class="row" style="padding:10px;">
                                <div class="col-md-12">
                                    <ul class="nav justify-content-end">
                                        <li class="nav-item links-margin">
                                            <a class="btn btn-primary active" href="#">Download PDF File</a>
                                        </li>
                                        <li class="nav-item links-margin">
                                            <a class="btn btn-danger" href="#">Download Excel File</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <script src="http://maps.googleapis.com/maps/api/js"></script>
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead class="bg-info">
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            </tr>
                                        </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection