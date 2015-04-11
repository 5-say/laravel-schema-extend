laravel-schema-extend
=====================

- support MySQL 'column comment' and 'table comment'.
- 让 laravel 的 Schema 支持 MySQL “列注释”和“表注释”。

---

> **不会对官方源码照成任何影响。**  
> 随官方源码的更新，自动保持最新。  
> 官方后期若更新了新的功能，您都还可以正常使用。


## 使用前的准备

在 composer.json 文件中申明依赖：

* support laravel 4.1.*
```json
"five-say/laravel-schema-extend": "1.*"
```

* support laravel 4.2.*
```json
"five-say/laravel-schema-extend": "2.*"
```

* support laravel 5.0.*
```json
"five-say/laravel-schema-extend": "3.*"
```


在配置文件 `config/app.php` 中替换“别名”

```php
'aliases' => array(
    ...
    // 'Schema' => 'Illuminate\Support\Facades\Schema',
    'Schema'    => 'FiveSay\LaravelSchemaExtend\Facade',
),
```

## 使用方法

```php
Schema::create('tests', function ($table) {
    $table->increments('id')->comment('列注释');
    $table->comment = '表注释';
});
```
