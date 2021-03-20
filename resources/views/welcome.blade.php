<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
  </head>
  
  <body>
    <script src="https://www.paypal.com/sdk/js?&client-id=ARM70s2eHSfG714-97kNiNtwT4v8kn6Hfq6RX7C3A_bqvKo-XYil5zjudW-8iY2cq5xnJvKJNTYAeXt3&merchant-id=LJF859TXWHJRJ"></script>
    <div id="paypal-button-container"></div>


  </body>
  <script>
    var SERVER = 'http://localhost/academia-qa-laravel/public/api';
    paypal.Buttons({
      createOrder: function (data, actions) {
        return fetch(SERVER + '/paypal/create-pay', {
          method: 'POST'
        }).then(function(res) {
          return res.json();
          console.log(res.json());
        }).then(function(data) {
          return data.id;
        });
      } /*,
      onApprove: function (data, actions) {
        return fetch('/my-server/capture-order/' + data.orderID, {
          method: 'POST'
        }).then(function(res) {
          if (!res.ok) {
            alert('Something went wrong');
          }
        });
      }*/
    }).render('#paypal-button-container');
  </script>

