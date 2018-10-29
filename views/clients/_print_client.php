<?php
use app\models\Company;
/**
 * Created by PhpStorm.
 * User: Akash
 * Date: 7/24/2018
 * Time: 9:11 PM
 */

?>
<?php

if (Yii::$app->session->has('company')):
    $session = Yii::$app->session;
    $company = $session->get('company');
    $com_id = $company['company_id'];
    $com_alldata = Company::find()->where(['company_id' => $com_id])->one();
    // print_r($com_alldata);
endif;
?>
<table width="100%" border="0" style="border-collapse: collapse; border-bottom: 1px solid black; margin-bottom: 15px; text-align: left; font-size: 12px;">
    <tr>
        <td width="10%" style="border: 0px solid black; padding: 0px 0px 0px 0px;margin: 0px 0px 0px 0px;">
            <img style="width: 70px !important; height: 70px; padding: 10px;" src="<?= Yii::$app->urlManager->createAbsoluteUrl('uploads/'. getExactField($com_alldata->image)); ?>" width="10px">
        </td>
        <td width="70%" style="border: 0px solid black; padding: 0px 0px 15px 0px;margin: 0px 0px 0px 0px;">
            <h4><b><i><?= getExactField($com_alldata->name)?></i></b></h4>
            <p><?= getExactField($com_alldata->flat)?>,<?= getExactField($com_alldata->street) ?>, <?= getExactField($com_alldata->landmark) ?>,<?= getExactField($com_alldata->area) ?>,</p>
            <p><?= !empty($com_alldata->city->name) ? $com_alldata->city->name : 'N/A'; ?>,<?= !empty($com_alldata->state->name) ? $com_alldata->state->name : 'N/A'; ?>, <?=!empty($com_alldata->country->name) ? $com_alldata->country->name : 'N/A'; ?>. Email : <?= getExactField($com_alldata->email) ?>. Contact No. : <?= getExactField($com_alldata->contact_person_no) ?>.</p>
        </td>
    </tr>
</table>

<br>

<table width="100%" style="border-collapse: collapse; border: 1px solid black; text-align: center; font-size: 10px;">
    <tr>
        <td colspan="4" align="center">
            <h3>Clients Information</h3>
        </td>
    </tr>
    <tr>
        <td colspan="2" style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;">
            <p style=" font-size: 12px; text-align: left;">Name : </p><?= getExactField($clients->name) ?>
        </td>
        <td colspan="2" style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;">
            <p style=" font-size: 12px; text-align: left;">Email : </p><?= getExactField($clients->email) ?>
        </td>
    </tr>
    <tr>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 25%; font-size: 12px;" >
            <p>Account Number</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 25%; font-size: 12px;">
            <p>Bank Ifsc</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 25%; font-size: 12px;">
            <p>Gstin</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 25%; font-size: 12px;">
            <p>Pan</p>
        </td>
    </tr>
    <tr>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;">
            <p><?= getExactField($clients->account_number) ?></p>
        </td>

        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;">
            <p><?= getExactField($clients->bank_ifsc) ?></p>
        </td>

        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;">
            <p><?= getExactField($clients->gstin) ?></p>
        </td>

        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;">
            <p><?= getExactField($clients->pan) ?></p>
        </td>
    </tr>
    <tr>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; font-size: 12px;">
            <p>Flat</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;  width: 16%; font-size: 12px;">
            <p>Street</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;  width: 16%; font-size: 12px;">
            <p>Landmark</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%; font-size: 12px;">
            <p>Area</p>
        </td>
    </tr>
    <tr>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%;">
            <p><?= getExactField($clients->flat) ?></p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;  width: 16%;">
            <p><?= getExactField($clients->street) ?></p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;  width: 16%;">
            <p><?= getExactField($clients->landmark) ?></p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%;">
            <p><?= getExactField($clients->area) ?></p>
        </td>
    </tr>
    <tr>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%; font-size: 12px;">
            <p>City</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%; font-size: 12px;">
            <p>State</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; font-size: 12px;">
            <p>Statecode</p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;  width: 16%; font-size: 12px;">
            <p>Country</p>
        </td>
    </tr>

    <tr>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%;">
            <p><?= getExactField($clients->city->name) ?></p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%;">
            <p><?= getExactField($clients->state->name) ?></p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;  width: 16%;">
            <p><?= getExactField($clients->statecode) ?></p>
        </td>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px;  width: 16%;">
            <p><?= getExactField($clients->country->name) ?></p>
        </td>
    </tr>


    <tr>
        <td style=" border: 1px solid black; padding: 0px 0px 0px 5px;margin: 0px 0px 0px 0px; width: 16%; font-size: 12px;">Mobiles</td>
        <?php
        $Mobile = \app\models\ClientMobile::find()->where(['client_id' => $clients->client_id])->all();
        ?>
        <?php if ($Mobile): ?>
        <?php foreach ($Mobile as $key => $clientmob): ?>
        <td><p><?= getExactField($clientmob->client_mobile) ?></p></td>
            <?php endforeach; ?>
        <?php endif; ?>
    </tr>
</table>
<p style="font-size: 10px;"><?= Yii::$app->params['print_tagline_bottom']; ?></p>