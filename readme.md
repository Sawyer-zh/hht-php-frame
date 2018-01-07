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

## 框架的规范问题

### 类文件

每个类都独立为一个文件，且命名空间至少有一个层次

### 类的方法命名

方法的名称:必须一直使用`camelCase`这种驼峰式

### 类的属性命名

PSR中没有做出规定，这里我们采用下划线分隔式` $under_score`

## 框架的使用方法

把你自己写的应用（程序）放在目录`App`里面。取一个项目名字，例如Admin。目录结构可以直接复制Home里面的内容。

### 访问方法

例如：

```
http://localhost/index.php?a=Home&c=Index&a=index
```

