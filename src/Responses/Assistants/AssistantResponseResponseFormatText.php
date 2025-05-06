<?php

declare(strict_types=1);

namespace OpenAI\Responses\Assistants;

use OpenAI\Contracts\ResponseContract;
use OpenAI\Responses\Concerns\ArrayAccessible;
use OpenAI\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: string, json_schema: ?array}>
 */
final class AssistantResponseResponseFormat implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string, json_schema: ?array}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $type,
        public ?array $json_schema,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: 'text'|'json_object'|'json_schema'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['json_schema'] ?? [],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'json_schema' => empty($this->json_schema) ? null : $this->json_schema,
        ]);
    }
}
