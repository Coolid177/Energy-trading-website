//statistics
httpRequest = new XMLHttpRequest();
httpRequest.onreadystatechange  = () => {
  if (httpRequest.readyState === 4) {
    if (httpRequest.status === 200) {
      const response = httpRequest.responseText;

      const obj = JSON.parse(response);
      buildCharts(obj);
    } else {
      alert('There was a problem with the request.');
    }
  }
};
httpRequest.open("GET", '/askStatistics', true);
httpRequest.setRequestHeader('Content-Type', 'application/json');
httpRequest.send();

function buildCharts(obj){
  title = obj.stats.map(function(elem){
    return elem.Title;
  })
  
  productSolds = obj.stats.map(function(elem){
    return elem.ProductSolds;
  })
  
  productRevenue = obj.stats.map(function(elem){
    return elem.ProductRevenue;
  })
  
  productVisits = obj.stats.map(function(elem){
    return elem.ProductVisits;
  })
  
  ctx = document.getElementById('productSolds');
  new Chart(ctx,{
      type: 'bar',
      data: {
          labels: title,
          datasets: [{
            axis: 'y',
            label: 'Products sold',
            data: productSolds,
            fill: false,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        indexAxis: 'y',
      }
  })
  
  ctx = document.getElementById('productRevenue');
  new Chart(ctx,{
      type: 'bar',
      data: {
          labels: title,
          datasets: [{
            axis: 'y',
            label: 'Product revenue',
            data: productRevenue,
            fill: false,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        indexAxis: 'y',
      }
  })
  
  ctx = document.getElementById('productVisits');
  new Chart(ctx,{
      type: 'bar',
      data: {
          labels: title,
          datasets: [{
            axis: 'y',
            label: 'Product visits',
            data: productVisits,
            fill: false,
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(255, 205, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
              'rgb(255, 99, 132)',
              'rgb(255, 159, 64)',
              'rgb(255, 205, 86)',
              'rgb(75, 192, 192)',
              'rgb(54, 162, 235)',
              'rgb(153, 102, 255)',
              'rgb(201, 203, 207)'
            ],
            borderWidth: 1
          }]
      },
      options: {
        indexAxis: 'y',
      }
  })
}