<?php
/**
 * ElementProcessor.php
 * Definition of class ElementProcessor
 * 
 * Created 16-Mar-2015 12:04:54
 *
 * @author M.D.Ward <matthew.ward@byng.co>
 * @copyright (c) 2015, Byng Services Ltd
 */
namespace ElasticSearch\Processor\Page;

use ElasticSearch\Processor\ProcessorException;
use NF\HtmlToText;



/**
 * ElementProcessor
 * 
 * @author M.D.Ward <matthew.ward@byng.co>
 */
class ElementProcessor
{

    /**
     *
     * @var HtmlToText
     */
    protected $htmlToTextFilter;
    
    
    
    /**
     * 
     * @param HtmlToText $htmlToTextFilter
     */
    public function __construct(HtmlToText $htmlToTextFilter)
    {
        $this->htmlToTextFilter = $htmlToTextFilter;
    }
    
    /**
     * 
     * @param Document_Tag $tag
     * @return string
     * @throws ProcessorException
     */
    public function processElement(Document_Tag $tag)
    {
        $elementData = $tag->getData();
        
        if (!is_string($elementData) || ($elementData = trim($elementData)) === '') {
            throw new ProcessorException(
                'This processor only accepts tags with immediate string data'
            );
        }
        
        // This needs to be handled much more elegantly than with the error suppression operator
        return @$this->htmlToTextFilter->convert($elementData);
    }
    
}
