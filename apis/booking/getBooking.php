<?php
require '../../conn.php';
require '../functions.php';


if (isset($_POST['bid'])) {
    $id = $_POST['bid'];
    $id = mysqli_real_escape_string($conn, $id);
    $sql = 'SELECT b.bookingType as btype,b.starttime as tfrom,b.endtime Tto, b.booking_id AS id, DATE(b.created_at) AS bdate, b.updated_at AS bupdatedate, c.firstname AS cname, b.booking_status AS STATUS, h.hall_type AS htype, b.start_date AS sdate, b.end_date AS edate, b.attendee AS attend, b.Rate AS rate, SUM(tr.debit - tr.credit) AS balance FROM hbs.bookings b LEFT JOIN hbs.transactions tr ON b.booking_id = tr.refID LEFT JOIN hbs.customers c ON c.custid = tr.custid LEFT JOIN hbs.halls h ON h.hall_id = b.hall_id GROUP BY b.booking_id;';
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $bdata = [
           'cname'  =>$row['cname'],
            'id'  => $row['id'],
            'status' =>$row['STATUS'],
            'rate' => $row['rate'],
            'htype'  => $row['htype'],
            'sdate' => $row['sdate'],
            'edate' => $row['edate'],
            'starttime' => $row['tfrom'],
            'endtime' => $row['Tto'],
            'attend' => $row['attend'] ,
            'balance' =>$row['balance'],
            'btype'=>$row['btype'],
            'date' =>$row['bdate'],
            'cid' => $row['custid'],
            'cname' => $row['firstname'],
           
            
        ];
        echo json_encode($bdata);
    } else {
        echo json_encode(['error' => 'Customer Not found']);
    }
}