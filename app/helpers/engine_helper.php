<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Core Engine for Meifter CMS
// Created by CodeMeifter
// All Rights Reserved.
// 2016

define('LIST_TYPE_BUY', 'cart');
define('LIST_TYPE_USER_LIST', 'list');
define('SALE_TYPE_CONTRAENTREGA', 'Contraentrega');
define('SALE_TYPE_PAYU', 'PayU');
define('STATUS_SALE_DELIVERY_PENDING', 'Pendiente');
define('STATUS_SALE_DELIVERY_OK', 'Entregado');
define('STATUS_SALE_DELIVERY_CANCELED', 'Cancelado');

// Operative Functions
function getMyID()
{
    $ci =& get_instance();
    $user = $ci->ion_auth->user()->row();
    if(isset($user->id)) {
        return $user->id;
    }else{
    	return null;
    }
}
function getUserNfo($user_id)
{
    $ci =& get_instance();
    $ci->db->from('users');
    $ci->db->where('id', $user_id);
    $user = $ci->db->get();
    $userNfo = null;
    if ($user->num_rows() > 0)
    {
        foreach ($user->result() as $p)
        {
            $userNfo = array(
                'id' => $p->id,
                'ip_address' => $p->ip_address,
                'username' => $p->username,
                'password' => $p->password,
                'salt' => $p->salt,
                'email' => $p->email,
                'activation_code' => $p->activation_code,
                'forgotten_password_code' => $p->forgotten_password_code,
                'forgotten_password_time' => $p->forgotten_password_time,
                'remember_code' => $p->remember_code,
                'created_on' => $p->created_on,
                'last_login' => $p->last_login,
                'active' => $p->active,
                'first_name' => $p->first_name,
                'last_name' => $p->last_name,
                'image' => $p->image_path,
                'company' => $p->company,
                'phone' => $p->phone,
                'adress' => $p->adress,
                'pais' => $p->pais,
                'provincia' => $p->provincia,
                'partido' => $p->partido,
                'localidad' => $p->localidad,
                'barrio' => $p->barrio,
                'subbarrio' => $p->subbarrio,
                'zip' => $p->zip,
                'about' => $p->about,
                'userPic' => $p->image_path
            );
        }
    }
    return $userNfo;
}

// Get Brand Info
function getBrandNfo($brand_ID)
{
    $ci =& get_instance();
    $ci->db->from('prod_brand');
    $ci->db->where('prod_brand_id', $brand_ID);
    $user = $ci->db->get();
    $brandNfo = null;
    if ($user->num_rows() > 0)
    {
        foreach ($user->result() as $p)
        {
            $brandNfo = array(
                'title' => $p->title,
                'slug' => $p->slug,
                'desc' => $p->desc,
            );
        }
    }
    return $brandNfo;
}

// Get Product Info
function getProductNfo($product_id)
{
    $ci =& get_instance();
    $ci->db->from('product');
    $ci->db->where('prod_id', $product_id);
    $prod = $ci->db->get();
    $prodNfo = null;
    if ($prod->num_rows() > 0)
    {
        foreach ($prod->result() as $prod)
        {
            $prodNfo = array(
                'name' => $prod->name,
                'slug' => $prod->slug,
                'desc' => $prod->desc,
                'short_desc' => $prod->short_desc,
                'pic' => $prod->pic,
                'price' => $prod->price,
                'tax_id' => $prod->tax_id,
                'brand_id' => $prod->brand_id,
                'cat_id' => $prod->cat_id
            );
        }
    }
    return $prodNfo;
}

function getProductByCat($cat_id)
{

    $ci =& get_instance();
    $ci->db->from('product');
    $ci->db->where('cat_id', $cat_id);
    $prod = $ci->db->get();
    $prodNfo = array();
    if ($prod->num_rows() > 0)
    {
        $prodContainer = array();
        foreach ($prod->result() as $prod)
        {
            $prodNfo = array(
                'name' => $prod->name,
                'slug' => $prod->slug
            );
            array_push($prodContainer, $prodNfo);
        }
        return $prodContainer;
    }else{
      return false;
    }
}

function getProductSegment($product_id)
{
    $ci =& get_instance();
    $ci->db->from('prod_seg');
    $ci->db->where('prod_id', $product_id);
    $segmentProd = $ci->db->get();
    $prodSegmentList = array();
    if ($segmentProd->num_rows() > 0)
    {
        foreach ($segmentProd->result() as $sgpr)
        {
            $segmentName = getSegmentByID($sgpr->prod_segment_id)['symbol'];
            array_push($prodSegmentList, $segmentName);
        }
    }

    return $prodSegmentList;
}

function getSegmentByID($prod_segment_id)
{
    $ci =& get_instance();
    $ci->db->from('prod_segment');
    $ci->db->where('prod_segment_id', $prod_segment_id);
    $segmentNfo = $ci->db->get();
    $segmentNfoList = null;
    if ($segmentNfo->num_rows() > 0)
    {
        foreach ($segmentNfo->result() as $sgpr)
        {
            $segmentNfoList = array(
                'title' => $sgpr->title,
                'symbol' => $sgpr->symbol,
                'slug' => $sgpr->slug,
                'desc' => $sgpr->desc
            );
        }
    }

    return $segmentNfoList;
}

// Segment Functions

// Cart Process Info
function calcAllCart($id)
{
    $ci =& get_instance();
    $ci->db->from('cart');
    $ci->db->where('usr_id', $id);
    $itemsCant = $ci->db->get();

    $totalCantCart = 0;


    // Get Total Number of Items in Cart
    if ($itemsCant->num_rows() > 0)
    {
        foreach ($itemsCant->result() as $p)
        {
            $totalCantCart = $totalCantCart + $p->prod_quantity;
        }
    }

    // Get Total Amount of Cash in Cart
    $totalCashCart = 0;
    if ($itemsCant->num_rows() > 0)
    {
        foreach ($itemsCant->result() as $p)
        {
            $totalCashCart = $totalCashCart + (getProductNfo($p->prod_id)['price'] * $p->prod_quantity);
        }
    }

    // Cart Information
    $cartNfo = array(
        'cartItems' => $totalCantCart,
        'cartCash' => $totalCashCart,
    );

    return $cartNfo;
}

// Blog Process
function getPostNfo($post_id, $user_id)
{
    $ci =& get_instance();
    $ci->db->from('post');
    $ci->db->where('post_id', $post_id);
    $blogNfo = $ci->db->get();
    $postResult = null;


    if ($blogNfo->num_rows() > 0)
    {
        foreach ($blogNfo->result() as $p)
        {
            $postResult = array(

            );
        }
    }
    return $postResult;
}
function getCatPostNfo($categorie_id)
{
    $ci =& get_instance();
    $ci->db->from('post_categorie');
    $ci->db->where('categorie_id', $categorie_id);
    $pcatnfo = $ci->db->get();
    $blogCatNfo = null;


    if ($pcatnfo->num_rows() > 0)
    {
        foreach ($pcatnfo->result() as $p)
        {
            $blogCatNfo = array(
                'title' => $p->title,
                'slug' => $p->slug,
                'desc' => $p->desc,
                'image' => $p->image
            );
        }
    }
    return $blogCatNfo;
}

function getCurrencyByID($currencyID)
{
    $ci =& get_instance();
    $ci->db->from('currency_list');
    $ci->db->where('currency_id', $currencyID);
    $currency = $ci->db->get();
    $currencyVal = null;
    if ($currency->num_rows() > 0)
    {
        foreach ($currency->result() as $cur)
        {
            $currencyVal = array(
                'name' => $cur->name,
                'iso' => $cur->iso,
                'symbol' => $cur->symbol
            );
        }
    }
    return $currencyVal;
}

function getTaxByID($taxID)
{
    $ci =& get_instance();
    $ci->db->from('tax_prod');
    $ci->db->where('tax_id', $taxID);
    $tax = $ci->db->get();
    $taxValue = null;
    if ($tax->num_rows() > 0)
    {
        foreach ($tax->result() as $tx)
        {
            $taxValue = array(
                'title' => $tx->title,
                'value' => $tx->value
            );
        }
    }
    return $taxValue;
}

function getStoreConfiguration()
{
    $ci =& get_instance();
    $ci->db->from('store_conf');
    $storeConf = $ci->db->get();
    $storeConfVal = null;
    if ($storeConf->num_rows() > 0)
    {
        foreach ($storeConf->result() as $stconf)
        {
            $storeConfVal = array(
                'currency' => getCurrencyByID($stconf->currency_id)['symbol'],
                'tax' => getTaxByID($stconf->tax_id)['value'],
                'payustate' => $stconf->disable_payu,
                'stock' => $stconf->show_stock,
                'shipping' => $stconf->show_shipping
            );
        }
    }
    return $storeConfVal;
}

function getSiteConfiguration()
{
    $ci =& get_instance();
    $ci->db->from('site_conf');
    $siteConf = $ci->db->get();
    $siteConfVal = null;
    if ($siteConf->num_rows() > 0)
    {
        foreach ($siteConf->result() as $stconf)
        {
            $siteConfVal = array(
                'site_name' => $stconf->site_name,
                'site_author' => $stconf->site_author,
                'site_desc' => $stconf->site_desc,
                'site_favicon' => $stconf->site_favicon,
                'site_logo' => $stconf->site_logo,
                'site_logofoot' => $stconf->site_logofoot,
                'site_charset' => $stconf->site_charset,
                'site_lang' => $stconf->site_lang,
                'cooming_soon' => $stconf->cooming_soon,
                'site_keywords' => $stconf->site_keywords,
                'site_appleicon' => $stconf->site_appleicon,
                'site_mail' => $stconf->site_mail
            );
        }
    }
    return $siteConfVal;
}

function getPayMethods()
{
    $ci =& get_instance();
    $ci->db->from('pay_mods');
    $icon = $ci->db->get();
    if ($icon->num_rows() > 0)
    {
        foreach ($icon->result() as $pymtd)
        {
            echo '<div class="col-md-4 paymods">';
            echo    '<img src="' . base_url() . 'assets/uploads/files/icons/' . $pymtd->icon . '" alt="">';
            echo '</div>';

        }
    }
}

function getRelProdByPost($post_id)
{
    $ci =& get_instance();
    $ci->db->from('prod_post');
    $ci->db->where('post_id', $post_id);
    $prodPost = $ci->db->get();
    if ($prodPost->num_rows() > 0)
    {
        foreach ($prodPost->result() as $pID)
        {
            $ci =& get_instance();
            $ci->db->from('product');
            $ci->db->where('prod_id', $pID->prod_id);
            $prodPost = $ci->db->get();
            if ($prodPost->num_rows() > 0)
            {
                foreach ($prodPost->result() as $prod)
                {
                    echo '<div class="col-md-3 highlight-dest relpostprod">';
                    echo '<a href="' . base_url() . 'product/' . $prod->slug . '">';
                    echo   '<img src="' . base_url() . 'assets/uploads/files/products/' . $prod->pic . '" alt="' . $prod->name . '"/>';
                    echo   '<h3 class="title">' . $prod->name . '</h3>';
                    echo   '<p class="description">' . $prod->short_desc . '</p>';
                    echo   '<span class="price">' . getStoreConfiguration()['currency'] . ' ' . $prod->price . '</span>';
                    echo '</a>';
                    echo '</div>';

                }
            }
        }
    }
}

// Get Products Nfo
function getMinProductPrice()
{
    $ci =& get_instance();
    $ci->db->select_min('price');
    $ci->db->limit(1);
    $minval = $ci->db->get('product');
    if ($minval->num_rows() > 0)
    {
        foreach ($minval->result() as $min)
        {
            $minPrice = $min->price;
        }
    }

    return $minPrice;
}
function getMaxProductPrice()
{
    $ci =& get_instance();
    $ci->db->select_max('price');
    $ci->db->limit(1);
    $minval = $ci->db->get('product');
    if ($minval->num_rows() > 0)
    {
        foreach ($minval->result() as $min)
        {
            $minPrice = $min->price;
        }
    }

    return $minPrice;
}

function checkRelProdByPost($post_id)
{
    $ci =& get_instance();
    $ci->db->from('prod_post');
    $ci->db->where('post_id', $post_id);
    $prodPost = $ci->db->get();
    if ($prodPost->num_rows() > 0)
    {
        return true;
    }else{
        return false;
    }
}


// Get Category
function getCatNfo($cat_id)
{
    $ci =& get_instance();
    $ci->db->from('prod_categorie');
    $ci->db->where('prod_cat_id', $cat_id);
    $catInfo = $ci->db->get();
    $categoriNfo = null;
    if ($catInfo->num_rows() > 0)
    {
        foreach ($catInfo->result() as $ctNfo)
        {
            $categoriNfo = array(
                'title' => $ctNfo->title,
                'slug' => $ctNfo->slug,
                'desc' => $ctNfo->desc
            );
        }
        return $categoriNfo;
    }else{
        return null;
    }
}
function getCatBlogList()
{
    $ci =& get_instance();
    $ci->db->from('post_categorie');
    $blogCat = $ci->db->get();
    if ($blogCat->num_rows() > 0)
    {
        foreach ($blogCat->result() as $cat)
        {
            echo '<li>';
            echo   '<a href="' . base_url() . 'blog/category/' . $cat->slug . '">';
            echo     $cat->title;
            echo   '</a>';
            echo '</li>';
        }
    }
}

// Social Plugins Addons
function makeFbBtn($shareURL, $type){
    $callbackJS = "this.href, 'Facebook', 'width=640,height=580'";

    if ($type == 1) {
        $fbBtn = '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $shareURL . '" class="btn btn-social btn-round btn-fill btn-facebook" onclick="return !window.open(' . $callbackJS . ')">' .
                     '<i class="fa fa-facebook"></i>' .
                 '</a>';
    }
    if ($type == 2) {
        $fbBtn = '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $shareURL . '" class="btn btn-social btn-round" onclick="return !window.open(' . $callbackJS . ')">' .
                     '<i class="fa fa-facebook"></i>' .
                 '</a>';
    }
    if ($type == 3) {
        $fbBtn = '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $shareURL . '" onclick="return !window.open(' . $callbackJS . ')"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
    }
    if ($type == 4) {
        $fbBtn = '<li><a href="https://www.facebook.com/sharer/sharer.php?u=' . $shareURL . '" onclick="return !window.open(' . $callbackJS . ')"><i class="fa fa-facebook"></i> Compartir</a></li>';
    }
    echo $fbBtn;
}
function makeTwBtn($shareURL, $type){
    $callbackJS = "this.href, 'Facebook', 'width=640,height=580'";

    if ($type == 1) {
        $twBtn = '<a href="https://twitter.com/home?status=' . $shareURL . '" class="btn btn-social btn-round btn-fill btn-twitter" onclick="return !window.open(' . $callbackJS . ')">' .
                     '<i class="fa fa-twitter"></i>' .
                 '</a>';
    }
    if ($type == 2) {
        $twBtn = '<a href="https://twitter.com/home?status=' . $shareURL . '" class="btn btn-social btn-round" onclick="return !window.open(' . $callbackJS . ')">' .
                     '<i class="fa fa-twitter"></i>' .
                 '</a>';
    }
    if ($type == 3) {
        $twBtn = '<a href="https://twitter.com/home?status=' . $shareURL . '" onclick="return !window.open(' . $callbackJS . ')"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
    }
    if ($type == 4) {
        $twBtn = '<li><a href="https://twitter.com/home?status=' . $shareURL . '" onclick="return !window.open(' . $callbackJS . ')"><i class="fa fa-twitter"></i> Tweetear</a></li>';
    }
    echo $twBtn;
}

function makePntBtn($imgPin, $shareURL, $type){
    $callbackJS = "this.href, 'Facebook', 'width=640,height=580'";
    $siteDescription =  getSiteConfiguration()['site_desc'];

    if ($imgPin == null) {
        $imgPin = base_url() . 'assets/img/' . getSiteConfiguration()['site_appleicon'];
    }

    if ($type == 1) {
        $pntBtn = '<a href="https://pinterest.com/pin/create/button/?url=' . $shareURL . '&media=' . $imgPin . '&description=' . $siteDescription . '" class="btn btn-social btn-round btn-fill btn-pinterest" onclick="return !window.open(' . $callbackJS . ')">' .
                     '<i class="fa fa-pinterest-p"></i>' .
                 '</a>';
    }
    if ($type == 2) {
        $pntBtn = '<a href="https://pinterest.com/pin/create/button/?url=' . $shareURL . '&media=' . $imgPin . '&description=' . $siteDescription . '" class="btn btn-social btn-round" onclick="return !window.open(' . $callbackJS . ')">' .
                     '<i class="fa fa-pinterest-p"></i>' .
                 '</a>';
    }
    if ($type == 3) {
        $pntBtn = '<a href="https://pinterest.com/pin/create/button/?url=' . $shareURL . '&media=' . $imgPin . '&description=' . $siteDescription . '" onclick="return !window.open(' . $callbackJS . ')"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
    }
    if ($type == 4) {
        $pntBtn = '<li><a href="https://pinterest.com/pin/create/button/?url=' . $shareURL . '&media=' . $imgPin . '&description=' . $siteDescription . '" onclick="return !window.open(' . $callbackJS . ')"><i class="fa fa-pinterest"></i> Pinear</a></li>';
    }
    echo $pntBtn;
}

// Get Promo Code Nfo
function getPromoCodeNfoByCode($promoCode)
{
    $ci =& get_instance();
    $ci->db->from('promo_code');
    $ci->db->where('disc_code', $promoCode);
    $codeNfo = $ci->db->get();
    $promoCodeValues = null;
    if ($codeNfo->num_rows() > 0)
    {
        foreach ($codeNfo->result() as $pmc)
        {
            $promoCodeValues = array(
                'disc_name' => $pmc->disc_name,
                'disc_code' => $pmc->disc_code,
                'disc_percent' => $pmc->disc_percent,
                'disc_from' => $pmc->disc_from,
                'disc_to' => $pmc->disc_to
            );
        }
        return $promoCodeValues;
    }else{
        return null;
    }
}

// Get Mail Configuration
function getMailConfiguration()
{
    $ci =& get_instance();
    $ci->db->from('smtp_mail_conf');
    $ci->db->where('smtp_conf_id', 1);
    $malRend = $ci->db->get();
    $mlCnfVal = null;
    if ($malRend->num_rows() > 0)
    {
        foreach ($malRend->result() as $mlCnf)
        {
            $mlCnfVal = array(
                'smtp_host' => $mlCnf->smtp_host,
                'smtp_port' => $mlCnf->smtp_port,
                'smtp_timeout' => $mlCnf->smtp_timeout,
                'smtp_user' => $mlCnf->smtp_user,
                'smtp_pass' => $mlCnf->smtp_pass,
                'smtp_charset' => $mlCnf->smtp_charset,
                'smtp_newline' => $mlCnf->smtp_newline,
                'smtp_mailtype' => $mlCnf->smtp_mailtype,
                'smtp_validation' => $mlCnf->smtp_validation
            );
        }
        return $mlCnfVal;
    }else{
        return null;
    }
}

// Get Contact Info
function getContactNfo()
{
    $ci =& get_instance();
    $ci->db->from('contact_data');
    $ci->db->where('contact_id', 1);
    $contactNfoRend = $ci->db->get();
    $contactNfo = null;
    if ($contactNfoRend->num_rows() > 0)
    {
        foreach ($contactNfoRend->result() as $cnfo)
        {
            $contactNfo = array(
                'adress' => $cnfo->adress,
                'lat' => $cnfo->lat,
                'lng' => $cnfo->lng,
                'city' => $cnfo->city,
                'phone' => $cnfo->phone,
                'email' => $cnfo->email,
                'time' => $cnfo->time,
                'linkedin' => $cnfo->linkedin,
                'facebook' => $cnfo->facebook,
                'twitter' => $cnfo->twitter
            );
        }
        return $contactNfo;
    }else{
        return null;
    }
}


function getCatLinkBreadcrum($catID)
{
    $ci =& get_instance();
    $ci->db->from('prod_categorie');
    $ci->db->where('prod_cat_id', $catID);
    $catSlug = $ci->db->get();
    if ($catSlug->num_rows() > 0)
    {
        foreach ($catSlug->result() as $slg)
        {
            return '<a href="' . base_url() . 'category/' . $slg->slug . '">' . $slg->title . '</a>';
        }

    }
}


// Industrial Functions
function getIndSubCatByCatID($catID)
{
    $ci =& get_instance();
    $ci->db->from('ind_subcat');
    $ci->db->where('indcat_id', $catID);
    $catSlug = $ci->db->get();
    if ($catSlug->num_rows() > 0)
    {
        foreach ($catSlug->result() as $slg)
        {
            echo '<a href="' . base_url() . 'industrial/subcat/' . $slg->slug . '">' . $slg->name . '</a>';
        }

    }
}

function checkIFSubcatInCat($catID)
{
    $ci =& get_instance();
    $ci->db->from('ind_subcat');
    $ci->db->where('indcat_id', $catID);
    $catSlug = $ci->db->get();
    if ($catSlug->num_rows() > 0)
    {
        return true;
    }else{
        return false;
    }
}

function getCertNfoByID($ID)
{
    $ci =& get_instance();
    $ci->db->from('ind_cert_type');
    $ci->db->where('ind_cert_type_id', $ID);
    $catSlug = $ci->db->get();
    $certNfo = null;
    if ($catSlug->num_rows() > 0)
    {
        foreach ($catSlug->result() as $ctNfo)
        {
            $certNfo = array(
                'name' => $ctNfo->name,
                'desc' => $ctNfo->desc
            );
        }
        return $certNfo;
    }else{
        return null;
    }
}

function getCertListByIndID($ID)
{
    $ci =& get_instance();
    $ci->db->from('ind_cert');
    $ci->db->where('ind_id', $ID);
    $catSlug = $ci->db->get();
    if ($catSlug->num_rows() > 0)
    {
        foreach ($catSlug->result() as $ctNfo)
        {
            echo getCertNfoByID($ctNfo->ind_cert_type_id)['name'] . '<br>';
        }
    }else{
        return null;
    }

}

function getIndSubcatNfo($ID)
{
    $ci =& get_instance();
    $ci->db->from('ind_subcat');
    $ci->db->where('indsubcat_id', $ID);
    $nfo = $ci->db->get();
    if ($nfo->num_rows() > 0)
    {
        foreach ($nfo->result() as $ctNfo)
        {
            $subcatNfo = array(
                'name' => $ctNfo->name,
                'slug' => $ctNfo->slug,
                'visit' => $ctNfo->visit,
                'indcat_id' => $ctNfo->indcat_id
            );
        }
        return $subcatNfo;
    }else{
        return null;
    }
}

// Geolocation Functions
function getCountryByID($ID)
{
    $ci =& get_instance();
    $ci->db->from('pais');
    $ci->db->where('id', $ID);
    $nfo = $ci->db->get();
    if ($nfo->num_rows() > 0)
    {
        foreach ($nfo->result() as $ctNfo)
        {
            $certNfo = array(
                'nombre' => $ctNfo->nombre
            );
        }
        return $certNfo;
    }else{
        return null;
    }
}
function getProvinceByID($ID)
{
    $ci =& get_instance();
    $ci->db->from('provincias');
    $ci->db->where('id', $ID);
    $nfo = $ci->db->get();
    if ($nfo->num_rows() > 0)
    {
        foreach ($nfo->result() as $ctNfo)
        {
            $certNfo = array(
                'nombre' => $ctNfo->nombre,
                'idPais' => $ctNfo->idPais
            );
        }
        return $certNfo;
    }else{
        return null;
    }
}
function getPartidoByID($ID)
{
    $ci =& get_instance();
    $ci->db->from('partidos');
    $ci->db->where('id', $ID);
    $nfo = $ci->db->get();
    if ($nfo->num_rows() > 0)
    {
        foreach ($nfo->result() as $ctNfo)
        {
            $certNfo = array(
                'nombre' => $ctNfo->nombre,
                'idProvincia' => $ctNfo->idProvincia
            );
        }
        return $certNfo;
    }else{
        return null;
    }
}
function getLocalidadByID($ID)
{
    $ci =& get_instance();
    $ci->db->from('localidades');
    $ci->db->where('id', $ID);
    $nfo = $ci->db->get();
    if ($nfo->num_rows() > 0)
    {
        foreach ($nfo->result() as $ctNfo)
        {
            $certNfo = array(
                'nombre' => $ctNfo->nombre,
                'idPartido' => $ctNfo->idPartido
            );
        }
        return $certNfo;
    }else{
        return null;
    }
}
function getBarrioByID($ID)
{
    $ci =& get_instance();
    $ci->db->from('barrios');
    $ci->db->where('id', $ID);
    $nfo = $ci->db->get();
    if ($nfo->num_rows() > 0)
    {
        foreach ($nfo->result() as $ctNfo)
        {
            $certNfo = array(
                'nombre' => $ctNfo->nombre,
                'idLocalidad' => $ctNfo->idLocalidad
            );
        }
        return $certNfo;
    }else{
        return null;
    }
}
function getSubBarrioByID($ID)
{
    $ci =& get_instance();
    $ci->db->from('subbarrios');
    $ci->db->where('id', $ID);
    $nfo = $ci->db->get();
    if ($nfo->num_rows() > 0)
    {
        foreach ($nfo->result() as $ctNfo)
        {
            $certNfo = array(
                'nombre' => $ctNfo->nombre,
                'idBarrio' => $ctNfo->idBarrio
            );
        }
        return $certNfo;
    }else{
        return null;
    }
}

function geocode($address){
    $address = urlencode($address);
    $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
    $resp_json = file_get_contents($url);
    $resp = json_decode($resp_json, true);
    if($resp['status']=='OK'){
        $lati = $resp['results'][0]['geometry']['location']['lat'];
        $longi = $resp['results'][0]['geometry']['location']['lng'];
        if($lati && $longi){
            $data_arr = array();
            array_push(
            $data_arr,
                $lati,
                $longi
            );
            return $data_arr;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function saveGeocode($lat, $lng, $indID)
{
    $ci =& get_instance();
    $data = array(
       'lat' => $lat,
       'lng' => $lng
    );
    $ci->db->where('ind_id', $indID);
    $ci->db->update('ind', $data);
}

function getLastUserRegister()
{
    $ci =& get_instance();
    $ci->db->from('users');
    $ci->db->select_max('id');
    $user = $ci->db->get();
    if ($user->num_rows() > 0)
    {
        foreach ($user->result() as $usrID)
        {
            return $usrID->id;
        }
    }else{
        return null;
    }
}

function getLastIndCreated()
{
    $ci =& get_instance();
    $ci->db->from('ind');
    $ci->db->select_max('ind_id');
    $ind = $ci->db->get();
    if ($ind->num_rows() > 0)
    {
        foreach ($ind->result() as $indID)
        {
            return $indID->ind_id;
        }
    }else{
        return null;
    }
}

function createIndCompany($user_id)
{
    $ci =& get_instance();
    $data = array(
       'user_id' => $user_id,
       'status' => 0
    );

    $ci->db->insert('ind', $data);
}

function getIndustrialUserByID($user_id)
{
    $ci =& get_instance();
    $ci->db->from('ind');
    $ci->db->where('user_id', $user_id);
    $ind = $ci->db->get();
    if ($ind->num_rows() > 0)
    {
        foreach ($ind->result() as $indID)
        {
            return $indID->ind_id;
        }
    }else{
        return null;
    }
}


function do_upload($propertyName, $imgName, $folder = '')
{
    $userID = getMyID();
    $indID = getIndustrialUserByID($userID);

    $imgName = str_replace(' ','_',$imgName);

    $config['upload_path'] = './assets/uploads/' . $folder;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '10000';
    $config['max_width']  = '2048';
    $config['max_height']  = '1768';
    $config['file_name'] = $imgName . $_FILES[$propertyName]['name'];

    $ci =& get_instance();
    $ci->load->library('upload');
    $ci->upload->initialize($config);

    if ( !$ci->upload->do_upload($propertyName))
    {
        $error = array('error' => $ci->upload->display_errors());
        redirect('Industrial/editIndustrial/' . $indID,'refresh');
    }
    else
    {
        return  $imgName . $ci->upload->data()["client_name"];
    }
}

function remove_file ($filepathToRemove) {
    $ci =& get_instance();
    $ci->load->helper("file");
    var_dump(delete_files($filepathToRemove));die;
    if ( !delete_files($filepathToRemove) ) {
        echo "Error al borrar archivo " . $filepathToRemove; die;
    } else echo "JAJAJ";die;
}

function countNullRowsInInd($user_id)
{
    $ci =& get_instance();
    $ci->db->from('ind');
    $ci->db->where('user_id', $user_id);
    $industry = $ci->db->get();
    if ($industry->num_rows() > 0)
    {
        foreach ($industry->result() as $ind)
        {
            $industrilData['title'] = $ind->title;
            $industrilData['slug'] = $ind->slug;
            $industrilData['logo'] = $ind->logo;
            $industrilData['indsubcat_id'] = $ind->indsubcat_id;
            $industrilData['adress'] = $ind->adress;
            $industrilData['number'] = $ind->number;
            $industrilData['pais_id'] = $ind->pais_id;
            $industrilData['provincia_id'] = $ind->provincia_id;
            $industrilData['localidad_id'] = $ind->localidad_id;
            $industrilData['partido_id'] = $ind->partido_id;
            $industrilData['barrio_id'] = $ind->barrio_id;
            $industrilData['subbarrio_id'] = $ind->subbarrio_id;
            $industrilData['phone'] = $ind->phone;
            $industrilData['fax'] = $ind->fax;
            $industrilData['email'] = $ind->email;
            $industrilData['facebook'] = $ind->facebook;
            $industrilData['twitter'] = $ind->twitter;
            $industrilData['youtube'] = $ind->youtube;
            $industrilData['linkedin'] = $ind->linkedin;
            $industrilData['shortdesc'] = $ind->shortdesc;
            $industrilData['desc'] = $ind->desc;
            $industrilData['body'] = $ind->body;
            $industrilData['visit'] = $ind->visit;
            $industrilData['lat'] = $ind->lat;
            $industrilData['lng'] = $ind->lng;
            $industrilData['status'] = $ind->status;
            $nullFields = 0;
            $fillFields = 0;
            foreach ($industrilData as $key => $value) {
                if ($value == null) {
                    $nullFields = $nullFields + 1;
                }else{
                    $fillFields = $fillFields + 1;
                }
            }
            $totalFields = $nullFields + $fillFields;
            $completePercent = round(($fillFields * 100) / $totalFields);
            return $completePercent;
        }
    }else{
        return null;
    }
}

function checkIfHasCert($ind_id, $certID)
{
    $ci =& get_instance();
    $ci->db->from('ind_cert');
    $ci->db->where('ind_id', $ind_id);
    $ci->db->where('ind_cert_type_id', $certID);
    $hasCert = $ci->db->get();
    if ($hasCert->num_rows() > 0)
    {
        return true;
    }else{
        return false;
    }
}

function deleteAllCertsByIndID($ind_id)
{
    $ci =& get_instance();
    $ci->db->where('ind_id', $ind_id);
    $ci->db->delete('ind_cert');
}

function getIndustrialSlug($ind_id)
{
    $ci =& get_instance();
    $ci->db->from('ind');
    $ci->db->where('ind_id', $ind_id);
    $industry = $ci->db->get();
    if ($industry->num_rows() > 0)
    {
        foreach ($industry->result() as $ind)
        {
            return $ind->slug;
        }
    }else{
        return null;
    }
}

function getIndustrialName($ind_id)
{
    $ci =& get_instance();
    $ci->db->from('ind');
    $ci->db->where('ind_id', $ind_id);
    $industry = $ci->db->get();
    if ($industry->num_rows() > 0)
    {
        foreach ($industry->result() as $ind)
        {
            return $ind->title;
        }
    }else{
        return null;
    }
}

function countNewMessages($user_id)
{
    $ci =& get_instance();
    $ci->db->from('msg_system');
    $ci->db->where('user_id', $user_id);
    $ci->db->where('state', 1);
    return $ci->db->count_all_results();
}

// MP Configuration Account
function getMPConf()
{
    $ci =& get_instance();
    $ci->db->from('mp_conf');
    $ci->db->where('mp_conf_id', 1);
    $mpconf = $ci->db->get();
    if ($mpconf->num_rows() > 0)
    {
        foreach ($mpconf->result() as $mcf)
        {
            $mpConfNfo = array(
                'client_id' => $mcf->client_id,
                'client_secret' => $mcf->client_secret
            );
        }
        return $mpConfNfo;
    }else{
        return null;
    }
}

function checkMPRecurrent($clientID, $secretID, $preapprovalID)
{
    $ci =& get_instance();
    $ci->db->from('membership_mp_info');
    $ci->db->where('id', $preapprovalID);
    $mpconf = $ci->db->get();
    if ($mpconf->num_rows() > 0)
    {
    }else{
        $mp = new MP ($clientID, $secretID);
        $paymentInfo = $mp->get_preapproval_payment($preapprovalID);
        $data = array(
           'id' => $paymentInfo['response']['id'],
           'payer_id' => $paymentInfo['response']['payer_id'],
           'payer_email' => $paymentInfo['response']['payer_email'],
           'back_url' => $paymentInfo['response']['back_url'],
           'collector_id' => $paymentInfo['response']['collector_id'],
           'application_id' => $paymentInfo['response']['application_id'],
           'status' => $paymentInfo['response']['status'],
           'reason' => $paymentInfo['response']['reason'],
           'external_reference' => $paymentInfo['response']['external_reference'],
           'date_created' => $paymentInfo['response']['date_created'],
           'last_modified' => $paymentInfo['response']['last_modified'],
           'init_point' => $paymentInfo['response']['init_point'],
           'sandbox_init_point' => $paymentInfo['response']['sandbox_init_point'],
           'frequency' => $paymentInfo['response']['auto_recurring']['frequency'],
           'frequency_type' => $paymentInfo['response']['auto_recurring']['frequency_type'],
           'transaction_amount' => $paymentInfo['response']['auto_recurring']['transaction_amount'],
           'currency_id' => $paymentInfo['response']['auto_recurring']['currency_id']
        );
        $ci->db->insert('membership_mp_info', $data);
        if ($data['status'] == 'authorized') {
            $data = array(
               'status' => 1
            );
            $ci->db->where('preapproval_id', $preapprovalID);
            $ci->db->update('membership_log', $data);
        }elseif ($data['status'] == 'paused') {
            $data = array(
               'status' => 0
            );
            $ci->db->where('preapproval_id', $preapprovalID);
            $ci->db->update('membership_log', $data);
        }
    }

}

// Forum Engine
function getForumCatNfoById($catId)
{
    $ci =& get_instance();
    $ci->db->from('forum_cat');
    $ci->db->where('for_cat_id', $catId);
    $forumCat = $ci->db->get();
    if ($forumCat->num_rows() > 0)
    {
        foreach ($forumCat->result() as $frC)
        {
            $forumCatNfo = array(
                'title' => $frC->title,
                'slug' => $frC->slug,
                'desc' => $frC->desc
            );
        }
        return $forumCatNfo;
    }else{
        return null;
    }
}

function getForumTopicNfoById($topID)
{
    $ci =& get_instance();
    $ci->db->from('forum_topic');
    $ci->db->where('for_topic_id', $topID);
    $forumTop = $ci->db->get();
    if ($forumTop->num_rows() > 0)
    {
        foreach ($forumTop->result() as $frC)
        {
            $forumTopNfo = array(
                'title' => $frC->title,
                'slug' => $frC->slug,
                'date' => $frC->date,
                'user_id' => $frC->user_id,
                'for_cat_id' => $frC->for_cat_id,
                'body' => $frC->body

            );
        }
        return $forumTopNfo;
    }else{
        return null;
    }
}

function getPositiveVotesComByID($comID)
{
    $ci =& get_instance();
    $ci->db->from('forum_comment');
    $ci->db->where('for_com_id', $comID);
    $vote = $ci->db->get();
    if ($vote->num_rows() > 0)
    {
        foreach ($vote->result() as $vt)
        {
            return $vt->plus_vote;
        }
    }else{
        return null;
    }
}

function getNegativeVotesComByID($comID)
{
    $ci =& get_instance();
    $ci->db->from('forum_comment');
    $ci->db->where('for_com_id', $comID);
    $vote = $ci->db->get();
    if ($vote->num_rows() > 0)
    {
        foreach ($vote->result() as $vt)
        {
            return $vt->neg_vote;
        }
    }else{
        return null;
    }
}

function countCommentsByTopicID($topID)
{
    $ci =& get_instance();
    $ci->db->from('forum_comment');
    $ci->db->where('for_topic_id', $topID);
    $result = $ci->db->count_all_results();
    return $result;
}

// RRHH
function createCand($user_id)
{
    $ci =& get_instance();
    $data = array(
       'user_id' => $user_id,
       'status' => 0
    );

    $ci->db->insert('rrhh_cand', $data);
}

function getCandUserByID($user_id)
{
    $ci =& get_instance();
    $ci->db->from('rrhh_cand');
    $ci->db->where('user_id', $user_id);
    $ind = $ci->db->get();
    if ($ind->num_rows() > 0)
    {
        foreach ($ind->result() as $indID)
        {
            return $indID->rrhh_cand_id;
        }
    }else{
        return null;
    }
}

function calcAge($birthDate)
{
    $fecha = str_replace('/', '-', $birthDate);
    $fecha = time() - strtotime($birthDate);
    $edad = floor((($fecha / 3600) / 24) / 360);
    echo $edad;
}

function getSex($sexID)
{
    if ($sexID == 1) {
        $sexString = 'Masculino';
    }elseif($sexID == 2){
        $sexString = 'Femenino';
    }
    return $sexString;
}

function getDocType($doctypeID)
{
    if ($doctypeID == 1) {
        $docTypeString = 'D.N.I.';
    }elseif($doctypeID == 2){
        $docTypeString = 'Pasaporte';
    }elseif($doctypeID == 3){
        $docTypeString = 'D.U.';
    }
    return $docTypeString;
}

function getCatNameByID($catID)
{
    $ci =& get_instance();
    $ci->db->from('rrhh_cat');
    $ci->db->where('rrhh_cat_id', $catID);
    $ind = $ci->db->get();
    if ($ind->num_rows() > 0)
    {
        foreach ($ind->result() as $indID)
        {
            return $indID->title;
        }
    }else{
        return null;
    }
}

function getExpByCandID($candID)
{
    $ci =& get_instance();
    $ci->db->from('rrhh_exp');
    $ci->db->where('cand_id', $candID);
    $ind = $ci->db->get();
    if ($ind->num_rows() > 0)
    {
        foreach ($ind->result() as $indID)
        {
            echo  '<p style="margin-top:0px;line-height: 16px;font-size: 15px;">';
            echo    '<b>' . $indID->company . '</b><br>';
            echo    $indID->position . ' <br>';
            echo    '<i>"' . $indID->title . '"</i><br>';
            echo    'Periodo: ' . $indID->start . ' - ' . $indID->end . '<br>';
            echo  '</p>';
        }
    }else{
        return null;
    }
}

function getEduByCandID($candID)
{
    $ci =& get_instance();
    $ci->db->from('rrhh_edu');
    $ci->db->where('cand_id', $candID);
    $ind = $ci->db->get();
    if ($ind->num_rows() > 0)
    {
        foreach ($ind->result() as $indID)
        {
            echo  '<p style="margin-top:0px;line-height: 16px;font-size: 15px;">';
            echo    '<b>' . $indID->title . '</b><br>';
            echo    $indID->entity . ' <br>';
            echo    'Materias: ' . $indID->courses_comp . '/' . $indID->courses_total . '<br>';
            echo    'Promedio: ' . $indID->calification . '<br>';
            echo    'Periodo: ' . $indID->start . ' - ' . $indID->end . '<br>';
            echo  '</p>';
        }
    }else{
        return null;
    }
}

function getExtraByCandID($candID)
{
    $ci =& get_instance();
    $ci->db->from('rrhh_extra');
    $ci->db->where('cand_id', $candID);
    $ind = $ci->db->get();
    if ($ind->num_rows() > 0)
    {
        foreach ($ind->result() as $indID)
        {
            echo  '<p style="margin-top:0px;line-height: 16px;font-size: 15px;">';
            echo    '<b>' . $indID->title . '</b><br>';
            echo    $indID->desc;
            echo  '</p>';
        }
    }else{
        return null;
    }
}

function haveCand($userID)
{
    $ci =& get_instance();
    $ci->db->from('rrhh_cand');
    $ci->db->where('user_id', $userID);
    $hasCert = $ci->db->get();
    if ($hasCert->num_rows() > 0)
    {
        return true;
    }else{
        return false;
    }
}

function haveInd($userID)
{
    $ci =& get_instance();
    $ci->db->from('ind');
    $ci->db->where('user_id', $userID);
    $hasCert = $ci->db->get();
    if ($hasCert->num_rows() > 0)
    {
        return true;
    }else{
        return false;
    }
}


function getMyCandidates($indID)
{
    $ci =& get_instance();
    $ci->db->from('rrhh_cand_ind');
    $ci->db->where('ind_id', $indID);
    $candNFo = $ci->db->get();
    if ($candNFo->num_rows() > 0)
    {
        foreach ($candNFo->result() as $indNfo)
        {
            $ci->db->from('rrhh_cand');
            $ci->db->where('rrhh_cand_id', $indNfo->cand_id);
            $cNfo = $ci->db->get();
            if ($cNfo->num_rows() > 0)
            {
                foreach ($cNfo->result() as $candNfo)
                {
                    echo '<div class="uk-width-medium-1-3">';
                            if ($candNfo->certificated_state == 1) {
                    echo        '<div class="uk-alert-success uk-alert" style="margin-bottom:0px;">Verificada por Unisos</div>';
                            }else{
                    echo        '<div class="uk-alert-success uk-warning" style="margin-bottom:0px;">Sin Verificar</div>';
                            }
                    echo    '<div class="uk-panel uk-panel-box">';
                            if ($candNfo->pic != null) {
                    echo            '<img id="imageProfile" class="pic" src="' . base_url() . 'assets/img/avatar.jpg" alt="">';
                            }else{
                    echo            '<img id="imageProfile" class="pic" src="' . base_url() . 'assets/img/avatar.jpg" alt="">';
                            }
                    echo        '<h3 class="uk-panel-title" style="margin-bottom:0px; padding-bottom:0px;">';
                    echo            $candNfo->firstname . '<br>';
                    echo        '</h3>';
                    echo        '<h3 class="uk-panel-title" style="margin-bottom: 5px;padding-bottom:0px;line-height: 0;margin-top: -5px;"><small>' . $candNfo->profesion . '</small></h3>';
                    echo        '<p style="margin-top:0px;line-height: 16px;font-size: 15px;">';
                    echo            $candNfo->short_desc . '<br>';
                    echo            calcAge($candNfo->birthdate) . ' años <br>';
                    echo            '$ ' . number_format($candNfo->salary, 0, 0, '.');
                    echo        '</p>';
                    echo        '<a class="uk-button-color uk-button-mini uk-button" href="' . base_url() . 'rrhh/directory/candidate/' . $candNfo->rrhh_cand_id  . '" target="_self">Ver Perfil</a>';
                    echo    '</div>';
                    echo '</div>';
                }
            }
        }
    }else{
        echo '<p>Aun no adquirio ningun perfil de candidato.</p>';
    }

}

function getProdListInCombo($comboID)
{
    $ci =& get_instance();
    $ci->db->from('pro_com');
    $ci->db->where('prod_combo_id', $comboID);
    $combo = $ci->db->get();
    if ($combo->num_rows() > 0)
    {
        foreach ($combo->result() as $prodID)
        {
            echo  '<p>' . getProductNfo($prodID->prod_id)['name'] . '</p>';
        }
    }else{
        return null;
    }
}

function getProdListInComboV2($comboID)
{
    $ci =& get_instance();
    $ci->db->from('pro_com');
    $ci->db->where('prod_combo_id', $comboID);
    $combo = $ci->db->get();
    if ($combo->num_rows() > 0)
    {
        $comboLength = $combo->num_rows();
        $counter = 1;
        foreach ($combo->result() as $prodID)
        {
          if ($counter >= $comboLength) {
            echo  getProductNfo($prodID->prod_id)['name'] . '.';
          }else{
            echo  getProductNfo($prodID->prod_id)['name'] . ', ';
          }

          $counter++;
        }
    }else{
        return null;
    }
}

function slugify($text)
{
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  if (empty($text)) {
    return 'n-a';
  }
  return $text;
}
