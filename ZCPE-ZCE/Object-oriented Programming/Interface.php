<?php

if (!function_exists('dd')) {
    function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}

const DATA = [
    Stock::class => [
        1 => [],
        2 => [],
        3 => []
    ],
    StockLocation::class => [
        [
            "id" => 6,
            "quantity" => 10,
            "locality" => "Apocalypse Peaks, Antarctica",
            "stock_id" => 1
        ],
        [
            "id" => 7,
            "quantity" => 20,
            "locality" => "Best, Texas, USA",
            "stock_id" => 1
        ],
        [
            "id" => 8,
            "quantity" => 120,
            "locality" => "Boring, Oregon, USA",
            "stock_id" => 2
        ],
        [
            "id" => 9,
            "quantity" => 80,
            "locality" => "Celebration, Florida, USA",
            "stock_id" => 2
        ],
        [
            "id" => 10,
            "quantity" => 95,
            "locality" => "Dinosaur, Colorado, USA",
            "stock_id" => 3
        ]
    ],
    ProductController::class => [
        10 => [
            StockLocation::class => 5
        ]
    ]
];

abstract class Stock
{
    /**  @var string */
    public const ALL = 'ALL';

    /**
     * 
     */
    public function all(): int
    {
        return 0;
    }

    /**
     * 
     */
    public function product(): int
    {
        return 0;
    }
}

class StockLocation extends Stock
{
    /** @var int */
    private int $ID;

    /** @var Stock */
    protected \Stock $SID;

    /**
     * Constructor Method.
     * 
     * @param int $id
     */
    public function __construct(
        int $id = 0
    ) {

        foreach(DATA[StockLocation::class] as $data) {
            dd($data);
        }


        // if ((bool) is_array[$id]) === false) {
        //     throw new \Exception("This {:register} don't exist!");
        // }

        $this->ID = $id;
    }

    /**
     * Quantity (Getter).
     * 
     * @param \ProductController $id
     * @param int $StockId
     * 
     * @return int
     */
    public function getQuantity(): int
    {
        dd($this->ID);

        foreach (DATA[StockLocation::class] as $data) {
            dd($data);
            // if ($data['stock_id'] == $this->ID) {
            // }
        }

        return 0;
    }

    /**
     * Quantity (Setter).
     * 
     * @return Self;
     */
    public function setQuantity(
        ProductController $id,
        StockLocation $StockId
    ): self {
        return $this;
    }

    /**
     * Id (Getter).
     * 
     * @param void
     * 
     * @return $this->ID
     */
    public function id(): int
    {
        return $this->ID;
    }
}

interface Assign
{
}

final class ProductController extends StockLocation implements Assign
{
    /** @var int */
    private int $ID;

    /** @var StockLocation */
    private \StockLocation $SLID;

    /**
     * Constructor Method.
     * 
     * @param void
     */
    public function __construct(
        int $ID,
        int $SLID
    ) {
        $this->ID = $ID;
        $this->SLID =  new StockLocation($SLID);
    }

    /** 
     * Setter Method.
     */
    public function __set(string $str, $value): self
    {
        $this->$str = $value;

        return $this;
    }

    /**
     * Getter Method.
     * 
     * @param string $str
     */
    public function __get(string $str)
    {
        return $this->$str;
    }

    // /**
    //  * Quantity (Getter).
    //  * 
    //  * @param void
    //  * 
    //  * @return int;
    //  */
    // public function getQuantity(): self
    // {
    //     dd("aaaa");
    //     return $this;
    // }
}

$s = new StockLocation(7);
$s->getQuantity();


// $p = new ProductController(10, 7);

// $p->getQuantity($p->__get('ID'));



dd(DATA);

echo "HERE !";

// // 

// ->__get(ProductController::ID);

// var_dump(\Stock::init(10));

// $item = new ProductController(\Stock::init(10));


$str = "<note>
        <to>Tove</to>
        <from>Jani</from>
        <heading>Reminder</heading>
        <body>Don't forget me this weekend!</body>
        </note>";

$dado = simplexml_load_string($str);

dd($dado);

dd($dado->children());
