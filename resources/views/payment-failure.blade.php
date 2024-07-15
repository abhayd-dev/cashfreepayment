<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Failure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Payment Failed',
                text: 'Unfortunately, your payment could not be processed.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#paymentModal1').modal('show'); // Open Bootstrap modal on confirmation
                }
            });
        });
        
        function redirectToCallback() {
            window.location.href = "{{ route('callback') }}"; // Redirect to callback route on button click
        }
    </script>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal1" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> {{ $payment->name }}</p>
                    <p><strong>Email:</strong> {{ $payment->email }}</p>
                    <p><strong>Mobile:</strong> {{ $payment->mobile }}</p>
                    <p><strong>Amount:</strong> {{ $payment->amount }}</p>
                    <p><strong>Order ID:</strong> {{ $payment->order_id }}</p>
                    <p><strong>Payment ID:</strong> {{ $payment->payment_id }}</p>
                    <p><strong>Status:</strong> {{ $payment->status }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="redirectToCallback()">Pay Now</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
