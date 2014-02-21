<?php namespace Connor4312\WhmcsL4;

class Whmcs
{
    public $api;
    public $hosting;

    /**
     * @var array Maps for method calls to child object methods. For example,
     *            the mapping ['api' => 'call'] will proxy $this->api() to
     *            $api->call().
     */
    protected $mapping = array(
        'api' => 'call'
    );

    public function __construct(API\API $api)
    {
        $this->api = $api;
    }

    public function __call($method, $arguments)
    {
        if (!array_key_exists($method, $this->mapping)) {
            throw new BadMethodCallException('Method ' . $method . ' not found on the WHMCS facade.');
        }

        return call_user_func_array(array($this, $method), $arguments);
    }
}