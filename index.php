<input type="text" name="harga" id="harga" placeholder="Masukan Jumlah Total" required>
<button id="pay-button" type="submit">Pay!</button>
<div id="demo">
	
</div>
<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-z3cWozTaV56piZD7"></script>
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function(){

    var total = document.getElementById("harga").value;
    // This is minimal request body as example.
    // Please refer to docs for all available options: https://snap-docs.midtrans.com/#json-parameter-request-body
    // TODO: you should change this gross_amount and order_id to your desire. 
    var requestBody = 
    {
      transaction_details: {
        gross_amount: total,
        // as example we use timestamp as order ID
        order_id: 'T-'+Math.round((new Date()).getTime() / 1000) 
      }
    }
    
    getSnapToken(requestBody, function(response){
      var response = JSON.parse(response);
      console.log("new token response", response);

      // Open SNAP payment popup, please refer to docs for all available options: https://snap-docs.midtrans.com/#snap-js
      snap.pay(response.token,{
        // function(result){"https://airless-shout.000webhostapp.com/finish.php"}


      //   onSuccess: function(result){
      //   	console.log('success');
      //   	console.log(result);
      //   	// var myObj = JSON.parse(result);
      //   	// console.log(myObj);
    		// // document.getElementById('demo').innerHTML += myObj ;
      //   },
      //   onPending: function(result){
      //   	console.log('pending');
      //   	console.log(result);
      //   	// var myObj = JSON.parse(result);
      //   	// console.log(myObj);
      // //   	var myObj = JSON.parse(JSON.stringify(result, null, 2));
    		// // document.getElementById('demo').innerHTML += myObj ;
      // //   	var myObj = JSON.parse(result);
    		// // document.getElementById("demo").innerHTML = myObj;
      //   },
      //   onError: function(result){
      //   	console.log('error');
      //   	console.log(result);
      //   	// var myObj = JSON.parse(result);
      //   	// console.log(myObj);
      // //   	var myObj = JSON.parse(JSON.stringify(result, null, 2));
    		// // document.getElementById('demo').innerHTML += myObj ;
      //   },
      //   onClose: function(){
      //   	console.log('customer closed the popup without finishing the payment');
      //   },

        
        // function(callback){finish: "https://airless-shout.000webhostapp.com/finish.php";}
      });
    })


  };
  /**
  * Send AJAX POST request to checkout.php, then call callback with the API response
  * @param {object} requestBody: request body to be sent to SNAP API
  * @param {function} callback: callback function to pass the response
  */
  function getSnapToken(requestBody, callback) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
      if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
        callback(xmlHttp.responseText);
      }
    }
    xmlHttp.open("post", "https://airless-shout.000webhostapp.com/checkout.php");
    xmlHttp.send(JSON.stringify(requestBody));
  }
</script>