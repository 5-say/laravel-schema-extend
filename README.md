laravel-schema-extend
=====================

- support MySQL 'column comment' and 'table comment'.
- 让 laravel 的 Schema 支持 MySQL “列注释”和“表注释”。

---

> **不会对官方源码照成任何影响。**  
> 继承随官方 schema，随源码更新。  


## 使用前的准备

在 composer.json 文件中申明依赖：

* support laravel 4.1.*
```json
"five-say/laravel-schema-extend": "1.*"
```

* support laravel 4.2.*（官方已支持 MySQL “列注释”，需要“表注释”的朋友还可以继续使用此插件）
```json
"five-say/laravel-schema-extend": "2.*"
```

* support laravel 5.0.*（官方已支持 MySQL “列注释”，需要“表注释”的朋友还可以继续使用此插件）
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

## 致谢

- [ghostboyzone](https://github.com/ghostboyzone)
- [xuhuan](https://github.com/xuhuan)
- [xiaobeicn](https://github.com/xiaobeicn)
