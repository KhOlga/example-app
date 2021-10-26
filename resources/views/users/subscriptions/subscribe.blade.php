<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Subscribe') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<div class="p-6">
					<!-- Display a payment form -->
					<form id="payment-form"
					      action="{{ route('users.subscriptions.subscription_store') }}"
					>
						@csrf
						<div class="form-row">
							<div class="mt-4">
								<input type="radio" name="plan" id="monthly"
								       value="price_1JorMSG3eiV1G8jZsAHPnKnp"
								       checked>
								<label for="monthly">Monthly - 10 EUR / Month</label>

								<input type="radio" name="plan" id="yearly"
								       value="price_1JorMSG3eiV1G8jZ9jeOA8nv"
								>
								<label for="yearly">Yearly - 100 EUR / Year</label>
							</div>

							<label for="card-element"></label>
							<div id="card-element"><!--Stripe.js injects the Card Element--></div>
							<x-jet-button class="mt-4">
								{{ __('Subscribe now') }}
							</x-jet-button>
							<p id="card-error" role="alert"></p>
							<p class="result-message hidden">
								Payment succeeded, see the result in your
								<a href="" target="_blank">Stripe dashboard.</a> Refresh the page to pay again.
							</p>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	@push('scripts')
		<script src="https://js.stripe.com/v3/"></script>

		<script>
			// A reference to Stripe.js initialized with your real test publishable API key.
			var stripe = Stripe("pk_test_51JoVwqG3eiV1G8jZJdYLxnnJGffBi3ZbNFNHFZUj5Rrt6wXuceF5g0sOpVaFyMx5GQFxFVsa0arfyyqd1yTc28Ei00uzUUF4iA");

			var elements = stripe.elements();
			var style = {
				base: {
					color: "#32325d",
					fontFamily: 'Arial, sans-serif',
					fontSmoothing: "antialiased",
					fontSize: "16px",
					"::placeholder": {
						color: "#32325d"
					}
				},
				invalid: {
					fontFamily: 'Arial, sans-serif',
					color: "#fa755a",
					iconColor: "#fa755a"
				}
			};

			var card = elements.create("card", { style: style });
			// Stripe injects an iframe into the DOM
			card.mount("#card-element");

			card.on("change", function (event) {
				// Disable the Pay button if there are no card details in the Element
				document.querySelector("button").disabled = event.empty;
				document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
			});

			// The items the customer wants to buy
			var purchase = {
				items: [{ id: "xl-tshirt" }]
			};

			// Disable the button until we have Stripe set up on the page
			document.querySelector("button").disabled = true;
			fetch("users/subscriptions/subscribe-store", {
				method: "POST",
				headers: {
					"Content-Type": "application/json"
				},
				body: JSON.stringify(purchase)
			})
				.then(function(result) {
					return result.json();
				})
				.then(function(data) {
					/*var elements = stripe.elements();

					var style = {
						base: {
							color: "#32325d",
							fontFamily: 'Arial, sans-serif',
							fontSmoothing: "antialiased",
							fontSize: "16px",
							"::placeholder": {
								color: "#32325d"
							}
						},
						invalid: {
							fontFamily: 'Arial, sans-serif',
							color: "#fa755a",
							iconColor: "#fa755a"
						}
					};

					var card = elements.create("card", { style: style });
					// Stripe injects an iframe into the DOM
					card.mount("#card-element");

					card.on("change", function (event) {
						// Disable the Pay button if there are no card details in the Element
						document.querySelector("button").disabled = event.empty;
						document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
					});
					*/
					var form = document.getElementById("payment-form");
					form.addEventListener("submit", function(event) {
						event.preventDefault();
						// Complete payment when the submit button is clicked
						payWithCard(stripe, card, data.clientSecret);
					});
				});

			// Calls stripe.confirmCardPayment
			// If the card requires authentication Stripe shows a pop-up modal to
			// prompt the user to enter authentication details without leaving your page.
			var payWithCard = function(stripe, card, clientSecret) {
				loading(true);
				stripe
					.confirmCardPayment(clientSecret, {
						payment_method: {
							card: card
						}
					})
					.then(function(result) {
						if (result.error) {
							// Show error to your customer
							showError(result.error.message);
						} else {
							// The payment succeeded!
							orderComplete(result.paymentIntent.id);
						}
					});
			};

			/* ------- UI helpers ------- */

			// Shows a success message when the payment is complete
			var orderComplete = function(paymentIntentId) {
				loading(false);
				document
					.querySelector(".result-message a")
					.setAttribute(
						"href",
						"https://dashboard.stripe.com/test/payments/" + paymentIntentId
					);
				document.querySelector(".result-message").classList.remove("hidden");
				document.querySelector("button").disabled = true;
			};

			// Show the customer the error from Stripe if their card fails to charge
			var showError = function(errorMsgText) {
				loading(false);
				var errorMsg = document.querySelector("#card-error");
				errorMsg.textContent = errorMsgText;
				setTimeout(function() {
					errorMsg.textContent = "";
				}, 4000);
			};

			// Show a spinner on payment submission
			var loading = function(isLoading) {
				if (isLoading) {
					// Disable the button and show a spinner
					document.querySelector("button").disabled = true;
					document.querySelector("#spinner").classList.remove("hidden");
					document.querySelector("#button-text").classList.add("hidden");
				} else {
					document.querySelector("button").disabled = false;
					document.querySelector("#spinner").classList.add("hidden");
					document.querySelector("#button-text").classList.remove("hidden");
				}
			};

		</script>
	@endpush
</x-app-layout>




