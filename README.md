# 01.02 | System | Module Mortor CMI | Feature กรอกข้อมูลการสั่งซื้อ พ.ร.บ.

### การตั้งค่าระบบเบื้องต้น

1. ตั้งค่า environment จากไฟล์ index.php

    ```php
    define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
    ```

2. ตั้งค่า config จากไฟล์ application/config/development/config.php

    ```php
    $config['base_url'] = 'http://www.domain.com';
    ```

### ตัวอย่างการกรอกข้อมูลการสั่งซื้อ พ.ร.บ.

https://demo.360innovative.com/2019/viriyah/cmi/placing_order