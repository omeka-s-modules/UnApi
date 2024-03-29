<?php
namespace UnApi\Controller;

use EasyRdf\Graph;
use Laminas\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $id = $this->params()->fromQuery('id');
        $format = $this->params()->fromQuery('format');
        $response = $this->getResponse();

        if (!$id) {
            $content = '<formats><format name="rdf_dc" type="application/xml"/></formats>';
        } else {
            $item = $this->api()->read('items', $id)->getContent();
            if (!$format) {
                $content = sprintf('<formats id="%s"><format name="rdf_dc" type="application/xml"/></formats>', htmlspecialchars($id));
            } else {
                // Map requested format to valid EasyRdf format.
                switch ($format) {
                    case 'rdf_dc':
                    default:
                        $easyRdfFormat = 'rdfxml';
                }
                $graph = new Graph;
                $graph->parse(json_encode($item), 'jsonld');
                $content = $graph->serialise($easyRdfFormat);
            }
        }

        $response->setContent($content);
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/xml');
        return $response;
    }
}
