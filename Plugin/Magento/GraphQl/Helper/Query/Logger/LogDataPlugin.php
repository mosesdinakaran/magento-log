<?php

/**
 * Copyright © 2023 Moses All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace Moses\Log\Plugin\Magento\GraphQl\Helper\Query\Logger;

use Exception;
use GraphQL\Language\Parser;
use GraphQL\Language\Source;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Response\Http as HttpResponse;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Schema;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\GraphQl\Helper\Query\Logger\LogData;
use Moses\Log\Model\Config\Source\HttpMethods;
use Moses\Log\Services\Configuration;

/**
 * Plugin for the class Magento\GraphQl\Helper\Query\Logger\LogData
 * To add more data such as body and response
 */
class LogDataPlugin
{
    private Configuration $configuration;

    private SerializerInterface $serializer;

    /**
     * @param Configuration $configuration
     * @param SerializerInterface $serializer
     */
    public function __construct(
        Configuration $configuration,
        SerializerInterface $serializer
    ) {
        $this->configuration = $configuration;
        $this->serializer = $serializer;
    }

    /**
     * @param LogData $subject
     * @param $logData
     * @param RequestInterface $request
     * @param array $data
     * @param Schema|null $schema
     * @param HttpResponse|null $response
     * @return array
     * @throws NoSuchEntityException
     */
    public function afterGetLogData(
        LogData $subject,
        $logData,
        RequestInterface $request,
        array $data,
        ?Schema $schema,
        ?HttpResponse $response
    ) {
        if (!$this->configuration->getGraphqlLoggingStatus()) {
            return [$logData];
        }

        // Filter HTTP Method
        $httpMethod = strtolower($this->configuration->getGraphqlHttpMethods());
        if ($httpMethod != strtolower(HttpMethods::HTTP_ALL) &&
            $httpMethod != strtolower($request->getMethod())
        ) {
            return [$logData];
        }

        // Filter By Header
        $headers = $this->configuration->getGraphqlHeader();
        foreach ($headers as $header) {
            if ($request->getHeader($header['key']) != $header['value']) {
                return [$logData];
            }
        }
        $data = $this->getDataFromRequest($request);
        $queryPayload = $data['query'] ?? '';
        $variables = $data['variables'] ?? null;

        // Validate Query Type
        $queryTypeConfigured = $this->configuration->getGraphqlQueryType();
        if ($queryTypeConfigured && $queryPayload) {
            if (!$this->isQueryTypeValidForLogging($queryPayload, $queryTypeConfigured)) {
                return [$logData];
            }
        }

        // Log the Final Data
        $data = [
            'METHOD' => $request->getMethod(),
            'REQUEST' => $queryPayload ?? '',
            'VARIABLES' => $variables ?? '',
            'RESPONSE' => $response->getContent()
        ];
        $logData['GraphQLCustomLogging'] = $data;
        return [$logData];
    }

    /**
     * @param $queryPayload
     * @param $queryTypeConfigured
     * @return bool
     */
    private function isQueryTypeValidForLogging($queryPayload, $queryTypeConfigured)
    {
        try {
            $loqGraphQL = false;
            $requestQueries = $this->extractQueryName($queryPayload);
            $queryTypesToLog = explode(",", $queryTypeConfigured);
            foreach ($queryTypesToLog as $queryTypeToLog) {
                if (in_array($queryTypeToLog, $requestQueries)) {
                    $loqGraphQL = true;
                    break;
                }
            }
        } catch (Exception $exception) {
            // $query = $variables = '';
        }
        return $loqGraphQL;
    }

    /**
     * @param RequestInterface $request
     * @return array
     */
    private function getDataFromRequest(RequestInterface $request): array
    {
        /** @var Http $request */
        if ($request->isPost()) {
            $data = $this->serializer->unserialize($request->getContent());
        } elseif ($request->isGet()) {
            $data = $request->getParams();
            $data['variables'] = isset($data['variables']) ?
                $this->serializer->unserialize($data['variables']) : null;
            $data['variables'] = is_array($data['variables']) ?
                $data['variables'] : null;
        } else {
            return [];
        }
        return $data;
    }

    /**
     * @param $query
     * @return array
     * @throws \GraphQL\Error\SyntaxError
     */
    private function extractQueryName($query)
    {
        $queryNames = [];
        $queryAst = Parser::parse(new Source($query, 'GraphQL'));
        foreach ($queryAst->definitions as $definition) {
            $selections = $definition->selectionSet->selections ?? [];
            foreach ($selections as $selection) {
                $queryNames[] = $selection->name->value ?? '';
            }
        }
        return $queryNames;
    }
}
