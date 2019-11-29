<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>

            <!-- <body>
                // client site integration
                <div class="flex-center position-ref full-height">
                    
                    <div class="content">

                    <div class="links">
                        <div id="paypal-button"></div>
                    </div>

                    </div>
                </div>

                <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                <script>
                paypal.Button.render({
                    // Configure environment
                    env: 'sandbox',
                    client: {
                    sandbox: 'AUl4TdKSUb5ZuTwizqZb1nxmpHE2h1FtgwJo24nOYg_qOIQkQtyS-5o6JGpfsPiNloIYnXrHrNbhaXXB',
                    production: 'demo_production_client_id'
                    },
                    // Customize button (optional)
                    locale: 'en_US',
                    style: {
                    size: 'large',
                    color: 'gold',
                    shape: 'pill',
                    },

                    // Enable Pay Now checkout flow (optional)
                    commit: true,

                    // Set up a payment
                    payment: function(data, actions) {
                    return actions.payment.create({
                        transactions: [{
                        amount: {
                            total: '0.01',
                            currency: 'USD'
                        }
                        }]
                    });
                    },
                    // Execute the payment
                    onAuthorize: function(data, actions) {
                    return actions.payment.execute().then(function() {
                        // Show a confirmation message to the buyer
                        window.alert('Thank you for your purchase!');
                    });
                    }
                }, '#paypal-button');
                </script>

            </body> -->



            <body>
                <div class="flex-center position-ref full-height">
                    
                    <div class="content">

                    <div class="links">
                        <div id="paypal-button"></div>
                    </div>

                    </div>
                </div>

                <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                <script>
                    paypal.Button.render({
                        env: 'sandbox', // Or 'production'
                        style: {
                        size: 'large',
                        color: 'gold',
                        shape: 'pill',
                        },
                        // Set up the payment:
                        // 1. Add a payment callback
                        payment: function(data, actions) {
                        // 2. Make a request to your server
                        return actions.request.post('/api/create-payment')
                            .then(function(res) {
                            // 3. Return res.id from the response
                            // console.log(res);
                            return res.id;
                            });
                        },
                        // Execute the payment:
                        // 1. Add an onAuthorize callback
                        onAuthorize: function(data, actions) {
                        // 2. Make a request to your server
                        return actions.request.post('/api/execute-payment', {
                            paymentID: data.paymentID,
                            payerID:   data.payerID
                        })
                            .then(function(res) {
                              console.log(res);
                              alert('Payment went throught');
                            // 3. Show the buyer a confirmation message.
                            });
                        }
                    }, '#paypal-button');
                </script>

            </body>
</html>
