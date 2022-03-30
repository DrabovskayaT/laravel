<?php 

declare(strict_types=1);

namespace App\Servises;

use Exception;

abstract class AbstractFormatServises {
    
    private $value;
    protected array $options = [];

    /**
     * Construct
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * Get object
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get object
     *
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set object
     *
     * @param mixed $value
     * @return self
     * @throws ArgumentException
     */
    public function setValue($value): self
    {
        if (($type = $this->getTypeObject()) && !($value instanceof $type)) {
            throw new Exception('Не валидный тип входящего объекта');
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Format data
     *
     * @param $value
     * @return mixed
     * @throws ArgumentException
     */
    final public function format($value)
    {
        return $this->setValue($value)->getFormatted();
    }

    /**
     * Create formatter
     *
     * @param $value
     * @param array $options
     * @return static
     * @throws ArgumentException
     */
    public static function create($value, array $options = []): AbstractFormatServises
    {
        $object = new static($options);
        $object->setValue($value);

        return $object;
    }

    /**
     * Get format
     *
     * @param $value
     * @param array $options
     * @return mixed
     * @throws ArgumentException
     */
    public function createFormatted($value, array $options = [])
    {
        return static::create($value, $options)->getFormatted();
    }

    /**
     * Метод возвращает тип объекта, который необходимо форматировать.
     *
     * @return mixed
     */
    public function getTypeObject()
    {
        return null;
    }
}
