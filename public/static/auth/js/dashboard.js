var chart = new ApexCharts(document.getElementById('chart_scholarship'), optioncharts());
chart.render();
getDataScholarship(new Date().getFullYear())


var proBar = $('.progress-bar-major');
if(proBar.length){
    proBar.barfiller({barColor: '#2F90F7', duration: 300});
}

function optioncharts(data) {
  
  if (!data){
    for (let index = 0; index == 12; index++) {
      data[index] = 0
    }
  }

  var options = {
    series: [{
        name: "Total Beasiswa",
        type: "column",
        data: data
    }],
    chart: {
        height: 280,
        type: "line",
        toolbar: {
            show: !1
        }
    },
    stroke: {
        width: [0, 3],
        curve: "smooth"
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            columnWidth: "20%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    legend: {
        show: !1
    },
    colors: ["#6F7BD9", "#3EC59D"],
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
  }
  return options
}


$('#year-scholarship-chart').change(function () {
  var year = "";
  $("#year-scholarship-chart option:selected" ).each(function() {
    year = $( this ).val();
  });
  getDataScholarship(year)
});

function chartScholarship(data) {
  chart.updateSeries([{data:data}])
}

function getDataScholarship(year) {
  $('#year-of-chart-scholarship-label').text(year)
  $.ajax({
    data: {'year': year},
    url: "/dashboard/loadChartScholarship/",
    context: document.body,
    error: function(response, error) {
      alert(error);
      console.log(response)
    }
  }).done(function(response) {
    chartScholarship(response.data)
  });
}

function donloadReport(){
  var year = "";
  $("#year-of-report option:selected" ).each(function() {
    year = $( this ).val();
  });
  
  window.location = '/dashboard/export/xls/?year='+year
}