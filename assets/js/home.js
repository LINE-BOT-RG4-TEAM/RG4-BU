function hume_data()
{
	$.ajax({
			url: 'api/home_data.php',
			method: 'POST',
			async: true,
			cache: false,
			processData: false,
			contentType: false,
			success: function(response) {
						var obj = JSON.parse(response);
						var numcase1 = document.getElementById("numcase1");
						var numcase2 = document.getElementById("numcase2");
						var numcase3 = document.getElementById("numcase3");
						numcase1.innerHTML = "จำนวน " + obj.numcase1 + " งาน"; 
                        numcase2.innerHTML = "จำนวน " + obj.numcase2 + " งาน";
						numcase3.innerHTML = "จำนวน " + obj.numcase3 + " งาน"; 
						pie(obj.sts);
						bar(obj.sts);
                    }				
			});
}