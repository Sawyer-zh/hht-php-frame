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

PSR规范中没有做出规定，这里我们采用下划线分隔式` $under_score`

## 框架的使用方法

把你自己写的应用（程序）放在目录`App`里面。取一个项目名字，例如Admin。目录结构可以直接复制Home里面的内容。

### 访问项目的方式

```
http://localhost/index.php?a=项目名&c=控制器名&a=方法名
```

例如：

```
http://localhost/index.php?a=Home&c=Index&a=index
```

### 视图文件

放在目录：

```
App/Home/View
```

里面。

你可以在`View`文件夹里面创建任意子目录。例如我在View里面建立一个Header目录，里面放一个视图文件`index.php`。

#### 给视图文件传递变量

```php
class IndexController extends Controller {
    public function index () {
        $a = array('key1' => 'value1', 'key2' => 'value2');
        $this->render('Header/index.php', $a);
    }
}
```

那么，你就可以在`Header/index.php`视图文件中使用变量`$key1`和变量`$key2`了：

```html
<!DOCTYPE html>
<html>
<head>
	<title>Header index.php</title>
</head>
<body>
<?php echo $key1;?>
<?php echo $key2;?>
</body>
</html>
```

