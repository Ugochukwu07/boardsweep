<?php

namespace Sample;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "ARotwUjYsxE_p5thYRMkHAkVJzakNyb0pcPUQodLip8MPb2EjeRxOIRnL73KYQzkGj3qnCFRd2HcSuoB";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EMdIcK1dl9XgS7fqEsmz2q9N-C_UCAgC5bi_MDwM9INIYzS79ZoRXvKwxY3H9AjiQL-zUzzWZxUT2gEk";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}