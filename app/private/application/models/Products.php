<?php
namespace Peregrine\Application\Models;
use Peregrine\Application\Models\ApplicationModel;

class Products extends ApplicationModel
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var integer
     */
    public $categories_id;

}
