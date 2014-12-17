<!-- Script for this page -->
<script type="text/javascript">
 /* Curve chart starts */

    $(function () {
        var counter = [];
		//, cos = [];
		//data
		counter.push([0	,0]);
		<?php
					$date = date("d");
					$month = date("m");
					$year = date("Y");
					$hour = date("H", time()+(3600*6));
					for($i=1;$i<=$hour;$i++) {
    					$sql = "SELECT * FROM `order` WHERE dateOrder BETWEEN '$year-$month-$date $i:00:00' AND '$year-$month-$date $i:59:59' ";
    					//echo $sql;
                        $query = mysqli_query($connect, $sql);
    					$row = mysqli_num_rows($query);
    					echo "counter.push([$i, $row]);\n";
					}
			?>
        //for (var i = 0; i < 14; i += 0.5) {
           // sin.push([i, Math.sin(i)]);
            //cos.push([i, Math.cos(i)]);
        //}

        var plot = $.plot($("#curve-chart"),
                [
                    { data: counter, label: "ใบสั่งซื้อ"}
                    //{ data: cos, label: "cos(x)" }
                ], {
                    series: {
                        lines: { show: true,
                            fill: true,
                            fillColor: {
                                colors: [
                                    {
                                        opacity: 0.05
                                    },
                                    {
                                        opacity: 0.01
                                    }
                                ]
                            }
                        },
                        points: { show: true }
                    },
                    grid: { hoverable: true, clickable: true, borderWidth: 0 },
                    //yaxis: { min: -1.2, max: 1.2 },
					xaxis: { max: 24 },
                    colors: ["#fa3031", "#43c83c"]
                });


        function showTooltip(x, y, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                width: 100,
                left: x + 5,
                border: '1px solid #000',
                padding: '2px 8px',
                color: '#ccc',
                'background-color': '#000',
                opacity: 0.9
            }).appendTo("body").fadeIn(200);
        }

        var previousPoint = null;
        $("#curve-chart").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));

            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);

                    showTooltip(item.pageX, item.pageY, item.series.label + " of " + x + " = " + y);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });

        $("#curve-chart").bind("plotclick", function (event, pos, item) {
            if (item) {
                $("#clickdata").text("You clicked point " + item.dataIndex + " in " + item.series.label + ".");
                plot.highlight(item.series, item.datapoint);
            }
        });

    });

    /* Curve chart ends */
/* Pie chart starts */

$(function () {

    var data = [];
    var series = Math.floor(Math.random() * 10) + 1;
    /*for (var i = 0; i < series; i++) {
        data[i] = { label: "Series" + (i + 1), data: Math.floor(Math.random() * 100) + 1 }
		
    }*/
	//data[0] = { label: "Series1", data: 25 }
	//data[1] = { label: "Series1", data: 30 }
	<?php
					$sql = "SELECT description, sum(piece) AS value FROM category LEFT OUTER JOIN product ON category.catid=product.catid LEFT OUTER JOIN buyproduct ON product.productid=buyproduct.productid GROUP BY category.catid ORDER BY category.catid ASC";
					$query = mysqli_query($connect, $sql);
					$numcat = mysqli_num_rows($query);
					for($i=0;$i<$numcat;$i++) {
					$row = mysqli_fetch_array($query);
					
						$value = (isset($row['value'])) ? $row['value'] : 0;
					
					echo "data[$i] = {label: \"{$row['description']}\", data: {$value}}\n";
					}
	?>
			
     $.plot($("#pie-chart"), data,
           {
                series: {
					pie: {
						innerRadius: 0.5,
						show: true,
						 label: {
								show: true,
								radius: 1,
								 formatter: function (label, series) {
                                return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label  +" "+ Math.round(series.percent) + '%</div>';
                            },
								background: {
									opacity: 0.8
								}
							}
					}
				},
				 grid: {
					hoverable: true,
					clickable: true
				},
				 legend: {
					show: false
				}
            });

    /* Pie chart ends */
	
});

</script>
