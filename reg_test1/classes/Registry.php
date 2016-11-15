<?php

class Registry Implements ArrayAccess {
    
    private static $instance;

    /**
     * Data
     *
     * @var array
     */
    private $data = [];
    
    private function __construct() {
        
    }
    
    public static function getInstance() {

        if (static::$instance === NULL) {
            static::$instance = new static();
        }
        
        return static::$instance;
    }

    /**
     * Get a data by key
     *
     * @param string The key data to retrieve
     */
    public function get($key) {
        return $this->data[$key];
    }

    /**
     * Assigns a value to the specified data
     * 
     * @param string The data key to assign the value to
     * @param mixed  The value to set
     */
    public function set($key, $value) {
        if (!isset($this->data[$key])) {
            $this->data[$key] = $value;
        } else {
            trigger_error('Variable ' . $key . ' already defined in Registry', E_USER_WARNING);
        }
    }

    /**
     * Whether or not an data exists by key
     *
     * @param string An data key to check for
     * @return boolean
     */
    public function __isset($key) {
        return isset($this->data[$key]);
    }

    /**
     * Removes a data by key
     *
     * @param string The key to unset
     */
    public function remove($key) {
        unset($this->data[$key]);
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     * @return boolean
     */
    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     */
    public function offsetUnset($offset) {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @return mixed
     */
    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    private function __clone() {
        
    }

    private function __wakeup() {
        
    }
}
