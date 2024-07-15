<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Payments Table</h2>
        <a href="{{ route('callback') }}" class="btn btn-warning ">Payment Page</a>
        <table class="table table-bordered" id="payments-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Order ID</th>
                    <th>Payment ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
        </table>
    </div>

    <script type="text/javascript">
        $(function () {
            $('#payments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('show-table') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'order_id', name: 'order_id' },
                    { data: 'payment_id', name: 'payment_id' },
                    { data: 'amount', name: 'amount' },
                    { data: 'status', name: 'status' },
                    { data: 'created_at', name: 'created_at' },
                ]
            });
        });
    </script>
</body>
</html>
