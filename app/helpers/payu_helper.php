<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// PayU Integration for Meifter CMS
// Created by CodeMeifter
// All Rights Reserved.
// 2016

// Operative Functions
function getPayUStats()
{
    $ci =& get_instance();
    $ci->db->from('payusystem');
    $payu = $ci->db->get();
    $payuNfo = null;
    if ($payu->num_rows() > 0)
    {
        foreach ($payu->result() as $p)
        {
            $payuNfo = array(
                'merchantID' => $p->merchantID,
                'APILogin' => $p->APILogin,
                'APIkey' => $p->APIkey,
                'accountID' => $p->accountID,
                'test' => $p->test,
                'desc' => $p->desc,
            );
        }
    }
    return $payuNfo;
}

function getCode()
{
    $letters = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $stringletter = '';
    for ($i = 0; $i < 5; $i++) {
          $stringletter .= $letters[rand(0, strlen($letters) - 1)];
    }
    $stringnumber = '';
    for ($i = 0; $i < 5; $i++) {
          $stringnumber .= $numbers[rand(0, strlen($numbers) - 1)];
    }
    $code = $stringletter . '' . $stringnumber;
    return 'MFRKALE' .  $code . 'REF';
}

function encodeMD5($value)
{
    $encodeVal = md5($value);

    return $encodeVal;
}

function savePayuTrans($payutransnfo)
{
    $ci =& get_instance();
    $ci->db->from('payureg');
    $ci->db->where('transactionid', $payutransnfo['transactionId']);
    $validPayuReg = $ci->db->get();
    if ($validPayuReg->num_rows() < 1)
    {
        $payustate = $payutransnfo['estadoTx'];
        $payutrans = $payutransnfo['transactionId'];
        $payurefpol = $payutransnfo['reference_pol'];
        $payurefcod = $payutransnfo['referenceCode'];
        $payuUser = $payutransnfo['user_id'];

        if ($payutransnfo['pseBank'] != null) {
            $payucus =  $payutransnfo['cus'];
            $payubank =  $payutransnfo['pseBank'];
        }
        
        $payutx = $payutransnfo['TX_VALUE'];
        $payucurrency = $payutransnfo['currency'];
        $payuextra = $payutransnfo['extra1'];
        $payumethod = $payutransnfo['lapPaymentMethod'];

        if ($payutransnfo['pseBank'] != null) {
            $payuNfo = array(
                'user_id' => $payuUser,
                'estadoTx' => $payustate,
                'transactionId' => $payutrans,
                'reference_pol' => $payurefpol,
                'referenceCode' => $payurefcod,
                'pseBank' => $payubank,
                'cus' => $payucus,
                'TX_VALUE' => $payutx,
                'currency' => $payucurrency,
                'extra1' => $payuextra,
                'lapPaymentMethod' => $payumethod,
            );
        }else{
            $payuNfo = array(
                'user_id' => $payuUser,
                'estadoTx' => $payustate,
                'transactionId' => $payutrans,
                'reference_pol' => $payurefpol,
                'referenceCode' => $payurefcod,
                'pseBank' => null,
                'cus' => null,
                'TX_VALUE' => $payutx,
                'currency' => $payucurrency,
                'extra1' => $payuextra,
                'lapPaymentMethod' => $payumethod,
            );
        }

        $ci->db->insert('payureg', $payuNfo); 
    }
}

function havePayu($userID)
{
    $ci =& get_instance();
    $ci->db->from('payureg');
    $ci->db->where('user_id', $userID);
    $validPayuReg = $ci->db->get();
    if ($validPayuReg->num_rows() > 0)
    {
        return TRUE;
    }else{
        return FALSE;
    }
}