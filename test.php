
<?php
require_once 'dompdf/autoload.inc.php'; // Include the DOMPDF library

// Function to generate an invoice
function generateInvoice($bookingID, $customerName, $startDate, $endDate, $totalAmount)
{
    // Create the invoice template and populate it with booking details
    $invoiceHTML = '<h1>Invoice</h1>';
    $invoiceHTML .= '<p>Booking ID: ' . $bookingID . '</p>';
    $invoiceHTML .= '<p>Customer Name: ' . $customerName . '</p>';
    $invoiceHTML .= '<p>Booking Period: ' . $startDate . ' to ' . $endDate . '</p>';
    $invoiceHTML .= '<p>Total Amount: $' . $totalAmount . '</p>';
    // Add more invoice details as needed, such as payment methods, itemized breakdown, etc.

    // Convert HTML to PDF using DOMPDF
    $dompdf = new Dompdf\Dompdf();
    $dompdf->loadHtml($invoiceHTML);
    $dompdf->render();
    $output = $dompdf->output();

    // Save the invoice as a PDF file
    file_put_contents('invoices/' . $bookingID . '_invoice.pdf', $output);

    // You can also send the invoice as an email attachment (optional)
    // Use PHP's mail() function or a library like PHPMailer to send the email

    // Return the invoice HTML (if you want to display it directly on a page)
    return $invoiceHTML;
}

// Example usage:
// After successful booking insertion, call the generateInvoice function
$bookingID = 1234;
$customerName = 'John Doe';
$startDate = '2023-07-10';
$endDate = '2023-07-15';
$totalAmount = 500.00;

$invoiceHTML = generateInvoice($bookingID, $customerName, $startDate, $endDate, $totalAmount);

// Now, you can save the $invoiceHTML in a file or send it as an email attachment.
?>