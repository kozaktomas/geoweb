<?php

namespace Jednoadem\Communications;


use Nette\Object,
    ArrayAccess,
    Countable,
    Iterator;

class StreamReader extends Object implements ArrayAccess, Countable, Iterator
{

    /**
     * @var \DOMDocument
     */
    protected $document;

    /**
     * @var \DOMNodeList
     */
    protected $data;

    /**
     * @param int
     */
    protected $current;

    public function __construct(\DOMDocument $document)
    {
        $this->document = $document;
        $this->data = $this->document->getElementsByTagName("point");
        $this->current = 0;
    }

    public function getId()
    {
        return $this->document->getElementsByTagName("user_key")->item(0)->nodeValue;
    }

    public function offsetExists($offset)
    {
        if ($this->data->item($offset) == NULL) {
            return FALSE;
        }
        return TRUE;
    }

    public function offsetGet($offset)
    {

    }


    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }


    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    public function count()
    {
        return $this->data->length;
    }

    public function current()
    {
        return $this->createPoint($this->current);
    }


    public function next()
    {
        $this->current++;
        return $this->createPoint($this->current);
    }


    public function key()
    {
        return $this->current();
    }


    public function valid()
    {
        $res = ($this->current !== NULL && $this->current !== FALSE);
        return $res;
    }


    public function rewind()
    {
        $this->current = 0;
    }

    private function createPoint($offset)
    {
        if ($this->offsetExists($offset)) {
            $lat = 0.0;
            $lng = 0.0;
            foreach ($this->data->item($offset)->childNodes as $node) {
                if ($node->nodeName == "lat") {
                    $lat = $node->nodeValue;
                }
                if ($node->nodeName == "lng") {
                    $lng = $node->nodeValue;
                }
               // $lat = $node->nodeName;
            }
            return new Point($lat, $lng);
        }
        return FALSE;
    }
}