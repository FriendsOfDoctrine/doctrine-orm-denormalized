<?php
namespace FOD\OrmDenormalizer;

/**
 * Class DnColumn
 * @package FOD\OrmDenormalizer
 */
class DnColumn
{
    /** @var  string */
    protected $name;
    /** @var  string */
    protected $type;
    /** @var array */
    protected $options = [];
    /** @var  string */
    protected $columnName;

    /**
     * @var string
     */
    protected $targetEntityClass;
    /**
     * @var string
     */
    protected $targetPropertyName;

    /** @var string */
    protected $selfRelatedPropertyName;

    /**
     * DnColumn constructor.
     *
     * @param string $name
     * @param array $field
     * @param string $targetEntityClass
     * @param string $targetPropertyName
     * @param string $selfRelatedPropertyName
     */
    public function __construct($name, array $field, $targetEntityClass, $targetPropertyName, $selfRelatedPropertyName = null)
    {
        $this->name = $name;

        $this->type = isset($field['type']) && !empty($field['type']) ? $field['type'] : 'string';
        $this->targetEntityClass = $targetEntityClass;
        $this->targetPropertyName = $targetPropertyName;
        $this->selfRelatedPropertyName = $selfRelatedPropertyName;

        $this->options = array_filter($field, function ($key) {
            return in_array($key, ['scale', 'length', 'unique', 'nullable', 'precision', 'id'], true);
        }, ARRAY_FILTER_USE_KEY);
    }

    /**
     * @return string
     */
    public function getName()
    {
        if (!$this->columnName) {
            $this->columnName = strtolower($this->name);
        }
        return $this->columnName;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getTargetEntityClass()
    {
        return $this->targetEntityClass;
    }

    /**
     * @return string
     */
    public function getTargetPropertyName()
    {
        return $this->targetPropertyName;
    }

    /**
     * @return bool
     */
    public function isSelfRelated()
    {
        return !empty($this->selfRelatedPropertyName);
    }

    /**
     * @return string
     */
    public function getSelfRelatedPropertyName()
    {
        return $this->selfRelatedPropertyName;
    }
}