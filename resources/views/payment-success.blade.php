<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <script>
        // Use jQuery ready function to ensure DOM is fully loaded
        $(document).ready(function () {
            // Initialize SweetAlert for success message
            Swal.fire({
                title: 'Payment Successful',
                text: 'Your payment has been successfully processed.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show Bootstrap modal after confirmation
                    $('#paymentModal').modal('show');
                }
            });
        });

        // Function to redirect to callback route
        function redirectToCallback() {
            window.location.href = "{{ route('callback') }}";
        }
    </script>

    <!-- Bootstrap modal for payment details -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
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
                    <!-- Close modal and redirect button -->
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="redirectToCallback()">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
