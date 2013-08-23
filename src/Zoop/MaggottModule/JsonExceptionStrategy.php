<?php
/**
 * @link       http://superdweebie.com
 * @package    Zoop
 * @license    MIT
 */
namespace Zoop\MaggottModule;

use Zend\Http\Header\ContentType;
use Zend\Http\Request;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

/**
 *
 * @since   1.0
 * @author  Tim Roediger <superdweebie@gmail.com>
 */
class JsonExceptionStrategy
{

    protected $displayExceptions;

    protected $exceptionMap;

    protected $describePath;

    public function getDisplayExceptions() {
        return $this->displayExceptions;
    }

    public function setDisplayExceptions($displayExceptions) {
        $this->displayExceptions = $displayExceptions;
    }

    public function getExceptionMap() {
        return $this->exceptionMap;
    }

    public function setExceptionMap($exceptionMap) {
        $this->exceptionMap = $exceptionMap;
    }

    public function getDescribePath() {
        return $this->describePath;
    }

    public function setDescribePath($describePath) {
        $this->describePath = $describePath;
    }

    /**
     * Create an exception json view model, and set the HTTP status code
     *
     * @todo   dispatch.error does not halt dispatch unless a response is
     *         returned. As such, we likely need to trigger rendering as a low
     *         priority dispatch.error event (or goto a render event) to ensure
     *         rendering occurs, and that munging of view models occurs when
     *         expected.
     * @param  MvcEvent $e
     * @return void
     */
    public function prepareExceptionViewModel(MvcEvent $e)
    {
        // Do nothing if no error in the event
        if ( ! ($error = $e->getError())) {
            return;
        }

        // Do nothing if the result is a response object
        $result = $e->getResult();
        if ($result instanceof Response) {
            return;
        }

        if ($error != Application::ERROR_EXCEPTION){
            return;
        }

        if (! $e->getRequest() instanceof Request){
            return;
        }

        $accept = $e->getRequest()->getHeaders()->get('Accept');
        if (! ($accept && $accept->match('application/json'))){
            return;
        }

        if (! ($exception = $e->getParam('exception'))){
            return;
        }

        $modelData = $this->serializeException($exception);
        $e->setResult(new JsonModel($modelData));
        $e->setError(false);

        $response = $e->getResponse();
        if (!$response) {
            $response = new HttpResponse();
            $e->setResponse($response);
        }

        if (isset($modelData['statusCode'])){
            $response->setStatusCode($modelData['statusCode']);
        } else {
            $response->setStatusCode(500);
        }
        $response->getHeaders()->addHeaders([$accept, ContentType::fromString('Content-type: application/api-problem+json')]);
    }

    public function serializeException($exception){

        if (isset($this->exceptionMap[get_class($exception)])){
            $mapping = $this->exceptionMap[get_class($exception)];
            $data = ['title' => $mapping['title']];

            if (isset($this->describePath)){
                if (isset($mapping['described_by'])){
                    $data['describedBy'] = $this->describePath . '/' . $mapping['described_by'];
                } else {
                    $data['describedBy'] = $this->describePath . '/application-exception';
                }
            }
   
            if (isset($mapping['status_code'])){
                $data['statusCode'] = $mapping['status_code'];
            }
            if (isset($mapping['extension_fields'])){
                foreach ($mapping['extension_fields'] as $field){
                    $data[$field] = $exception->{'get' . ucfirst($field)}();
                }
            }
            if ($this->displayExceptions){
                if (isset($mapping['restricted_extension_fields'])){
                    foreach ($mapping['restricted_extension_fields'] as $field){
                        $data[$field] = $exception->{'get' . ucfirst($field)}();
                    }
                }
            }
        } else {
            $data = [
                'title' => 'Application Exception'
            ];
            if (isset($this->describePath)){
                $data['describedBy'] = $this->describePath . '/application-exception';
            }
        }

        if ($this->displayExceptions){
            $data['detail'] = $exception->getMessage();
            $data['class'] = get_class($exception);
            $data['file'] = $exception->getFile();
            $data['line'] = $exception->getLine();
        }

        return $data;
    }
}

