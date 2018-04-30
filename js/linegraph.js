$(document).ready(function(){
	$.ajax({
		url : "http://localhost/money/js/followersdata.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var date = [];
			var balance = [];
			var deposit = [];
			var withdraw = [];

			for(var i in data) {
				date.push("Date " + data[i].date);
				balance.push(data[i].balance);
				deposit.push(data[i].deposit);
				withdraw.push(data[i].withdraw);
			}

			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "facebook",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(59, 89, 152, 0.75)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: balance
					},
					{
						label: "twitter",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(29, 202, 255, 0.75)",
						borderColor: "rgba(29, 202, 255, 1)",
						pointHoverBackgroundColor: "rgba(29, 202, 255, 1)",
						pointHoverBorderColor: "rgba(29, 202, 255, 1)",
						data: deposit
					},
					{
						label: "googleplus",
						fill: false,
						lineTension: 0.1,
						backgroundColor: "rgba(211, 72, 54, 0.75)",
						borderColor: "rgba(211, 72, 54, 1)",
						pointHoverBackgroundColor: "rgba(211, 72, 54, 1)",
						pointHoverBorderColor: "rgba(211, 72, 54, 1)",
						data: withdraw
					}
				]
			};

			var ctx = $("#mycanvas");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata
			});
		},
		error : function(data) {

		}
	});
});