<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #chartdiv {
        width: 100%;
        height: 500px;
        }
    </style>
</head>
<body>

    <div id="chartdiv1"></div>
    <div id="chartdiv2"></div>
    <div id="chartdiv3"></div>

    {{--reference: https://www.amcharts.com/ --}}
    <script src="//cdn.amcharts.com/lib/5/index.js"></script>
    <script src="//cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="//cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <!-- RBS -->
    <script>
    am5.ready(function() {

        var root = am5.Root.new("chartdiv1");

        root.setThemes([
        am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX: true
        }));

        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);

        var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
        xRenderer.labels.template.setAll({
        rotation: -90,
        centerY: am5.p50,
        centerX: am5.p100,
        paddingRight: 15
        });

        xRenderer.grid.template.setAll({
        location: 1
        })

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
        maxDeviation: 0.3,
        categoryField: "date",
        renderer: xRenderer,
        tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        maxDeviation: 0.3,
        renderer: am5xy.AxisRendererY.new(root, {
            strokeOpacity: 0.1
        })
        }));

        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Series 1",
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        sequencedInterpolation: true,
        categoryXField: "date",
        tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
        })
        }));

        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
        series.columns.template.adapters.add("fill", function(fill, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        var data = @json($data_rbs);

        xAxis.data.setAll(data);
        series.data.setAll(data);

        series.appear(1000);
        chart.appear(1000, 100);

        });
    </script>

    <!-- BP -->
    <script>
    am5.ready(function() {
        var root = am5.Root.new("chartdiv2");
        root.setThemes([
        am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: false,
        panY: false,
        wheelX: "panX",
        wheelY: "zoomX",
        layout: root.verticalLayout
        }));

        var legend = chart.children.push(am5.Legend.new(root, {
        centerX: am5.p50,
        x: am5.p50
        }));

        var data = @json($data_bp);

        var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
        categoryField: "date",
        renderer: am5xy.AxisRendererY.new(root, {
            inversed: true,
            cellStartLocation: 0.1,
            cellEndLocation: 0.9
        })
        }));
        yAxis.data.setAll(data);

        var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
        renderer: am5xy.AxisRendererX.new(root, {
            strokeOpacity: 0.1
        }),
        min: 0
        }));

        function createSeries(field, name) {
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: name,
            xAxis: xAxis,
            yAxis: yAxis,
            valueXField: field,
            categoryYField: "date",
            sequencedInterpolation: true,
            tooltip: am5.Tooltip.new(root, {
            pointerOrientation: "horizontal",
            labelText: "[normal]{name}: {valueX}"
            })

        }));

        series.columns.template.setAll({
            height: am5.p100,
            strokeOpacity: 0
        });

        series.bullets.push(function() {
            return am5.Bullet.new(root, {
            locationX: 1,
            locationY: 0.5,
            sprite: am5.Label.new(root, {
                centerY: am5.p50,
                text: "{valueX}",
                populateText: true,
                fontSize: 12
            })
            });
        });

        series.bullets.push(function() {
            return am5.Bullet.new(root, {
            locationX: 1,
            locationY: 0.5,
            sprite: am5.Label.new(root, {
                centerX: am5.p100,
                centerY: am5.p50,
                text: "{name}",
                fontSize: 10,
                fill: am5.color(0xffffff),
                populateText: true
            })
            });
        });

        series.data.setAll(data);
        series.appear();

        return series;
        }

        createSeries("highbp", "Systolic");
        createSeries("lowbp", "Diastolic");


        var legend = chart.children.push(am5.Legend.new(root, {
        centerX: am5.p50,
        x: am5.p50
        }));
        legend.data.setAll(chart.series.values);

        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
        behavior: "zoomY"
        }));
        cursor.lineY.set("forceHidden", true);
        cursor.lineX.set("forceHidden", true);

        chart.appear(1000, 100);
    });
    </script>

    <!-- weight -->
    <script>
    am5.ready(function() {

        var root = am5.Root.new("chartdiv3");

        root.setThemes([
        am5themes_Animated.new(root)
        ]);

        var chart = root.container.children.push(am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX",
        pinchZoomX: true
        }));

        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);

        var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
        xRenderer.labels.template.setAll({
        rotation: -90,
        centerY: am5.p50,
        centerX: am5.p100,
        paddingRight: 15
        });

        xRenderer.grid.template.setAll({
        location: 1
        })

        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
        maxDeviation: 0.3,
        categoryField: "date",
        renderer: xRenderer,
        tooltip: am5.Tooltip.new(root, {})
        }));

        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
        maxDeviation: 0.3,
        renderer: am5xy.AxisRendererY.new(root, {
            strokeOpacity: 0.1
        })
        }));

        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
        name: "Series 1",
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        sequencedInterpolation: true,
        categoryXField: "date",
        tooltip: am5.Tooltip.new(root, {
            labelText: "{valueY}"
        })
        }));

        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
        series.columns.template.adapters.add("fill", function(fill, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
        return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        var data = @json($data_weight);

        xAxis.data.setAll(data);
        series.data.setAll(data);

        series.appear(1000);
        chart.appear(1000, 100);

        });
    </script>

</body>
</html>



<!-- Controller -->
<!-- Single value -->

{{-- public function patient_bp_rbs($id)
{
$patient_bp_rbs = PatientVisit::select('visit_date', 'bp', 'rbs')
->where('patient_id', $id)->orderBy('visit_date', 'desc')->latest()->take(10)->get();

$data_rbs = [];

foreach ($patient_bp_rbs as $item) {
$temp = [];
$temp['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j M, y');
$temp['value'] = (int) $item->rbs;
$data_rbs[] = $temp;
}

return view('admin.patient.patient_rbs', compact('data_rbs'));
} --}}


<!--- multiple value--->

{{-- public function patient_bp_rbs($id){
    $patient_bp_rbs = PatientVisit::select('visit_date', 'weight', 'bp', 'rbs')
    ->where('patient_id', $id)
    ->orderBy('visit_date', 'desc')
    ->latest()
    ->take(10)
    ->get();

    $data_rbs = [];
    $data_bp = [];
    $data_weight = [];

    foreach ($patient_bp_rbs as $item) {
    $temp_rbs = [];
    $temp_rbs['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j M');
    $temp_rbs['value'] = (float) $item->rbs;
    $data_rbs[] = $temp_rbs;

    $temp_bp = [];
    $temp_bp['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j M');
    $temp_bp['value'] = (float) $item->bp;
    $data_bp[] = $temp_bp;

    $temp_weight = [];
    $temp_weight['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j M');
    $temp_weight['value'] = (float) $item->weight;
    $data_weight[] = $temp_weight;
    }
    return view('admin.patient.patient_rbs', compact('data_rbs', 'data_bp', 'data_weight'));
} --}}


<!-- demo data -->

{{-- var data = [{
date: "2023-08-16",
value: 10
}, {
date: "2023-08-15",
value: 3
}, {
date: "2023-08-14",
value: 4
}, {
date: "2023-08-13",
value: 9
},
{
date: "2023-08-12",
value: 5},
{
date: "2023-08-11",
value: 7}
{
date: "2023-08-10",
value: 8
}]; --}}
