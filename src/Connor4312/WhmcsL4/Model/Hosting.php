<?php namespace Connor4312\WhmcsL4\Model;

use \Illuminate\Database\Eloquent;
use \Config;

class Hosting extends Eloquent;
{
    protected $table = 'hosting';
    protected $connection = Config::get('whmcs-l4::connection');

    /**
     * The client who owns the given hosting.
     */
    public function client()
    {
        return $this->belongsTo('\Connor4312\WhmcsL4\Model\Client', 'userid');
    }

    /**
     * The order to which the hosting belongs.
     */
    public function order()
    {
        return $this->belongsTo('\Connor4312\WhmcsL4\Model\Order', 'orderid');
    }

    /**
     * The product that the hosting is an instance of.
     */
    public function product()
    {
        // Okay, what the fuck WHMCS? You can't even name your tables sanely.
        return $this->belongsTo('\Connor4312\WhmcsL4\Model\Product', 'packageid');
    }

    /**
     * Addons that the hosting has.
     */
    public function addons()
    {
        return $this->hasManyThrough('\Connor4312\WhmcsL4\Model\Addon', '\Connor4312\WhmcsL4\Model\HostingAddon', 'addonid', 'hostingid');
    }

    /**
     * Linkings between the hosting and addons. This stores information such as
     * cost, billing cycle, and service status.
     */
    public function hostingAddons()
    {
        return $this->hasMany('\Connor4312\WhmcsL4\Model\HostingAddon', 'hostingid');
    }

    /**
     * Configs the given hosting has.
     */
    public function configs()
    {
        // FYI: relid's are the same as hostingids. There are two different names because WHMCS loves consistency.
        return $this->hasManyThrough('\Connor4312\WhmcsL4\Model\ProductConfig', '\Connor4312\WhmcsL4\Model\HostingConfig', 'configid', 'relid');
    }

    /**
     * Options the given hosting has, inside the options. Don't ask me why
     * there are double relations between configs and options.
     */
    public function options()
    {
        return $this->hasManyThrough('\Connor4312\WhmcsL4\Model\ProductConfigOption', '\Connor4312\WhmcsL4\Model\HostingConfig', 'optionid', 'relid');
    }

    /**
     * The server that the hosting lives on.
     */
    public function server()
    {
        // Why is it `server`, not `serverid` like EVERYTHING ELSE. Don't ask me. Another consistency A+ to WHMCS.
        return $this->belongsTo('\Connor4312\WhmcsL4\Model\Server', 'server');
    }

    /**
     * Promotion that is active on the given hosting package.
     */
    public function promo()
    {
        return $this->belongsTo('\Connor4312\WhmcsL4\Model\Promo', 'promoid');
    }
}