<?php

declare(strict_types=1);

namespace PhpMyAdmin\Controllers\Table\Structure;

use PhpMyAdmin\Controllers\InvocableController;
use PhpMyAdmin\Http\Response;
use PhpMyAdmin\Http\ServerRequest;

use function __;
use function in_array;

final class AddKeyController extends AbstractIndexController implements InvocableController
{
    public function __invoke(ServerRequest $request): Response|null
    {
        $GLOBALS['reload'] = true;

        $keyType = $this->getKeyType($request->getParsedBodyParam('key_type'));
        if ($keyType === '') {
            $this->response->setRequestStatus(false);
            $this->response->addJSON('message', __('Invalid request parameter.'));

            return null;
        }

        return $this->handleIndexCreation($request, $keyType);
    }

    /** @psalm-return  'FULLTEXT'|'INDEX'|'PRIMARY'|'SPATIAL'|'UNIQUE'|'' */
    private function getKeyType(mixed $keyType): string
    {
        return in_array($keyType, ['FULLTEXT', 'INDEX', 'PRIMARY', 'SPATIAL', 'UNIQUE'], true) ? $keyType : '';
    }
}
