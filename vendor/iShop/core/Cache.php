<?php


namespace iShop;


class Cache extends Singleton
{
    /**
     * добавть кеш
     * @param string $key
     * @param array|float|string $data
     * @param int $seconds
     * @return bool
     */
    public function set(string $key, $data, int $seconds = 3600): bool
    {
        if ($seconds) {
            $content['data'] = $data;
            $content['end_time'] = time() + $seconds;

            if (file_put_contents(
                CACHE . '/' . md5($key) . '.txt',
                serialize($content)
            )) {
                return true;
            }
        }
        return false;
    }

    /**
     * получить кеш
     * @param string $kay
     * @return array|null
     */
    public function get(string $key): ?array
    {
        $file = CACHE . '/' . md5($key) . '.txt';

        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content;
            }
            unlink($file);
        }
        return null;
    }

    /**
     * удалить кеш
     * @param string $kay
     */
    public function delete(string $key): void
    {
        $file = CACHE . '/' . md5($key) . '.txt';

        if (file_exists($file)) {
            unlink($file);
        }
    }
}