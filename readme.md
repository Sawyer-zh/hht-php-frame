## 目录结构

```
hht-php-frame
|-App
  |-Home
    |-Conf
    |-Controller
      |-IndexController.php
    |-Model
    |-View
|-Data
|-HHTCore
  |-Common
    |-bootstrap.php
    |-function.php
  |-Controller
  |-Model
  
|-index.php
```

## 使用方法

把你自己写的应用（程序）放在目录`App`里面。取一个项目名字，例如Admin。目录结构可以直接复制Home里面的内容。

### 访问方法

例如：

```
http://localhost/index.php?a=Home&c=Index&a=index
```

