<?php

const API_KEY = "CG-i5ZrDDku6DdZnBin4k51Bwgs";

# WRONG REQUEST
const WRONG_REQUEST_CODE = 0;

# COINGECKO API DOMAINS AND PATHS
const GECKO_URL = "https://api.coingecko.com/api/v3/";
const AUTH_HEADER = "x-cg-demo-api-key: CG-i5ZrDDku6DdZnBin4k51Bwgs";

# COINGECKO ENDPOINTS

const MAIN_COINS_ID = ["bitcoin","ethereum","xrp","tether","litecoin",
                        "bitcoin-cash","eos","tezos","stellar","cardano",
                        "dogecoin","polkadot","usd-coin","uniswap","binancecoin",
                        "chainlink","wrapped-bitcoin","bitcoin-sv","cosmos","aave",
                        "monero","tron","nem","vechain","theta-token","neo",
                        "dash","ethereum-classic","maker","compound","ftx-token"];
                        
const USD_CURRENCY = "?vs_currency=usd";
const EUR_CURRENCY = "?vs_currency=eur";

const COIN_ENDPOINT = "coins";

// /coins/list (get all coins)
const COIN_LIST = COIN_ENDPOINT . "/list";

// /coins/markets?vs_currency={currency}&ids={coinId1},{coinId2},{coinId3}
const COIN_PRICE = COIN_ENDPOINT . "/markets";

// /coins/{coinId}/market_chart?vs_currency={currency}&days={numDays}
const COIN_CHART = "/market_chart";
const CHART_DAYS = "&days=3";

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