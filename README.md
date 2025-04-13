# 党团组织管理系统

> ⚠️ **特别说明**：这是一个大一时期的练手项目，代码质量和规范性都比较初级。变量命名和文件名主要使用拼音，不建议用于生产环境。这个项目更适合作为学习和改进的参考。

这是一个基于PHP开发的党团组织管理系统，用于管理党务、团务等相关工作。系统使用Tabler作为UI框架，提供现代化的用户界面。

## 项目说明

### 代码特点
- 使用原生PHP开发，没有使用框架
- 变量命名多用拼音（如：dygl.php 表示"党员管理"）
- 代码结构比较简单，适合PHP初学者学习
- 没有使用MVC架构，代码组织较为简单
- SQL语句直接写在PHP文件中，没有使用ORM
- 安全性考虑不够完善（如：SQL注入防护不足）

### 命名示例
```php
// 文件命名示例
dygl.php    -> 党员管理
jjfz.php    -> 积极分子
lsdy.php    -> 历史党员
tygl.php    -> 团员管理
zyzc.php    -> 志愿者管理

// 变量命名示例
$xingming   -> 姓名
$nianling   -> 年龄
$xuehao     -> 学号
$banji      -> 班级
```

## 数据库结构

### 数据库名：dangtuanzuzhi

#### 1. 党员表 (dangyuan)
```sql
CREATE TABLE `dangyuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuehao` varchar(20) NOT NULL COMMENT '学号',
  `xingming` varchar(50) NOT NULL COMMENT '姓名',
  `xingbie` varchar(10) NOT NULL COMMENT '性别',
  `banji` varchar(50) NOT NULL COMMENT '班级',
  `rudangshijian` date DEFAULT NULL COMMENT '入党时间',
  `zhuanzhengshijian` date DEFAULT NULL COMMENT '转正时间',
  `lianxidianhua` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

#### 2. 团员表 (tuanyuan)
```sql
CREATE TABLE `tuanyuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuehao` varchar(20) NOT NULL COMMENT '学号',
  `xingming` varchar(50) NOT NULL COMMENT '姓名',
  `xingbie` varchar(10) NOT NULL COMMENT '性别',
  `banji` varchar(50) NOT NULL COMMENT '班级',
  `rutuanshijian` date DEFAULT NULL COMMENT '入团时间',
  `lianxidianhua` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

#### 3. 积极分子表 (jijifenzi)
```sql
CREATE TABLE `jijifenzi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xuehao` varchar(20) NOT NULL COMMENT '学号',
  `xingming` varchar(50) NOT NULL COMMENT '姓名',
  `banji` varchar(50) NOT NULL COMMENT '班级',
  `kaishishijian` date DEFAULT NULL COMMENT '开始培养时间',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

#### 4. 用户表 (users)
```sql
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `role` int(11) DEFAULT '0' COMMENT '角色',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

### 示例SQL语句

#### 插入测试数据
```sql
-- 插入管理员账号
INSERT INTO users (username, password, role) VALUES 
('admin', md5('123456'), 1);

-- 插入党员数据
INSERT INTO dangyuan (xuehao, xingming, xingbie, banji, rudangshijian) VALUES 
('2021001', '张三', '男', '计算机2101', '2022-06-01');

-- 插入团员数据
INSERT INTO tuanyuan (xuehao, xingming, xingbie, banji, rutuanshijian) VALUES 
('2021002', '李四', '女', '计算机2102', '2021-09-01');
```

## 常用操作示例

### 登录验证
```php
// login.php 中的登录验证代码示例
$username = $_POST['username'];
$password = md5($_POST['password']);
$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysql_query($sql);
```

### 数据查询
```php
// dygl.php 中的党员查询代码示例
$sql = "SELECT * FROM dangyuan WHERE status=1";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
    echo $row['xingming'];
}
```

## 改进建议

1. 代码规范化
   - 使用规范的英文变量命名
   - 采用PSR编码规范
   - 添加适当的注释

2. 安全性提升
   - 使用PDO或mysqli替代mysql扩展
   - 添加SQL注入防护
   - 加强密码加密方式
   - 添加XSS防护

3. 架构优化
   - 采用MVC架构
   - 使用composer管理依赖
   - 添加配置文件
   - 实现日志记录

4. 功能完善
   - 添加数据导出功能
   - 完善用户权限管理
   - 添加数据备份功能
   - 优化用户界面

## 项目结构

```
WWW/
├── admin/           # 管理员模块
│   ├── class.php
│   ├── index.php
│   └── menu.php
├── controller/      # 控制器
│   ├── .config
│   └── logincont.php
├── dwgl/           # 党务管理模块
│   ├── dygl.php    # 党员管理
│   ├── index.php
│   ├── jjfz.php    # 积极分子
│   ├── lsdy.php    # 历史党员
│   ├── menu.php
│   └── tuiyou.php  # 退休管理
├── twgl/           # 团务管理模块
│   ├── index.php
│   ├── menu.php
│   ├── shyk.php    # 社会实践
│   ├── tuiyou.php  # 退休管理
│   ├── tygl.php    # 团员管理
│   └── zyzc.php    # 志愿者管理
├── tzs/            # 通知书模块
├── photo/          # 图片资源
├── sub/            # 公共组件
├── tabler/         # Tabler UI框架
├── index.php       # 首页
├── login.php       # 登录页
└── logout.php      # 退出登录
```

## 技术栈

- 后端：原生PHP（无框架）
- 前端框架：[Tabler](https://tabler.io/)
- 数据库：MySQL
- Web服务器：Apache/Nginx

## 安装说明

1. 确保您的服务器已安装PHP环境（建议PHP 5.6+）
2. 将项目文件上传到网站根目录
3. 设置数据库
4. 修改数据库连接配置（在 controller/.config 中）
5. 访问网站首页即可使用

默认管理员账号：
- 用户名：admin
- 密码：123456

## 注意事项

- 这是一个练手项目，不建议直接用于生产环境
- 代码质量和安全性需要大幅提升
- 建议在使用前进行代码审查和优化
- 如果要在生产环境使用，请务必进行安全加固

