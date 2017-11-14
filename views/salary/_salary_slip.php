<?php

use app\models\Attendance;
use app\helpers\AppHelper;

//echo $username = $user->user->first_name . ' ' . $user->user->last_name;
//echo '<br>';
//echo 'ctc = ' .$ctc = $user->ctc;
//echo '<br>';
//echo 'TDS = ' . $tds = $user->tds;
//echo '<br>';
//echo 'PT = ' . $pt = $user->pt;
//echo '<br>';
//echo 'PF = ' . $pf = $user->pf;
//echo '<br>';
//echo 'ESI = ' . $esi = $user->esi;
//echo '<br>';
//echo 'insenstive = ' . $incentive = $user->incentive;
//echo '<br>';
//echo  'bonus = ' . $bonus = $user->bonus;
//echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';


$username = ucfirst($user->user->first_name) . ' ' . ucfirst($user->user->last_name);
$ctc = $user->ctc;
$tds = $user->tds;
$pt = $user->pt;
$pf = $user->pf;
$esi = $user->esi;
$incentive = $user->incentive;
$bonus = $user->bonus;

$datestring= $user->created_date.' first day of last month';
$dt=date_create($datestring);
$salary_month = $dt->format('F');


$date = date_create($user->created_date);
$created_date = date_format($date,'d-m-Y');


//CALCULATION
$total_days_of_month = date('t');
$total_present_days = Attendance::find()->where(['user_id' => $user->user_id])->count();

//GROSS AMOUNT
$gross = floor($ctc * $total_present_days / $total_days_of_month);

//CALCULATIING GROSS-1 AMOUNT
$tds_value = $tds / 100 * $gross;
$gross1 = $gross - $tds_value;

//CALCULATIING GROSS-2 AMOUNT
$gross2 = $gross1 - $pt;

//CALCULATIING GROSS-3 AMOUNT
$gross3 = $gross2 - $pf;

//CALCULATIING GROSS-4 AMOUNT
$gross4 = $gross3 - $esi;

//CALCULATIING GROSS-5 AMOUNT
$gross5 = $gross4 + $incentive;

//CALCULATIING GROSS-6 AMOUNT
$gross6 = $gross5 + $bonus;


//echo 'Gross = ' . $gross;  echo '<br>';
//echo 'Gross-1 = ' . $gross1; echo '<br>';
//echo 'Gross-2 = ' . $gross2; echo '<br>';
//echo 'Gross-3 = ' . $gross3; echo '<br>';
//echo 'Gross-4 = ' . $gross4; echo '<br>';
//echo 'Gross-5 = ' . $gross5; echo '<br>';
//echo 'Gross-6 = ' . $gross6; echo '<br>';

?>


<!DOCTYPE html>

<html>
<body>
<table style="width: 500px;">
    <tbody>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="text-align: center; width: 104px;"><strong> Vytech Enterprise </strong></td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="text-align: center; width: 104px;">55, 5th floor, Raj Tower,<br/> Sattadhar Char Rasta, Opp
            Swaminarayan Temple,<br/> Ghatlodiya, Sola Village,<br/> Ahmedabad, Gujarat 380061&nbsp;
        </td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="text-align: center; width: 104px;"><strong>Email : info@vytechenterprise.com</strong></td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="text-align: center; width: 104px;"><strong>Payment Voucher</strong></td>
            <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: center;">No. :</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">Dated:</td>
        <td style="width: 132px;"><strong><?= $created_date; ?></strong></td>
    </tr>

    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>

    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;  border: 1px solid black;">Particulars</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;  border: 1px solid black;">Amount</td>

    </tr>


    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><strong>Account:</strong></td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;"><?= $username ?></td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">₹<?= number_format($ctc) ?></td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 150px;">Project : Monthly Salary (<?= $salary_month ?>)</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;"><strong>Payment Voucher</strong></td>
        <td style="width: 10px;"><strong>₹<?= number_format($ctc) ?></strong></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">Professional Tax</td>
        <td style="width: 10px;">₹<?= number_format($pt) ?></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">Provident Fund</td>
        <td style="width: 10px;">₹<?= number_format($pf) ?></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">ESI</td>
        <td style="width: 10px;">₹<?= number_format($esi) ?></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">Insenstive</td>
        <td style="width: 10px;">₹<?= number_format($incentive) ?></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">Bonus</td>
        <td style="width: 10px;">₹<?= number_format($bonus) ?></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>

    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">TDS Deducted : <?= $tds ?>%&nbsp;</td>
        <td style="width: 10px;">₹<?= number_format($tds_value) ?></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">TDS Deducted on Total Amount</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>

    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;"><strong>Grand Total :</strong>&nbsp;</td>
        <td style="width: 10px;"><strong>₹<?= number_format($gross6) ?></strong></td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>


    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px; text-align: right;"><strong>&nbsp;Amount (in Words):</strong></td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">INR <?= ucfirst(AppHelper::getIndianCurrency($gross6)); ?> Only</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;  border: 1px solid black;"><strong>₹<?= number_format($gross6) ?></strong></td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">&nbsp;</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="width: 150px;">Receiver's Signature</td>
        <td style="width: 104px;">&nbsp;</td>
        <td style="width: 10px;">&nbsp;</td>
        <td style="width: 73px;">&nbsp;</td>
        <td style="width: 132px;">Authorised Signatory</td>
    </tr>
    </tbody>
</table>
</body>
</html>
