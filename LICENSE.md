

# php127/moredian-sdk


魔点考勤机 非钉版 php-sdk

官方文档
[https://open.moredian.com/#/doc/guide/sdk](https://open.moredian.com/#/doc/guide/sdk)


### 要求

1. php >= 7.4
2. Composer 2.x

### 安装

```shell
composer require php127/moredian-sdk -vvv
```



### 用法


```shell
use MoredianSDK\MoredianSDK;

$config = [
     'appId' => 'xxx',
     'appKey' => 'xxx',
     'orgId' => 'xxx',
     'orgAuthKey' => 'xxx'
 ];
    
$sdk = new MoredianSDK($config);

// post 接口
$list = $sdk->postJson('/magicube/app/listOrg',[
   'size' => 10,
   'offset' => 0
]);


// get 接口
$list = $sdk->get('/magicube/app/listOrg',[
   'xxx' => 
]);

        
```



### 替换缓存

默认使用redis缓存, 可以替换成其他缓存 需要有标准的 set get 方法

```shell

$redis = new Redis();

$redis->connect('127.0.0.1',6379);
$redis->auth('xxxx');
        
$sdk->setCache($redis);

       
```

### 参与贡献

1. fork 当前库到你的名下
3. 在你的本地修改完成审阅过后提交到你的仓库
4. 提交 PR 并描述你的修改，等待合并

### License

[MIT license](https://opensource.org/licenses/MIT)
