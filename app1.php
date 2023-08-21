var data = [{
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
}];






// public function patient_bp_rbs($id)
// {
// $patient_bp_rbs = PatientVisit::select('visit_date', 'bp', 'rbs')
// ->where('patient_id', $id)->orderBy('visit_date', 'desc')->latest()->take(10)->get();

// $data_rbs = [];

// foreach ($patient_bp_rbs as $item) {
// $temp = [];
// $temp['date'] = \Carbon\Carbon::parse($item->visit_date)->format('j M, y');
// $temp['value'] = (int) $item->rbs;
// $data_rbs[] = $temp;
// }

// return view('admin.patient.patient_rbs', compact('data_rbs'));
// }



public function patient_bp_rbs($id)
{
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
}

// public function patient_bp_rbs($id)
// {
// $patient_bp_rbs = PatientVisit::select('visit_date', 'weight', 'bp', 'rbs')
// ->where('patient_id', $id)
// ->orderBy('visit_date', 'desc')
// ->latest()
// ->take(10)
// ->get();

// $data_rbs = [];
// $data_bp = [];
// $data_weight = [];

// foreach ($patient_bp_rbs as $item) {
// $data_rbs[] = [
// 'date' => \Carbon\Carbon::parse($item->visit_date)->format('j M, y');
// 'value' => (int) $item->rbs,
// ];

// $data_bp[] = [
// 'date' => \Carbon\Carbon::parse($item->visit_date)->format('j M, y');
// 'value' => (int) $item->bp,
// ];

// $data_weight[] = [
// 'date' => \Carbon\Carbon::parse($item->visit_date)->format('j M, y');
// 'value' => (int) $item->weight,
// ];
// }

// return view('admin.patient.patient_rbs', compact('data_rbs', 'data_bp', 'data_weight'));
// }



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

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
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

        series.columns.template.setAll({
            cornerRadiusTL: 5,
            cornerRadiusTR: 5,
            strokeOpacity: 0
        });
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

<script>
    am5.ready(function() {

        var root = am5.Root.new("chartdiv2");

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

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
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

        series.columns.template.setAll({
            cornerRadiusTL: 5,
            cornerRadiusTR: 5,
            strokeOpacity: 0
        });
        series.columns.template.adapters.add("fill", function(fill, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", function(stroke, target) {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        var data = @json($data_bp);

        xAxis.data.setAll(data);
        series.data.setAll(data);

        series.appear(1000);
        chart.appear(1000, 100);

    });
</script>

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

        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
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

        series.columns.template.setAll({
            cornerRadiusTL: 5,
            cornerRadiusTR: 5,
            strokeOpacity: 0
        });
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

{{-- <script>
    function createChart(div, data) {

    var root = am5.Root.new(div);

    root.setThemes([
      am5themes_Animated.new(root)
    ]);

    var chart = root.container.children.push(
      am5xy.XYChart.new(root, {
        panX: true,
        panY: true,
        wheelX: "panX",
        wheelY: "zoomX"
      })
    );

    var xAxis = chart.xAxes.push(
      am5xy.DateAxis.new(root, {
        maxDeviation: 0.1,
        groupData: false,
        baseInterval: {
          timeUnit: "week",
          count: 1
        },
        renderer: am5xy.AxisRendererX.new(root, {
          minGridDistance: 50
        }),
        tooltip: am5.Tooltip.new(root, {})
      })
    );

    var yAxis = chart.yAxes.push(
      am5xy.ValueAxis.new(root, {
        maxDeviation: 0.1,
        renderer: am5xy.AxisRendererY.new(root, {})
      })
    );

    var series = chart.series.push(
      am5xy.ColumnSeries.new(root, {
        xAxis: xAxis,
        yAxis: yAxis,
        valueYField: "value",
        valueXField: "date"
      })
    );

    series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
    series.columns.template.adapters.add("fill", function(fill, target) {
      return chart.get("colors").getIndex(series.columns.indexOf(target));
    });

    series.columns.template.adapters.add("stroke", function(stroke, target) {
      return chart.get("colors").getIndex(series.columns.indexOf(target));
    });


    series.data.setAll(data);
    series.appear(1000, 100);
    chart.appear(1000, 100);
  }

  var data1 = @json($data_rbs);
  var data2 = @json($data_bp);
  var data3 = @json($data_weight);

  createChart("chartdiv1", data1);
  createChart("chartdiv2", data2);
  createChart("chartdiv3", data3);





  var data1 = @json($data_rbs);
  var data2 = @json($data_bp);
  var data3 = @json($data_weight);

  createChart("chartdiv1", [
    { date: new Date(2022, 9, 1).getTime(), value: 8 },
    { date: new Date(2022, 9, 8).getTime(), value: 10 },
    { date: new Date(2022, 9, 15).getTime(), value: 12 },
    { date: new Date(2022, 9, 22).getTime(), value: 14 },
    { date: new Date(2022, 9, 29).getTime(), value: 11 }
  ]);

  createChart("chartdiv2", [
    { date: new Date(2022, 9, 1).getTime(), value: 18 },
    { date: new Date(2022, 9, 8).getTime(), value: 2 },
    { date: new Date(2022, 9, 15).getTime(), value: 8 },
    { date: new Date(2022, 9, 22).getTime(), value: 24 },
    { date: new Date(2022, 9, 29).getTime(), value: 11 }
  ]);

  createChart("chartdiv3", [
    { date: new Date(2022, 9, 1).getTime(), value: 5 },
    { date: new Date(2022, 9, 8).getTime(), value: 6 },
    { date: new Date(2022, 9, 15).getTime(), value: 12 },
    { date: new Date(2022, 9, 22).getTime(), value: 5 },
    { date: new Date(2022, 9, 29).getTime(), value: 2 }
  ]);
</script> --}}