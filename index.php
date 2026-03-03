<?php

/**
 * 這是一個動態預覽檔案。
 * 您可以執行 `php -S localhost:8000` 然後訪問 http://localhost:8000/index.php
 * 來即時查看您的履歷變更。
 */

// 1. 載入資料
$data = require __DIR__ . '/config/resume.php';

// 2. 模擬 Blade 模板渲染 (簡單替換邏輯或直接載入)
// 為了簡化，我們直接讀取模板並手動處理變數，或者直接產出 HTML。
// 這裡我們直接使用產出的 index.html 作為同步對象是最保險的。

if (file_exists(__DIR__ . '/index.html')) {
    include __DIR__ . '/index.html';
} else {
    echo "<h1>尚未產出 index.html</h1>";
    echo "<p>請在終端機執行: <code>php application resume:export</code></p>";
}
