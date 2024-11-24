
<!DOCTYPE HTML>
<html>
<head>
    <style>
        /* Add this CSS to change the background color */
        body {
            background-color: navy;
            color: white; /* To ensure text is visible on navy background */
        }
    </style>
    <script>
        window.onload = function() {
            var dataPoints = [];

            // Initialize a JavaScript object to store the aggregated data
            var topicMarks = {};

            // Fetch the data from PHP script (replace with your PHP script path)
            $.getJSON("http://localhost/ipd/script5.php", function(data) {
                // Log the data to verify the structure
                console.log(data);

                // Iterate over the data and aggregate marks by topic
                for (var i = 0; i < data.length; i++) {
                    var topic = data[i].topic;
                    var marks = parseInt(data[i].y);  // Ensure the 'y' values are parsed as integers

                    // If the topic already exists, add the marks to it, else initialize it
                    if (topicMarks[topic]) {
                        topicMarks[topic] += marks;
                    } else {
                        topicMarks[topic] = marks;
                    }
                }

                // Convert the aggregated data to the format required for the chart
                for (var topic in topicMarks) {
                    if (topicMarks.hasOwnProperty(topic)) {
                        dataPoints.push({
                            label: topic, // Topic name
                            y: topicMarks[topic] // Total marks for that topic
                        });
                    }
                }

                // Create and render the chart
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    theme: "light2",
                    zoomEnabled: true,
                    title: {
                        text: "Quiz Marks for User"
                    },
                    axisY: {
                        title: "Marks",
                        titleFontSize: 24
                    },
                    axisX: {
                        title: "Topic",
                        titleFontSize: 24
                    },
                    data: [{
                        type: "column", // You can change this to "line" for a line chart
                        yValueFormatString: "#,##0.##",
                        dataPoints: dataPoints
                    }]
                });

                chart.render(); // Render the chart with the aggregated data
            }).fail(function() {
                console.log("Error fetching data");
            });
        }
    </script>
</head>
<body>
    <div id="chartContainer" style="height: 720px; width: 100% ;"></div>

    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
</body>
</html>
