<!-- Dans resources/views/partials/invoices_list.blade.php -->
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice Number</th>
            <!-- Ajoutez d'autres en-têtes de colonnes ici -->
        </tr>
    </thead>
    <tbody>
        @foreach ($invoicesWithSameCounterReference as $invoice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $invoice->invoice_number }}</td>
                <!-- Ajoutez d'autres colonnes de données ici -->
            </tr>
        @endforeach
    </tbody>
</table>
