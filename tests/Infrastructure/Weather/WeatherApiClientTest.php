<?php

namespace WeatherProductRecommender\Tests\Infrastructure\Weather;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use WeatherProductRecommender\Infrastructure\Weather\WeatherFetcher;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherFetcherTest extends TestCase
{
    private HttpClientInterface $client;
    private WeatherFetcher $weatherFetcher;

    protected function setUp(): void
    {
        $mockResponse = new MockResponse(json_encode(['temperature' => 25]));
        $this->client = new MockHttpClient($mockResponse);

        $this->weatherFetcher = new WeatherFetcher($this->client);
    }

    public function testFetchWeather()
    {
        $weatherCondition = $this->weatherFetcher->fetchWeather('Paris');

        $this->assertEquals('Paris', $weatherCondition->city);
        $this->assertEquals(25, $weatherCondition->temperature);
    }
}
