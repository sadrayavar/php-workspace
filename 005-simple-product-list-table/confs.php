<?php

define("DB_NAME", "simple_shop_db");
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");

define("ALLOWED_KEYWORDS", ["title", "base_price", "sale_price", "state", "created_at", "stock", "discount"]);
define("SQL_INJECTION_CHARS", ["'", "\"", ";", "#", "\\", "%", "(", ")", "AND", "OR", "=", "UNION", ">", "<", "/", "*", "+"]);

define("PER_PAGE", 3);
