<?php namespace Palmabit\GoogleDirections\Abstracts;

abstract class Api implements \Palmabit\GoogleDirections\Interfaces\Api
{

    /** @var int Timeout value in ms - defaults to 30s if empty */
    private $timeout = 30000;

    /** @var string API URL to which to send the request */
    protected $apiUrl;

    /** @var array Settings on which optional fields to fetch */
    protected $fieldSettings = [];

    protected $apikey;

    public function __construct($apikey)
    {
        $this->apikey = $apikey;
    }

    /**
      * Setting the timeout will define how long GoogleDirections will keep trying
      * to fetch the API results.
      *
      * @param int|null $timeout Defaults to 30000 even if not set
      *
      * @return $this
      */
    public function setTimeout($timeout = null)
    {
        if ($timeout === null) {
          $timeout = 3000;
        }
        self::validateTimeout($timeout);
        $this->timeout = $timeout;
        return $this;
    }

    private static function validateTimeout($timeout)
    {
        if (!is_int($timeout)) {
            throw new \InvalidArgumentException('Timeout is not an integer.');
        }
        if ($timeout < 0) {
            throw new \InvalidArgumentException('Timeout is negative. Only positive timeouts accepted.');
        }
        return true;
    }

    public function __call($name, $arguments)
    {
        $prefix = substr(lcfirst($name), 0, 3);
        $field = lcfirst(substr($name, 3));
        $fields = static::getOptionalFields();
        if (in_array($field, $fields)) {
            if ($arguments[0] !== null) {
                $this->fieldSettings[$field] = $arguments[0];
                return $this;
            }
            throw new \BadMethodCallException('Prefix "'.$prefix.'" not allowed.');
        }
        throw new \BadMethodCallException($name . ': such a field does not exist for this API class.');
    }

    public function call()
    {
      $url = $this->buildUrl();
      $result = file_get_contents($url);
      return json_decode(utf8_encode($result), true);
    }

    public function buildUrl()
    {
       $url = rtrim($this->apiUrl, '/').'?';
       $url .= 'key=' . $this->apikey;

       $fields = $this->fieldSettings;
       foreach ($fields as $field => $value) {
         $url .= '&' . $field . '=' . $value;
       }
       return $url;
   }

}
