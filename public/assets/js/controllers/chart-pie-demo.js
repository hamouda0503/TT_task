
module.exports = {
  data: function() {
       return {
        server: { id: null, name : null, weight : null, cpu : null, os : null, os_ver: null, description: null, ram : null, stockage : null, nbr_partition: null}
        }
  },
  computed: {
    serverWeight: function(){
      var tasks = this.server.tasks;
      var remainingWeight = 0;

      for (var i = 0; i < tasks.length; i++){
          if( tasks[i].state != "complete" ){
              remainingWeight = remainingWeight + Number(tasks[i].weight);
          }
      }
 
      return remainingWeight;
  },
  numTasks: function(){
      var tasks = this.server.tasks;
      var finalNum = 0;

     
      for (var i = 0; i < tasks.length; i++){
          if( tasks[i].state != "daily" ){
              finalNum++;
          } 
          
      }
          this.test=finalNum
      return this.test ;
  },
  numProgressTasks: function(){
      var tasks = this.server.tasks;
      var finalNum = 0;

      for (var i = 0; i < tasks.length; i++){
          if( tasks[i].state == "progress" ){
              finalNum++;
          }
      }

      return finalNum;
  },
  numTestingTasks: function(){
      var tasks = this.server.tasks;
      var finalNum = 0;

      for (var i = 0; i < tasks.length; i++){
          if( tasks[i].state == "testing" ){
              finalNum++;
          }
      }

      return finalNum;
  },
  numCompleteTasks: function(){
      var tasks = this.server.tasks;
      var finalNum = 0;

      for (var i = 0; i < tasks.length; i++){
          if( tasks[i].state == "complete" ){
              finalNum++;
          }
      }

      return finalNum;
  },
  numDailyTasks: function(){
      var tasks = this.server.tasks;
      var finalNum = 0;

      for (var i = 0; i < tasks.length; i++){
          if( tasks[i].state == "daily" ){
              finalNum++;
          }
      }

      return finalNum;
  },
  
  numCredentials: function(){
      return this.server.credentials.length;
  },
  serverProgress: function(){
      var tasks = this.server.tasks;
      var totalWeight = 0;
      var completedWeight = 0;

      for (var i = 0; i < tasks.length; i++){
          totalWeight = totalWeight + Number(tasks[i].weight);

          if( tasks[i].state == "complete" ){
              completedWeight = completedWeight + Number(tasks[i].weight);
          }
      }
      return  (completedWeight / totalWeight) * 100;
  }
  }
}
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");

var myPieChart = new Chart(ctx, {

  type: 'doughnut',
  data: {
    labels: ["Direct", "Referral", "Social"],
    datasets: [{
      data: [numCompleteTasks, numTasks, numProgressTasks],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
