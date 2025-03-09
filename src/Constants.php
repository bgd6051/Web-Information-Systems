<?php

const API_KEY = "CG-i5ZrDDku6DdZnBin4k51Bwgs";

# WRONG REQUEST
const WRONG_REQUEST_CODE = 0;

# COINGECKO API DOMAINS AND PATHS
const GECKO_URL = "https://api.coingecko.com/api/v3/";
const AUTH_HEADER = ["Accepts: application/json"
                    ,"x-cg-demo-api-key:" . API_KEY];

# COINGECKO ENDPOINTS
const MAIN_COINS_ID = ["bitcoin", "ethereum", "ripple", "tether", "litecoin",
                        "bitcoin-cash", "eos", "tezos", "stellar", "cardano",
                        "dogecoin", "polkadot", "usd-coin", "uniswap", "binancecoin"];

const MAIN_COINS_ID_INT = [
    "bitcoin" => 1, 
    "ethereum" => 2, 
    "ripple" => 3, 
    "tether" => 4, 
    "litecoin" => 5,
    "bitcoin-cash" => 6, 
    "eos" => 7, 
    "tezos" => 8, 
    "stellar" => 9, 
    "cardano" => 10,
    "dogecoin" => 11, 
    "polkadot" => 12, 
    "usd-coin" => 13, 
    "uniswap" => 14, 
    "binancecoin" => 15
];

const EUR_CURRENCY = "?vs_currency=eur"; 

// /coins/markets?vs_currency={currency}&ids={coinId1},{coinId2},{coinId3}
const COINS_ID_FIRST_CALL = "bitcoin,ethereum,ripple,tether,litecoin,bitcoin-cash,eos,tezos";
const COINS_ID_SECOND_CALL = "stellar,cardano,dogecoin,polkadot,usd-coin,uniswap,binancecoin";

const COINS_MARKETS = "coins/markets";

const URL_COINS_MARKETS = GECKO_URL . COINS_MARKETS . EUR_CURRENCY . "&ids=";

// /coins/{coinId}/market_chart?vs_currency={currency}&days={numDays}
const COIN_MARKET_CHART = "/market_chart";
const CHART_DAYS = "&days=1";

const URL_COIN_CHART_FIRST_PART = GECKO_URL . "coins/";
const URL_COIN_CHART_SECOND_PART = COIN_MARKET_CHART . EUR_CURRENCY . CHART_DAYS;

// exchanges
const EXCHANGE_ENDPOINT = "exchanges";
const URL_EXCHANGE_INFO = GECKO_URL . EXCHANGE_ENDPOINT;

// trending
const TRENDING_ENDPOINT = "search/trending";
const URL_TRENDING_INFO = GECKO_URL . TRENDING_ENDPOINT;

# HTTP CODES
const HTTP_CODE_200 = 200;
const HTTP_CODE_400 = 400;
const HTTP_CODE_401 = 401;
const HTTP_CODE_404 = 404;
const HTTP_CODE_500 = 500;

# DB info
const HOST = "dbserver";
const USERNAME = "grupo70";
const PASSWORD = "zief4Meima";
const DATABASE = "db_grupo70";
