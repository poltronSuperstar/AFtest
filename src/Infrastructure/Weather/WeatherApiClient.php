<?php
namespace WeatherProductRecommender\Infrastructure\Weather;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use WeatherProductRecommender\Domain\Port\WeatherFetcherPort;
use WeatherProductRecommender\Domain\ValueObject\WeatherCondition;

class WeatherFetcher implements WeatherFetcherPort
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function fetchWeather(string $city): WeatherCondition
    {
        $response = $this->client->request('GET', 'http://api.weather.com', [
            'query' => ['city' => $city]
        ]);

        $data = $response->toArray();
        return new WeatherCondition($city, $data['temperature']);
    }
}
