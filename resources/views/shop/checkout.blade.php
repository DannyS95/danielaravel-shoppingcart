@extends('layouts.master')

@section('title')

@endsection

@section('content')
    <script src="https://js.stripe.com/v3/"> </script>

    <div class="row mb-2">
        <div class="col-sm-6 col-md-4 mx-auto">
            <h1>Checkout</h1>
            <h4>Your Total: ${{ $total }}</h4>
            <form action="{{ route('sendCheckout') }}" method="POST" id="payment-form">
                <div class="form-group">
                    <div class="col-xs-12 col-md-12">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-md-12">
                        <label for="address">Address</label>
                        <input type="text" id="address" class="form-control" name="address"
                               required>
                    </div>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element" class="form-group col-xs-12 col-md-12">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-xs-12 col-md-12">
                        <button class="btn btn-payment col-xs-12 col-md-12"
                                id="complete-order" type="submit">Buy
                            now</button>
                    </div>
                </div>

            </form>
        </div>
        </div>
    @endsection

@section('scripts')
    <script>
        var stripe = Stripe('pk_test_8XvoUubbfqWwutYISn8BCEDB');
        var elements = stripe.elements();

        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: "#32325d",
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Prevent from charing the payment twice
            document.getElementById('complete-order').isDisabled = true;

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Prevent from charing the payment twice
                    document.getElementById('complete-order').isDisabled = false;
                    // Inform the customer that there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
    @endsection