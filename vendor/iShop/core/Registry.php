<?php


namespace iShop;


class Registry extends Singleton
{

    private static array $properties = [];

    /**
     * получить свойство
     * @param string $name
     * @return array|null
     */
    public function getProperty(string $name): ?string
    {
        if (isset (self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }

    /**
     * записать свойство
     * @param string $name
     * @param string $value
     */
    public function setProperty(string $name, string $value): void
    {
        self::$properties[$name] = $value;
    }

    /**
     * получить свойства
     * @return array
     */
    public function getProperties (): array
    {
        return self::$properties;
    }
}